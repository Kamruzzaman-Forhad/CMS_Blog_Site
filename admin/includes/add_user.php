<?php
    if(isset($_POST['create_user'])){
        
        $user_firstname = $_POST['user_firstname'];
        $user_lastname = $_POST['user_lastname'];
        $user_role = $_POST['user_role'];


        $username = $_POST['username'];
        $user_email = $_POST['user_email'];
		$user_password = $_POST['user_password'];
		

		$user_password = password_hash($user_password,PASSWORD_BCRYPT,array('cost' => 12));
 
        $query = "INSERT INTO users(user_firstname, user_lastname, user_role, username, user_email, user_password)";

        $query .= "VALUES('{$user_firstname}','{$user_lastname}','{$user_role}','{$username}','{$user_email}','{$user_password}')";

        $create_user_query = mysqli_query($connection, $query);

        comfirmQuery($create_user_query); 
		
		
		echo "Create User:"." "."<a href='users.php'>View all users</a>";

    }


?>




<form action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label for="title">Firstname</label>
        <input type="text" class="form-control" name="user_firstname">    
    </div>
	
    <div class="form-group">
        <label for="title">Lastname</label>
        <input type="text" class="form-control" name="user_lastname">
    </div> 

    <div class="form-group">
		<label for="title">User Role</label>
        <select name="user_role" class="form-control" id="form-status">
			<option value="subscriber">Select Option</option>
			<option value="admin">Admin</option>
			<option value="subscriber">Subscriber</option>
        
        
        
        </select>
    </div>


    <div class="form-group">
        <label for="post_status">Username</label>
        <input type="text" class="form-control" name="username">    
    </div>

<!--  <div class="form-group">
        <label for="post_image">Post Image</label>
        <input type="file" name="image">    
    </div> -->

    <div class="form-group">
        <label for="post_tags">Email</label>
        <input type="email" class="form-control" name="user_email">    
    </div>

    <div class="form-group">
        <label for="post_content">Password</label>
        <input type="password" class="form-control" name="user_password">    
    </div>

    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="create_user" value="Add User">
    </div>

</form>