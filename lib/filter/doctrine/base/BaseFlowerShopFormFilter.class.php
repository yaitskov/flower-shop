<?php

/**
 * FlowerShop filter form base class.
 *
 * @package    donbuket
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseFlowerShopFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'phone'         => new sfWidgetFormFilterInput(),
      'start_work_at' => new sfWidgetFormFilterInput(),
      'end_work_at'   => new sfWidgetFormFilterInput(),
      'name'          => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'email_address' => new sfWidgetFormFilterInput(),
      'mail_address'  => new sfWidgetFormFilterInput(),
      'outline_route' => new sfWidgetFormFilterInput(),
      'map_x'         => new sfWidgetFormFilterInput(),
      'map_y'         => new sfWidgetFormFilterInput(),
      'place_x'       => new sfWidgetFormFilterInput(),
      'place_y'       => new sfWidgetFormFilterInput(),
      'map_scale'     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'map_width'     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'map_heigth'    => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'views'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('PhotoAlbum'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'phone'         => new sfValidatorPass(array('required' => false)),
      'start_work_at' => new sfValidatorPass(array('required' => false)),
      'end_work_at'   => new sfValidatorPass(array('required' => false)),
      'name'          => new sfValidatorPass(array('required' => false)),
      'email_address' => new sfValidatorPass(array('required' => false)),
      'mail_address'  => new sfValidatorPass(array('required' => false)),
      'outline_route' => new sfValidatorPass(array('required' => false)),
      'map_x'         => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'map_y'         => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'place_x'       => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'place_y'       => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'map_scale'     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'map_width'     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'map_heigth'    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'views'         => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('PhotoAlbum'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('flower_shop_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'FlowerShop';
  }

  public function getFields()
  {
    return array(
      'id'            => 'Number',
      'phone'         => 'Text',
      'start_work_at' => 'Text',
      'end_work_at'   => 'Text',
      'name'          => 'Text',
      'email_address' => 'Text',
      'mail_address'  => 'Text',
      'outline_route' => 'Text',
      'map_x'         => 'Number',
      'map_y'         => 'Number',
      'place_x'       => 'Number',
      'place_y'       => 'Number',
      'map_scale'     => 'Number',
      'map_width'     => 'Number',
      'map_heigth'    => 'Number',
      'views'         => 'ForeignKey',
    );
  }
}
