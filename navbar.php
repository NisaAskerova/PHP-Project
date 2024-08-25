<?php
include_once "index.php";
$userAuthCheck = auth();
$user_profile = getUserDetails($connection);

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['search'])) {
    $searchQuery = "%" . $_GET['search'] . "%";
    $sql = "SELECT * FROM blogs WHERE title LIKE ? OR description LIKE ? OR profile LIKE ?";
    $searchStmt = $connection->prepare($sql);
    $searchStmt->execute([$searchQuery, $searchQuery, $searchQuery]);
    $searchResults = $searchStmt->fetchAll(PDO::FETCH_ASSOC);
}
?>

<?php if (!$userAuthCheck): ?>
    <nav>
        <ul>
            <li><a href="<?php echo route('auth/register.php'); ?>">Register</a></li>
            <li><a href="<?php echo route('auth/login.php'); ?>">Login</a></li>
        </ul>
    </nav>
<?php else: ?>
    <?php if ($user_profile['role'] === 0): ?>
        <nav>
            <ul>
                <li><a href="<?php echo route('home/home.php'); ?>">Home</a></li>
                <li><a href="<?php echo route('client/blog/myblogs.php'); ?>">My Blogs</a></li>
                <li><a href="<?php echo route('client/blog/insert.php'); ?>">Add Blog</a></li>
                <li><a href="<?php echo route('client/blog/allblogs.php'); ?>">All Blogs</a></li>
                <a href="http://localhost/final-project-php/search_results.php"><button class="searchBtn">Search</button></a>

                <li>
                    <?php if (isset($_SESSION["user_profile"]) && !empty($_SESSION["user_profile"])): ?>
                        <a href="<?php echo route('client/profile/profile.php'); ?>">
                            <img class="profileImg" src="/final-project-php/<?php echo htmlspecialchars($_SESSION['user_profile']); ?>" alt="Profile Image">
                        </a>
                </li>
            <?php else: ?>
                <?php if (isset($user_profile['name'])): ?>
                    <li>
                        <a href="<?php echo route('client/profile/profile.php'); ?>">
                            <div class="profileImg profileDiv">
                                <?php echo strtoupper(substr($user_profile['name'], 0, 1)); ?>
                            </div>
                        </a>
                    </li>
                <?php endif; ?>
            <?php endif; ?>
            <li><a href="<?php echo route('auth/logout.php'); ?>">Log Out</a></li>
            </ul>
        </nav>
    <?php endif; ?>
<?php endif; ?>
<?php if ($userAuthCheck): ?>
    <?php if (isset($user_profile['role'])): ?>
        <?php if ($user_profile['role'] === 1): ?>
            <div class="top-nav-right">
                <ul>
                    <li><a href="<?php echo route('admin/dashboard/statistics.php'); ?>">Dashboard</a></li>
                    <li><a href="<?php echo route('admin/blogs/allblogs.php'); ?>">Manage Blogs</a></li>
                    <li><a href="<?php echo route('admin/users/users.php'); ?>">Manage Users</a></li>
                    <li><a href="<?php echo route('admin/category/category.php'); ?>">Categories</a></li>
                    <li><a href="<?php echo route('auth/logout.php'); ?>">Log Out</a></li>
                </ul>
            </div>
        <?php endif; ?>
    <?php endif; ?>
<?php endif; ?>

<?php if (isset($searchResults)): ?>
    <div class="main">

        <div class="search-results">
            <?php foreach ($searchResults as $result): ?>
                <div>
                    <h3><?php echo htmlspecialchars($result['title']); ?></h3>
                    <p><?php echo htmlspecialchars($result['description']); ?></p>
                    <img src="<?php echo htmlspecialchars($result['profile']); ?>" alt="Blog Image">
                </div>
            <?php endforeach; ?>
        </div>
    </div>
<?php endif; ?>