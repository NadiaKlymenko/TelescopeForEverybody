<?
   
    include ('db_fns.php');
    include ('cart_fns.php');

    session_start();
    
    if (!isset($_SESSION['cart']))
    {
        $_SESSION['cart']=array();
        $_SESSION['total_items']=0;
        $_SESSION['total_price']='0.00';
        
        
    }

     if (!isset($_SESSION['currency']))
    {

         $_SESSION['currency']=get_current('UAH');
        
    }

  
   
    
        
       

    $view = empty($_GET['view']) ? 'index' : $_GET['view'];
    
    switch($view) {
        
            
        case ('choose'):
        
        break;
        
        
        case ('prod'):
        $products = get_products();
        break;
        
        case ('cat'):
            $cat= $_GET['cat_id'];
            $products = get_cat_products($cat);
        break;
        
                
        case ('product'):
            $id = $_GET['id'];
            $product = get_product($id);
        break;
        
        
       case ('add_to_cart'):
            $id = mysql_real_escape_string(htmlspecialchars($_GET['id']));
            $add_item = add_to_cart($id);
            $_SESSION['total_items'] = total_items($_SESSION['cart']);
            $_SESSION['total_price'] = total_price($_SESSION['cart']);
            header ('Location: index.php?view=product&id='.$id);
        
        break;

        case 'clear_cart':
            clear_cart();
            $_SESSION['total_items']=0;
            $_SESSION['total_price']='0.00';
            header('Location: index.php?view=cart');

    break;
    case 'change_currency':
        
        $_SESSION['currency']= get_current($_POST['curr']);

        echo $_POST['curr'];
        echo $_SESSION['currency']['name'];

\
//            foreach ($_POST['curr'] as $key => $value);
//                echo "the value of the $key is ".$value;
//        header('Location:'. $_SERVER['HTTP_REFERER'] );
        

    break;
        
        case ('update_cart'):
            update_cart();
            $_SESSION['total_items'] = total_items($_SESSION['cart']);
            $_SESSION['total_price'] = total_price($_SESSION['cart']);
            header ('Location: index.php?view=cart');
        break;
    }
if(isset($_GET['out']))
{
        unset($_SESSION['user']);
        
}


    include ($_SERVER['DOCUMENT_ROOT'].'/ready/views/layouts/shop.php');
?>