<?php
include 'index.php';

$categories = [];
try {
    $categoryQuery = "SELECT id, name FROM categories";
    $stmt = $connection->prepare($categoryQuery);
    $stmt->execute();
    $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $categories = "Error: " . $e->getMessage();
}

$title = isset($_GET['title']) ? $_GET['title'] : '';
$description = isset($_GET['description']) ? $_GET['description'] : '';
$creator = isset($_GET['creator']) ? $_GET['creator'] : '';
$category = isset($_GET['category']) ? $_GET['category'] : '';

$blogs = [];

if ($title || $description || $creator || $category) {
    try {
        $query = "
            SELECT b.*, u.name as creator_name, c.name as category_name
            FROM blogs b
            LEFT JOIN users u ON b.user_id = u.id
            LEFT JOIN categories c ON b.category_id = c.id
            WHERE 1=1
        ";

        if ($title) {
            $query .= " AND b.title LIKE :title";
        }
        if ($description) {
            $query .= " AND b.description LIKE :description";
        }
        if ($creator) {
            $query .= " AND u.name LIKE :creator";
        }
        if ($category) {
            $query .= " AND c.id = :category";
        }

        $stmt = $connection->prepare($query);

        if ($title) {
            $stmt->bindValue(':title', '%' . $title . '%');
        }
        if ($description) {
            $stmt->bindValue(':description', '%' . $description . '%');
        }
        if ($creator) {
            $stmt->bindValue(':creator', '%' . $creator . '%');
        }
        if ($category) {
            $stmt->bindValue(':category', $category);
        }

        $stmt->execute();
        $blogs = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        $blogs = "Error: " . $e->getMessage();
    }
}
?>
<style>
    .search-form {
        background: #fff;
        padding: 20px;
        margin: 20px 0;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .search-form input[type="text"] {
        width: calc(25% - 22px);
        padding: 10px;
        margin-right: 10px;
        border: 1px solid #ddd;
        border-radius: 4px;
    }

    .search-form select {
        width: calc(25% - 22px);
        padding: 10px;
        margin-right: 10px;
        border: 1px solid #ddd;
        border-radius: 4px;
    }

    .search-form input[type="submit"] {
        background: #333;
        color: #fff;
        border: none;
        padding: 10px;
        border-radius: 4px;
        cursor: pointer;
        width: 100%;
        margin-top: 10px;
    }

    .search-form input[type="submit"]:hover {
        background: #555;
    }
</style>
<div class="main">

    <header>
        <h1>Search Blogs</h1>
    </header>
    <div class="container">
        <div class="search-form">
            <form method="get">
                <input type="text" name="title" placeholder="Title" value="<?php echo htmlspecialchars($title); ?>">
                <input type="text" name="description" placeholder="Description" value="<?php echo htmlspecialchars($description); ?>">
                <input type="text" name="creator" placeholder="Creator" value="<?php echo htmlspecialchars($creator); ?>">
                <select name="category">
                    <option value="">Select Category</option>
                    <?php foreach ($categories as $cat): ?>
                        <option value="<?php echo htmlspecialchars($cat['id']); ?>" <?php echo ($category == $cat['id']) ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($cat['name']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <input type="submit" value="Search">
            </form>
        </div>

        <?php if (!empty($blogs)): ?>
            <div class="blog-list">
                <h2>Search Results</h2>
                <?php foreach ($blogs as $blog): ?>
                    <div class="blogItem">
                        <a href="http://localhost/final-project-php/client/blog/detail.php?id=<?= htmlspecialchars($blog['id']); ?>">
                            <?php if ($blog['profile']): ?>
                                <img src="public/<?= htmlspecialchars($blog['profile']); ?>" alt="Blog Image" style="max-width:200px;">
                            <?php endif; ?>
                            <div class="title">
                                <h3><?= htmlspecialchars(substr($blog['title'], 0, 20)) . "..." ?></h3>
                                <p><?= htmlspecialchars(substr($blog['description'], 0, 40)); ?></p>
                                <p><?= htmlspecialchars($blog['category_name']); ?></p>
                                <p><?= htmlspecialchars($blog['created_at']); ?></p>
                                <p><strong>Views:</strong> <?= htmlspecialchars($blog['view_count']); ?></p>
                                <p><?= htmlspecialchars($blog['creator_name']); ?></p>
                            </div>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php elseif ($title || $description || $creator || $category): ?>
            <p>No results found.</p>
        <?php endif; ?>
    </div>
</div>
