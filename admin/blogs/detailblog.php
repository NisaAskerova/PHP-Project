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
            b.is_publish AS blog_is_publish,
            c.name AS category_name,
            u.name AS user_name,
            u.id AS user_id,
            u.role AS user_role
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

$current_user_id = $_SESSION['id'];
?>
<style>

.main {
    max-width: 800px;
    margin: 20px auto;
    padding: 20px;
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.blogDetail {
    margin-bottom: 20px;
}

.blogDetail img {
    display: block;
    margin: 0 auto 20px;
    border-radius: 10px;
    max-width: 100%;
    height: auto;
}

.blogDetail h2 {
    font-size: 28px;
    color: #333;
    margin-bottom: 10px;
}

.blogDetail p {
    font-size: 16px;
    color: #555;
    line-height: 1.6;
}

.blogDetail p strong {
    color: #333;
}

.actions {
    margin-top: 20px;
    display: flex;
    gap: 10px;
}

.actions a {
    text-decoration: none;
}

.actions button {
    padding: 10px 20px;
    font-size: 16px;
    color: #fff;
    background-color: #007bff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.actions button:hover {
    background-color: #0056b3;
}

.actions button.deactivate {
    background-color: #dc3545;
}

.actions button.deactivate:hover {
    background-color: #c82333;
}

</style>


    <div class="hero">
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

