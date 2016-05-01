<?php
session_start();
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset='UTF-8'>
  </head>
	<body>
	<?php
		// remove all session variables
		session_unset(); 

		// destroy the session 
		session_destroy(); 
		header('Location: index.php');
		exit;
?>

</body>
</html>