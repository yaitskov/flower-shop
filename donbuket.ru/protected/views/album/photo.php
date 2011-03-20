<?php
  //          echo "HELLO WORLD";
  //      exit;
  //ob_clean();
          // $model = $this->loadModel( $id );
          
          // header('Pragma: public');
          // header('Expires: 0');
          // header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
          // header('Content-Transfer-Encoding: binary');
          // header('Content-length: '.$model->file_size);
          // header('Content-Type: '.$model->file_type);
          // header('Content-Disposition: attachment; filename='.$model->file_name);
          // echo $model->photo;
          // exit;

$this->breadcrumbs=array(
	'Album'=>array('/album'),
	'Photo',
);?>
<h1><?php echo $model->filename; ?></h1>

<p>
	You may change the content of this page by modifying
	the file <tt><?php echo __FILE__; ?></tt>.
</p>
