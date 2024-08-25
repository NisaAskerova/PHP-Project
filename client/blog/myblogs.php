<?php
include '../../index.php';

$user_id = $_SESSION['id']; 

$sql = "
    SELECT 
        b.id AS blog_id,
        b.title AS blog_title,
        b.description AS blog_description,
        b.profile AS blog_profile_image,
        b.created_at AS blog_created_at,
        c.name AS category_name
    FROM 
        blogs b
    JOIN 
        categories c ON b.category_id = c.id
    WHERE
        b.user_id = :user_id
        AND b.is_publish = 1
    ORDER BY 
        b.created_at DESC
";

$result = $connection->prepare($sql);
$result->bindParam(':user_id', $user_id, PDO::PARAM_INT);
$result->execute();
$blogs = $result->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="main">
    <h2>Blog Listesi</h2>
    <div class="blogList">
        <?php if ($blogs): ?>
            <?php foreach ($blogs as $blog): ?>
                <div class="blogItem">
                    <?php if ($blog['blog_profile_image']): ?>
                        <img src="../../public/<?= htmlspecialchars($blog['blog_profile_image']); ?>" alt="Blog Image" style="max-width:200px;">
                    <?php endif; ?>
                    <div class="title">
                        <h3><?= htmlspecialchars(substr($blog['blog_title'], 0, 20))."..." ?></h3>
                        <p><?= htmlspecialchars(substr($blog['blog_description'], 0, 40)); ?></p>
                        <p><?= htmlspecialchars($blog['category_name']); ?></p>
                        <p><?= htmlspecialchars($blog['blog_created_at']); ?></p>
                    </div>
                    <a href="http://localhost/final-project-php/client/blog/update.php?id=<?= $blog['blog_id']; ?>"><button type="submit" class="update">Update</button></a>
                    <a href="http://localhost/final-project-php/client/blog/delete.php?id=<?= $blog['blog_id']; ?>"><button class="delete">Delete</button></a>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No blogs found.</p>
        <?php endif; ?>
    </div>
</div>
