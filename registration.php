<?php  include "includes/db.php"; ?>
 <?php  include "includes/header.php"; ?>

<?php

if(isset($_POST['submit'])){
	$username = trim($_POST['username']);
	$email	  = trim($_POST['email']);
	$password = trim($_POST['password']);
	
	$error = [
		'username'=>'',
		'email'=>'',
		'password'=>''
	];
	
	if(strlen($username)<4){
		$error['username'] =  'Username needs to be long';
	}
	
	if($username == ''){
		$error['username'] =  'Username cannot be empty';
	}
	
	if(username_exists($username)){
		
		$error['username'] = 'Username already exists,pick another one';
	}
	
	if($email == ''){
		$error['email'] =  'Email cannot be empty';
	}
	
	if(email_exists($email)){
		
		$error['email'] = 'Email already exists,<a href="index.php">please login</a>';
	}
	
	
	if($password == ''){
		$error['password'] =  'password cannot be empty';
	}
	

	
	
	
if(!empty($username) && !empty($email) && !empty($password)){
	$username = mysqli_real_escape_string($connection, $username);
	$email	  = mysqli_real_escape_string($connection, $email);
	$password = mysqli_real_escape_string($connection, $password);
	
	$password = password_hash($password,PASSWORD_BCRYPT,array('cost' => 12));

	
	
/* 	$query    = "SELECT randsalt FROM users";

	$select_randsalt_query = mysqli_query($connection,$query);
	if(!$select_randsalt_query){
		die("QUERY FAILED".mysqli_error($connection));
		}
	$row  = mysqli_fetch_array($select_randsalt_query);
	$salt = $row['randsalt'];

	$password = crypt($password,$salt); */
	
	
	
	$query = "INSERT INTO users(username,user_email,user_password,user_role)";
	$query .= "VALUES('{$username}','{$email}','{$password}','subscriber')";

	$register_user_query = mysqli_query($connection,$query);
	if(!$register_user_query){
		die("QUERY FAILED".mysqli_error($connection));
		}
		//$message = "Your registration is successful";
		
		
		
		
		
		
		
		//if(isset($_POST['login'])){
		 $username = $_POST['username'];
		 $password = $_POST['password'];
		 
		$username = mysqli_real_escape_string($connection,$username);
		$password = mysqli_real_escape_string($connection,$password);
		
		$query = "SELECT * FROM users WHERE username = '{$username}'";
		$select_user_query = mysqli_query($connection,$query);
		
		if(!$select_user_query){
			die("QUERY FAILED".mysqli_error($connection));
		}
		 while($row = mysqli_fetch_array($select_user_query)){
			 $db_user_id = $row['user_id'];
			 $db_username = $row['username'];
			 $db_user_firstname = $row['user_firstname'];
			 $db_user_lastname = $row['user_lastname'];
			 $db_user_password = $row['user_password'];
			 $db_user_role = $row['user_role'];
			 
		 }
		 
/* 		 $password = crypt($password,$db_user_password);
		 
		 if($db_username !== $username && $db_user_password !== $password){
			 header("Location: ../index.php");
		 }
		else  */
		
		if(password_verify($password,$db_user_password)){
			   
			 $_SESSION['username'] = $db_username;
			 $_SESSION['firstname'] = $db_user_firstname;
			 $_SESSION['lastname'] = $db_user_lastname;
			 $_SESSION['user_role'] = $db_user_role;

			 header("Location: ../cms/admin");
			 
			 
		 }
		 else{
			 header("Location: ../index.php");
			 
		 }
		 
	//}
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
}else{
	$message = "Fields cantn't be empty";
}
	
}else{
	$message="";
}

?>

 
 
 
 
 
    <!-- Navigation -->
    
    <?php  include "includes/navigation.php"; ?>
    
 
    <!-- Page Content -->
    <div class="container">
    
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1>Register</h1>
                    <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">

					
                        <div class="form-group">
                            <label for="username" class="sr-only">username</label>
                            <input type="text" name="username" id="username" class="form-control" placeholder="Enter Desired Username" autocomplete="on">
							<p><?php echo isset($error['username'])?$error['username']:''?></p>
							
                        </div>
                         <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com">
							
							<p><?php echo isset($error['email'])?$error['email']:''?></p>
                        </div>
                         <div class="form-group">
                            <label for="password" class="sr-only">Password</label>
                            <input type="password" name="password" id="key" class="form-control" placeholder="Password">
							
							<p><?php echo isset($error['password'])?$error['password']:''?></p>
                        </div>
                
                        <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Register">
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>



<?php include "includes/footer.php";?>
