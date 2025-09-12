<?php
require_once 'model.php';

$model = new model();

$controller = $_GET['controller']??'agency';
$action = $_GET