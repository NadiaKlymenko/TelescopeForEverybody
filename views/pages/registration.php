<?
	db_connect();
	 if (isset($_POST['submit']))
	 {
	 	$name=$_POST['name'];
		$adress=$_POST['adress'];
		$email=$_POST['email'];
		$phone=$_POST['phone'];
		$password=$_POST['password'];
		$rPass=$_POST['passwordrepeat'];
		$errorName=$errorPass=$errorEmail=$errorPhone='';

		$query="SELECT * FROM users WHERE name='$name'";
		$result = mysql_query($query);


		if (mysql_affected_rows() > 0)
		{

			$errorName="<div id=\"error\">That name is allready used.</div>";			
		}

		if ($password!=$rPass)
		{
			$errorPass="<div id=\"error\">Password must match!</div>";
		}

		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) 				
		{
			$errorEmail="<div id=\"error\">Email invalid format</div>";
		}

		if (!filter_var($phone, FILTER_VALIDATE_INT)) 
		{   				
			$errorPhone="<div id=\"error\">Phone invalid format</div>";
		}


		if ($errorName=="" && $errorPhone=="" && $errorPass=="" && $errorEmail=="")
		{
			$password=md5($password);
						
			$query=mysql_query("INSERT INTO users(name,adress,email,phone,password) VALUES ('$name','$adress','$email','$phone','$password')");
			echo "<h1>Ваш аккаунт зарегистрирован.</h1>";
		}
					
	}
?>

<form  id="my-form-registration" action="index.php?view=registration" method="post" >  

		        <p > Your name:<input type="text" name="name"  value="<?=$name;?>" required> <?=$errorName;?> 
		        </p>
		        
		        <p> Your password:<input  type="password" name="password"  size=”10” required> 
		         <?=$errorPass;?>  </p>
		        <p> Repeat password:<input  type="password" name="passwordrepeat" size=”10” required>
		         </p>
		        <p> Adress:    <input  type="Text" name="adress" size=”10” value="<?=$adress;?>" required> 
		          </p>
		        <p> phone:    <input  type="Text" name="phone" size=”10” value="<?=$phone;?>" required> 
		        <?=$errorPhone;?>  </p>
		        <p> email:    <input  type="Text" name="email" size=”10” value="<?=$email;?>" required>
		         <?=$errorEmail;?> </p>     

		         <p align="center"><input type="submit" id="sub" class="button" name="submit" value="Submit"  > </p>
		        
		       
</form>
