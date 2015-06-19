<p>

<?php 

    if (empty($_SESSION['username']))
    {
        echo "<a href = 'http://pluto.hood.edu/~htun/projectgreed/index.php?signuplogin'>Signup/Login</a>";
    } 
    else 
    {
	echo "<a href = 'http://pluto.hood.edu/~htun/projectgreed/index.php?logout'>Logout</a>";
    }

?>
</p>




