<?php


class SmoothmGalleryWidget extends CWidget {
  /**
   * @var array< GalleryItemIf >
   */
  public $listOfImages;
  /**
   * @var string tooltip
   */
  public $toolip = 'Открыть на новой странице';
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
    $cs = Yii::app()->clientScript;    
    $am = Yii::app()->assetManager;

    $cssdir = $am->publish ( dirname( __FILE__ ) . DIRECTORY_SEPARATOR . 'css' );
    $jsdir =  $am->publish ( dirname( __FILE__ ) . DIRECTORY_SEPARATOR . 'js' );

    $cs->registerCssFile ( $cssdir . '/layout.css' );
    $cs->registerCssFile ( $cssdir . '/jd.gallery.css' );    
    $cs->registerScriptFile ( $jsdir . '/mootools.v1.11.js'  );
    $cs->registerScriptFile ( $jsdir . '/jd.gallery.js'  );    

    $cs->registerScript ( 
                          <<<EOF
function {$this->getId()}startGallery() {
  var {$this->getId()} = new gallery( \$('{$this->getId()}'),
                                      { timed: false } );
}
window.addEvent('domready', {$this->getId()}startGallery);
EOF
    );
  }
  public function run (){
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
