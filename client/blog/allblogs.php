<?php
include '../../index.php';

$page = empty($_GET['page']) ? 1 : $_GET['page'];
$limit = 2;
$startLimit = ($page - 1) * $limit;

$sqlTotal = "SELECT COUNT(*) FROM blogs WHERE is_publish = 1";
$resultTotal = $connection->prepare($sqlTotal);
$resultTotal->execute();
$totalRecord = $resultTotal->fetchColumn();

$pageNumber = ceil($totalRecord / $limit);

$paginationRange = 3;
$startPage = max(1, $page - floor($paginationRange / 2));
$endPage = min($pageNumber, $page + floor($paginationRange / 2));

if ($endPage - $startPage + 1 < $paginationRange) {
    if ($startPage > 1) {
        $startPage = max(1, $endPage - $paginationRange + 1);
    } else {
        $endPage = min($pageNumber, $startPage + $paginationRange - 1);
    }
}

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
        b.is_publish = 1
    ORDER BY 
        b.created_at DESC
    LIMIT $startLimit, $limit
";

$result = $connection->prepare($sql);
$result->execute();
$blogs = $result->fetchAll(PDO::FETCH_ASSOC);
?>
<style>
    .pagination {
    display: flex;
    justify-content: center;
    margin-top: 20px;
}

.pagination a {
    color: #007bff;
    padding: 10px 15px;
    margin: 0 5px;
    text-decoration: none;
    border: 1px solid #ddd;
    border-radius: 5px;
    transition: background-color 0.3s, color 0.3s;
}

.pagination a:hover {
    background-color: #007bff;
    color: #fff;
}

.pagination a.active {
    background-color: #007bff;
    color: #fff;
    border-color: #007bff;
    font-weight: bold;
}

</style>

<div class="main">
    <h2>All Blogs</h2>
    <div class="blogList">
        <?php if ($blogs): ?>
            <?php foreach ($blogs as $blog): ?>
                <div class="blogItem">
                    <a href="http://localhost/final-project-php/client/blog/detail.php?id=<?= htmlspecialchars($blog['blog_id']); ?>">
                        <?php if ($blog['blog_profile_image']): ?>
                            <img src="../../public/<?= htmlspecialchars($blog['blog_profile_image']); ?>" alt="Blog Image" style="max-width:200px;">
                        <?php endif; ?>
                        <div class="title">
                            <h3><?= htmlspecialchars(substr($blog['blog_title'], 0, 20)) . "..."; ?></h3>
                            <p><?= htmlspecialchars(substr($blog['blog_description'], 0, 40)) . "..."; ?></p>
                            <p><?= htmlspecialchars($blog['category_name']); ?></p>
                            <p><?= htmlspecialchars($blog['blog_created_at']); ?></p>
                            <p><strong>Views:</strong> <?= htmlspecialchars($blog['blog_view_count']); ?></p>
                            <p><?= htmlspecialchars($blog['user_name']); ?></p>
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No blogs found.</p>
        <?php endif; ?>
    </div>
    <div class="pagination">
        <?php if ($page > 1): ?>
            <a href="?page=<?= $page - 1; ?>">Prev</a>
        <?php endif; ?>

        <?php for ($i = $startPage; $i <= $endPage; $i++): ?>
            <a href="?page=<?= $i; ?>" class="<?= $i == $page ? 'active' : ''; ?>"><?= $i; ?></a>
        <?php endfor; ?>

        <?php if ($page < $pageNumber): ?>
            <a href="?page=<?= $page + 1; ?>">Next</a>
        <?php endif; ?>
    </div>
</div>
