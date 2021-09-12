<?php 
if(isset($_POST['name'])) {
	sleep(2);
	$connect = new PDO('mysql:host=localhost; dbname=testing', 'root', '');

	$success = '';

	$name = $_POST['name'];
	$email = $_POST['email'];
	$website = $_POST['website'];
	$comment = $_POST['comment'];
	$gender = $_POST['gender'];

	$name_error = '';
	$email_error = '';
	$website_error = '';
	$comment_error = '';
	$gender_error = '';


	if(empty($name)) {
		$name_error = 'Name is required';
	} else {
		if(!preg_match("/^[a-zA-Z-' ]*$/", $name)) {
			$name_error = 'Only letter and white space are allowed';
		}
	}

	if(empty($email)) {
		$email_error = 'Email is required';
	} else {
		if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$email_error = 'Email is invalid';
		}
	}

	if(empty($website)) {
		$website_error = 'Website is required';
	} else {
		if(!filter_var($website, FILTER_VALIDATE_URL)) {
			$website_error = 'Website is invalid';
		}
	}

	if(empty($comment)) {
		$comment_error = 'Comment is required';
	}

	if(empty($gender)) {
		$gender_error = 'Please select gender';
	}

	if($name_error == '' && $email_error == '' && $website_error == '' && $comment_error == '' && $gender_error == '') {
		$data = array(
			':name' => $name,
			':email' => $email,
			':website' => $website,
			':comment' => $comment,
			':gender' => $gender,
		);

		$query = "
		INSERT INTO data_sample
		(name, email, website, comment, gender)
		VALUES(:name, :email, :website, :comment, :gender)
		";

		$statement = $connect->prepare($query)->execute($data);
		// $statement->execute($data);

		$success = '<div class="alert alert-success">Data Inserted Successfully</div>';
	}







	$output = array(
		'success'     => $success,
		'name_error'  => $name_error,
		'email_error'  => $email_error,
		'website_error'  => $website_error,
		'comment_error'  => $comment_error,
		'gender_error'  => $gender_error,

	);

	echo json_encode($output);




}

?>