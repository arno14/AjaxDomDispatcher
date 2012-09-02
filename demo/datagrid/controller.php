<?php
function _from($array,$index,$default=null){
  return (isset($array[$index]))?$array[$index]:$default;
}


require 'crud.class.php';

$db=new CRUD('commune.sqlite');



switch( _from($_GET,'action') ){
  
  case 'list';
    $limit=_from($_GET,'limit',10);
    $offset=_from($_GET,'offset',0);
    
    $datas=$db->find($limit,$offset);
    echo '<table><tbody data-ajax-target="#datagrid tbody">';
    foreach($datas as $data){
      include 'row.html.php';
    }
    echo '</tbody></table>';
    break;
  
  case 'show';
    $id=_from($_GET,'id');
    $data=$db->findOne($id);
    echo '<table><tbody data-ajax-target="#row_',$id,'" data-ajax-method="replace">';
      include 'row.html.php';
    echo '</tbody></table>';
    break;
  
  case 'edit';
    $id=_from($_GET,'id');
    $data=$db->findOne($id);
    echo '<table><tbody data-ajax-target="#row_',$id,'" data-ajax-method="replace" >';
      include 'row_editable.html.php';
    echo '</tbody></table>';
    break;
 
  case 'update';
    $datas=_from($_POST,'row');
    foreach($datas as $data){
      if($db->update($data)){
        $tpl='row.html.php';
      }else{
        $msg='error';
        $tpl='row_editable.html.php';
      }      
      echo '<table><tbody data-ajax-target="#row_',$data['rowid'],'" data-ajax-method="replace">';
      include $tpl;
      echo '</tbody></table>';
    }
    break;
 
  
  
}

