<?php
    if(isset($_GET['edit_user'])){
        
       $the_user_id = $_GET['edit_user'];
                         
      $query = "SELECT * FROM users WHERE user_id = $the_user_id";  
      $select_users_query = mysqli_query($connection,$query);
      
      while($row = mysqli_fetch_assoc($select_users_query)){
          $user_id = $row['user_id'];
		  $username = $row['username'];
          $user_password = $row['user_password'];
          $user_firstname = $row['user_firstname'];
          $user_lastname = $row['user_lastname'];
          $user_email = $row['user_email'];
          $user_image = $row['user_image'];
		  $user_role = $row['user_role'];
	  }
    


if(isset($_POST['edit_user'])){
        
	 $user_firstname = $_POST['user_firstname'];
	 $user_lastname = $_POST['user_lastname'];
	 $user_role = $_POST['user_role'];
	 $username = $_POST['username'];
	 $user_email = $_POST['user_email'];
	 $user_password = $_POST['user_password'];



if(!empty($user_password)){
	$query_password = "SELECT user_password FROM users WHERE user_id = $the_user_id";
	$get_user_query = mysqli_query($connection,$query_password);	
	comfirmQuery($get_user_query);
	
	$row = mysqli_fetch_array($get_user_query );
	$db_user_password = $row['user_password'];
	
	if($db_user_password != $user_password) {
		$hased_password = password_hash($user_password,PASSWORD_BCRYPT,array('cost' => 12));
	}

	 
$query = "UPDATE users SET ";
$query .= "user_firstname = '{$user_firstname}', ";
$query .= "user_lastname = '{$user_lastname}', ";
$query .= "user_role = '{$user_role}', ";
$query .= "username = '{$username}', ";
$query .= "user_email = '{$user_email}', ";
$query .= "user_password = '{$hased_password}' ";
$query .= "WHERE user_id = {$the_user_id} ";

$edit_user_query = mysqli_query($connection,$query);

comfirmQuery($edit_user_query);
echo "Update User:"." "."<a href='users.php'>View all users</a>";
	
}

 

}

}else{
	header("Location: index.php");
}
?>

<form action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label for="title">Firstname</label>
        <input type="text" class="form-control" value="<?php echo $user_firstname;?>" name="user_firstname">    
    </div>
	
	<div class="form-group">
        <label for="title">Lastname</label>
        <input type="text" class="form-control" value="<?php echo $user_lastname;?>" name="user_lastname">
    </div> 

	 <div class="form-group">
        <select name="user_role" class="form-control" id="form-status">
		<option value='<?php echo $user_role?>'><?php echo $user_role;?></option>;
<?php


if($user_role == 'admin'){
	echo "<option value='subscriber'>subscriber</option>";
}
else{
	echo "<option value='admin'>admin</option>";
}




?>
        
        
        
        </select>
    </div>

    <div class="form-group">
        <label for="post_status">Username</label>
        <input type="text" class="form-control" value="<?php echo $username;?>" name="username">    
    </div>
	


    <div class="form-group">
        <label for="post_tags">Email</label>
        <input type="email" class="form-control" value="<?php echo $user_email;?>" name="user_email">    
    </div>

<!--    <div class="form-group">
       <img width="100" src="../images/<?php //echo $post_image; ?>" alt="">
          <input type="file" name="image">
    </div> -->

    <div class="form-group">
        <label for="post_content">Password</label>
        <input type="password" class="form-control" value="<?php echo $user_password;?>" name="user_password">    
    </div>

 <!--   <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea class="form_content" name="post_content" id="" cols="30" rows="10"> <?php //echo $post_content;?> </textarea>   
    </div>-->

    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="edit_user" value="Edit User">
    </div>

</form>