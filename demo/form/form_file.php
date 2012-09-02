<form data-ajax-submit="true" data-ajax-block="#content"
      action="submit_file.php" method="post" enctype="multipart/form-data">    
  <label for="name">name</label><input type="text" id="name" name="name"/>
  <br/>
  <label for="file">file</label><input type="file" id="file" name="file"/>
  <div style="color:red">
  <?php if (isset($msg))echo '',$msg,''?>
  </div>
  <button type="submit">send</button>
</form>