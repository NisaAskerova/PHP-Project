<?php
include_once "../index.php";
$user = getUserDetails($connection);
if ($user) { ?>
<div class="main"> 
    <h2>Welcome <?= $user['name'] ?></h2>
</div>
<?php
}