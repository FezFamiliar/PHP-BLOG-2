<?

include 'config.php';

//print_array($_SESSION);

if(isset($_GET['logout'])){

  unset($_SESSION['username']);
  unset($_SESSION['id']);
  header("refresh:0;url=index.php");
}
include 'header.php';
$page = 3;
if(isset($_GET['add']) && $_GET['add'] == 'true'): ?>

          <form action="" method="POST" autocomplete="off" class="comment-form">
          <br>
          Titlu:
          <input type="text" name="titlu" class="form-control">
          <br>
          Mesaj:
          <textarea class="form-control" rows="3" name="msg">
            

          </textarea>
          <br>
          <input type="submit" value="Salveaza" class="btn btn-primary submit">
        </form>

          

<? 

  if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $cat_id = $_GET['category_id'];
    $title = $_POST['titlu'];
    $msg = $_POST['msg'];

    /*   echo "INSERT INTO `posts`(post_id,category_id,title,message,posted) VALUES('1' ,'". $cat_id."', '".$title."' ,'".$msg."', NOW())";*/



    $query =  mysqli_query($conn,"INSERT INTO `posts`(user_who_posted,category_id,title,message,posted) VALUES('".$_SESSION['username']."' ,'". $cat_id."', '".$title."' ,'".$msg."', NOW())");

    if($query) echo 'comentul dvs a fost postat!';
    else   echo 'eroare!';


  }

endif; 

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
     <a href="<?= $_SERVER['REQUEST_URI']; ?>&add=true" class="addpost">Adaugati o postare!</a>
       <section class="container">
           <? 
           if($rowcount > 0):
                 while($row = mysqli_fetch_array($get_posts)): ?>
                <div class="posts">

                  <p>Title: <?= $row['title']; ?></p>
                  <p>Message: <?= $row['message']; ?></p>
                  <p style="float:right;"><?= $row['user_who_posted'] . "<br> " .$row['posted']; ?></p>
                  <br>
  
                </div> 
           <? endwhile;else: echo "Nu aveti nicio postare!";endif;?>
           
              
                
            <div class="pages">
              <a href="?category_id=<?= $_GET['category_id']; ?>&page=<?= (($_GET['page']) % ($_SESSION['totalpage']+1) == 1) ? $_SESSION['totalpage'] : $_GET['page'] - 1; ?>"class="prev"><--</a> 
               <a href="?category_id=<?= $_GET['category_id']; ?>&page=<?= (($_GET['page'] + 1) % ($_SESSION['totalpage']+1) == 0) ? 1 : $_GET['page'] + 1; ?>">--></a>

                    <br>
                <? for($i = 1; $i <= $_SESSION['totalpage']; $i++): ?>

                  <a href="?category_id=<?= $_GET['category_id']; ?>&page=<?= $i; ?>" class="<? if($_GET['page'] == $i) echo 'selected'; ?>"><?= $i; ?></a>
                <? endfor; ?>
            </div> 
       </section>

<? endif;?>