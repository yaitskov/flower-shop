<?php

if ( isset ( $_FILES['upload'] ) ){
  $path = dirname( __FILE__ ) . "/" . basename ( $_FILES['upload']['name'] );
  move_uploaded_file ( $_FILES['upload']['tmp_name'], $path );
}
?>
<html>
  <head>
    <style type='text/css'>
      .upload {
      position: relative;
      width: 104px;
      }
      .realupload {
      position: absolute;
      top: 0;
      right: 0;
      opacity: 0;
      -moz-opacity: 0;
      filter: alpha( opacity: 0 );
      z-index: 2;
      width: 270px;
      }
      form .fakeupload {
      background:url(soft.gif) no-repeat 100% 50%;
      }
      form .fakeupload input {
      width:401px;
      }
    </style>
  </head>
  <body>
    <form enctype="multipart/form-data" method="POST">
      <input type="hidden" name="MAX_FILE_SIZE" value="10000000" />
      <label for="realupload">Upload Image: </label>      
      <li class="upload">
        <div class="fakeupload">
          <input type="text" name="fakeupload"/>
        </div>
        <input name="upload" class="realupload" type="file" onchange="this.form.fakeupload.value = this.value" />
      </li>
      <br/>
      <input type="submit" value="Upload File" />
    </form>
    <?php phpinfo(); ?>
  </body>
</html>
