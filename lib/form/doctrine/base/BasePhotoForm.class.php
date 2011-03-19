<?php

/**
 * Photo form base class.
 *
 * @method Photo getObject() Returns the current form's model object
 *
 * @package    donbuket
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BasePhotoForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'        => new sfWidgetFormInputHidden(),
      'numlinks'  => new sfWidgetFormInputText(),
      'path'      => new sfWidgetFormInputText(),
      'extention' => new sfWidgetFormInputText(),
      'width'     => new sfWidgetFormInputText(),
      'height'    => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'        => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'numlinks'  => new sfValidatorInteger(array('required' => false)),
      'path'      => new sfValidatorString(array('max_length' => 255)),
      'extention' => new sfValidatorString(array('max_length' => 10)),
      'width'     => new sfValidatorInteger(array('required' => false)),
      'height'    => new sfValidatorInteger(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('photo[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Photo';
  }

}
