<?php
include "../index.php";
$user = getUserDetails($connection);
if ($user) { ?>
<div class="hero">
    <h2>Welcome <?= $user['name'] ?></h2>
    <h2>admin</h2>
</div>
<?php
}