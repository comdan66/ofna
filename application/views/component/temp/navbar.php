<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if (isset ($navbar_list) && count ($navbar_list) && isset ($navbar_list['navheader_list']) && isset ($navbar_list['navitem_list']) && isset ($navbar_list['right_navitem_list']) && (count ($navbar_list['navheader_list']) || count ($navbar_list['navitem_list']) || count ($navbar_list['right_navitem_list']))) {
  $navheader_list = $navbar_list['navheader_list'];
  $navitem_list = $navbar_list['navitem_list'];
  $right_navitem_list = $navbar_list['right_navitem_list'];

  function print_dropdowns ($navitem_list, $level = 0) {
    if (count ($navitem_list)) {
      foreach ($navitem_list as $navitem) {
        if ($navitem['name'] === null) { ?>
          <li class="divider"><?php echo !$level? '' : '';?></li>
  <?php } else if (count ($navitem['dropdowns'])) { ?>
          <li class="dropdown<?php echo $level ? '-submenu' : '';?>">
            <a class='dropdown-toggle jqui_tooltip' href="#" data-toggle="dropdown" title="<?php echo $navitem['title'];?>"><?php echo $navitem['name'];?> <?php echo !$level ? '' : '';?></a>
            <ul class="dropdown-menu">
              <?php print_dropdowns ($navitem['dropdowns'], $level + 1);?>
            </ul>
          </li>
  <?php } else if ($navitem['url'] === null) { ?>
          <li><a class='jqui_tooltip' title="<?php echo $navitem['title'];?>"><?php echo $navitem['name'];?></a></li>
  <?php } else { ?>
          <li><a class='jqui_tooltip' title="<?php echo $navitem['title'];?>" href="<?php echo $navitem['url'];?>"><?php echo $navitem['name'];?></a></li>
  <?php }
      }
    }
  } ?>
  
    <nav class="navbar navbar-default">
      <div class="navbar-header">
    <?php if (count ($navheader_list)) {
            foreach ($navheader_list as $navheader) { ?>
              <a class="navbar-brand" href="<?php echo $navheader['url'];?>"><?php echo $navheader['name'];?></a>
      <?php }
          } ?>
      </div>

      <div class='my_collapse'>
  <?php if (count ($navitem_list)) { ?>
          <ul class="nav navbar-nav">
            <?php print_dropdowns ($navitem_list); ?>
          </ul>
  <?php } ?>

  <?php if (count ($right_navitem_list)) { ?>
          <ul class="nav navbar-nav navbar-right">
            <?php print_dropdowns ($right_navitem_list); ?>
          </ul>
  <?php } ?>

      </div>
    </nav>
<?php
}