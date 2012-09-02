<div data-ajax-target="#content" style="border:5px solid red">  

<?php
$name=(isset($_POST['name']))?$_POST['name']:null; 
if(!$name):
  $msg='name cannot be empty';
  include "form.php"; 
else:
  echo 'Success! you entered <b>',$name,'</b>';
endif; ?>
  
</div><!--[data-ajax-target]-->