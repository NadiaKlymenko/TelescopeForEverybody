<div id="info">
	<p>Name: <?=$_SESSION['user']['name'];?></p>
	<p>Adress: <?=$_SESSION['user']['name'];?></p>
	<p>Phone: <?=$_SESSION['user']['phone'];?></p>
	<p>Email: <?=$_SESSION['user']['email'];?></p>
</div>

<?
	db_connect ();
	$id=$_SESSION ['user']['id'];
	$query="SELECT * FROM orders WHERE user_id='$id'";
	$result = mysql_query($query);

	if (mysql_affected_rows()>0)
	{ ?>
 
      <table > 
	    <tr>
	        <th>Товар</th> 
	        <th>Цена</th> 
	        <th>Количество</th> 
	        <th>Всего</th> 
	    </tr>
	    <?
	    $products = get_user_products($_SESSION['user']['id']);
	    foreach($products as $product ):
	   
	     ?>
	    <tr>
	        <td align="center"><?=$product['title'];?></td>
	        <td align="center">$<?=number_format($product['price'], 2);?></td>
	        <td align="center"><?=$quantity?></td>
	        <td align="center">$<?=number_format($product['price']*$product['qty'],2);?></td>
	    </tr>
	    <?endforeach;?>
	</table>
	<?}


	else
	{
		echo ("<p align = 'center'> У вас нет заказов</p>");
	}
?>