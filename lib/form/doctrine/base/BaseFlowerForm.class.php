<?php

/**
 * Flower form base class.
 *
 * @method Flower getObject() Returns the current form's model object
 *
 * @package    donbuket
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseFlowerForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                  => new sfWidgetFormInputHidden(),
      'comment'             => new sfWidgetFormInputText(),
      'howcare'             => new sfWidgetFormTextarea(),
      'created_at'          => new sfWidgetFormDateTime(),
      'updated_at'          => new sfWidgetFormDateTime(),
      'legheight'           => new sfWidgetFormInputText(),
      'price'               => new sfWidgetFormInputText(),
      'work_factor'         => new sfWidgetFormInputText(),
      'sex'                 => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Sex'), 'add_empty' => true)),
      'start_age'           => new sfWidgetFormInputText(),
      'end_age'             => new sfWidgetFormInputText(),
      'amount'              => new sfWidgetFormInputText(),
      'lowest_temperature'  => new sfWidgetFormInputText(),
      'highest_temperature' => new sfWidgetFormInputText(),
      'uptime_measure'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('FaceUptime'), 'add_empty' => true)),
      'uptime'              => new sfWidgetFormInputText(),
      'season_start'        => new sfWidgetFormInputText(),
      'season_end'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Season'), 'add_empty' => true)),
      'album_id'            => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('PhotoAlbum'), 'add_empty' => true)),
      'icon_id'             => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Photo'), 'add_empty' => true)),
      'publisher_id'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('SiteUser'), 'add_empty' => false)),
      'color_id'            => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Color'), 'add_empty' => true)),
      'category_id'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ProductCategory'), 'add_empty' => false)),
    ));

    $this->setValidators(array(
      'id'                  => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'comment'             => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'howcare'             => new sfValidatorString(array('max_length' => 4000, 'required' => false)),
      'created_at'          => new sfValidatorDateTime(),
      'updated_at'          => new sfValidatorDateTime(),
      'legheight'           => new sfValidatorInteger(array('required' => false)),
      'price'               => new sfValidatorNumber(array('required' => false)),
      'work_factor'         => new sfValidatorNumber(array('required' => false)),
      'sex'                 => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Sex'), 'required' => false)),
      'start_age'           => new sfValidatorInteger(array('required' => false)),
      'end_age'             => new sfValidatorInteger(array('required' => false)),
      'amount'              => new sfValidatorInteger(array('required' => false)),
      'lowest_temperature'  => new sfValidatorInteger(array('required' => false)),
      'highest_temperature' => new sfValidatorInteger(array('required' => false)),
      'uptime_measure'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('FaceUptime'), 'required' => false)),
      'uptime'              => new sfValidatorInteger(array('required' => false)),
      'season_start'        => new sfValidatorInteger(array('required' => false)),
      'season_end'          => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Season'), 'required' => false)),
      'album_id'            => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('PhotoAlbum'), 'required' => false)),
      'icon_id'             => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Photo'), 'required' => false)),
      'publisher_id'        => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('SiteUser'))),
      'color_id'            => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Color'), 'required' => false)),
      'category_id'         => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('ProductCategory'))),
    ));

    $this->widgetSchema->setNameFormat('flower[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Flower';
  }

}
