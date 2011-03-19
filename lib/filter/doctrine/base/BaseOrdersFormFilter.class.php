<?php

/**
 * Orders filter form base class.
 *
 * @package    donbuket
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseOrdersFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'number'              => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'ordered_at'          => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'deadline'            => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'accepted_at'         => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'completed_at'        => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'canceled_at'         => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'cancel_description'  => new sfWidgetFormFilterInput(),
      'client_requirements' => new sfWidgetFormFilterInput(),
      'client_phone'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'client_name'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'client_email'        => new sfWidgetFormFilterInput(),
      'order_amount'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'client_id'           => new sfWidgetFormFilterInput(),
      'responsible_id'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('SiteUser'), 'add_empty' => true)),
      'posy_id'             => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Posy'), 'add_empty' => true)),
      'created_at'          => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'          => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'number'              => new sfValidatorPass(array('required' => false)),
      'ordered_at'          => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'deadline'            => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'accepted_at'         => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'completed_at'        => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'canceled_at'         => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'cancel_description'  => new sfValidatorPass(array('required' => false)),
      'client_requirements' => new sfValidatorPass(array('required' => false)),
      'client_phone'        => new sfValidatorPass(array('required' => false)),
      'client_name'         => new sfValidatorPass(array('required' => false)),
      'client_email'        => new sfValidatorPass(array('required' => false)),
      'order_amount'        => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'client_id'           => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'responsible_id'      => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('SiteUser'), 'column' => 'id')),
      'posy_id'             => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Posy'), 'column' => 'id')),
      'created_at'          => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'          => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('orders_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Orders';
  }

  public function getFields()
  {
    return array(
      'id'                  => 'Number',
      'number'              => 'Text',
      'ordered_at'          => 'Date',
      'deadline'            => 'Date',
      'accepted_at'         => 'Date',
      'completed_at'        => 'Date',
      'canceled_at'         => 'Date',
      'cancel_description'  => 'Text',
      'client_requirements' => 'Text',
      'client_phone'        => 'Text',
      'client_name'         => 'Text',
      'client_email'        => 'Text',
      'order_amount'        => 'Number',
      'client_id'           => 'Number',
      'responsible_id'      => 'ForeignKey',
      'posy_id'             => 'ForeignKey',
      'created_at'          => 'Date',
      'updated_at'          => 'Date',
    );
  }
}
