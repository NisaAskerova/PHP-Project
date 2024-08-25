<?php
include '../../index.php';
if(isset($_GET['id'])){
    $sql="DELETE FROM blogs WHERE id=?";
    $deleteQuery=$connection->prepare($sql);
    $deleteQuery->execute([
        $_GET['id']
    ]);
    view(route('client/blog/myblogs.php'));}