<? session_start();?>
<div class="header">
    <div class="left">
      <h2>
        <i class="fas fa-server"></i>&nbsp;&nbsp;Administrare</h2>
    </div>
    <div class="right">
      <span>Bun venit , <?= $_SESSION['admin']; ?> | </span>
      <a href="index.php?logout=true">Logout</a>
    </div>
</div>
<ul class="nav nav-pills">
  	<li class="dropdown">
        <a class="dropdown-toggle" href="#">CATALOG <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="users.php?page=1">Users</a></li>
        	<li><a href="posts.php?page=1">Posts</a></li>
        	<li><a href="category.php?page=1">Categorii</a></li>
        </ul>
    </li>
  	    <li><a href="index.php?logout=true">LOGOUT</a></li>
</ul>
