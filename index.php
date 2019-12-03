<?

include 'config.php';
if(isset($_GET['logout'])){

  unset($_SESSION['username']);
  unset($_SESSION['id']);
  header("refresh:0;url=index.php");
}
include 'header.php';
$page = 3;
if(isset($_GET['category_id'])){

  $max_query = mysqli_query($conn,"SELECT count(id) FROM posts WHERE category_id = '".$_GET['category_id']."'");

  $max = mysqli_fetch_array($max_query);
  $_SESSION['totalpage'] = ceil($max[0]/$page);
  $start = ($_GET['page'] * $page) - $page;
  $get_posts = mysqli_query($conn,"SELECT * FROM posts WHERE category_id = '".$_GET['category_id']."' LIMIT $start,$page");
  $rowcount=mysqli_num_rows($get_posts);

}
if(isset($_GET['comment']) && $_GET['comment'] == 'true'):
    if(isset($_SESSION['username']) == false): ?>
    <script type="text/javascript">alert('You need to sign in!');</script>
        <?else: ?>                   
          <form action="" method="POST" autocomplete="off" class="comment-form">
          <br>
          Mesaj:
          <textarea class="form-control" rows="3" name="msg">
            
          </textarea>
          <br>
          <input type="submit" value="Comenteaza!" class="btn btn-primary submit">
        </form>

          

<? 

  if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $msg = mysqli_real_escape_string($conn,$_POST['msg']);
    $post_id = mysqli_real_escape_string($conn,$_GET['post_id']);
    // $query =  mysqli_query($conn,"UPDATE `posts` SET comment_ = '".$msg."', who_comment = '".$_SESSION['username']."' WHERE id = '".$post_id."'");

    $query =  mysqli_query($conn,"INSERT INTO `comments`(post_id,comment,commented,who_comment) VALUES('".$post_id."','".$msg."',NOW(),'".$_SESSION['username']."')");
    

    if($query) {

      echo'<p class="success-post">Your comment has been posted!</p>';

      
     // $row_c = mysqli_fetch_array($query_comm);
      // print_r($row_c);
      // die();
    } 
    else   echo 'eroare!';


  }



endif;endif; 


include 'menu.php';

   if(isset($_GET['category_id'])): ?>
      
       <section class="container">
           <? 
           if($rowcount > 0):
                 while($row = mysqli_fetch_array($get_posts)): ?>
                <div class="posts">
                  <p>Title: <?= $row['title']; ?></p>
                  <p>Message: <?= $row['message']; ?></p>
                  <p style="float:right;"><?= $row['user_who_posted'] . "<br> " .$row['posted']; ?></p>
                  <br>
                  <a href="<?= $_SERVER['REQUEST_URI']; ?>&comment=true&post_id=<?= $row['id'];?>" class="addpost">Adaugati un comentariu!</a>
                  <?
                    $query_comm = mysqli_query($conn,"SELECT * FROM `comments` WHERE post_id = '".$row['id']."'"); 
                    while($row_c = mysqli_fetch_array($query_comm)): ?>
                    <p><?= $row_c['comment'] . " - " . $row_c['who_comment'];?></p>
                  <? endwhile;?>
                </div> 
           <? endwhile;else: echo "Nu este nicio postare!";endif;?>
           
              
                
            <div class="pages">
              <a href="?category_id=<?= $_GET['category_id']; ?>&page=<?= (($_GET['page']) % ($_SESSION['totalpage']+1) == 1) ? $_SESSION['totalpage'] : $_GET['page'] - 1; ?>"class="prev"><--</a> &nbsp;&nbsp;&nbsp;&nbsp;
               <a href="?category_id=<?= $_GET['category_id']; ?>&page=<?= (($_GET['page'] + 1) % ($_SESSION['totalpage']+1) == 0) ? 1 : $_GET['page'] + 1; ?>">--></a>

                    <br>
                <? for($i = 1; $i <= $_SESSION['totalpage']; $i++): ?>

                  <a href="?category_id=<?= $_GET['category_id']; ?>&page=<?= $i; ?>" class="<? if($_GET['page'] == $i) echo 'selected'; ?>"><?= $i; ?></a>
                <? endfor; ?>
            </div> 
       </section>

<? endif;?>