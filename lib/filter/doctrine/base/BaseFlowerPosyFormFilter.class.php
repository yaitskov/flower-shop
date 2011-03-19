<?php

/**
 * FlowerPosy filter form base class.
 *
 * @package    donbuket
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseFlowerPosyFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'amount'    => new sfWidgetFormFilterInput(),
      'flower_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Flower'), 'add_empty' => true)),
      'posy_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Posy'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'amount'    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'flower_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Flower'), 'column' => 'id')),
      'posy_id'   => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Posy'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('flower_posy_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'FlowerPosy';
  }

  public function getFields()
  {
    return array(
      'id'        => 'Number',
      'amount'    => 'Number',
      'flower_id' => 'ForeignKey',
      'posy_id'   => 'ForeignKey',
    );
  }
}
