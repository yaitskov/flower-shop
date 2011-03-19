<?php

/**
 * ProductCategory form base class.
 *
 * @method ProductCategory getObject() Returns the current form's model object
 *
 * @package    donbuket
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseProductCategoryForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'           => new sfWidgetFormInputHidden(),
      'is_flower'    => new sfWidgetFormInputCheckbox(),
      'name'         => new sfWidgetFormInputText(),
      'description'  => new sfWidgetFormTextarea(),
      'catorder'     => new sfWidgetFormInputText(),
      'created_at'   => new sfWidgetFormDateTime(),
      'measure_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Measure'), 'add_empty' => true)),
      'icon_id'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Photo'), 'add_empty' => true)),
      'publisher_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('SiteUser'), 'add_empty' => false)),
      'updated_at'   => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'           => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'is_flower'    => new sfValidatorBoolean(array('required' => false)),
      'name'         => new sfValidatorString(array('max_length' => 100)),
      'description'  => new sfValidatorString(array('max_length' => 3000, 'required' => false)),
      'catorder'     => new sfValidatorInteger(),
      'created_at'   => new sfValidatorDateTime(),
      'measure_id'   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Measure'), 'required' => false)),
      'icon_id'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Photo'), 'required' => false)),
      'publisher_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('SiteUser'))),
      'updated_at'   => new sfValidatorDateTime(),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorAnd(array(
        new sfValidatorDoctrineUnique(array('model' => 'ProductCategory', 'column' => array('name'))),
        new sfValidatorDoctrineUnique(array('model' => 'ProductCategory', 'column' => array('catorder'))),
      ))
    );

    $this->widgetSchema->setNameFormat('product_category[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ProductCategory';
  }

}
