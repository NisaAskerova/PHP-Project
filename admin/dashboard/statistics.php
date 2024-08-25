<?php
include '../../index.php';
?>
<style>
.hero a {
    text-decoration: none;
}

.hero button {
    background-color: #007BFF; /* Mavi rəng */
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
    transition: background-color 0.3s, transform 0.3s;
}

.hero button:hover {
    background-color: #0056b3; /* Daha tünd mavi rəng */
    transform: scale(1.05);
}

.hero button:active {
    background-color: #003f7f; /* Ən tünd mavi rəng */
    transform: scale(1);
}
#buttonss{
    width: 100%;
    display: flex;
    gap: 20px;
    margin-top: 20px;
}

</style>
<div class="hero">
    <h2>Statistics</h2>
    <div id="buttonss">
        <a href="http://localhost/final-project-php/admin/dashboard/day.php"><button>Blogs of the Day</button></a>
        <a href="http://localhost/final-project-php/admin/dashboard/month.php"><button>Blogs of the Month</button></a>
        <a href="http://localhost/final-project-php/admin/dashboard/categories.php"><button>Count by Category</button></a>
        <a href="http://localhost/final-project-php/admin/dashboard/user.php"><button>Blog Counts</button></a>

    </div>
    
</div>