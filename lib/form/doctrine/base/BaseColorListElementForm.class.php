<?php

/**
 * ColorListElement form base class.
 *
 * @method ColorListElement getObject() Returns the current form's model object
 *
 * @package    donbuket
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseColorListElementForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'       => new sfWidgetFormInputHidden(),
      'color_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Color'), 'add_empty' => false)),
      'list_id'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ColorList'), 'add_empty' => false)),
    ));

    $this->setValidators(array(
      'id'       => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'color_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Color'))),
      'list_id'  => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('ColorList'))),
    ));

    $this->widgetSchema->setNameFormat('color_list_element[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ColorListElement';
  }

}
