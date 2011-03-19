<?php

/**
 * Product filter form base class.
 *
 * @package    donbuket
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseProductFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'name'              => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'description'       => new sfWidgetFormFilterInput(),
      'vendor'            => new sfWidgetFormFilterInput(),
      'amount'            => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'price'             => new sfWidgetFormFilterInput(),
      'last_entrance'     => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'is_home_plant'     => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'temperature_range' => new sfWidgetFormFilterInput(),
      'blossoming_id'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Blossoming'), 'add_empty' => true)),
      'blossoming_start'  => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'blossoming_end'    => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'sun'               => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('SunSense'), 'add_empty' => true)),
      'sprinkling_period' => new sfWidgetFormFilterInput(),
      'size'              => new sfWidgetFormFilterInput(),
      'weight'            => new sfWidgetFormFilterInput(),
      'category_id'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ProductCategory'), 'add_empty' => true)),
      'icon_id'           => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Photo'), 'add_empty' => true)),
      'album_id'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('PhotoAlbum'), 'add_empty' => true)),
      'color_id'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Color'), 'add_empty' => true)),
      'publisher_id'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('SiteUser'), 'add_empty' => true)),
      'created_at'        => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'        => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'name'              => new sfValidatorPass(array('required' => false)),
      'description'       => new sfValidatorPass(array('required' => false)),
      'vendor'            => new sfValidatorPass(array('required' => false)),
      'amount'            => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'price'             => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'last_entrance'     => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'is_home_plant'     => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'temperature_range' => new sfValidatorPass(array('required' => false)),
      'blossoming_id'     => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Blossoming'), 'column' => 'id')),
      'blossoming_start'  => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'blossoming_end'    => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'sun'               => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('SunSense'), 'column' => 'id')),
      'sprinkling_period' => new sfValidatorPass(array('required' => false)),
      'size'              => new sfValidatorPass(array('required' => false)),
      'weight'            => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'category_id'       => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('ProductCategory'), 'column' => 'id')),
      'icon_id'           => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Photo'), 'column' => 'id')),
      'album_id'          => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('PhotoAlbum'), 'column' => 'id')),
      'color_id'          => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Color'), 'column' => 'id')),
      'publisher_id'      => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('SiteUser'), 'column' => 'id')),
      'created_at'        => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'        => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('product_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Product';
  }

  public function getFields()
  {
    return array(
      'id'                => 'Number',
      'name'              => 'Text',
      'description'       => 'Text',
      'vendor'            => 'Text',
      'amount'            => 'Number',
      'price'             => 'Number',
      'last_entrance'     => 'Date',
      'is_home_plant'     => 'Boolean',
      'temperature_range' => 'Text',
      'blossoming_id'     => 'ForeignKey',
      'blossoming_start'  => 'Date',
      'blossoming_end'    => 'Date',
      'sun'               => 'ForeignKey',
      'sprinkling_period' => 'Text',
      'size'              => 'Text',
      'weight'            => 'Number',
      'category_id'       => 'ForeignKey',
      'icon_id'           => 'ForeignKey',
      'album_id'          => 'ForeignKey',
      'color_id'          => 'ForeignKey',
      'publisher_id'      => 'ForeignKey',
      'created_at'        => 'Date',
      'updated_at'        => 'Date',
    );
  }
}
