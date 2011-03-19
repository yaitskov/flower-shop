<?php

/**
 * ColorListElement filter form base class.
 *
 * @package    donbuket
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseColorListElementFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'color_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Color'), 'add_empty' => true)),
      'list_id'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ColorList'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'color_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Color'), 'column' => 'id')),
      'list_id'  => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('ColorList'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('color_list_element_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ColorListElement';
  }

  public function getFields()
  {
    return array(
      'id'       => 'Number',
      'color_id' => 'ForeignKey',
      'list_id'  => 'ForeignKey',
    );
  }
}
