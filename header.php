<header>
  <div class="row">
      <a href="index.php" class="login"><?= 'Home'; ?></a>
      <a href="register.php" class="login"><?= 'Sign Up'; ?></a>
      <a href="login.php" class="login"><?= 'Login'; ?></a>
    <div class="logo">
        <h1>Welcome <span class="logged"><?if(isset($_SESSION['username'])) echo $_SESSION['username']; ?></span> to the Blog</h1>
    </div>
    <? if(isset($_SESSION['username'])): ?>
      <a href="index.php?logout=true" class="logout">Logout</a>
    <? endif; ?>
</header>