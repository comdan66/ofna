<?php
  if ($news) { ?>
    <div id='news'>
      <div>
        <div class='l'>NEWS</div>
        <div class='r'>
    <?php foreach ($news as $new) { ?>
            <div class='n' data-id='<?php echo $new->id;?>'>
              <img src='<?php echo $new->pic->name->url ('221x155c');?>' />
              <div class='d'><?php echo $new->date->format ('Y-m-d');?></div>
              <div class='t p'><?php echo $new->$title;?></div>
              <div class='c'><?php echo $new->$description;?></div>
              <div class='m p'>+ More</div>
            </div>
    <?php } ?>
        </div>
      </div>
    </div>
<?php
    foreach ($news as $new) { ?>
      <div class='news_pop' data-id='<?php echo $new->id;?>'>
        <div>
          <div class='c'><span>&#10005;</span></div>
          <div class='cr'>
            <div class='de'><?php echo $new->date->format ('Y-m-d');?></div>
            <div class='t'><?php echo $new->$title;?></div>
            <div class='d'><?php echo $new->$description;?></div>
            <div class='li'></div>
            <div class='co'>
              <div class='l'>
          <?php if ($new->pics) {
                  foreach ($new->pics as $pic) { ?>
                    <img src='<?php echo $pic->name->url ('400w');?>' />
            <?php }
                } ?>
              </div>
              <div class='r'>
          <?php if ($new->blocks) {
                  foreach ($new->blocks as $block) { ?>
                    <div class='b'>
                      <div class='ti'><?php echo $block->$title;?></div>
                      <div class='ds'><?php echo $block->$content;?></div>
                    </div>
            <?php }
                } ?>
              </div>
            </div>
          </div>
        </div>
      </div>
<?php
    }
  }