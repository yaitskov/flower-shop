<?php $this->beginContent('//layouts/main'); ?>
<div class="page-content">
  <div class="span-19" style="float: left; width: 73%;">
    <?php echo $content; ?>
  </div>
   <?php  $i = 0; foreach ($this->menu as $mi) {  if (!isset($mi['visible']) or $mi['visible']) { $i++; } }
   if ($i > 0): ?>
  <div class="span-5 last rounded-corners"
   style="float: right; width: 24%; border: 1px solid #80c087; padding: 7px; padding-top: 0px; padding-left:10px; padding-bottom: 0px;">
    <div id="sidebar">
    <?php

     $this->beginWidget('zii.widgets.CPortlet', array(
       //      'title'=>'Меню',
     ));
     $this->widget('zii.widgets.CMenu', array(
      'items'=>$this->menu,
      'htmlOptions'=>array('class'=>'operations'),
     ));
     $this->endWidget();
    ?>
    </div> 
  </div>
    
    
     <?php
         Yii::app()->clientScript->registerCoreScript('jquery');
Yii::app()->clientScript->registerScript('clickOnLiGotoByHref',
                                         <<<EOF
$('ul.operations li').each(function(){
    $(this).click(function(){
        location.href = $(this).find('a').attr('href');
      });
  });
EOF
                                         ,CClientScript::POS_READY);

    endif; ?>
</div>
<?php $this->endContent(); ?>
