
<?php
  if (count ($objects)) { ?>
    <table class='list'>
      <thead>
        <tr>
          <td>名稱</td>
          <td>網址</td>
          <td>檔案名稱</td>
          <td>刪除</td></tr>
      </thead>
      <tbody id='sortable'>
  <?php foreach ($objects as $object) { ?>
          <tr>
            <td width='100'><?php echo $object->name;?></td>
            <td><a href='<?php echo $object->url;?>' target='_blank'><?php echo $object->url;?></a></td>
            <td width='400'><?php echo $object->file_name;?></td>
            <td width='100'>
              <span class='icon-trash2 jqui_tooltip' onClick='window.location.assign ("<?php echo $delete_url . '/' . $object->key; ?>");' title='刪除'></span>        
            </td>
          </tr>
  <?php } ?>
      </tbody>
    </table>
<?php
  } else { ?>
    <div class="alert alert-info">
      <strong>提示!</strong> 目前沒有任何資料。
    </div>
<?php
  }
?>