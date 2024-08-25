<?php
include '../../index.php';

$startOfMonth = date('Y-m-01');
$endOfMonth = date('Y-m-t');

$sql = "
    SELECT 
        b.id AS blog_id,
        b.title AS blog_title,
        b.description AS blog_description,
        b.profile AS blog_profile_image,
        b.created_at AS blog_created_at,
        b.view_count AS blog_view_count,
        c.name AS category_name,
        u.name AS user_name
    FROM 
        blogs b
    JOIN 
        categories c ON b.category_id = c.id
    JOIN
        users u ON b.user_id = u.id
    WHERE
        b.is_publish = 1 AND b.created_at BETWEEN :startOfMonth AND :endOfMonth
    ORDER BY 
        b.created_at DESC
";

$result = $connection->prepare($sql);
$result->bindParam(':startOfMonth', $startOfMonth);
$result->bindParam(':endOfMonth', $endOfMonth);
$result->execute();
$blogs = $result->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blogs of the Month</title>
</head>
<body>
    <div class="hero">
        <h2>Blogs of the Month</h2>
        <div class="blogList">
            <?php if ($blogs): ?>
                <?php foreach ($blogs as $blog): ?>
                    <div class="blogItem">
                        <a href="http://localhost/final-project-php/admin/blogs/detailblog.php?id=<?= htmlspecialchars($blog['blog_id']); ?>">
                            <?php if ($blog['blog_profile_image']): ?>
                                <img src="../../public/<?= htmlspecialchars($blog['blog_profile_image']); ?>" alt="Blog Image" style="max-width:200px;">
                            <?php endif; ?>
                            <div class="title">
                                <h3><?= htmlspecialchars(substr($blog['blog_title'], 0, 20)) . "..." ?></h3>
                                <p><?= htmlspecialchars(substr($blog['blog_description'], 0, 40)); ?></p>
                                <p><?= htmlspecialchars($blog['category_name']); ?></p>
                                <p><?= htmlspecialchars($blog['blog_created_at']); ?></p>
                                <p><strong>Views:</strong> <?= htmlspecialchars($blog['blog_view_count']); ?></p>
                                <p><?= htmlspecialchars($blog['user_name']); ?></p>
                            </div>
                        </a>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No blogs found for this month.</p>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
