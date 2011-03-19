<?php

/**
 * FlowerPosy form base class.
 *
 * @method FlowerPosy getObject() Returns the current form's model object
 *
 * @package    donbuket
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseFlowerPosyForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'        => new sfWidgetFormInputHidden(),
      'amount'    => new sfWidgetFormInputText(),
      'flower_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Flower'), 'add_empty' => false)),
      'posy_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Posy'), 'add_empty' => false)),
    ));

    $this->setValidators(array(
      'id'        => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'amount'    => new sfValidatorInteger(array('required' => false)),
      'flower_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Flower'))),
      'posy_id'   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Posy'))),
    ));

    $this->widgetSchema->setNameFormat('flower_posy[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'FlowerPosy';
  }

}
