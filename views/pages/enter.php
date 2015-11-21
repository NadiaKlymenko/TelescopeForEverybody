<?
        db_connect();
         if (isset($_POST['submit']))
         {
                $name=$_POST['name'];
                $password=md5($_POST['password']);
                $error='';

                $query=("SELECT * FROM users WHERE name='$name'");

                $result = mysql_query($query);

                $user=mysql_fetch_array($result);

                if ($user['password']!=$password)
                {
                        $error="<span id=\"error\">Неверное имя или пароль!</span>";
                }
                else
                {
                        $_SESSION['user']=$user;
                        
                        echo "Вы вошли на сайт.";
                }


                
        }
?>


<form name="myFormLogin" id="my-form-login" method="post" action="index.php?view=enter"> 


        <p> Your name:<input  type="Text" name="name" size=”10” value="<?=$name?>" required> 
         </p>
        <p> Your password:<input  type="password" name="password" size=”10” required>
          </p>
        <p><?=$error?></p>
        <p align="center"> <input type="submit" id="sublog" class="button" name="submit" value="Submit"  ></p>
</form>



