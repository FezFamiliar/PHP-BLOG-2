<?

include 'config.php';

if(isset($_GET['cart'])) header( "refresh:0;url=".str_replace('&cart=true','',$_SERVER['REQUEST_URI']));
if(isset($_GET['payed'])){

 foreach ($_SESSION['cart'] as $key => $products) {
       if($key == 'total')continue;
        mysqli_query($conn,"UPDATE `products` SET stock = stock - '".$products['quantity']."' WHERE id = '". $products['id']."'");
 }

 unset($_SESSION['cart']);
 header("refresh:0;url=index.php");
}
//print_array($_SESSION);

if(isset($_GET['logout'])){

  unset($_SESSION['username']);
  header("refresh:0;url=index.php");
}
include 'header.php';
$page = 3;

if($_SERVER['REQUEST_METHOD'] == 'POST'){


  $_SESSION['cart'][$_SESSION['cart']['total']] = array(

    'id' => trim($_POST['id']),
    'name' => trim($_POST['name']),
    'description' =>  trim($_POST['description']),
    'price' => trim($_POST['price']),
    'quantity' => trim($_POST['quantity'])

  );


}

if(isset($_GET['category_id'])){

  $max_query = mysqli_query($conn,"SELECT count(id) FROM posts WHERE category_id = '".$_GET['category_id']."'");

  $max = mysqli_fetch_array($max_query);
  $_SESSION['totalpage'] = ceil($max[0]/$page);
  $start = ($_GET['page'] * $page) - $page;
  $get_posts = mysqli_query($conn,"SELECT * FROM posts WHERE category_id = '".$_GET['category_id']."' LIMIT $start,$page");
  $rowcount=mysqli_num_rows($get_posts);
}
include 'menu.php';

   if(isset($_GET['category_id'])): ?>
       <section class="container">
           <? 
           if($rowcount > 0):
                 while($row = mysqli_fetch_array($get_posts)): ?>
                <div class="products">


             </div>
           <? endwhile;else: echo "Nu aveti nicio postare!";endif;?>
              <a href="?category_id=<?= $_GET['category_id']; ?>&page=<?= (($_GET['page'] + 1) % ($_SESSION['totalpage']+1) == 0) ? 1 : $_GET['page'] + 1; ?>">
                <img src="lightbox/images/next.png" class="next">
              </a>
            <div class="pages">
                <? for($i = 1; $i <= $_SESSION['totalpage']; $i++): ?>
                  <a href="?category_id=<?= $_GET['category_id']; ?>&page=<?= $i; ?>" class="<? if($_GET['page'] == $i) echo 'selected'; ?>"><?= $i; ?></a>
                <? endfor; ?>
            </div>
       </section>

<? endif;?>