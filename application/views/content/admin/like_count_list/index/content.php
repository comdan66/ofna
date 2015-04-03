<h2><?php echo $feature_name_1?> 列表</h2>
<br/>

<input type='button' value='搜尋 <?php echo $feature_name_1?>' class='OA-ui-OA_Button' id='target_index_list_search'/>
<input type='button' value='新增 <?php echo $feature_name_1?>' class='OA-ui-OA_Button' onClick='window.location.assign ("<?php echo $create_url; ?>");'/>

<hr/>

<form id="search_form" method="post" action="<?php echo $search_url; ?>" style='<?php echo $has_append_condition ? '' : 'display: none;';?>'>
  <table class='search_list'>
    <tbody>
      <tr><th>編  號</th><td><input type='text' name='id' value="<?php echo $id?>" placeholder='請輸入要搜尋的 編號...' class='form-control' x-webkit-speech/></td></tr>
      <tr><th>網  址</th><td><input type='text' name='url' value="<?php echo $url?>" placeholder='請輸入要搜尋的 網址...' class='form-control' x-webkit-speech/></td></tr>
      <tr><th>按讚數</th><td><input type='text' name='click_count' value="<?php echo $click_count?>" placeholder='請輸入要搜尋的 數目...' class='form-control' x-webkit-speech/></td></tr>
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
          <td>網址</td>
          <td>按讚數</td>
          <td>上次按讚日期</td></tr>
      </thead>
      <tbody id='sortable'>
  <?php foreach ($objects as $object) { ?>
          <tr>
            <td width='50'><?php echo $object->id;?></td>
            <td><a href='<?php echo $object->url;?>' target='_blank'><?php echo $object->url;?></a></td>
            <td width='200'><?php echo $object->click_count;?></td>
            <td width='180'><?php echo $object->updated_at;?></td>
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
