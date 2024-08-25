<?php
include "../../index.php";
$categories = [];
$categorySelect = $_SESSION['select_category'] ?? '';

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    
    $sql = "SELECT name FROM categories WHERE name = ?";
    $result = $connection->prepare($sql);
    $result->execute([$_POST["category"]]);
    $categories = $result->fetchAll(PDO::FETCH_ASSOC);
}
?>

<h2>Categories</h2>
<form action="" method="POST">
    <label for="category">Select category</label>
    <select name="category" id="category">
        <?php
        $sql = "SELECT name FROM categories";
        $result = $connection->prepare($sql);
        $result->execute();
        $allCategories = $result->fetchAll(PDO::FETCH_ASSOC);

        foreach ($allCategories as $cat) {
            echo '<option value="' . $cat['name'] . '"' . 
                 ($cat['name'] == $categorySelect ? ' selected' : '') . '>' . 
                $cat['name'] . '</option>';
        }
        ?>
    </select>
    <button type="submit">Submit</button>
</form>
