<?php
require '../config/db.php';
if (!empty($_SESSION["user"])){
    $user = $conne->prepare("SELECT * FROM User WHERE id = ?");
    $user-> execute([$_SESSION["user"]]);
    $row = $user->fetch(PDO::FETCH_ASSOC);
} else {
    header("Location: ../");
}
?>