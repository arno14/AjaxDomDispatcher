<tr id="row_<?php echo $data['rowid']?>">
  <td><?php echo $data['rowid']?></td>
  <td><?php echo $data['CODGEO']?></td>
  <td><?php echo $data['LIBGEO']?></td>
  <td><?php echo $data['REG']?></td>
  <td><?php echo $data['DEP']?></td>  
  <td>
    <button data-ajax-link="controller?action=edit&id=<?php echo $data['rowid']?>">edit</button>
  </td>
</tr>