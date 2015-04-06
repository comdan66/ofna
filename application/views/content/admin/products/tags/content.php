<section class="grid col-three-quarters mq2-col-full">
  <h2>PRODUCT > 標簽</h2>

  <form action="<?php echo base_url (array ('admin', 'products', 'tags'));?>" method="post">
    <article id="navphilo">
      <input type='text' value='' name='name' placeholder='請輸入分類' pattern=".{1,100}" required title="輸入100個字元以內" />
      <button type="submit">新增</button>
      <br />
      <hr />
    </article>
  </form>

  <form action="<?php echo base_url (array ('admin', 'products', 'tags'));?>" method="post">
    <article id="navplace">
      <table width="100%" border="1" cellspacing="0" cellpadding="0">
        <thead>
          <tr>
            <th bgcolor="#F7F7F7">名稱</th>
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
                <input type='text' name='tags[<?php echo $i;?>][name]' value="<?php echo $tag->name;?>" maxlength='100' pattern=".{1,100}" required title="輸入100個字元以內" />
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
          <tr><td colspan='3'>沒有任何產品分類</td></tr>
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