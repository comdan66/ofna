<html lang="en">
  <head>
    <?php echo isset ($meta_list) ? $meta_list : ''; ?>
    <title><?php echo isset ($title) ? $title : ''; ?></title>

    <link rel="chitorch icon" href="<?php echo base_url (array ('resource', 'image', 'tiicon.ico'));?>">

    <?php echo isset ($css_list) ? $css_list : ''; ?>
    <?php echo isset ($js_list) ? $js_list : ''; ?>
  </head>
  <body>
<?php echo isset ($hidden_list) ? $hidden_list : ''; ?>

    <div class="container">
<?php echo render_cell ('admin_cell', 'main_header', array ());?>

      <div class="home-page main">
        <section class="grid-wrap" >
    <?php echo render_cell ('admin_cell', 'sub_header', array ());?>
          <aside class="grid col-one-quarter mq2-col-full"></aside>
    <?php echo isset ($content) ? $content : '';?>
        </section>
      </div>
<?php echo render_cell ('admin_cell', 'footer', array ());?>
    </div>

  </body>
</html>