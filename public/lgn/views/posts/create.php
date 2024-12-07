<h1>Добавить пост</h1>
<form action="/lgn/crud-posts.php/add" method="POST">
<div class="input">
    <input type="text" name="title" placeholder="Название">
</div>
<div class="input">
    <input type="datetime-local" name="event_date" id="">
</div>
<div class="input">
    <input type="text" name="accuracy" placeholder="Точность прогноза %">
</div>
<div class="input">
    <textarea name="summary" id="" placeholder="Краткое описание"></textarea>
</div>
<div class="input">
    <textarea name="content" id="" placeholder="Описание"></textarea>
</div>
<div class="input">
    <label for="status">Опубликован</label>
    <input type="checkbox" name="status" id="status" checked>
</div>
<div class="input">
    <label for="archive">Архив</label>
    <input type="checkbox" name="archive" id="status">
</div>

<button>Добавить</button>

</form>