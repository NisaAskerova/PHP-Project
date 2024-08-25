<?php
include "../index.php";
$errors = [];

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $errors = validation(['email', 'password']);

    if (empty($errors)) {
        $query = "SELECT * FROM users WHERE email=?";
        $loginQuery = $connection->prepare($query);
        $loginQuery->execute([post('email')]);
        $user = $loginQuery->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify(post('password'), $user['password'])) {
            if ($user['active'] == 0) {
                $errors['login'] = "Hesabınız deaktiv edilib. Zəhmət olmasa admin ilə əlaqə saxlayın.";
            } elseif ($user['otp'] != null) {
                $_SESSION['otp_email'] = post('email');
                $_SESSION['otp'] = $otp;
                $_SESSION['otp_ttl'] = time() + 300;
                view(route("auth/otp.php"));
            } else {
                $_SESSION['user_profile'] = $user["profile"];
                $_SESSION['id'] = $user['id'];
                if ($user['role'] == 1) {
                    view(route('admin/index.php'));
                } elseif ($user['role'] == 0) {
                    view(route('client/index.php'));
                } else {
                    $errors['login'] = "Email və ya şifrə yanlışdır";
                }
            }
        } else {
            $errors['login'] = "Email və ya şifrə yanlışdır";
        }
    }
}
?>

<div class="formDiv">
    <div class="imgDiv">
        <img src="../profile.webp" alt="">
    </div>
    <h2>Login Form</h2>
    <form action="" method="POST">
        <div>
            <label for="email">Email</label>
            <input type="email" name="email" id="email">
            <?php if (isset($errors['email'])): ?>
            <span class='error'><?php echo $errors['email']; ?></span>
            <?php endif; ?>
        </div>
        <div>
            <label for="password">Password</label>
            <input type="password" name="password" id="password">
            <?php if (isset($errors['password'])): ?>
            <span class='error'><?php echo $errors['password']; ?></span>
            <?php endif; ?>
            <?php if (isset($errors['login'])): ?>
            <span class='error'><?php echo $errors['login']; ?></span>
            <?php endif; ?>
        </div>
        <button type="submit">Göndər</button>
    </form>
</div>
