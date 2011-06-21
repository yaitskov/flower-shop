<map name="main_menu_map">
  <area shape="poly"
        coords="53,41,67,41,86,39,113,37,134,39,144,45,145,51,138,58,117,64,92,64,71,62,53,57,55,49,53,41"
        href="/site/index" TITLE="Главная страница"/>
  <area shape="poly"
        coords="53,57,69,61,91,64,110,64,135,77,140,84,139,90,130,95,111,93,86,85,63,73,51,64,53,58"
        href="/site/posy" TITLE="Букеты"/>
  <area shape="poly"
        coords="50,63,65,74,85,84,106,92,120,108,121,112,123,118,119,122,107,122,88,113,69,98,49,76,46,68,48,67"
        href="/site/product" TITLE="Товары"/>
  <area shape="poly"
        coords="46,68,49,76,72,100,88,113,97,132,96,136,96,142,91,146,79,141,63,124,45,91,41,79,38,69"
        href="/forum/index" TITLE="Форум"/>
  <area shape="poly"
        coords="51,37,65,33,81,24,105,14,124,10,133,10,140,15,140,19,137,26,119,37,96,38,67,41,53,41"
        href="/site/aboutus" TITLE="О нас"/>
</map>

<map name="enter_exit_map">
  <area shape="poly"
        coords="82,28,87,22,96,17,130,15,155,20,174,20,171,26,173,30,175,33,174,36,157,41,126,44,106,43,89,38,83,32"
        href="<?=$this->enterExitHref?>"
        title="<?=$this->enterExitCaption?>"/>      
</Map>
<?php if ( $this->regIsVisible ): ?>
<map name="registration_map">
  <area shape="poly"
        coords="3,29,13,21,45,17,75,21,95,23,94,28,95,33,97,36,80,43,50,45,32,45,12,40,4,35"
        href="/site/registration" title="Регистрация"/>      
</map>
<?php endif; ?>

<div class="header-of-site-page">
  <div>
    <img usemap="#main_menu_map" border="0" src='<?=$this->curItemImage?>'/>
  </div>
  <div>
    <img src="<?=$this->titleImage?>"/>
  </div>
  <div>
    <div>
      <img src='<?=$this->enterExitImage?>'
           usemap='#enter_exit_map' border='0'/>
    </div>
    <div  class="stop-float"></div>    
   <?php if ( ! Yii::app()->user->isGuest ): ?>
   <div class="user-login-label">
      <div><?= $this->userName ?></div>
   </div>
   <?php Yii::app()->clientScript->registerScript (
             'login-label',
             <<<EOF
   \$(".user-login-label").each (
     function(){
       \$(this).mouseenter(
         function () {
           var p = \$("<div>{$this->userName}</div>");
           p.addClass( "user-panel" );
           \$(this).parent().append ( p ) ;
           var ppos = \$(this).offset();
           ppos.top += 13;
           ppos.left += 29;           
           p.offset( ppos );           
           var r = \$(".user-panel").mouseleave (
             function (){
               \$(this).fadeOut( 900, function() { \$(this).remove(); } );
             } );
         } );
     } );
EOF
   ); ?>
   <?php endif; ?>
      <img src="<?=$this->regImage?>" usemap="#registration_map"
           border="0"/>

    </div>
   </div>
   <div class="stop-float">
   </div>
</div>

