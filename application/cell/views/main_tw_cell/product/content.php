<?php 
  if ($tags) { ?>
    <div id='product'>
      <div>
        <div class='t'>PRODUCT</div>
        <div class='ts'>
    <?php foreach ($tags as $tag) { ?>
            <div class='t' data-id='<?php echo $tag->id;?>'><?php echo $tag->$name;?></div>
    <?php } ?>
        </div>
        <div class='ds'>
          <div>
          </div>
        </div>
        <div class='ps'></div>
      </div>
    </div>

<script id='_pb' type='text/x-html-template'>
  <div class='b'>
    <div class='t'><%=title%></div>
    <div class='d'><%=content%></div>
  </div>
</script>

<script id='_pi' type='text/x-html-template'>
  <div><%=value%></div>
</script>

<script id='_pp' type='text/x-html-template'>
  <div class='product_pop'>
    <div>
      <div class='c'><span>&#10005;</span></div>
      <div class='cr'>
        <div class='p'>
          <div class='l'><img src='<%=src%>' alt='<%=title%>' title='<%=title%>' /></div>
          <div class='r'>
            <div class='t'>
              <div><%=title%></div>
              <div><%=description%></div>
            </div>
            <div class='b'><%=pis%></div>
          </div>
        </div>
        <div class='li'></div>
        <div class='w'>
          <div class='l'><%=lbs%></div>
          <div class='r'><%=rbs%></div>
        </div>
      </div>
    </div>
  </div>
</script>

<script id='_p' type='text/x-html-template'>
  <div class='p' data-id='<%=id%>'>
    <img src='<%=src%>' alt='<%=title%>' title='<%=title%>' />
    <div>
      <div><%=title%></div>
      <div><%=description%></div>
    </div>
  </div>
</script>
<?php 
  }
