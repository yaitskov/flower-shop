<?php

/**
 * BaseFaceUptime
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property string $name
 * @property Doctrine_Collection $Flower
 * 
 * @method string              getName()   Returns the current record's "name" value
 * @method Doctrine_Collection getFlower() Returns the current record's "Flower" collection
 * @method FaceUptime          setName()   Sets the current record's "name" value
 * @method FaceUptime          setFlower() Sets the current record's "Flower" collection
 * 
 * @package    donbuket
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseFaceUptime extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('face_uptime');
        $this->hasColumn('name', 'string', 10, array(
             'type' => 'string',
             'notnull' => true,
             'unique' => true,
             'length' => 10,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('Flower', array(
             'local' => 'id',
             'foreign' => 'uptime_measure'));
    }
}