<section class="grid col-three-quarters mq2-col-full">
  <h2>NEWS > 列表</h2>
  <hr>

  <article id="navplace">
    <form action="<?php echo base_url (array ('admin', 'news'));?>" method="post">
      <button type="submit" id="delete">刪除</button>
      &nbsp;
      <button type="button" id="select_all">全選</button>
      &nbsp;
      <button type="button" id="create" onClick='window.location.assign("<?php echo base_url (array ('admin', 'news', 'add'));?>");'>新增</button>
      
      <br/><br/>

      <table width="100%" border="1" cellspacing="0" cellpadding="0">
        <thead>
          <tr>
           <th width='20'><input type="checkbox" id='check_all'></th>
           <th width='100'>日期</th>
           <th width='100'>中文標題</th>
           <th width='100'>英文標題</th>
           <th >中文敘述</th>
           <th >英文敘述</th>
           <th width="40">修改</th>
          </tr>
        </thead>
        <tbody>
          </tr>
    <?php if ($news) {
            foreach ($news as $new) { ?>
              <tr>
                <td><label><input type="checkbox" name='delete_ids[]' value='<?php echo $new->id;?>'></label></td>
                <td class="textleft"><?php echo $new->date->format ('Y-m-d');?></td>
                <td class="textleft"><?php echo $new->title_tw;?></td>
                <td class="textleft"><?php echo $new->title_en;?></td>
                <td class="textleft"><?php echo $new->description_tw;?></td>
                <td class="textleft"><?php echo $new->description_en;?></td>
                <td><a href="<?php echo base_url (array ('admin', 'news', 'edit', $new->id));?>">修改</a></td>
              </tr>
      <?php }
          } else { ?>
            <tr>
              <td colspan='7'>沒有任何資料產品</td>
            </tr>
    <?php } ?>
        </tbody>
      </table>
      <p>
        <a href="<?php echo $pagination['prev_link'];?>" class="arrowpre"></a>
        <?php echo $pagination['now_page'];?> / <?php echo $pagination['page_total'];?>
        <a href="<?php echo $pagination['next_link'];?>" class="arrow"></a>
        ｜ 筆數共<?php echo $pagination['total'];?>筆
      </p>
    </form>
  </article>
</section>