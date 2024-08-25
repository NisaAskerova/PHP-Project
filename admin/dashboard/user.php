<?php
include '../../index.php';

$sql = "
    SELECT 
        u.id AS user_id,
        u.name AS user_name,
        COUNT(b.id) AS blog_count
    FROM 
        users u
    LEFT JOIN 
        blogs b ON u.id = b.user_id
    WHERE 
        b.is_publish = 1
    GROUP BY 
        u.id, u.name
    ORDER BY 
        blog_count DESC
";

$result = $connection->prepare($sql);
$result->execute();
$clients = $result->fetchAll(PDO::FETCH_ASSOC);
?>

    <style>
        h2 {
            color: #333;
            border-bottom: 2px solid #007BFF;
            padding-bottom: 10px;
        }
        .clientsList {
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
        button {
            background-color: #007BFF;
            color: #fff;
            border: none;
            padding: 5px 10px;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        button:hover {
            background-color: #0056b3;
        }
        a {
            text-decoration: none;
        }
    </style>

    <div class="hero">
        <h2>Clients and Their Blog Counts</h2>
        <div class="clientsList">
            <?php if ($clients): ?>
                <table>
                    <thead>
                        <tr>
                            <th>Client Name</th>
                            <th>Number of Blogs</th>
                            <th>View Blogs</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($clients as $client): ?>
                            <tr>
                                <td><?= htmlspecialchars($client['user_name']); ?></td>
                                <td><?= htmlspecialchars($client['blog_count']); ?></td>
                                <td>
                                    <a href="http://localhost/final-project-php/admin/dashboard/blogs.php?user_id=<?= htmlspecialchars($client['user_id']) ?>">
                                        <button>View</button>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p>No clients found.</p>
            <?php endif; ?>
        </div>
    </div>
