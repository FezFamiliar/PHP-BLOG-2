<?
include 'config.php';
include 'header.php';
if(!isset($_GET['page'])) $_GET['page'] = 1;
$page = $_GET['page'];
$max_query = mysqli_query($conn,"SELECT count(id) FROM posts");
$max = mysqli_fetch_array($max_query);
$end = 10;
$_SESSION['posts_total'] = ceil($max[0]/$end);
$start = ($page * $end) - $end;
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_GET['action']) && $_GET['action'] == 'add'){


    $category_id = mysqli_real_escape_string($conn,$_POST['category']);
    $title = mysqli_real_escape_string($conn,$_POST['title']);
    $message = mysqli_real_escape_string($conn,$_POST['msg']);

     $get_category =  mysqli_query($conn,"SELECT * FROM `categories` WHERE id ='".$category_id."'");
     if(mysqli_num_rows($get_category) > 0){

       $c_name = mysqli_fetch_array($get_category);
       $dir = $c_name['name'];
     }


    mysqli_query($conn,"INSERT INTO `posts`(user_who_posted,category_id,title,message,posted) VALUES('admin' ,'".$category_id ."', '".$title."' ,'".$message."' ,now())");
   header("refresh:0;posts.php");
}
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_GET['action']) && $_GET['action'] == 'edit'){


  $title = mysqli_real_escape_string($conn,$_POST['title']);
  $msg = mysqli_real_escape_string($conn,$_POST['msg']);


  if(!empty($title) && !empty($msg))
    $query = "UPDATE `posts` SET title ='".$title."',message ='".$msg."',posted = NOW() WHERE id = '".$_POST['post_id']."'";

  mysqli_query($conn,$query);
  header("refresh:0;posts.php");
}

if(isset($_GET['action']) && $_GET['action'] == 'remove'){

  $query = "DELETE FROM `posts` WHERE id = '".$_GET['edit_id']."'";
  mysqli_query($conn,$query);
  //  header("refresh:0;posts.php");
}

 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Administration area</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
<link rel="stylesheet" href="admin_style.css">
</head>
<body>
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-6">
        <h1>Posts</h1>
      </div>
      <div class="col-md-6 pull">
        <a class="btn btn-primary add" href="posts.php?action=add">Adauga</a>
      </div>
      <div class="col-md-12">
            <? if(isset($_GET['action']) &&  $_GET['action'] == 'add'):

                $category_query = mysqli_query($conn,"SELECT * FROM categories");
               ?>
              <form action="posts.php?action=add" method="POST" enctype="multipart/form-data" autocomplete="off">
                Categorie:
                <select name="category" class="form-control">
                  <option></option>
                  <? while($row = mysqli_fetch_array($category_query)): ?>
                    <option value="<?= $row['id']; ?>"><?= $row['name']; ?></option>
                  <? endwhile; ?>
                </select>
                <br>
                Title:
                <input type="text" name="title" class="form-control">
                <br>
                Message:
                <input type="text" name="msg" class="form-control">
                <br>
                <input type="submit" value="Salveaza" class="btn btn-primary submit">
              </form>
            <? endif; ?>
      </div>

<div class="col-md-12">
        <? if(isset($_GET['action']) && $_GET['action'] == 'edit'):
          $category_query = mysqli_query($conn,"SELECT * FROM categories");
          ?>
        <form action="posts.php?action=edit" method="POST" autocomplete="off">
          <br>
          Title:
          <input type="text" name="title" class="form-control">
          <br>
          Message:
          <input type="text" name="msg" class="form-control">
          <br>
          <input type="hidden" name="post_id" value="<?= $_GET['edit_id']; ?>">
          <input type="submit" value="Salveaza" class="btn btn-primary submit">
        </form>

      <? endif; ?>
    </div>
    </div>

    <table id="post-table">
      <tr>
        <th width=200><b>ID</b></th>
        <th width=300><b>Title</b></th>
        <th width=300 style="max-width:300px"><b>Message</b></th>
        <th width=200><b>Categorie</b></th>
        <th width=200><b>Action</b></th>
      </tr>
      <?
        $result = mysqli_query($conn,"SELECT * FROM posts LIMIT $start,$end");
        while($row = mysqli_fetch_array($result)):
          $get_category = mysqli_query($conn,"SELECT name FROM categories WHERE id ='".$row['category_id']."'");
          while($row_j = mysqli_fetch_array($get_category)):
       ?>
       <tr>
         <td><?= $row['id']; ?></td>
         <td><?= $row['title']; ?></td>
         <td style="width:30% !important"><?= $row['message']; ?></td>
         <td><?= $row_j['name']; ?></td>
         <td>
          <i class="fas fa-pencil-alt" onclick="window.location='posts.php?page=<? echo $_GET['page']; ?>&edit_id=<? echo $row['id']; ?>&action=edit'"></i>
           &nbsp;&nbsp;&nbsp;
           <i class="far fa-times-circle" onclick="if(confirm('Are you sure?'))window.location='posts.php?page=<?= $_GET['page']; ?>&edit_id=<?= $row['id']; ?>&action=remove'"></i>
         </td>
       </tr>
     <? endwhile;endwhile;?>
    </table>
    <br>
    <a href="posts.php?page=<?= ($_GET['page'] - 1 == 0) ? $_SESSION['posts_total'] : $_GET['page'] - 1;?>">
      <i class="fas fa-arrow-left arrow-page"></i>
    </a>
    &nbsp;&nbsp;&nbsp;
    <? for($i = 1;$i <= $_SESSION['posts_total']; $i++): ?>
      <a href="posts.php?page=<?= $i; ?>" class="<? if($_GET['page'] == $i) echo 'selected'; ?>"><?= $i; ?></a>
    <? endfor; ?>
    &nbsp;&nbsp;&nbsp;
    <a href="posts.php?page=<?=  ($_GET['page'] + 1 == $_SESSION['posts_total']+1) ? 1 : $_GET['page'] + 1; ?>">
        <i class="fas fa-arrow-right arrow-page"></i>
    </a>
  </div>
</body>
