<?php

/**
 * Flower filter form base class.
 *
 * @package    donbuket
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseFlowerFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'comment'             => new sfWidgetFormFilterInput(),
      'howcare'             => new sfWidgetFormFilterInput(),
      'created_at'          => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'          => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'legheight'           => new sfWidgetFormFilterInput(),
      'price'               => new sfWidgetFormFilterInput(),
      'work_factor'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'sex'                 => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Sex'), 'add_empty' => true)),
      'start_age'           => new sfWidgetFormFilterInput(),
      'end_age'             => new sfWidgetFormFilterInput(),
      'amount'              => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'lowest_temperature'  => new sfWidgetFormFilterInput(),
      'highest_temperature' => new sfWidgetFormFilterInput(),
      'uptime_measure'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('FaceUptime'), 'add_empty' => true)),
      'uptime'              => new sfWidgetFormFilterInput(),
      'season_start'        => new sfWidgetFormFilterInput(),
      'season_end'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Season'), 'add_empty' => true)),
      'album_id'            => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('PhotoAlbum'), 'add_empty' => true)),
      'icon_id'             => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Photo'), 'add_empty' => true)),
      'publisher_id'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('SiteUser'), 'add_empty' => true)),
      'color_id'            => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Color'), 'add_empty' => true)),
      'category_id'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ProductCategory'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'comment'             => new sfValidatorPass(array('required' => false)),
      'howcare'             => new sfValidatorPass(array('required' => false)),
      'created_at'          => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'          => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'legheight'           => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'price'               => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'work_factor'         => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'sex'                 => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Sex'), 'column' => 'id')),
      'start_age'           => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'end_age'             => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'amount'              => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'lowest_temperature'  => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'highest_temperature' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'uptime_measure'      => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('FaceUptime'), 'column' => 'id')),
      'uptime'              => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'season_start'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'season_end'          => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Season'), 'column' => 'id')),
      'album_id'            => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('PhotoAlbum'), 'column' => 'id')),
      'icon_id'             => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Photo'), 'column' => 'id')),
      'publisher_id'        => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('SiteUser'), 'column' => 'id')),
      'color_id'            => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Color'), 'column' => 'id')),
      'category_id'         => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('ProductCategory'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('flower_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Flower';
  }

  public function getFields()
  {
    return array(
      'id'                  => 'Number',
      'comment'             => 'Text',
      'howcare'             => 'Text',
      'created_at'          => 'Date',
      'updated_at'          => 'Date',
      'legheight'           => 'Number',
      'price'               => 'Number',
      'work_factor'         => 'Number',
      'sex'                 => 'ForeignKey',
      'start_age'           => 'Number',
      'end_age'             => 'Number',
      'amount'              => 'Number',
      'lowest_temperature'  => 'Number',
      'highest_temperature' => 'Number',
      'uptime_measure'      => 'ForeignKey',
      'uptime'              => 'Number',
      'season_start'        => 'Number',
      'season_end'          => 'ForeignKey',
      'album_id'            => 'ForeignKey',
      'icon_id'             => 'ForeignKey',
      'publisher_id'        => 'ForeignKey',
      'color_id'            => 'ForeignKey',
      'category_id'         => 'ForeignKey',
    );
  }
}
