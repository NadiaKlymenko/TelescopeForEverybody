<?
if ($_SESSION['cart']){
?>
<form action="index.php?view=update_cart" method="post" id="cart-form">
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
        <td align="center"><input type="text" size="2" name="<?=$id;?>" maxlength="2" value="<?=$quantity?>" /></td>
        <td align="center">$<?=number_format($product['price']*$quantity,2);?></td>
    </tr>
    <?endforeach;?>
</table>

<p class="total" align="center">Общая сумма заказа: <span class= product-price>- <?=$_SESSION['total_price'];?>$$</span></p>
<p align="center"> <input type="submit" name="update" value="Обновить" /></p>
</form>

<form action="index.php?view=clear_cart" method="post" id="cart-form">
<p align="center"> <input type="submit" name="clear" value="Очистить" /></p>
</form>

<p align="center"><a href="index.php?view=order">Оформить заказ</a></p>
<?
}
else 
{
    echo "Ваша корзина пуста";
}
?>