<h1>Редактировать пост <?php echo $post['title'] ?></h1>
<form action="/lgn/crud-posts.php/update" method="POST">
<div class="input">
    <input type="hidden" name="id" value="<?php echo $post['id'] ?>">
    <input type="text" name="title" placeholder="Название" value="<?php echo $post['title'] ?>">
</div>
<div class="input">
    <input type="datetime-local" name="event_date" value ="<?php echo $post['event_date'] ?>">
</div>
<div class="input">
    <input type="text" name="accuracy" placeholder="Точность прогноза %" value ="<?php echo $post['accuracy'] ?>">
</div>
<div class="input">
    <textarea name="summary" id="" placeholder="Краткое описание"><?php echo $post['summary'] ?></textarea>
</div>
<div class="input">
    <textarea name="content" id="" placeholder="Описание"><?php echo $post['content'] ?></textarea>
</div>
<div class="input">
    <label for="status">Опубликован</label>
    <?php if($post['status'] == 1): ?>
    <input type="checkbox" name="status" id="status" checked>
    <?php else : ?>
        <input type="checkbox" name="status" id="status"> 
    <?php endif; ?>   
</div>
<div class="input">
    <label for="archive">Архив</label>
    <?php if($post['archive'] == 1): ?>
    <input type="checkbox" name="archive" id="archive" checked>
    <?php else : ?>
        <input type="checkbox" name="archive" id="archive"> 
    <?php endif; ?>
</div>

<button>Обновить</button>

</form>