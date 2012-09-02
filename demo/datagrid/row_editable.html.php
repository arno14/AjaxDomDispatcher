<?php $msg=isset($msg)?$msg:null?>
<tr id="row_<?php echo $data['rowid']?>" <?php if($msg=='error'){?>style="background-color:red"<?php }?> >
  <td>
    <?php echo $data['rowid']?>
    <input type="hidden" 
           value="<?php echo $data['rowid']?>" 
           name="row[<?php echo $data['rowid']?>][rowid]"/>   
  </td>
  <?php foreach($db->getFieldList()as $field):?>
  <td>
    <input type="text" value="<?php echo $data[$field]?>" 
           name="row[<?php echo $data['rowid']?>][<?php echo $field?>]"/>    
  </td>  
  <?php endforeach;?>
  <td>
    <button type="submit" >update</button>
    <button data-ajax-link="controller?action=show&id=<?php echo $data['rowid']?>">abort</button>
  </td>
</tr>