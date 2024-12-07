<?php
require_once('classes/DB.php');
require_once('classes/User.php');


$database = new DB;
$db = $database->getConnection();
$user = new User($db);

$user->checkAuth();

require_once('controllers/Router.php');
require_once('routes/web.php');






?>
<?php include $_SERVER['DOCUMENT_ROOT']."/lgn/views/inc/header.inc.php"; ?>
<div class="wrapper">
    <?php if (!empty($_SESSION['info'])) : ?>
    <div class="info"><h1><? echo $_SESSION['info']; unset($_SESSION['info']); ?> </h1></div>
    <?php endif; ?>
<?php  route($uri,$routes); ?>
</div>
<?php include $_SERVER['DOCUMENT_ROOT']."/lgn/views/inc/footer.inc.php"; ?>
    





