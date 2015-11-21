<?

function get_user($name,$password)
{
	db_connect();

	$query=("SELECT name, password FROM users WHERE name='$name' and password='$password'");
    $result=mysql_query($query);
    $row=mysql_fetch_array($result);
    return $row;
}


?>