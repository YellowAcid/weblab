<?php
require_once 'operationWithDataBase.php';
$tmp = respond($_GET["id"]);
header('Location: /index.php');