
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<?php 
	session_start();
?>

<?php if(!isset($_SESSION['auth'])): ?>

<!--Grazinimas i login.php puslapi -->

<?php header('Location: http://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']).'/login.php'); ?>
<?php else: ?>
<?php require_once('header.php'); ?>
<?php require_once('reservlist.php'); ?>

<?php endif; ?>
<?php require_once('footer.php') ?>
