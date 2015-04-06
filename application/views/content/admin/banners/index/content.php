<section class="grid col-three-quarters mq2-col-full">
  <h2>BANNER > 列表</h2>
  <hr>

  <article id="navphilo"> 上傳圖片:
    <form action="<?php echo base_url (array ('admin', 'banners'));?>" method="post" enctype="multipart/form-data" >
      <input type="hidden" name='get_delete_url' value='<?php echo base_url (array ('admin', 'banners')); ?>' />
      <input type="file" value='' name='file' accept="image/jpg, image/jpeg, image/png" />
      &nbsp;&nbsp;
      <button type="submit">新增</button>
    </form>
    <br>
    (圖片格式:jpg / gif / png)<br>
    圖片尺寸: 2048 * 1152 或 高解析 16:9 圖片<br>
    圖片大小:不超過2M
    <br><br>
<?php if ($banners) { ?>
        <table width="100%" border="1">
          <tr>
            <td>
              <div class="pic">
                <ul>
            <?php foreach ($banners as $banner) { ?>
                    <li data-id='<?php echo $banner->id;?>'>
                      <img src="<?php echo $banner->name->url ('80x80c');?>" alt="" width="80" height="80" />
                      <a href="#" class='del_banner'>刪除</a>
                    </li>
            <?php } ?>
                </ul>
              </div>
            </td>
          </tr>
        </table>
<?php } ?>
    <br>
    <hr>
    </article>
  <article id="navplace"> </article>
</section>