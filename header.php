  
<?php

//Po logout nukreipia i log in puslapi
//<--------------------
if(!empty($_GET['logout'])){
		unset($_SESSION['auth']);
		header('Location: http://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']).'/index.php');
	}
//---------------------->
?>
<html>
    <head>
         <meta charset="utf-8">
        <meta name="viewport" content="width-device-width, initial-scale-1">
        <title>Base HTML</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
        <link rel="stylesheet" href="assets/css/p_style.css">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
    </head>
    <body>
<!--        Hederis ir jo komponentai -->
        
        <header class="headerstyle">
            <ul>
                <?php if(!isset($_SESSION['auth'])): ?>
                <?php if($_SERVER['PHP_SELF'] == dirname($_SERVER['PHP_SELF']).'/login.php'): ?>
                    <li> 
                        <a href="<?php echo 'http://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']).'/registration.php'; ?>">Registration</a>
                    </li>
                <?php endif; ?>
                <?php if($_SERVER['PHP_SELF'] == dirname($_SERVER['PHP_SELF']).'/registration.php'): ?>
                    <li>
                        <a href="<?php echo 'http://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']).'/login.php'; ?>">Login</a>
                    </li>
                <?php endif; ?>
                <?php else: ?>
                    <li>
                        <a href="<?php echo 'http://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']).'/index.php'; ?>">Reservations</a>
                    </li>                    
                    <li>
                        <a href="<?php echo 'http://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']).'/tables.php'; ?>">Tables</a>
                    </li>
                    <li>
                        <a href="<?php echo 'http://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']).'/reservations.php'; ?>">New Reservation</a>
                    </li>
                    
                    <li><a href="?logout=true">Logout</a></li>
                <?php endif; ?> 
            </ul>
        </header>
        <div class="container-fluid">

    
    