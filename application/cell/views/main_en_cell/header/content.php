<div id='header'>
  <div>
    <div class='l'>
      <img src='/resource/image/site/logo.png' />
    </div>
    <div class='r'>
      <div class='m'>
        <div class='i'>HOME</div>
        <div class='i'>BRAND</div>
        <div class='i'>NEWS</div>
        <div class='i'>PRODUCT</div>
        <div class='i'>STORE</div>
        <div class='i'>HOW TO BUY</div>
        <div class='i'>CONTACT</div>
      </div>
      <div class='s'>
        <a class='i f'></a>
        <a class='i e<?php echo identity ()->get_session ('is_en') ? ' a' : '';?>' href='<?php echo base_url (array ('lang', 1));?>'></a>
        <a class='i t<?php echo identity ()->get_session ('is_en') ? '' : ' a';?>' href='<?php echo base_url (array ('lang', 0));?>'></a>
      </div>
    </div>
  </div>
</div>