<h2><?php echo $feature_name_1?> 列表</h2>
<br/>

<input type='button' value='搜尋 <?php echo $feature_name_1?>' class='OA-ui-OA_Button' id='target_index_list_search'/>
<input type='button' value='新增 <?php echo $feature_name_1?>' class='OA-ui-OA_Button' onClick='window.location.assign ("<?php echo $create_url; ?>");'/>

<hr/>

<form id="search_form" method="post" action="<?php echo $search_url; ?>" style='<?php echo $has_append_condition ? '' : 'display: none;';?>'>
  <table class='search_list'>
    <tbody>
      <tr><th>編號</th><td><input type='text' name='id' value="<?php echo $id?>" placeholder='請輸入要搜尋的 編號...' class='form-control' x-webkit-speech/></td></tr>
      <tr><th>標題</th><td><input type='text' name='title' value="<?php echo $title?>" placeholder='請輸入要搜尋的 標題...' class='form-control' x-webkit-speech/></td></tr>
      <tr><th>敘述</th><td><input type='text' name='description' value="<?php echo $description?>" placeholder='請輸入要搜尋的 敘述...' class='form-control' x-webkit-speech/></td></tr>
      <tr><th>user id</th><td><input type='text' name='user_id' value="<?php echo $user_id?>" placeholder='請輸入要搜尋的 user id...' class='form-control' x-webkit-speech/></td></tr>
      <tr><th>fb uid</th><td><input type='text' name='user_uid' value="<?php echo $user_uid?>" placeholder='請輸入要搜尋的 fb uid...' class='form-control' x-webkit-speech/></td></tr>
      <tr><th>fb name</th><td><input type='text' name='user_name' value="<?php echo $user_name?>" placeholder='請輸入要搜尋的 fb name...' class='form-control' x-webkit-speech/></td></tr>
      <tr><td colspan='2'>
        <input type="submit" class='OA-ui-OA_Button' value="確定搜尋"/>
        <input type="reset" class='OA-ui-OA_Button' value="重新填寫"/>
        </td></tr>
    </tbody>
  </table>
  <hr/>
</form>

<?php
  if (count ($objects)) { ?>
    <div class='row'><div class="col-md-6">總共有 <?php echo $total_rows;?> 筆資料。</div><div class="col-md-6"><?php echo $pagination;?></div></div>
    <table class='list'>
      <thead>
        <tr>
          <td>編號</td>
          <td>標題</td>
          <td>敘述</td>
          <td>照片</td>
          <td>新增日期</td>
          <td>刪除</td></tr>
      </thead>
      <tbody id='sortable'>
  <?php foreach ($objects as $object) { ?>
          <tr>
            <td width='50'><?php echo $object->id;?></td>
            <td width='100'><?php echo $object->title;?></td>
            <td width='200'><?php echo $object->description;?></td>
            <td>
              <img class='fancybox' src='<?php echo $object->file_name->url ('310xW'); ?>' href='<?php echo $object->file_name->url ();?>'/>
            </td>
            <td width='180'><?php echo $object->created_at;?></td>
            <td width='160'>
              <span class='icon-trash2 jqui_tooltip' onClick='window.location.assign ("<?php echo $delete_url . '/' . $object->id; ?>");' title='刪除 <?php echo $feature_name_1?>'></span>
            </td>
          </tr>
  <?php } ?>
      </tbody>
    </table>
    <div class='row'><div class="col-md-6">總共有 <?php echo $total_rows;?> 筆資料。</div><div class="col-md-6"><?php echo $pagination;?></div></div>
<?php
  } else { ?>
    <div class="alert alert-info">
      <strong>提示!</strong> 目前沒有任何資料。
    </div>
<?php
  }
?>
<hr/>
<div class='row'><div class="col-md-6"></div><div class="col-md-6"><?php echo $run_time;?></div></div>
