<?php
include "../../index.php";

$errors = [];
$newFileName = null; 
$blogId = $_GET['id'] ?? null;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $categorySelect = $_POST['category'] ?? null;

    $errors = validation(['title', 'description', 'category']);

    if (isset($_FILES['profile']) && $_FILES['profile']['error'] === 0) {
        $newFileName = fileUpload('../../public/', $_FILES['profile']);
        if (!$newFileName) {
            $errors['profile'] = 'Error uploading file';
        }
    }

    if (empty($errors)) {
        $sql = 'UPDATE blogs SET title = ?, description = ?, profile = ?, category_id = ? WHERE id = ?';
        $updateQuery = $connection->prepare($sql);
        $updateQuery->execute([
            post('title'),
            post('description'),
            $newFileName ?? post('existing_profile'),
            $categorySelect,
            $blogId
        ]);
        view(route('client/blog/myblogs.php'));
        exit();
    }
}

$sql = 'SELECT * FROM blogs WHERE id = ?';
$blogQuery = $connection->prepare($sql);
$blogQuery->execute([$blogId]);
$blog = $blogQuery->fetch(PDO::FETCH_ASSOC);

if (!$blog) {
    echo 'Blog post not found!';
    exit();
}

$sql = "SELECT id, name FROM categories";
$result = $connection->prepare($sql);
$result->execute();
$allCategories = $result->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="main">
    <div class="formDiv">
        <h2>Update Blog</h2>
        <form action="" method='POST' enctype='multipart/form-data'>
        <label for="category">Select category</label>
        <select name="category" id="category">
            <?php
            foreach ($allCategories as $cat) {
                echo '<option value="' . htmlspecialchars($cat['id']) . '"' . 
                     ($cat['id'] == htmlspecialchars($blog['category_id']) ? ' selected' : '') . '>' . 
                    htmlspecialchars($cat['name']) . '</option>';
            }
            ?>
        </select>
        <label for="title">Title</label>
        <input type="text" name="title" id="title" value="<?php echo htmlspecialchars($blog['title']); ?>">
        <?php
        if (isset($errors['title'])) {
        ?>
            <span class='error'><?php echo htmlspecialchars($errors['title']); ?></span>
        <?php
        }
        ?>
        <label for="description">Description</label>
        <textarea name="description" id="description"><?php echo htmlspecialchars($blog['description']); ?></textarea>
        <?php
        if (isset($errors['description'])) {
            ?>
            <span class='error'><?php echo htmlspecialchars($errors['description']); ?></span>
            <?php
        }
        ?>
        <label for="profile">Image</label>
        <input type="file" name="profile" id="profile">
        <input type="hidden" name="existing_profile" value="<?php echo htmlspecialchars($blog['profile']); ?>">
        <?php
        if (isset($errors['profile'])) {
        ?>
            <span class='error'><?php echo htmlspecialchars($errors['profile']); ?></span>
        <?php
        }
        ?>
        <button type="submit">Update</button>
    </form>
</div>
</div>
