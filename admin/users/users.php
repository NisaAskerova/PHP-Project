<?php
include "../../index.php";

$page = empty($_GET['page']) ? 1 : $_GET['page'];
$limit = 2;
$startLimit = ($page - 1) * $limit;

$sqlTotal = "SELECT COUNT(*) FROM users WHERE role = 0";
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

$query = "SELECT id, name, surname, email, active FROM users WHERE role = 0 ORDER BY users.id DESC  LIMIT $startLimit, $limit";
$stmt = $connection->prepare($query);
$stmt->execute();
$clients = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $clientId = $_POST['client_id'];
    $newStatus = $_POST['new_status'];

    $updateQuery = "UPDATE users SET active = ? WHERE id = ?";
    $stmt = $connection->prepare($updateQuery);
    $stmt->execute([$newStatus, $clientId]);

    view(route("admin/users/users.php"));
    exit;
}
?>

<style>
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    table, th, td {
        border: 1px solid #ddd;
    }

    th, td {
        padding: 8px;
        text-align: left;
    }

    th {
        background-color: #f2f2f2;
    }

    .action-btn {
        padding: 6px 12px;
        color: #fff;
        text-decoration: none;
        border-radius: 4px;
        cursor: pointer;
    }

    .activate-btn {
        background-color: #28a745;
    }

    .deactivate-btn {
        background-color: #dc3545;
    }

    .view-btn {
        background-color: #007bff;
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
    <h1>Client Management</h1>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Surname</th>
                <th>Email</th>
                <th>Status</th>
                <th>Action</th>
                <th>View</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($clients as $client): ?>
                <tr>
                    <td><?= htmlspecialchars($client['id']); ?></td>
                    <td><?= htmlspecialchars($client['name']); ?></td>
                    <td><?= htmlspecialchars($client['surname']); ?></td>
                    <td><?= htmlspecialchars($client['email']); ?></td>
                    <td><?= $client['active'] ? 'Active' : 'Inactive'; ?></td>
                    <td>
                        <form method="POST" style="display:inline;">
                            <input type="hidden" name="client_id" value="<?= $client['id']; ?>">
                            <input type="hidden" name="new_status" value="<?= $client['active'] ? 0 : 1; ?>">
                            <button type="submit" class="action-btn <?= $client['active'] ? 'deactivate-btn' : 'activate-btn'; ?>">
                                <?= $client['active'] ? 'Deactivate' : 'Activate'; ?>
                            </button>
                        </form>
                    </td>
                    <td>
                        <a href="view.php?id=<?= $client['id']; ?>" class="action-btn view-btn">View</a>
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
