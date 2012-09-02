<form data-ajax-submit="true" action="submit.php" method="post">    
  <label for="name">name</label><input type="text" id="name" name="name"/>
  <div style="color:red">
  <?php if (isset($msg))echo '',$msg,''?>
  </div>
  <button type="submit">send</button>
</form>