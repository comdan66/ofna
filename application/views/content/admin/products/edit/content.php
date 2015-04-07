<section class="grid col-three-quarters mq2-col-full">
  <h2>PRODUCT > 修改</h2>
  <hr>

  <form action="<?php echo base_url (array ('admin', 'products', 'update', $product->id));?>" method="post" enctype="multipart/form-data" >
    <article>
<?php if (isset ($message) && $message) { ?>
        <div class='error'><?php echo $message;?></div>
<?php } ?>

      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tbody>

          <tr>
            <td width='150'>中文標題</td>
            <td class="textleft">
              <input type='text' name='title_tw' value="<?php echo $product->title_tw?>" placeholder='請輸入中文標題..' maxlength='255' pattern=".{1,255}" required title="請輸入中文標題!" />
            </td>
          </tr>

          <tr>
            <td width='150'>英文標題</td>
            <td class="textleft">
              <input type='text' name='title_en' value="<?php echo $product->title_en?>" placeholder='請輸入英文標題..' maxlength='255' pattern=".{1,255}" required title="請輸入英文標題!" />
            </td>
          </tr>

          <tr>
            <td width='150'>中文敘述</td>
            <td class="textleft">
              <input type='text' name='description_tw' value="<?php echo $product->description_tw?>" placeholder='請輸入中文敘述..' maxlength='255' pattern=".{1,255}" required title="請輸入中文敘述!" />
            </td>
          </tr>

          <tr>
            <td width='150'>英文敘述</td>
            <td class="textleft">
              <input type='text' name='description_en' value="<?php echo $product->description_en?>" placeholder='請輸入英文敘述..' maxlength='255' pattern=".{1,255}" required title="請輸入英文敘述!" />
            </td>
          </tr>

          <tr>
            <td width='150'>標簽選擇</td>
            <td class="textleft">
        <?php if ($tags = ProductTag::all (array ('order' => 'sort ASC'))) {
                foreach ($tags as $tag) { ?>
                  <div class='checkbox'>
                    <input type='checkbox' name='tag_ids[]' id='tag_<?php echo $tag->id;?>' value='<?php echo $tag->id;?>'<?php echo $product->product_tag_maps && in_array ($tag->id, column_array ($product->product_tag_maps, 'product_tag_id')) ? ' checked' : '';?> />
                    <span class='ckb-check'></span>
                    <label for='tag_<?php echo $tag->id;?>'><?php echo $tag->name_tw;?>(<?php echo $tag->name_en;?>)</label>
                  </div>
          <?php }
              }?>
            </td>
          </tr>

          <tr>
            <td>
              圖片
              <div class='info'>( 圖片格式：jpg / gif / png )</div>
            </td>
            <td class="textleft">
              <div class='files'>
                <button type="button" class='add_pic'>＋</button>
              </div>
        <?php if ($product->pics) { ?>
                <div class="pic">
                  <ul>
              <?php foreach ($product->pics as $pic) { ?>
                      <li>
                        <input type='hidden' name='pic_ids[]' value='<?php echo $pic->id;?>' />
                        <img src="<?php echo $pic->name->url ('100w');?>" alt="" width="80" height="80">
                        <a class='del_pic'>刪除</a>
                      </li>
              <?php } ?>
                  </ul>
                </div>
        <?php } ?>
            </td>
          </tr>

        </tbody>
      </table>

<?php if ($product->prices) {
        foreach ($product->prices as $index => $price) { ?>
          <table data-index='<?php echo $index;?>' data-count='0' width="100%" border="0" cellspacing="0" cellpadding="0" style='margin: 15px auto;' class='table_prices'>
            <tbody>
              <tr>
                <td width="100">中文價錢敘述</td>
                <td class="textleft">
                  <input type='text' value="<?php echo $price->value_tw;?>" name='prices[<?php echo $index;?>][value_tw]' placeholder='請輸入中文價錢敘述..' maxlength='255' pattern=".{1,255}" required title="請輸入中文價錢敘述!" />
                  <div class='delete'>x</div>
                </td>
              </tr>
              <tr>
                <td width="100">英文價錢敘述</td>
                <td class="textleft">
                  <input type='text' value="<?php echo $price->value_en;?>" name='prices[<?php echo $index;?>][value_en]' placeholder='請輸入英文價錢敘述..' maxlength='255' pattern=".{1,255}" required title="請輸入英文價錢敘述!" />
                </td>
              </tr>
            </tbody>
          </table>
  <?php }
      } ?>

<?php if ($product->blocks) {
        foreach ($product->blocks as $index => $block) { ?>
          <table data-index='<?php echo $index;?>' data-count='0' width="100%" border="0" cellspacing="0" cellpadding="0" style='margin: 15px auto;' class='table_blocks'>
            <tbody>
              <tr>
                <td width="80">順序</td>
                <td class="textleft">
                  <input type='number' value="<?php echo $block->sort;?>" name='blocks[<?php echo $index;?>][sort]' placeholder='請輸入順序' />
                </td>
              </tr>
              <tr>
                <td width="80">中文標題</td>
                <td class="textleft">
                  <input type='text' value="<?php echo $block->title_tw;?>" name='blocks[<?php echo $index;?>][title_tw]' placeholder='請輸入中文標題..' maxlength='255' pattern=".{1,255}" required title="請輸入中文標題!" />
                  <div class='delete'>x</div>
                </td>
              </tr>
              <tr>
                <td width="80">英文標題</td>
                <td class="textleft" colspan='2'>
                  <input type='text' value="<?php echo $block->title_en;?>" name='blocks[<?php echo $index;?>][title_en]' placeholder='請輸入英文標題..' maxlength='255' pattern=".{1,255}" required title="請輸入英文標題!" />
                </td>
              </tr>
              <tr>
                <td>中文內容</td>
                <td class="textleft">
                  <textarea name='blocks[<?php echo $index;?>][content_tw]' placeholder='請輸入中文內容..' pattern=".{1,}" required title="請輸入中文內容!"><?php echo $block->content_tw;?></textarea>
                </td>
              </tr>
              <tr>
                <td>英文內容</td>
                <td class="textleft">
                  <textarea name='blocks[<?php echo $index;?>][content_en]' placeholder='請輸入英文內容..' pattern=".{1,}" required title="請輸入英文內容!"><?php echo $block->content_en;?></textarea>
                </td>
              </tr>
            </tbody>
          </table>
  <?php }
      } ?>
      <hr />

      <button type="button" id='add_price'>加入價錢敘述</button>
      <button type="button" id='add_block'>加入小區塊</button>
      <button type="submit">確定修改</button>
    </article>
  </form>
</section>

<script id='_file' type='text/x-html-template'>
  <input type="file" name='files[]' class='file' value='' accept="image/jpg, image/jpeg, image/png" />
</script>

<script id='_price' type='text/x-html-template'>
  <table data-index='<%=index%>' data-count='0' width="100%" border="0" cellspacing="0" cellpadding="0" style='margin: 15px auto;'>
    <tbody>
      <tr>
        <td width="100">中文價錢敘述</td>
        <td class="textleft">
          <input type='text' value="" name='prices[<%=index%>][value_tw]' placeholder='請輸入中文價錢敘述..' maxlength='255' pattern=".{1,255}" required title="請輸入中文價錢敘述!" />
          <div class='delete'>x</div>
        </td>
      </tr>
      <tr>
        <td width="100">英文價錢敘述</td>
        <td class="textleft">
          <input type='text' value="" name='prices[<%=index%>][value_en]' placeholder='請輸入英文價錢敘述..' maxlength='255' pattern=".{1,255}" required title="請輸入英文價錢敘述!" />
        </td>
      </tr>
    </tbody>
  </table>
</script>

<script id='_block' type='text/x-html-template'>
  <table data-index='<%=index%>' data-count='0' width="100%" border="0" cellspacing="0" cellpadding="0" style='margin: 15px auto;'>
    <tbody>
      <tr>
        <td width="80">順序</td>
        <td class="textleft">
          <input type='number' value="<%=index%>" name='blocks[<%=index%>][sort]' placeholder='請輸入順序' />
        </td>
      </tr>
      <tr>
        <td width="80">中文標題</td>
        <td class="textleft">
          <input type='text' value="" name='blocks[<%=index%>][title_tw]' placeholder='請輸入中文標題..' maxlength='255' pattern=".{1,255}" required title="請輸入中文標題!" />
          <div class='delete'>x</div>
        </td>
      </tr>
      <tr>
        <td width="80">英文標題</td>
        <td class="textleft" colspan='2'>
          <input type='text' value="" name='blocks[<%=index%>][title_en]' placeholder='請輸入英文標題..' maxlength='255' pattern=".{1,255}" required title="請輸入英文標題!" />
        </td>
      </tr>
      <tr>
        <td>中文內容</td>
        <td class="textleft">
          <textarea name='blocks[<%=index%>][content_tw]' placeholder='請輸入中文內容..' pattern=".{1,}" required title="請輸入中文內容!"></textarea>
        </td>
      </tr>
      <tr>
        <td>英文內容</td>
        <td class="textleft">
          <textarea name='blocks[<%=index%>][content_en]' placeholder='請輸入英文內容..' pattern=".{1,}" required title="請輸入英文內容!"></textarea>
        </td>
      </tr>
    </tbody>
  </table>
</script>
