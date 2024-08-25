<?php
include "../../index.php";
if(isset($_GET['id'])){
    $sql="DELETE FROM categories WHERE id=?";
    $deleteQuery=$connection->prepare($sql);
    $deleteQuery->execute([
        $_GET['id']
    ]);
    view(route('admin/category/category.php'));
}