<?php

/**
 * UsedProducts form base class.
 *
 * @method UsedProducts getObject() Returns the current form's model object
 *
 * @package    donbuket
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseUsedProductsForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'         => new sfWidgetFormInputHidden(),
      'amount'     => new sfWidgetFormInputText(),
      'product_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Product'), 'add_empty' => true)),
      'posy_id'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Posy'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'         => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'amount'     => new sfValidatorInteger(array('required' => false)),
      'product_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Product'), 'required' => false)),
      'posy_id'    => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Posy'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('used_products[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'UsedProducts';
  }

}
