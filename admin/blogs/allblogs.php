<?php
include '../../index.php';
$page = empty($_GET['page']) ? 1 : $_GET['page'];
$limit = 2;
$startLimit = ($page - 1) * $limit;

$sqlTotal = "SELECT COUNT(*) FROM blogs";
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

if (isset($_GET['id']) && isset($_GET['status'])) {
    $blogId = (int)$_GET['id'];
    $status = (int)$_GET['status'];

    if ($status === 0 || $status === 1) {
        $sql = 'UPDATE blogs SET is_publish = ? WHERE id = ?';
        $stmt = $connection->prepare($sql);
        $stmt->execute([$status, $blogId]);

        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    } else {
        echo 'Invalid status.';
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
        b.is_publish AS blog_is_publish,
        c.name AS category_name,
        u.name AS user_name
    FROM 
        blogs b
    JOIN 
        categories c ON b.category_id = c.id
    JOIN
        users u ON b.user_id = u.id
    ORDER BY 
        b.created_at DESC
         LIMIT $startLimit, $limit
";

$result = $connection->prepare($sql);
$result->execute();
$blogs = $result->fetchAll(PDO::FETCH_ASSOC);
?>
<style>
    table {
        width: 100%;
        border-collapse: collapse;
    }

    th,
    td {
        padding: 12px;
        text-align: left;
    }

    th {
        background-color: #f2f2f2;
        font-weight: bold;
    }

    tr:nth-child(even) {
        background-color: #f9f9f9;
    }

    .actions button,
    .viewBtn {
        padding: 6px 12px;
        background-color: #007bff;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    .actions button:hover,
    .viewBtn:hover {
        background-color: #0056b3;
    }

    .blog-image {
        max-width: 100px;
    }
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

<div class="hero">
    <h2>All Blogs</h2>
    <table>
        <thead>
            <tr>
                <th>Image</th>
                <th>Title</th>
                <th>Description</th>
                <th>Category</th>
                <th>Created At</th>
                <th>Views</th>
                <th>Author</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($blogs): ?>
                <?php foreach ($blogs as $blog): ?>
                    <tr>
                        <td>
                            <?php if ($blog['blog_profile_image']): ?>
                                <img src="../../public/<?= htmlspecialchars($blog['blog_profile_image']); ?>" alt="Blog Image" class="blog-image">
                            <?php endif; ?>
                        </td>
                        <td><?= htmlspecialchars(substr($blog['blog_title'], 0, 20)) . "..." ?></td>
                        <td><?= htmlspecialchars(substr($blog['blog_description'], 0, 40)); ?></td>
                        <td><?= htmlspecialchars($blog['category_name']); ?></td>
                        <td><?= htmlspecialchars($blog['blog_created_at']); ?></td>
                        <td><?= htmlspecialchars($blog['blog_view_count']); ?></td>
                        <td><?= htmlspecialchars($blog['user_name']); ?></td>
                        <td class="actions">
                            <?php if ($blog['blog_is_publish']): ?>
                                <a href="?id=<?= $blog['blog_id']; ?>&status=0">
                                    <button type="button">Deactivate</button>
                                </a>
                            <?php else: ?>
                                <a href="?id=<?= $blog['blog_id']; ?>&status=1">
                                    <button type="button">Activate</button>
                                </a>
                            <?php endif; ?>
                        </td>
                        <td>
                            <a href="http://localhost/final-project-php/admin/blogs/detailblog.php?id=<?= htmlspecialchars($blog['blog_id']); ?>">
                                <button class="viewBtn">View</button>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td>No blogs found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
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