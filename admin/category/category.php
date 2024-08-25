<?php
include "../../index.php";
$page = empty($_GET['page']) ? 1 : $_GET['page'];
$limit = 2;
$startLimit = ($page - 1) * $limit;

$sqlTotal = "SELECT COUNT(*) FROM categories";
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


$categorySelect = $_POST['category'] ?? null;
$sql = "SELECT * FROM categories ORDER BY id DESC  LIMIT $startLimit, $limit";
$categoriesQuery = $connection->prepare($sql);
$categoriesQuery->execute();
$categories = $categoriesQuery->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $sql = "INSERT INTO categories (name) VALUES (?)";
    $insertQuery = $connection->prepare($sql);
    $insertQuery->execute([post('categories')]);

    $_SESSION['select_category'] = post('categories');
    view(route('admin/category/category.php'));
}
?>

    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
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
        .actions button {
            padding: 6px 12px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .actions button:hover {
            background-color: #0056b3;
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
    <h2>Add Categories</h2>
    <form action="" method="POST">
        <label for="categories">Categories</label>
        <input type="text" name="categories" id="categories" required>
        <button type="submit">Add</button>
    </form>

    <div style="margin-top: 30px;">
        <h2>List Categories</h2>
        <table>
            <thead>
                <tr>
                    <th>Category ID</th>
                    <th>Category Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($categories as $category): ?>
                    <tr>
                        <td><?php echo $category['id'] ?></td>
                        <td><?php echo htmlspecialchars($category['name']) ?></td>
                        <td class="actions">
                            <a href="http://localhost/final-project-php/admin/category/edit.php?id=<?= $category['id']; ?>"><button>Edit</button></a>
                            <a href="http://localhost/final-project-php/admin/category/delete.php?id=<?= $category['id']; ?>"><button>Delete</button></a>
                        </td>
                    </tr>
                <?php endforeach; ?>
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
    </div>

