<?php
include "../index.php";

use PHPMailer\PHPMailer\PHPMailer;

require "../vendor/PHPMailer/src/Exception.php";
require "../vendor/PHPMailer/src/PHPMailer.php";
require "../vendor/PHPMailer/src/SMTP.php";

$errors = [];
$profilePicture = null;

try {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $errors = validation(['name', 'surname', 'email', 'password', 'password-confirmation', 'gender', 'dob']);
        if (post('password') !== post('password-confirmation')) {
            $errors['password-confirmation'] = 'Password does not match';
        }

        if (empty($errors)) {
            $newFileName = null;

            if (isset($_FILES['profile']) && $_FILES['profile']['error'] == UPLOAD_ERR_OK) {
                $newFileName = fileUpload('../public/', $_FILES['profile']);
                $upload = "public/";
                $newFileName = !empty($newFileName) ? $upload . $newFileName : null;

                if ($newFileName === false) {
                    $errors['profile'] = 'Failed to upload profile picture';
                }
            }

            if (empty($errors)) {
                $otp = rand(1000, 9999);
                $passwordHash = password_hash(post('password'), PASSWORD_DEFAULT);

                $sql = "INSERT INTO users (name, surname, email, password, gender, dob, profile, otp) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
                $insertQuery = $connection->prepare($sql);
                $check = $insertQuery->execute([
                    post("name"),
                    post("surname"),
                    post("email"),
                    $passwordHash,
                    post('gender'),
                    post("dob"),
                    $newFileName,
                    $otp
                ]);

                $_SESSION['user_role'] = post('role');
                $_SESSION['user_profile'] = $newFileName;

                if ($check) {
                    $_SESSION['otp_email'] = post('email');
                    $_SESSION['otp'] = $otp;
                    $_SESSION['otp_ttl'] = time() + 300;

                    $email = new PHPMailer(true);
                    try {
                        $email->isSMTP();
                        $email->Host = 'smtp.gmail.com';
                        $email->SMTPAuth = true;
                        $email->Username = 'gismathusein@gmail.com';
                        $email->Password = 'byvq pkaq depo skiw';
                        $email->SMTPSecure = 'tls';
                        $email->Port = 587;

                        $email->setFrom('gismathusein@gmail.com', 'final-project');
                        $email->addAddress('nisaaskerova98@gmail.com');

                        $email->isHTML(true);
                        $email->Subject = 'Coders caravan project OTP code:';
                        $email->Body = 'Your OTP code: ' . $otp;
                        view(route("auth/otp.php"));
                        exit();
                    } catch (Exception $e) {
                        echo $e->getMessage();
                    }
                }
            }
        }
    }
} catch (PDOException $e) {
    if ($e->errorInfo[1] == 1062) {
        $errors['email'] = "This email is already registered";
    } else {
        echo $e->getMessage();
    }
}
?>

<form action="" method="POST" enctype="multipart/form-data">
    <label for="name">Name</label>
    <input type="text" id="name" name="name" value="<?php echo post('name'); ?>">
    <?php if (isset($errors['name'])): ?>
        <span class='error'><?php echo $errors['name']; ?></span>
    <?php endif; ?>

    <label for="surname">Surname</label>
    <input type="text" id="surname" name="surname" value="<?php echo post('surname'); ?>">
    <?php if (isset($errors['surname'])): ?>
        <span class='error'><?php echo $errors['surname']; ?></span>
    <?php endif; ?>

    <label for="email">Email</label>
    <input type="email" id="email" name="email" value="<?php echo post('email'); ?>">
    <?php if (isset($errors['email'])): ?>
        <span class='error'><?php echo $errors['email']; ?></span>
    <?php endif; ?>

    <label for="password">Password</label>
    <input type="password" id="password" name="password">
    <?php if (isset($errors['password'])): ?>
        <span class='error'><?php echo $errors['password']; ?></span>
    <?php endif; ?>

    <label for="password-confirmation">Password Confirmation</label>
    <input type="password" id="password-confirmation" name="password-confirmation">
    <?php if (isset($errors['password-confirmation'])): ?>
        <span class='error'><?php echo $errors['password-confirmation']; ?></span>
    <?php endif; ?>

    <label for="dob">Date of birth</label>
    <input type="date" id="dob" name="dob" value="<?php echo post('dob'); ?>">
    <?php if (isset($errors['dob'])): ?>
        <span class='error'><?php echo $errors['dob']; ?></span>
    <?php endif; ?>

    <label for="profile">Profile Picture:</label>
    <input type="file" id="profile" name="profile">
    
    <?php if ($profilePicture): ?>
        <div>
            <label>Current Profile Picture:</label>
            <img src="<?php echo $profilePicture; ?>" alt="Profile Picture" style="max-width: 150px;">
        </div>
    <?php endif; ?>

    <label for="male">Male</label>
    <input type="radio" name="gender" id="male" value="1">
    <label for="fimale">Female</label>
    <input type="radio" name="gender" id="fimale" value='2'>
    <?php if (isset($errors['gender'])): ?>
        <span class='error'><?php echo $errors['gender']; ?></span>
    <?php endif; ?>

    <button type="submit">Submit</button>
</form>
