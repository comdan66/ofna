<aside class='grid col-one-quarter mq2-col-one-third mq3-col-full'>
  <menu>
    <div id='wrapper'>
      <ul class='menu'>
        <li class='item5'><a>PRODUCT</a>
          <ul>
            <li><a href="<?php echo base_url (array ('admin', 'products', 'tags'));?>">標簽</a></li>
            <li><a href="<?php echo base_url (array ('admin', 'products'));?>">列表</a></li>
            <li><a href="<?php echo base_url (array ('admin', 'products', 'add'));?>">新增</a></li>
          </ul>
        </li>
        <li class='item5'><a>NEWS</a>
          <ul>
            <li><a href="<?php echo base_url (array ('admin', 'news'));?>">列表</a></li>
            <li><a href="<?php echo base_url (array ('admin', 'news', 'add'));?>">新增</a></li>
          </ul>
        </li>
        <li class='item5'><a>網站管理員</a>
          <ul>
            <li><a href="<?php echo base_url (array ('admin', 'edit'));?>">修改帳號密碼</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </menu>
</aside>