<html>
<head>
	<title>Build Internet! | Form validation Using PHP Part 2: Streamline with Arrays</title>
	<style type="text/css">
		*{
		    padding:0px;
		    margin:0px;
		}
		body{
		    text-align:center;
		    font:11px "Lucida Grande",Arial,sans-serif;	
		}
		p{
			margin:0px 0px 5px 0px;
		}
		#content{
		    width:300px;
		    text-align:left;
		    margin:10px;
		}
		#name, #email, #comments{
		    width:100%;
		    padding: 6px;
		    font:11px "Lucida Grande",Arial,sans-serif;	
		}
		#submit{
			float:right;
		}
		label{
		    font:18px "Helvetica",Arial,sans-serif;
		}
		.green{
		    width:100%;
		    background-color:#95ca78;
		    border-bottom:solid 1px #8AA000;
		    padding:10px 0px 10px 5px;
		    margin-bottom: 8px;
		    font-weight:bold;
		    text-align:left;
		}
		.red{
		    color:#E8514A;
		    font-weight:bold;
		}	
	</style>
</head>
<body>
<?php 
if (array_key_exists('submit',$_POST)){
	// Fields that are on form
	$expected = array('name', 'email', 'comments');
	// Set required fields 
	$required = array('name', 'comments'); 
	// Initialize array for errors 
	$errors = array(); 
	
	
	foreach ($_POST as $field => $value){
		// Assign to $temp and trim spaces if not array 
		$temp = is_array($value) ? $value : trim($value);
		// If field is empty and required, tag onto $errors array 
		if (empty($temp) && in_array($field, $required)) { 
			array_push($errors, $field); 
		} 
	}
	
?>

   <div id="content">
  
<form id="commentform" method="post" action="errorpart2.php"> 
	<p> 
	<label for="name">Name:</label> 
	<?php if (isset($errors) && in_array('name', $errors)){?>
	<div class="red">Please enter name</div>
	<?php } ?> 
	<br/>
	<input name="name" id="name" type="text"
	<?php if (isset($errors)) { echo 'value="'.htmlentities($_POST['name']).'"'; } ?>
	/> 
	</p> 
	<p> 
	<label for="email">Email:</label> <br/>
	<input name="email" id="email" type="text"
	<?php if (isset($errors)) { echo 'value="'.htmlentities($_POST['email']).'"'; } ?>
	/> 
	</p> 
	<p> 
	<label for="comments">Comment:</label>
	<?php if (isset($errors) && in_array('comments', $errors)){?>
	<div class="red">Please enter comment</div> 
	<?php } ?> 
	<br/> 
	<textarea name="comments" id="comments" rows="4"><?php 
	if (isset($errors)) { echo htmlentities($_POST['comments']); } 
	?></textarea> 
	</p> 
	<p> 
	<input name="submit" id="submit" type="submit" value="Submit" /> 
	</p>  
</form> 

</div>
</body>
</html>
