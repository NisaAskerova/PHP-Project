<?php
include '../../index.php';

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $blog_id = (int)$_GET['id'];

    $update_sql = "UPDATE blogs SET view_count = view_count + 1 WHERE id = :id";
    $stmt = $connection->prepare($update_sql);
    $stmt->bindParam(':id', $blog_id, PDO::PARAM_INT);
    $stmt->execute();

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
            b.id = :id
    ";
    $stmt = $connection->prepare($sql);
    $stmt->bindParam(':id', $blog_id, PDO::PARAM_INT);
    $stmt->execute();
    $blog = $stmt->fetch(PDO::FETCH_ASSOC);
} else {
    echo "Invalid blog ID.";
    exit;
}
?>


<body>
    <div class="main">
        <?php if ($blog): ?>
            <div class="blogDetail">
                <?php if ($blog['blog_profile_image']): ?>
                    <img src="../../public/<?= htmlspecialchars($blog['blog_profile_image']); ?>" alt="Blog Image" style="max-width:600px;">
                <?php endif; ?>
                <h2><?= htmlspecialchars($blog['blog_title']); ?></h2>
                <p><?= htmlspecialchars($blog['blog_description']); ?></p>
                <p><strong>Category:</strong> <?= htmlspecialchars($blog['category_name']); ?></p>
                <p><strong>Created at:</strong> <?= htmlspecialchars($blog['blog_created_at']); ?></p>
                <p><strong>Author:</strong> <?= htmlspecialchars($blog['user_name']); ?></p>
                <p><strong>Views:</strong> <?= htmlspecialchars($blog['blog_view_count']); ?></p>
            </div>
        <?php else: ?>
            <p>Blog not found.</p>
        <?php endif; ?>
    </div>
</body>
</html>
