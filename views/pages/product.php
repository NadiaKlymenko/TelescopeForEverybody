   
   
					<div id="img_telescop">
						<a href="index.php? view=product&id=<?=$product['id']?>"><img src="images/tovar/<?=$product['image']?>"></a>
					</div>
					<div id="name_telescop">
						<p><a href="index.php?view=product&id=<?=$product['id']?>"><?=$product['title']?></a></p>
					</div>
					<div id="price_telescop">
						<p><?=$product['price']?>.грн</p>
					</div>
                    
                    <p><?=$product['description']?> </p>
                    <div><a href="index.php?view=add_to_cart&id=<?=$product['id']?>"> Add to the cart </a></div>
				