<form action=""method="post">
                                <div class="form-group">
                                    <label for="cat-title">Edit Category</label>

<?php
    if(isset($_GET['edit'])){
        $the_cat_id = $_GET['edit'];

        $query = "SELECT * FROM categories WHERE cat_id =$the_cat_id ";
        $select_categories_id = mysqli_query($connection,$query);

        while($row = mysqli_fetch_assoc($select_categories_id)){
          $cat_id = $row['cat_id'];
          $cat_title = $row['cat_title'];
          
?>

<input value="<?php if(isset($cat_title)){echo $cat_title;} ?>" type="text" name="cat_title" class="form-control">
<?php }}?>


<?php
        ///Update categories
        if(isset($_POST['update_category'])){
        $the_cat_title = $_POST['cat_title'];
		
		
		
	  /*$query = "UPDATE categories SET cat_title = '{$the_cat_title}' WHERE cat_id = {$cat_id}";
        $update_query = mysqli_query($connection,$query);

        if(!$update_query){
            die("QUERY FAILED".mysqli_error($connection));
        } */
		
		
		$stmt = mysqli_prepare($connection, "UPDATE categories SET cat_title = ? WHERE cat_id = ? ");
		mysqli_stmt_bind_param($stmt, "si", $the_cat_title, $cat_id);
		mysqli_stmt_execute($stmt);
		
		if(!$stmt){
			die("QUERY FAILED".mysqli_error($connection));
		}
		
		mysqli_stmt_close($stmt);
		
		header("Location: categories.php");
    }


?>
                                </div>
                                <div class="form-group">
                                    <input type="submit" name="update_category" class="btn btn-primary" value="Update category">
                                </div>
                            </form>