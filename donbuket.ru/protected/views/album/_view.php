<div class="view">
   <?php echo CHtml::link ( CHtml::image( $data->getPhotoUrl(),
                                          $data->filename,
                                          array ( 'width' => 100,
                                                  'height' => 'auto' ) ),
                            'view?id=' . $data->id
                            ) ?>
</div>