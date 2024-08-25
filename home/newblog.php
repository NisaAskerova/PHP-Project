<?php
include_once "../config/database.php";
include_once "../helper/helper.php";
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
        WHERE b.is_publish=1
    ORDER BY 
        b.created_at DESC
        LIMIT 5
";

$result = $connection->prepare($sql);
$result->execute();
$blogs = $result->fetchAll(PDO::FETCH_ASSOC);
?>
<div class="main">
    <h2>New blogs</h2>
    <div class="blogList">
        <?php if ($blogs): ?>
            <?php foreach ($blogs as $blog): ?>
                <a href="http://localhost/final-project-php/client/blog/detail.php?id=<?= htmlspecialchars($blog['blog_id']); ?>">
                    <div class="blogItem">
                        <?php if ($blog['blog_profile_image']): ?>
                            <img src="../public/<?= htmlspecialchars($blog['blog_profile_image']); ?>" alt="Blog Image" style="max-width:200px;">
                        <?php endif; ?>
                        <div class="title">
                            <h3><?= htmlspecialchars(substr($blog['blog_title'], 0, 20)) . "..." ?></h3>
                            <p><?= htmlspecialchars(substr($blog['blog_description'], 0, 40)); ?></p>
                            <p><?= htmlspecialchars($blog['category_name']); ?></p>
                            <p><?= htmlspecialchars($blog['blog_created_at']); ?></p>
                            <p><strong>Views:</strong> <?= htmlspecialchars($blog['blog_view_count']); ?></p>
                            <p><?= htmlspecialchars($blog['user_name']); ?></p>
                        </div>
                    </div>
                </a>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No blogs found.</p>
        <?php endif; ?>
    </div>
</div>