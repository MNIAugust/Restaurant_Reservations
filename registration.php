<?php

//Registracijos funkcija 

require_once('db_conn.php');
if(!empty($_POST['registration'])){
    if(!empty($_POST['email'])){
        $email = htmlentities($_POST['email'], ENT_QUOTES, 'utf-8');
    }else{
        $email = '';
    }
    if(!empty($_POST['pass'])){
        $pass = md5($_POST['pass']);
    }else{
        $pass = '';
    }
    if(!empty($_POST['repass'])){
        $repass = md5($_POST['repass']);
    }else{
        $repass = '';
    }
    if(!empty($email) && !empty($pass) && $pass == $repass){
        $sql = 'INSERT INTO users SET
                email = "'.$email.'",
                pass = "'.$pass.'"
        ';
        
        $result = $db->query($sql);
        
        if($result){
            header('Location: http://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']).'/login.php');
            $message = "Registration successful";
        }else{
            $message = "Registration failed";
        }
    }else{
       $message = "All fields are required"; 
    }
}
?>



<?php
    require_once('header.php');
?>

<!-- Hero blokas -->
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
        
<!--        Registration blokas -->
        
        <div class="col-md-6">
            <div class="form-container">
                <h2>Registration</h2>
                <h3 style="color: red"><?php echo isset($message) ? $message : ""; ?></h3>
                <form method="POST" enctype="multipart/form-data">
                    <fieldset class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" class="form-control" name="email" value="<?php echo !empty($_POST['registration']) ? $email : ""; ?>" placeholder="Enter your email">
                    </fieldset>
                    <fieldset class="form-group">
                        <label for="pass">Password</label>
                        <input type="password" id="pass" name="pass" value="" class="form-control" placeholder="Enter your password">
                    </fieldset>
                    <fieldset class="form-group">
                        <label for="repass">Re-Entre Password</label>
                        <input type="password" id="repass" name="repass" value="" class="form-control" placeholder="Re-Enter your password">    
                    </fieldset>
                    <input type="submit" name="registration" value="Register" class="btn btn-default custom-btn">
                </form>
            </div>
        </div>
    </div>   
<?php require_once('footer.php'); ?>