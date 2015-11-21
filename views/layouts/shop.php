<!Doctype HTML>
<HTML>
	<head>
   	 <link rel="stylesheet" type="text/css" href="css/style_my.css">
   	 <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
   	 <link rel="stylesheet" href="css/style.css" type="text/css" media="screen"/>
		<script src="js/cufon-yui.js" type="text/javascript"></script>
		<script src="js/Cantarell.font.js" type="text/javascript"></script>
   	 <title>Shop</title>

	</head>
	<body>
		<header>
			<div id="emblem"><a href = "index.php?view=index"><img src="images/emblem.png"/></a></div>
			<div id="title" ><h1>Серверное сияние </h1></div>
			
				
				<ul id="tools">
					<?
						if (isset($_SESSION['user']))
						{
						?>
						<li><a href="index.php?view=cabinet"><?=$_SESSION['user']['name'];?></a></li>
						<li><form action="index.php?view=logout">
						<input type="submit" id="sublogout" class="button" name="out" value="Выйти"  >
						</form></li>
						<?
						}
						else
						{
						?>
		 
						<li ><a href="index.php?view=enter">Войти</a></li>
						<li><a href="index.php?view=registration">Зарегистрироватся</a></li>
		   				<?}?>
				</ul>
				<form action="index.php?view=change_currency" method="post" id="curr">
								<select name="curr" onchange="document.getElementById('curr').submit()">
									<? 
										$currency=get_currency();
										echo $currency;
										
										foreach ($currency as $item):?>
										
										<option name="<?=$item['name'];?>" 
											<?if ($_SESSION['currency']==$item) echo " selected" //) ?>
										>
										<?=$item['name'];?></option>
										<?
										endforeach;
										?>
										
								</select> 
								<?echo $_SESSION['currency'];?>

								
					</form>

			
			<ul id="nav">
					<li><a href="index.php?view=index">Главная</a></li>
					<li>
						<a href="index.php?view=prod">Телескопы</a>
                        <ul>
						<? 
						$cat=get_cat();
						foreach ($cat as $item):?>
						<div><li><a href="index.php?view=cat&cat_id=<?=$item['cat_id']?>"><?=$item['name']?></a></li></div>
						<?
						endforeach;
						?>
                        </ul>
					</li>
					<li>
						<a href="index.php?view=choose">Как выбрать?</a>
					</li>

					<li>
						<a href="index.php?view=contacts">Контакты</a>
					</li>
			    <li>
			        <a href="index.php?view=cart">Корзина (<?=$_SESSION['total_items']?>) </a>
			    </li>
			</ul>

		</header>
		<div id="slider">
			<div id="hs_container" class="hs_container">
					<div class="hs_area hs_area1">
						<img class="hs_visible" src="images/area1/1.jpg" alt=""/>
						<img src="images/area1/2.jpg" alt=""/>
						<img src="images/area1/3.jpg" alt=""/>
					</div>
					<div class="hs_area hs_area2">
						<img class="hs_visible" src="images/area2/1.jpg" alt=""/>
						<img src="images/area2/2.jpg" alt=""/>
						<img src="images/area2/3.jpg" alt=""/>
					</div>
					<div class="hs_area hs_area3">
						<img class="hs_visible" src="images/area3/1.jpg" alt=""/>
						<img src="images/area3/2.jpg" alt=""/>
						<img src="images/area3/3.jpg" alt=""/>
					</div>
					<div class="hs_area hs_area4">
						<img class="hs_visible" src="images/area4/1.jpg" alt=""/>
						<img src="images/area4/2.jpg" alt=""/>
						<img src="images/area4/3.jpg" alt=""/>
					</div>
					<div class="hs_area hs_area5">
						<img class="hs_visible" src="images/area5/1.jpg" alt=""/>
						<img src="images/area5/2.jpg" alt=""/>
						<img src="images/area5/3.jpg" alt=""/>
					</div>
				</div>

				
		</div>

		
        <!-- The JavaScript -->
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.3/jquery.min.js"></script>
		<script type="text/javascript" src="js/jquery.easing.1.3.js"></script>
        <script type="text/javascript">
            $(function() {
				//custom animations to use
				//in the transitions
				var animations		= ['right','left','top','bottom','rightFade','leftFade','topFade','bottomFade'];
				var total_anim		= animations.length;
				//just change this to one of your choice
				var easeType		= 'swing';
				//the speed of each transition
				var animSpeed		= 450;
				//caching
				var $hs_container	= $('#hs_container');
				var $hs_areas		= $hs_container.find('.hs_area');
				
				//first preload all images
                $hs_images          = $hs_container.find('img');
                var total_images    = $hs_images.length;
                var cnt             = 0;
                $hs_images.each(function(){
                    var $this = $(this);
                    $('<img/>').load(function(){
                        ++cnt;
                        if(cnt == total_images){
							$hs_areas.each(function(){
								var $area 		= $(this);
								//when the mouse enters the area we animate the current
								//image (random animation from array animations),
								//so that the next one gets visible.
								//"over" is a flag indicating if we can animate 
								//an area or not (we don't want 2 animations 
								//at the same time for each area)
								$area.data('over',true).bind('mouseenter',function(){
									if($area.data('over')){
										$area.data('over',false);
										//how many images in this area?
										var total		= $area.children().length;
										//visible image
										var $current 	= $area.find('img:visible');
										//index of visible image
										var idx_current = $current.index();
										//the next image that's going to be displayed.
										//either the next one, or the first one if the current is the last
										var $next		= (idx_current == total-1) ? $area.children(':first') : $current.next();
										//show next one (not yet visible)
										$next.show();
										//get a random animation
										var anim		= animations[Math.floor(Math.random()*total_anim)];
										switch(anim){
											//current slides out from the right
											case 'right':
												$current.animate({
													'left':$current.width()+'px'
												},
												animSpeed,
												easeType,
												function(){
													$current.hide().css({
														'z-index'	: '1',
														'left'		: '0px'
													});
													$next.css('z-index','9999');
													$area.data('over',true);
												});
												break;
											//current slides out from the left
											case 'left':
												$current.animate({
													'left':-$current.width()+'px'
												},
												animSpeed,
												easeType,
												function(){
													$current.hide().css({
														'z-index'	: '1',
														'left'		: '0px'
													});
													$next.css('z-index','9999');
													$area.data('over',true);
												});
												break;
											//current slides out from the top	
											case 'top':
												$current.animate({
													'top':-$current.height()+'px'
												},
												animSpeed,
												easeType,
												function(){
													$current.hide().css({
														'z-index'	: '1',
														'top'		: '0px'
													});
													$next.css('z-index','9999');
													$area.data('over',true);
												});
												break;
											//current slides out from the bottom	
											case 'bottom':
												$current.animate({
													'top':$current.height()+'px'
												},
												animSpeed,
												easeType,
												function(){
													$current.hide().css({
														'z-index'	: '1',
														'top'		: '0px'
													});
													$next.css('z-index','9999');
													$area.data('over',true);
												});
												break;
											//current slides out from the right	and fades out
											case 'rightFade':
												$current.animate({
													'left':$current.width()+'px',
													'opacity':'0'
												},
												animSpeed,
												easeType,
												function(){
													$current.hide().css({
														'z-index'	: '1',
														'left'		: '0px',
														'opacity'	: '1'
													});
													$next.css('z-index','9999');
													$area.data('over',true);
												});
												break;
											//current slides out from the left and fades out	
											case 'leftFade':
												$current.animate({
													'left':-$current.width()+'px','opacity':'0'
												},
												animSpeed,
												easeType,
												function(){
													$current.hide().css({
														'z-index'	: '1',
														'left'		: '0px',
														'opacity'	: '1'
													});
													$next.css('z-index','9999');
													$area.data('over',true);
												});
												break;
											//current slides out from the top and fades out	
											case 'topFade':
												$current.animate({
													'top':-$current.height()+'px',
													'opacity':'0'
												},
												animSpeed,
												easeType,
												function(){
													$current.hide().css({
														'z-index'	: '1',
														'top'		: '0px',
														'opacity'	: '1'
													});
													$next.css('z-index','9999');
													$area.data('over',true);
												});
												break;
											//current slides out from the bottom and fades out	
											case 'bottomFade':
												$current.animate({
													'top':$current.height()+'px',
													'opacity':'0'
												},
												animSpeed,
												easeType,
												function(){
													$current.hide().css({
														'z-index'	: '1',
														'top'		: '0px',
														'opacity'	: '1'
													});
													$next.css('z-index','9999');
													$area.data('over',true);
												});
												break;		
											default:
												$current.animate({
													'left':-$current.width()+'px'
												},
												animSpeed,
												easeType,
												function(){
													$current.hide().css({
														'z-index'	: '1',
														'left'		: '0px'
													});
													$next.css('z-index','9999');
													$area.data('over',true);
												});
												break;
										}	
									}
								});
							});
							
							//when clicking the hs_container all areas get slided
							//(just for fun...you would probably want to enter the site
							//or something similar)
							$hs_container.bind('click',function(){
								$hs_areas.trigger('mouseenter');
							});
						}
					}).attr('src',$this.attr('src'));
				});			
				

            });
        </script>
        <br>
        <div id="content">
        	  <?php include ($_SERVER['DOCUMENT_ROOT'].'/ready/views/pages/'.$view.'.php'); ?>
        </div>
		<footer>
		&copy;  2013 <a href="http://vk.com/nadia_klymenko">Nadia Klymenko</a>
		</footer>
	</body>
</HTML>

