<?php
$table = '       <table>
            <tr>
                <th>id</th>
                <th>Название</th>
                <th>Дата события</th>
                <th>Точность</th>
                <th>Кр. описание</th>
                <th>Описание</th>
                <th>Дата создания</th>
                <th>Дата обновления</th>
                <th>Опубликован</th>
                <th>Архив</th>
                <th>Действия</th>
            </tr>';
 $table2 = $table;

foreach ($current_posts as $post) {
        $table .= "<tr>
        <td>{$post['id']}</td>
        <td>{$post['title']}</td>
        <td>{$post['event_date']}</td>
        <td>{$post['accuracy']}</td>
        <td>{$post['summary']}</td>
        <td>{$post['content']}</td>
        <td>{$post['created_at']}</td>
        <td>{$post['updated_at']}</td>
        <td>{$post['status']}</td>
        <td>{$post['archive']}</td>
        <td> <a href='/lgn/crud-posts.php/edit/{$post['id']}'>Редактировать</a><a href='/lgn/crud-posts.php/delete/{$post['id']}' onclick='return confirm({$post['id']})' class='error'>Удалить</a></td></tr>";
}
foreach ($archive_posts as $post) {
    $table2 .= "<tr>
    <td>{$post['id']}</td>
    <td>{$post['title']}</td>
    <td>{$post['event_date']}</td>
    <td>{$post['accuracy']}</td>
    <td>{$post['summary']}</td>
    <td>{$post['content']}</td>
    <td>{$post['created_at']}</td>
    <td>{$post['updated_at']}</td>
    <td>{$post['status']}</td>
    <td>{$post['archive']}</td>
    <td> <a href='/lgn/crud-posts.php/edit/{$post['id']}'>Редактировать</a><a href='/lgn/crud-posts.php/delete/{$post['id']}' onclick='return confirm({$post['id']})' class='error'>Удалить</a></td></tr>";
}




?>

<div class="flex">
    <div class="posts current-posts">
    <h2>Текущие посты</h2>
          <?php 
    echo $table;
?>
</table>
    </div>
    <div class="posts archive-posts">
        <h2>Архив</h2>
    </div>
    <?php 
    echo $table2;
?>

    </div>

