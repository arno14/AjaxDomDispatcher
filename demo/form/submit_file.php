<div data-ajax-target="#content" style="border:5px solid red">  

<?php
print_r($_FILES);print_r($_POST);
$name=(isset($_POST['name']))?$_POST['name']:null; 
if(count($_POST)):
  
  if(!$name):
    $msg='name cannot be empty';
    include "form_file.php"; 
  else:
    echo 'Success! you entered <b>',$name,'</b>';
  endif; 
else:
  echo 'not submited';
  include "form_file.php"; 
endif;?>
  
</div><!--[data-ajax-target]-->