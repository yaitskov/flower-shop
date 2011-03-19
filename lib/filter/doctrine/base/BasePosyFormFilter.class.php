<?php

/**
 * Posy filter form base class.
 *
 * @package    donbuket
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BasePosyFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'client_made'  => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'numlinks'     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'name'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'description'  => new sfWidgetFormFilterInput(),
      'published_at' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'created_at'   => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'price_type'   => new sfWidgetFormChoice(array('choices' => array('' => '', 'unknown' => 'unknown', 'constant' => 'constant', 'variable' => 'variable'))),
      'const_price'  => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'icon'         => new sfWidgetFormFilterInput(),
      'publisher_id' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'author_id'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('SiteUser'), 'add_empty' => true)),
      'album_id'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('PhotoAlbum'), 'add_empty' => true)),
      'updated_at'   => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'client_made'  => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'numlinks'     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'name'         => new sfValidatorPass(array('required' => false)),
      'description'  => new sfValidatorPass(array('required' => false)),
      'published_at' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'created_at'   => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'price_type'   => new sfValidatorChoice(array('required' => false, 'choices' => array('unknown' => 'unknown', 'constant' => 'constant', 'variable' => 'variable'))),
      'const_price'  => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'icon'         => new sfValidatorPass(array('required' => false)),
      'publisher_id' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'author_id'    => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('SiteUser'), 'column' => 'id')),
      'album_id'     => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('PhotoAlbum'), 'column' => 'id')),
      'updated_at'   => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('posy_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Posy';
  }

  public function getFields()
  {
    return array(
      'id'           => 'Number',
      'client_made'  => 'Boolean',
      'numlinks'     => 'Number',
      'name'         => 'Text',
      'description'  => 'Text',
      'published_at' => 'Date',
      'created_at'   => 'Date',
      'price_type'   => 'Enum',
      'const_price'  => 'Number',
      'icon'         => 'Text',
      'publisher_id' => 'Number',
      'author_id'    => 'ForeignKey',
      'album_id'     => 'ForeignKey',
      'updated_at'   => 'Date',
    );
  }
}
