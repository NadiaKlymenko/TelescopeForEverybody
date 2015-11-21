<?
if ($_SESSION['cart'] && !isset($_POST['order']))
{
?>
<form action="index.php?view=order" method="post" id="cart-form">
<table id="mycart"> 
    <tr>
        <th>Товар</th> 
        <th>Цена</th> 
        <th>Количество</th> 
        <th>Всего</th> 
    </tr>
    <? foreach($_SESSION['cart'] as $id => $quantity):
    $product = get_product($id);
     ?>
    <tr>
        <td align="center"><?=$product['title'];?></td>
        <td align="center">$<?=number_format($product['price'], 2);?></td>
        <td align="center"><?=$quantity?></td>
        <td align="center">$<?=number_format($product['price']*$quantity,2);?></td>
    </tr>
    <?endforeach;?>
</table>

<p class="total" align="center">Общая сумма заказа: <span class= product-price>- <?=$_SESSION['total_price'];?>$</span></p>

<?
    if (!isset($_SESSION['user']))
    {
?>
    <p align="center" style="color: 000;">
Ваше имя: <br />
<input type="text" name="name"/> <br/>
Ваш телефон: <br />
<input type="text" name="phone"/> <br/>
Ваш ардрес: <br />
<input type="text" name="adress"/> <br/>
Ваш e-mail: <br />
<input type="text" name="email"/> <br/>
<select name="method" >
    <option>Самовывоз</option>
     <option>Доставка</option>


    </select><br/>
 </p>
<?
}
else
{
    ?>
    <p align="center" style="color: 000;">
Ваше имя: <br />
<input type="text" name="name" value="<?=$_SESSION['user']['name']?>"/> <br/>
Ваш телефон: <br />
<input type="text" name="phone" value="<?=$_SESSION['user']['phone']?>"/> <br/>
Ваш ардрес: <br />
<input type="text" name="adress" value="<?=$_SESSION['user']['adress']?>"/> <br/>
Ваш e-mail: <br />
<input type="text" name="email"value="<?=$_SESSION['user']['email']?>"/> <br/>
<select name="method" >
    <option>Самовывоз</option>
     <option>Доставка</option>


    </select><br/>
 </p>
 <?}?>
<p align="center"> <input type="submit" name="order" value="Заказать" /></p>
</form>

<?
}

if($_SESSION['cart'] && isset($_POST['order']))
{
	
	$name=$_POST['name'];
    $phone=$_POST['phone'];
	$adress=$_POST['adress'];
	$email=$_POST['email'];
    $method=$_POST['method'];
	$data=date('Y-m-d');
	$time=date('H:i:s');



if (isset($_SESSION['user']))
{
    foreach ($_SESSION['cart'] as $id => $quantity):
    	$product=get_product($id);
    	$query=mysql_query("INSERT INTO orders(method,user_id,name,phone,adress,email,data,time,product,prod_id,price,qty) VALUES ('$method','{$_SESSION['user']['id']}','$name','$phone','$adress','$email','$data','$time','{$product['title']}','{$product['id']}','{$product['price']}','$quantity')");

    endforeach;
}
else
{
    foreach ($_SESSION['cart'] as $id => $quantity):
        $product=get_product($id);
        $query=mysql_query("INSERT INTO orders(method,name,phone,adress,email,data,time,product,prod_id,price,qty) VALUES ('$method','$name','$phone','$adress','$email','$data','$time','{$product['title']}','{$product['id']}','{$product['price']}','$quantity')");

    endforeach;
}





$to=$email;
$subject="order";
if($_SESSION['total_items']==1)
{
$message="Вы заказали ".$_SESSION['total_items']."товар на сумму ".round($_SESSION['total_price']/$_SESSION['currency']['koef'],2)." ".$_SESSION['currency']['name'].". Спасибо за ваш заказ!";
}
elseif ($_SESSION['total_items']>1 && $_SESSION['total_items']<5)
{
$message="Вы заказали ".$_SESSION['total_items']." товара на сумму ".round($_SESSION['total_price']/$_SESSION['currency']['koef'],2)." ".$_SESSION['currency']['name'].". Спасибо за ваш заказ!";
}
else
{
$message="Вы заказали ".$_SESSION['total_items']." товаров на сумму ".round($_SESSION['total_price']/$_SESSION['currency']['koef'],2)." ".$_SESSION['currency']['name'].". Спасибо за ваш заказ!";
}
$headers = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

mail($to,$subject,$message,$headers);






clear_cart();
            $_SESSION['total_items']=0;
            $_SESSION['total_price']='0.00';
echo "<p align='center'>Ваш заказ принят.</p>";

}

?>