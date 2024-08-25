<?php
include "../../index.php";

$categoryId = $_GET['id'] ?? null;

if (!$categoryId) {
    view(route('admin/category/category.php'));
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $categoryName = $_POST['category_name'] ?? '';

    $sql = "UPDATE categories SET name = ? WHERE id = ?";
    $updateQuery = $connection->prepare($sql);
    $updateQuery->execute([$categoryName, $categoryId]);

    $_SESSION['update_success'] = "Category updated successfully.";
    view(route('admin/category/category.php'));
} else {
    $sql = "SELECT * FROM categories WHERE id = ?";
    $selectQuery = $connection->prepare($sql);
    $selectQuery->execute([$categoryId]);
    $category = $selectQuery->fetch(PDO::FETCH_ASSOC);

    if (!$category) {
        view(route('admin/category/category.php'));
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Category</title>
    <style>
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            font-weight: bold;
        }
        .form-group input {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
        }
        button {
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="hero">
        <h2>Edit Category</h2>
        <form action="" method="POST">
            <div class="form-group">
                <label for="category_name">Category Name</label>
                <input type="text" name="category_name" id="category_name" value="<?= htmlspecialchars($category['name']) ?>" required>
            </div>
            <button type="submit">Update</button>
        </form>
    </div>
</body>
</html>
