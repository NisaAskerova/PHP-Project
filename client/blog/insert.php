<?php
include "../../index.php";

$errors = [];
$newFileName = null; 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $categorySelect = $_POST['category'] ?? null;

    $errors = validation(['title', 'description', 'profile', 'category']);
    
    if (isset($_FILES['profile']) && $_FILES['profile']['error'] === 0) {
        $newFileName = fileUpload('../../public/', $_FILES['profile']);
    }

    if (!$newFileName) {
        $errors['profile'] = 'Error uploading file';
    }

    if (empty($errors)) {
        $user_id = $_SESSION['id'];
        $sql = 'INSERT INTO blogs (title, description, profile, user_id, category_id) VALUES (?, ?, ?, ?, ?)';
        $insertQuery = $connection->prepare($sql);
        $insertQuery->execute([
            post('title'),
            post('description'),
            $newFileName,
            $user_id,
            $categorySelect
        ]);
        view(route('client/blog/insert.php'));
        echo'Blog posted';
        exit();
    }
}

$sql = "SELECT id, name FROM categories";
$result = $connection->prepare($sql);
$result->execute();
$allCategories = $result->fetchAll(PDO::FETCH_ASSOC);
?>
<div class="main">
<div class="formDiv">
    <h2>Add Blog</h2>
    <form action="" method='POST' enctype='multipart/form-data'>
        <label for="category">Select category</label>
        <select name="category" id="category">
            <?php
            foreach ($allCategories as $cat) {
                echo '<option value="' . htmlspecialchars($cat['id']) . '"' . 
                     ($cat['id'] == htmlspecialchars($categorySelect) ? ' selected' : '') . '>' . 
                    htmlspecialchars($cat['name']) . '</option>';
            }
            ?>
        </select>
        <label for="title">Title</label>
        <input type="text" name="title" id="title">
        <?php
        if (isset($errors['title'])) {
        ?>
            <span class='error'><?php echo htmlspecialchars($errors['title']); ?></span>
        <?php
        }
        ?>
        <label for="description">Description</label>
        <textarea name="description" id="description"></textarea>
        <?php
        if (isset($errors['description'])) {
            ?>
            <span class='error'><?php echo htmlspecialchars($errors['description']); ?></span>
            <?php
        }
        ?>
        <label for="profile">Image</label>
        <input type="file" name="profile" id="profile">
        <?php
        if (isset($errors['profile'])) {
        ?>
            <span class='error'><?php echo htmlspecialchars($errors['profile']); ?></span>
        <?php
        }
        ?>
        <button type="submit">Submit</button>
    </form>
</div>
</div>
