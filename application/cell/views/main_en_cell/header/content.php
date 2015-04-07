<div id='header'>
  <div>
    <div class='l'>
      <img src='/resource/image/site/logo.png' />
    </div>
    <div class='r'>
      <div class='m'>
        <a class='i'>HOME</a>
        <a class='i' data-go='about'>BRAND</a>
        <a class='i' data-go='news'>NEWS</a>
        <a class='i' data-go='product'>PRODUCT</a>
        <a class='i' href='' target='_blank'>STORE</a>
        <a class='i' data-go='howtobuy'>HOW TO BUY</a>
        <a class='i' data-go='contact'>CONTACT</a>
      </div>
      <div class='s'>
        <a class='i f'></a>
        <a class='i e<?php echo identity ()->get_session ('is_en') ? ' a' : '';?>' href='<?php echo base_url (array ('lang', 1));?>'></a>
        <a class='i t<?php echo identity ()->get_session ('is_en') ? '' : ' a';?>' href='<?php echo base_url (array ('lang', 0));?>'></a>
      </div>
    </div>
  </div>
</div>