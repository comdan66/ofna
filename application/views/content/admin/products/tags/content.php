<section class="grid col-three-quarters mq2-col-full">
  <h2>PRODUCT > 標簽</h2>

  <form action="<?php echo base_url (array ('admin', 'products', 'tags'));?>" method="post">
    <article id="navphilo">
      <input type='text' value='' name='name_tw' placeholder='請輸入中文標簽名稱..' maxlength='255' pattern=".{1,255}" required title="請輸入中文標簽名稱!" />
      <input type='text' value='' name='name_en' placeholder='請輸入英文標簽名稱..' maxlength='255' pattern=".{1,255}" required title="請輸入英文標簽名稱!" />
      <button type="submit">新增</button>
    </article>
    <hr />
  </form>

  <form action="<?php echo base_url (array ('admin', 'products', 'tags'));?>" method="post">
    <article id="navplace">
      <table width="100%" border="1" cellspacing="0" cellpadding="0">
        <thead>
          <tr>
            <th bgcolor="#F7F7F7">中文名稱</th>
            <th bgcolor="#F7F7F7">英文名稱</th>
            <th bgcolor="#F7F7F7">排序</th>
            <th bgcolor="#F7F7F7">刪除</th>
          </tr>
        </thead>
        <tbody>
  <?php if ($tags) {
          foreach ($tags as $i => $tag) { ?>
            <tr data-id='<?php echo $tag->id;?>'>
              <td class="textleft">
                <input type='hidden' name='tags[<?php echo $i;?>][id]' value='<?php echo $tag->id;?>' />
                <input type='text' name='tags[<?php echo $i;?>][name_tw]' value="<?php echo $tag->name_tw;?>" placeholder='請輸入中文標簽名稱..' maxlength='255' pattern=".{1,255}" required title="請輸入中文標簽名稱!" />
              </td>
              <td class="textleft">
                <input type='text' name='tags[<?php echo $i;?>][name_en]' value="<?php echo $tag->name_en;?>" placeholder='請輸入英文標簽名稱..' maxlength='255' pattern=".{1,255}" required title="請輸入英文標簽名稱!" />
              </td>
              <td width="80" class="textleft">
                <input type='number' name='tags[<?php echo $i;?>][sort]' value="<?php echo $tag->sort;?>" maxlength='10' pattern=".{1,10}" required title="輸入10個字元以內" />
              </td>
              <td width="80">
                <a href="#" class='del_cate'>刪除</a>
              </td>
            </tr>
    <?php }
        } else { ?>
          <tr><td colspan='4'>沒有任何標簽。</td></tr>
  <?php } ?>
        </tbody>
      </table>
      <br/>
      <p>
        <button type="submit">確定修改</button>
      </p>
    </article>
  </form>
</section>