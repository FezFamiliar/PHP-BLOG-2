<div class="aside">
  <ul>
    <?
    $result = mysqli_query($conn,"SELECT * FROM categories");

       while($row = mysqli_fetch_array($result)): ?>
        <li>
          <a href="?category_id=<?= $row['id']; ?>&page=1" class="<? if(isset($_GET['category_id']) && $_GET['category_id'] == $row['id']) echo 'menu-highlight';?>"><?= $row['name']; ?></a>
        </li>
      <? endwhile; ?>
  </ul>
</div>
