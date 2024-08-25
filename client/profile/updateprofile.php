<?php
include "../../index.php";

if (!isset($_SESSION['id'])) {
    header('Location: login.php'); 
    exit();
}

$userId = $_SESSION['id'];

$sql = "SELECT name, surname, email, gender, dob, profile FROM users WHERE id = ?";
$query = $connection->prepare($sql);
$query->execute([$userId]);
$user = $query->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    echo "User not found";
    exit();
}

$nameInitial = strtoupper(substr($user['name'], 0, 1));

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $errors = [];
    $name = post('name');
    $surname = post('surname');
    $email = post('email');
    $gender = post('gender');
    $dob = post('dob');
    $profilePicture = null;

    if (isset($_FILES['profile']) && $_FILES['profile']['error'] == UPLOAD_ERR_OK) {
        $profilePicture = fileUpload('../../public/', $_FILES['profile']);
        $upload = "public/";
        $profilePicture = !empty($profilePicture) ? $upload . $profilePicture : null;

        if ($profilePicture === false) {
            $errors['profile'] = 'Failed to upload profile picture';
        }
    }

    if (empty($errors)) {
        $sql = "UPDATE users SET name = ?, surname = ?, email = ?, gender = ?, dob = ?, profile = ? WHERE id = ?";
        $updateQuery = $connection->prepare($sql);
        $updateQuery->execute([
            $name,
            $surname,
            $email,
            $gender,
            $dob,
            $profilePicture ?? $user['profile'],
            $userId
        ]);
        

        header('Location: profile.php');
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <style>
    </style>
</head>
<body>
    <div class="main">
        <h1>Edit Profile</h1>
        <div class="profInfo">
            <form action="" method="POST" enctype="multipart/form-data">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($user['name']); ?>" required>
                <br>
                
                <label for="surname">Surname:</label>
                <input type="text" id="surname" name="surname" value="<?php echo htmlspecialchars($user['surname']); ?>" required>
                <br>
                
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
                <br>
                
                <label for="gender">Gender:</label>
                <input type="radio" id="male" name="gender" value="1" <?php echo $user['gender'] == 1 ? 'checked' : ''; ?>>
                <label for="male">Male</label>
                <input type="radio" id="female" name="gender" value="2" <?php echo $user['gender'] == 2 ? 'checked' : ''; ?>>
                <label for="female">Female</label>
                <br>
                
                <label for="dob">Date of Birth:</label>
                <input type="date" id="dob" name="dob" value="<?php echo htmlspecialchars($user['dob']); ?>" required>
                <br>
                
                <label for="profile">Profile Picture:</label>
                <input type="file" id="profile" name="profile">
                
                <?php if ($user['profile']): ?>
                    <div>
                        <p>Current Profile Picture:</p>
                        <img src="../../public/<?php echo htmlspecialchars($user['profile']); ?>" alt="Profile Picture" style="max-width: 150px;">
                    </div>
                <?php endif; ?>
                
                <br>
                <button type="submit">Update Profile</button>
            </form>
        </div>
    </div>
</body>
</html>
