<?php

foreach ($products as $item ):?>
	



	<div class ="blok" id="blok">
					<div id="img_telescop">
						<a href="index.php?view=product&id=<?=$item['id']?>"><img src="images/tovar/<?=$item['image']?>"></a>
					</div>
					<div id="name_telescop">
						<p><a href="index.php?view=product&id=<?=$item['id']?>"><?=$item['title']?></a></p>
					</div>
					<div id="price_telescop">
						<p><?=$item['price']?>.грн</p>
					</div>
				</div>
<?
endforeach;

?>


