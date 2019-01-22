<?php 
        require_once "db_conn.php";
        session_start(); //paleidziame sesija, kad perejus is vieno puslapio i kita
        //pasiliktu $_SESSION['auth'] kintamasis



    //    Logout nukreipia i index.php kuris nukreipia i login puslapi 

        if(!empty($_GET['logout'])){
            unset($_SESSION['auth']);
            header('Location: http://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']).'/index.php');
        }

        if(!empty($_POST['login'])){
            //validuojame email
            if(!empty($_POST['email'])){
                $email = htmlentities($_POST['email'], ENT_QUOTES, 'utf-8');
            }else{
                $email = '';
            }

            //validuojame slaptazodi
            if(!empty($_POST['pass'])){
                $pass = md5($_POST['pass']); //uzkoduojame slaptazodi
            }else{
                $pass = '';
            }

            if(!empty($email) && !empty($pass)){
                $sql = 'SELECT id, email 
                        FROM users
                        WHERE email = "'.$email.'"
                        AND pass = "'.$pass.'"
                        LIMIT 1
                ';

                $result = $db->query($sql);


                if($result->num_rows){
                    //radome vartotoja

                    //fetch_assoc() metodas paima viena irasa (row)
                    //ir pavercia ji asocijuotu masyvu
                    $user = $result->fetch_assoc();
                    $message_login = "Welcome, ".$user['email'];
                    $_SESSION['auth'] = true; //issaugome i sesija jog vartotojas prisijunges
                    $_SESSION['userid'] = $user['id'];
                }else{
                    $message_login = "Wrong login credentials";
                }
            }else{
                $message_login = "Enter login and password";
            }
        }
?>
<?php
if(isset($_SESSION['auth'])): ?>

<!--    Login nukreipia i index.php  -->
<?php header('Location: http://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']).'/index.php'); ?>

	<h2>Authenticated: <a href="?logout=true">Logout</a></h2>
	<h3 style="color: red"><?php echo isset($message_login) ? $message_login : ""; ?></h3>
<?php
else: ?>
    <?php
        require_once('header.php');
    ?>

<!--	Hero blokas -->
    <div class="row">
        <div class="col-md-6">
            <div class="hero-image">
                <div class="hero-text">
                    <h1>
                        Welcome to your personal restaurant reservation book    
                    </h1>
                </div>    
            </div>    
        </div>
        
<!--        Login blokas -->
        
        <div class="col-md-6">
            <div class="form-container">
                <h2>Login</h2>
                <h3 style="color: red"><?php echo isset($message_login) ? $message_login : ""; ?></h3>
                <form method="POST" enctype="multipart/form-data">
                    <fieldset class="form-group">
                        <label for="email">Email/Username</label><br>
                        <input type="email" id="email" name="email" value="" class="form-control" placeholder="Enter your email">
                    </fieldset>
                    <fieldset class="form-group">
                        <label for="pass">Password</label><br>
                        <input type="password" id="pass" name="pass" class="form-control" placeholder="Enter password">
                    </fieldset>
                    <input type="submit" name="login" value="Login" class="btn btn-default custom-btn">
                </form>
            </div>
        </div>
    </div>
	<?php
endif;?>
<?php require_once('footer.php'); ?>