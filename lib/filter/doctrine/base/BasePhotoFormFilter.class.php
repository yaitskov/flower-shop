<?php

/**
 * Photo filter form base class.
 *
 * @package    donbuket
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BasePhotoFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'numlinks'  => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'path'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'extention' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'width'     => new sfWidgetFormFilterInput(),
      'height'    => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'numlinks'  => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'path'      => new sfValidatorPass(array('required' => false)),
      'extention' => new sfValidatorPass(array('required' => false)),
      'width'     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'height'    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('photo_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Photo';
  }

  public function getFields()
  {
    return array(
      'id'        => 'Number',
      'numlinks'  => 'Number',
      'path'      => 'Text',
      'extention' => 'Text',
      'width'     => 'Number',
      'height'    => 'Number',
    );
  }
}
