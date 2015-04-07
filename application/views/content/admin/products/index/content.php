<section class="grid col-three-quarters mq2-col-full">
  <h2>PRODUCT > 列表</h2>
  <hr>

  <article id="navplace">
    <form action="<?php echo base_url (array ('admin', 'products'));?>" method="post">
      <button type="submit" id="delete">刪除</button>
      &nbsp;
      <button type="button" id="select_all">全選</button>
      &nbsp;
      <button type="button" id="create" onClick='window.location.assign("<?php echo base_url (array ('admin', 'products', 'add'));?>");'>新增</button>
      
      <br/><br/>

      <table width="100%" border="1" cellspacing="0" cellpadding="0">
        <thead>
          <tr>
           <th width='20'><input type="checkbox" id='check_all'></th>
           <th width='100'>中文標題</th>
           <th width='100'>英文標題</th>
           <th >中文敘述</th>
           <th >英文敘述</th>
           <th width="40">修改</th>
          </tr>
        </thead>
        <tbody>
          </tr>
    <?php if ($products) {
            foreach ($products as $product) { ?>
              <tr>
                <td><label><input type="checkbox" name='delete_ids[]' value='<?php echo $product->id;?>'></label></td>
                <td class="textleft"><?php echo $product->title_tw;?></td>
                <td class="textleft"><?php echo $product->title_en;?></td>
                <td class="textleft"><?php echo $product->description_tw;?></td>
                <td class="textleft"><?php echo $product->description_en;?></td>
                <td><a href="<?php echo base_url (array ('admin', 'products', 'edit', $product->id));?>">修改</a></td>
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