<?php
include '../../index.php';

$sql = "
    SELECT 
        c.name AS category_name,
        COUNT(b.id) AS blog_count
    FROM 
        categories c
    LEFT JOIN 
        blogs b ON c.id = b.category_id AND b.is_publish = 1
    GROUP BY 
        c.id, c.name
    ORDER BY 
        blog_count DESC
";

$result = $connection->prepare($sql);
$result->execute();
$categories = $result->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category Blog Counts</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .main {
            width: 80%;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            color: #333;
            border-bottom: 2px solid #007BFF;
            padding-bottom: 10px;
        }
        .categoryList {
            margin: 20px 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #007BFF;
            color: #fff;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <div class="hero">
        <h2>Blog Count by Category</h2>
        <div class="categoryList">
            <?php if ($categories): ?>
                <table>
                    <thead>
                        <tr>
                            <th>Category Name</th>
                            <th>Number of Blogs</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($categories as $category): ?>
                            <tr>
                                <td><?= htmlspecialchars($category['category_name']); ?></td>
                                <td><?= htmlspecialchars($category['blog_count']); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p>No categories found.</p>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
