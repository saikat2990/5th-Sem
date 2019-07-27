<?php
	session_start();
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Rafed's Login</title>
	</head>
	
	<body>
		<?php
			if(isset($_POST['login'])){
								
				$sqlConnect=mysqli_connect('localhost', 'root', '', 'Future');
	
				if(!$sqlConnect)
					die("Could not connect. ".mysqli_connect_errno());
				
				$user = $_POST['user'];
				$pass = $_POST['pass'];
				
				$sqlQuery = "select * from users where username='".$user."' and password='".$pass."'";
				$sqlResult = mysqli_query($sqlConnect, $sqlQuery);
				
				$sqlRow = mysqli_fetch_array($sqlResult, MYSQLI_ASSOC);
				if(!$sqlRow){
					echo "Wrong username or password";
				}
				else{
					$_SESSION['username'] = $user;					
				}
				
			}
			if(isset($_POST['logout'])){
				session_unset(); 
				session_destroy(); 
			}
		?>
		<?php
			if(isset($_SESSION['username'])){
		?>
			<h2> Welcome <?php echo $_SESSION['username']?></h2>
			
			<form name="user" method="post" action="login.php">
				<input type = "submit" name = "logout" value = "Logout">
			</form>
			
			<?php 
			}
			else{
				
			?>
		<h2>Login now!</h2>
		
		<form name="user" method="post" action="login.php">
			<table>
				<tr><td>Username: </td><td><input type = "text" name = "user"></td></tr>
				<tr><td>Password: </td><td><input type = "text" name = "pass"></td></tr>
			</table>
			<input type = "submit" name = "login" value = "Login">
		</form>
		<?php } ?>
	</body>
</html>