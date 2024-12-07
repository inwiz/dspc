<?php
  require_once $_SERVER['DOCUMENT_ROOT'].'/lgn/classes/Post.php';
  require_once $_SERVER['DOCUMENT_ROOT'].'/lgn/classes/DB.php';


class Router {


   public $database;
   public  $db;

    public function __construct() {
        $this->database = new DB();
        $this->db = $this->database->getConnection();
    }



    function index() {
        $post = new Post($this->db);
        $current_posts = $post->getCurrentPosts();
        $archive_posts = $post->getArchivePosts();
   
        ob_start();
        include $_SERVER['DOCUMENT_ROOT'].'/lgn/views/posts/index.php';
        echo ob_get_clean();
    
    }

    function create() {
        ob_start();
        include $_SERVER['DOCUMENT_ROOT'].'/lgn/views/posts/create.php';
        echo ob_get_clean();

    }

    function store() {
        // print_r($_POST);
        $post = new Post($this->db);
        $post->create($_POST);
    }


    function postEdit($id) {
        $post = new Post($this->db);
        $post = $post->findPost($id);

        ob_start();
        include $_SERVER['DOCUMENT_ROOT'].'/lgn/views/posts/edit.php';
        echo ob_get_clean();
    }

 function postUpdate() {
    $post = new Post($this->db);
    $post->update($_POST);
 }

function postDelete($id) {
    $post = new Post($this->db);
    $post->remove($id);
}

    function logout() {
        session_start();
        session_unset();
        session_destroy();
        header('Location: /');
        exit();   
    }




function getPublicPostsJSON() {
    $post = new Post($this->db);
    $posts = $post->getPublicCurrentPosts();
    ob_start();
    include $_SERVER['DOCUMENT_ROOT'].'/lgn/views/json/json.php';
    echo ob_get_clean();
}


function getPublicPostsArchiveJSON() {
    $post = new Post($this->db);
    $posts = $post->getPublicArchivePosts();
    ob_start();
    include $_SERVER['DOCUMENT_ROOT'].'/lgn/views/json/json.php';
    echo ob_get_clean();
}



}