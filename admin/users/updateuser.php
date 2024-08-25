<?php
include "../../index.php";

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo "Invalid user ID.";
    exit;
}

$userId = (int)$_GET['id'];

$sql = "SELECT name, surname, email, gender, dob, profile FROM users WHERE id = ?";
$query = $connection->prepare($sql);
$query->execute([$userId]);
$user = $query->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    echo "User not found";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = trim($_POST['name']);
    $surname = trim($_POST['surname']);
    $gender = $_POST['gender'];
    $dob = $_POST['dob'];
    $profile = $_FILES['profile']['name'];

    $errors = [];

    if (empty($errors)) {
        if ($profile) {
            $targetDir = "../public/";
            $targetFile = $targetDir . basename($profile);
            move_uploaded_file($_FILES['profile']['tmp_name'], $targetFile);
        } else {
            $profile = $user['profile']; 
        }

        $updateSql = "UPDATE users SET name = ?, surname = ?, gender = ?, dob = ?, profile = ? WHERE id = ?";
        $stmt = $connection->prepare($updateSql);
        $stmt->execute([$name, $surname, $gender, $dob, $profile, $userId]);

        header("Location: view.php?id=$userId");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User Profile</title>
    <link rel="stylesheet" href="../public/styles.css">
</head>
<body>
    <div class="hero">
        <h1>Edit User Profile</h1>
        <form action="" method="POST" enctype="multipart/form-data">
            <div>
                <label for="name">Name:</label>
                <input type="text" name="name" id="name" value="<?= htmlspecialchars($user['name']); ?>" required>
            </div>
            <div>
                <label for="surname">Surname:</label>
                <input type="text" name="surname" id="surname" value="<?= htmlspecialchars($user['surname']); ?>" required>
            </div>
            <div>
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" readonly value="<?= htmlspecialchars($user['email']);?>" required>
            </div>
            <div>
                <label for="gender">Gender:</label>
                <select name="gender" id="gender" required>
                    <option value="1" <?= $user['gender'] == 1 ? 'selected' : ''; ?>>Male</option>
                    <option value="0" <?= $user['gender'] == 0 ? 'selected' : ''; ?>>Female</option>
                </select>
            </div>
            <div>
                <label for="dob">Date of Birth:</label>
                <input type="date" name="dob" id="dob" value="<?= htmlspecialchars($user['dob']); ?>" required>
            </div>
            <div>
                <label for="profile">Profile Picture:</label>
                <input type="file" name="profile" id="profile">
                <?php if ($user['profile']): ?>
                    <img src="../../public/<?= htmlspecialchars($user['profile']); ?>" alt="Profile Picture" style="max-width: 150px; margin-top: 10px;">
                <?php endif; ?>
            </div>
            <button type="submit">Update Profile</button>
        </form>
    </div>
</body>
</html>
