<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- <link rel="shortcut icon" href="<?php echo isset ($favicon) ? $favicon:'';?>" /> -->
    <?php echo isset ($meta) ? $meta:''; ?>
    <title data-ori="<?php echo isset ($title) ? $title:''; ?>"><?php echo isset ($title) ? $title:''; ?></title>

    <?php echo isset ($css) ? $css:''; ?>
    <?php echo isset ($javascript) ? $javascript:''; ?>

  </head>
  <body lang="zh-tw">
    
    <?php echo isset ($hidden) ? $hidden:'';?>
    <?php echo (isset ($topbar) && ($topbar !== '')) ? $topbar:'';?>

    <div id='container'>
      <?php echo (isset ($visit_menu) && ($visit_menu !== '')) ? ("<div id='visit_menu'>" . $visit_menu . "</div>"):'';?>

      <?php echo (isset ($sidebar) && ($sidebar !== '')) ? $sidebar:'';?>

      <?php echo (isset ($sidebar) && ($sidebar !== '')) ? "<div class='bs-content'>" . ((isset ($content) && ($content !== '')) ? $content:'') . "</div>":((isset ($content) && ($content !== '')) ? $content:'');?>
      
      <br/>
      <br/>
      <hr/>
      Beigang Matsu © 2014
    </div>
  </body>
</html>