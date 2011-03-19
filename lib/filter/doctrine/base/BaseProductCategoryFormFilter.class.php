<?php

/**
 * ProductCategory filter form base class.
 *
 * @package    donbuket
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseProductCategoryFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'is_flower'    => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'name'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'description'  => new sfWidgetFormFilterInput(),
      'catorder'     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'created_at'   => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'measure_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Measure'), 'add_empty' => true)),
      'icon_id'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Photo'), 'add_empty' => true)),
      'publisher_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('SiteUser'), 'add_empty' => true)),
      'updated_at'   => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'is_flower'    => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'name'         => new sfValidatorPass(array('required' => false)),
      'description'  => new sfValidatorPass(array('required' => false)),
      'catorder'     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'created_at'   => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'measure_id'   => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Measure'), 'column' => 'id')),
      'icon_id'      => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Photo'), 'column' => 'id')),
      'publisher_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('SiteUser'), 'column' => 'id')),
      'updated_at'   => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('product_category_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ProductCategory';
  }

  public function getFields()
  {
    return array(
      'id'           => 'Number',
      'is_flower'    => 'Boolean',
      'name'         => 'Text',
      'description'  => 'Text',
      'catorder'     => 'Number',
      'created_at'   => 'Date',
      'measure_id'   => 'ForeignKey',
      'icon_id'      => 'ForeignKey',
      'publisher_id' => 'ForeignKey',
      'updated_at'   => 'Date',
    );
  }
}
