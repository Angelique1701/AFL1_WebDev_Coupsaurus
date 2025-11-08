<?php
require_once 'config.php';
require_once 'model_User.php';

$userModel = new UserModel();
$userModel->logout();

header('Location: login.php');
exit();
?>
