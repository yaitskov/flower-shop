<?php

/**
 * UsedProducts filter form base class.
 *
 * @package    donbuket
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseUsedProductsFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'amount'     => new sfWidgetFormFilterInput(),
      'product_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Product'), 'add_empty' => true)),
      'posy_id'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Posy'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'amount'     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'product_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Product'), 'column' => 'id')),
      'posy_id'    => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Posy'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('used_products_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'UsedProducts';
  }

  public function getFields()
  {
    return array(
      'id'         => 'Number',
      'amount'     => 'Number',
      'product_id' => 'ForeignKey',
      'posy_id'    => 'ForeignKey',
    );
  }
}
