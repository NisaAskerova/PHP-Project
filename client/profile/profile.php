<?php
include "../../index.php";

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
?>

    <style>
        h1 {
            font-size: 24px;
            color: #333;
            margin-bottom: 20px;
        }
        .profInfo {
            display: flex;
            align-items: center;
            gap: 20px;
        }
        .profile-initial {
            width: 150px;
            height: 150px;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #007bff;
            border-radius: 50%;
            font-size: 3em;
            color: #fff;
            text-align: center;
            line-height: 150px;
        }
        .profInfo img {
            border-radius: 50%;
            max-width: 150px;
            height: auto;
            border: 2px solid #ddd;
        }
        .profInfo div {
            max-width: 400px;
        }
        p {
            font-size: 16px;
            margin: 5px 0;
        }
        strong {
            color: #007bff;
        }
        button {
            padding: 10px 20px;
            font-size: 16px;
            color: #fff;
            background-color: #007bff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        button:hover {
            background-color: #0056b3;
        }
    </style>

    <div class="main">
        <h1>User Profile</h1>
        <div class="profInfo">
            <?php if ($user['profile']): ?>
                <div>
                    <p><strong>Profile Picture:</strong></p>
                    <img src="../public/<?php echo htmlspecialchars($user['profile']); ?>" alt="Profile Picture">
                </div>
            <?php else: ?>
                <div class="profile-initial">
                    <?php echo $nameInitial; ?>
                </div>
            <?php endif; ?>
            <div>
                <p><strong>Name:</strong> <?php echo htmlspecialchars($user['name']); ?></p>
                <p><strong>Surname:</strong> <?php echo htmlspecialchars($user['surname']); ?></p>
                <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
                <p><strong>Gender:</strong> <?php echo $user['gender'] == 1 ? 'Male' : 'Female'; ?></p>
                <p><strong>Date of Birth:</strong> <?php echo htmlspecialchars($user['dob']); ?></p>
            </div>
        </div>
        <a href="<?php echo route('client/profile/updateprofile.php'); ?>"><button>Edit Profile</button></a>
        
    </div>
</body>
</html>
