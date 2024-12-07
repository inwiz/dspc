<?php


class Post {

private static $conn;
private $table_name = 'posts';

public $id;
public $status;
public $archive = 0;
public $event_date;
public $accuracy = null;
public $title;
public $summary;
public $content;
public $created_at;
public $updated_at;




function __construct($db)
{
    if (!self::$conn) {
        $this->conn = $db;
    }
  
}


function getDateForDatabase(string $date): string {
    $timestamp = strtotime($date);
    $date_formated = date('Y-m-d H:i:s', $timestamp);
    return $date_formated;
}



function create($request) {

    $this->title =   trim(htmlspecialchars(strip_tags($request['title'])));
    $this->event_date = $this->getDateForDatabase(htmlspecialchars(strip_tags($request['event_date'])));
    $this->summary = trim(htmlspecialchars(strip_tags($request['summary'])));
    $this->content = trim(htmlspecialchars(strip_tags($request['content'])));
    $accuracy = trim(htmlspecialchars(strip_tags($request['accuracy'])));

    if (isset($request['status'])) {
        $this->status = 1;
    }
    else {
        $this->status = 0;
    }
    if (isset($request['archive'])) {
        $this->archive = 1;
    }
    else {
        $this->archive = 0;
    }
    $accuracy = empty($accuracy) ? 0 : $accuracy;

    $this->created_at = date('Y-m-d H:i:s');
    $this->updated_at = date('Y-m-d H:i:s');

    $sql = "INSERT INTO `{$this->table_name}`
     (`title`,
     `event_date`,
     `summary`,
     `content`, 
     `status`, 
     `archive`, 
     `accuracy`, 
     `created_at`,
     `updated_at`) 
    VALUES (
    '$this->title',
    '$this->event_date',
    '$this->summary',
    '$this->content',
    '$this->status',
    '$this->archive',
    '$accuracy',
    '$this->created_at',
    '$this->updated_at'
    )";
    if ($this->conn->query($sql) === TRUE) {
        $_SESSION['info'] = "Новый пост создан: ". $this->title;
        
        header("Location: /lgn/crud-posts.php");
        exit; 
        
      } else {
        echo "Error: " . $sql . "<br>" . $this->conn->error;
      }

}



function update($request) {
  
    print_r($request);
 

    $this->title =   trim(htmlspecialchars(strip_tags($request['title'])));
    $this->event_date = $this->getDateForDatabase(htmlspecialchars(strip_tags($request['event_date'])));
    $this->summary = trim(htmlspecialchars(strip_tags($request['summary'])));
    $this->content = trim(htmlspecialchars(strip_tags($request['content'])));
    $accuracy = trim(htmlspecialchars(strip_tags($request['accuracy'])));

    $this->id = trim(htmlspecialchars(strip_tags($request['id'])));
    $this->updated_at = date('Y-m-d H:i:s');
   
  
    if (isset($request['status'])) {
        $this->status = 1;
    }
    else {
        $this->status = 0;
    }
    if (isset($request['archive'])) {
        $this->archive = 1;
    }
    else {
        $this->archive = 0;
    }


    $accuracy = empty($accuracy) ? 0 : $accuracy;

    print_r($accuracy.'ssssssssss');
    $sql = "UPDATE `posts` 
    SET 
    `title`='$this->title',
    `event_date`='$this->event_date',
    `summary`='$this->summary',
    `content`='$this->content',
    `accuracy`='$accuracy',
    `status`='$this->status',
    `archive`='$this->archive',
    `updated_at`='$this->updated_at' 
    WHERE `id` = '$this->id'";
       if ($this->conn->query($sql) === TRUE) {
        $_SESSION['info'] ="Пост обновлен: ". $this->title;
        header("Location: /lgn/crud-posts.php");
        exit; 
        
      } else {
        echo "Error: " . $sql . "<br>" . $this->conn->error;
      }
}

function remove($id) {
    $sql = "DELETE FROM `posts` WHERE id='$id'";
    if ($this->conn->query($sql) === TRUE) {
       $_SESSION['info'] = "Пост c id: ". $this->id.' удален' ;
        header("Location: /lgn/crud-posts.php");
        exit; 
        
      } else {
        echo "Error: " . $sql . "<br>" . $this->conn->error;
      }


   
}


function russianDateFormat($mysql_date) {
    $date = date('d.m.Y',strtotime($mysql_date));
    return $date;
}



function getPublicCurrentPosts() {
    $posts = [];
    $sql = "SELECT * FROM `{$this->table_name}` WHERE `archive` = 0 AND `status` = 1 ORDER BY `event_date` ASC";
    $result = $this->conn->query($sql);




    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {

            $id = $row['id'];

            if ($this->checkPostToArchive($row['event_date'],$id)) {
                 continue;
            }


            if (empty($row['accuracy']) || $row['accuracy'] == 0) {
                $row['accuracy'] = 'неизвестно';
            }
            else {
                $row['accuracy'] = $row['accuracy'].'%';
            }
            $row['event_date'] = $this->dateTimeToISO8601($row['event_date']);
            $row['textDate'] = $this->russianDateFormat($row['event_date']);


        $posts[] = $row;
        }
    }
    return $posts;
}

function getCurrentPosts() {
    $posts = [];
    $sql = "SELECT * FROM `{$this->table_name}` WHERE `archive` = 0 ORDER BY `event_date` ASC";
    $result = $this->conn->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
        $posts[] = $row;
        }
    }
    return $posts;
}

function getPublicArchivePosts() {
    $posts = [];
    $sql = "SELECT * FROM `{$this->table_name}` WHERE `archive` = 1 AND `status` = 1 ORDER BY `event_date` ASC";
    $result = $this->conn->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            if (empty($row['accuracy']) || $row['accuracy'] == 0) {
                $row['accuracy'] = 'неизвестно';
            }
            else {
                $row['accuracy'] = $row['accuracy'].'%';
            }
            $row['event_date'] = $this->dateTimeToISO8601($row['event_date']);
            $row['textDate'] = $this->russianDateFormat($row['event_date']);


        $posts[] = $row;
        }
    }
    return $posts;
}

function getArchivePosts() {
    $posts = [];
    $sql = "SELECT * FROM `{$this->table_name}` WHERE `archive` = 1 ORDER BY `event_date` ASC";
    $result = $this->conn->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
        $posts[] = $row;
        }
    }
    return $posts;
}


function dateTimeToISO8601($inputDate) {
    $date = new DateTime($inputDate);
    return $date->format('Y-m-d\TH:i');
}


function findPost($id)  {
    $sql = "SELECT * FROM `posts` WHERE `id` = '$id'";
    $result = $this->conn->query($sql);
     $row = $result->fetch_assoc();
     $row['event_date'] = $this->dateTimeToISO8601($row['event_date']);
    return $row;
}



function checkPostToArchive($post_date,$id)  {
    $today = strtotime(date('Y-m-d H:i:s'));
    $post_date_unix = strtotime($post_date); 
    if ($today >= $post_date_unix) {
        $this->addPostToArchive($id); return true;
    }
    return false;
}

function addPostToArchive($id) {
    $sql = "UPDATE `posts` SET `archive` = 1 WHERE `id`='$id'";
    $result = $this->conn->query($sql);
}


}