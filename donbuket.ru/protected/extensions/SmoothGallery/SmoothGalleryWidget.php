<?php


class SmoothGalleryWidget extends CWidget {
  public static function getThumbnailUrl(File $f, $width = null, $height = null) {
    $params = array('imgid' => base64_encode($f->hashName));
    if (is_numeric($width))
      $params['width'] = $width;
    elseif (is_numeric($height))
      $params['height'] = $height;
    else
      throw new Exception("set width or height");
    return Yii::app()->createUrl('site/thumbnail', $params);
  }

  /**
   * @var array< GalleryItemIf >
   */
  public $listOfImages;
  /**
   * @var string tooltip
   */
  public $tooltip = 'Открыть на новой странице';
  /**
   * @var integer width of the widget in pixels.
   * @default null then the value from css will be used
   */ 
  public $width = null;
  /**
   * @var integer height of the widget in pixels.
   * @default null then the value from css will be used
   */   
  public $height = null;
  /**
   * @var array <string > list of css classes
   */
  public $cssClasses = null;
  public function getId (){
        return "smoothgallery" . parent::getId();
  }
  public function init (){
  }
  public function run (){
    $cs = Yii::app()->clientScript;
    $am = Yii::app()->assetManager;

    $cssdir = $am->publish ( dirname( __FILE__ ) . DIRECTORY_SEPARATOR . 'css' );
    $gal =  $am->publish ( dirname( __FILE__ ) . DIRECTORY_SEPARATOR
                           . 'galleria'); // . DIRECTORY_SEPARATOR
    //                             . );
    //    $theme = $am->publish(dirname(__FILE__) . DIRECTORY_SEPARATOR .
    //                          'galleria' . DIRECTORY_SEPARATOR 'themes'
    //                          . DIRECTORY_SEPARATOR . 'classic');
    $cs->registerCssFile ( $cssdir . '/forGallery.css' );
    //$cs->registerCssFile ( $cssdir . '/jd.gallery.css' );
    //    $cs->registerScriptFile ( $jsdir . '/mootools.v1.11.js', CClientScript::POS_HEAD  );    
    $cs->registerScriptFile ( $gal . '/galleria-1.2.4.min.js' , CClientScript::POS_HEAD  );    

    $cs->registerScript ( $this->getId(),
                          <<<EOF
Galleria.loadTheme('${gal}/galleria.classic.min.js');
$('#gallery{$this->getId()}').galleria();
EOF
                          ,  CClientScript::POS_READY);
    
    if ( ! count ( $this->listOfImages ) ) return;
    $classes = $this->cssClasses === null
                  ? "" : implode ( " ", $this->cssClasses );
    
    $style = "";
    if ( $this->width != null )
       $style = "width: " . $this->width . "px;";
    if ( $this->height != null )
       $style .= " height: " . $this->height . "px;";
       
    $this->render( 'view',
                   array ( 'classes' => $classes,
                           'style' => $style
                         )
                 );
  }
}

?>
