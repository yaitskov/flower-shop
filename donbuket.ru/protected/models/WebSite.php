<?php

  /**
   * This is the model class for table "web_site".
   *
   * The followings are the available columns in table 'web_site':
   * @property string $id
   * @property string $visitors_a_hour
   * @property string $visitors_a_day
   * @property string $support_email
   * @property string $birth_year
   * @property string $meta_keywords
   * @property string $meta_description
   * @property string $meta_author
   * @property string $name
   * @property string $about
   */
class WebSite extends CActiveRecord
{
  /**
   * Returns the static model of the specified AR class.
   * @return WebSite the static model class
   */
  public static function model($className=__CLASS__)
  {
    return parent::model($className);
  }

  public function canUpdate ( WebUser $user ){
  }
  /**
   * @return string the associated database table name
   */
  public function tableName()
  {
    return 'web_site';
  }

  /**
   * @return array validation rules for model attributes.
   */
  public function rules()
  {
    // NOTE: you should only define rules for those attributes that
    // will receive user inputs.
    return array(
      array('support_email, name', 'required'),
      array('visitors_a_hour, visitors_a_day, birth_year', 'length', 'max'=>20),
      array('support_email', 'length', 'max'=>100),
      array('name', 'length', 'max'=>255),
      array('meta_keywords, meta_description, meta_author, about', 'safe'),
      // The following rule is used by search().
      // Please remove those attributes that should not be searched.
      array('id, visitors_a_hour, visitors_a_day, support_email, birth_year, meta_keywords,'
            . 'meta_description, meta_author, name, about', 'safe', 'on'=>'search'),
    );
  }

  /**
   * @return array relational rules.
   */
  public function relations()
  {
    // NOTE: you may need to adjust the relation name and the related
    // class name for the relations automatically generated below.
    return array(
    );
  }

  /**
   * @return array customized attribute labels (name=>label)
   */
  public function attributeLabels()
  {
    return array(
      'id' => 'ID',
      'visitors_a_hour' => 'Visitors A Hour',
      'visitors_a_day' => 'Visitors A Day',
      'support_email' => 'Support Email',
      'birth_year' => 'Birth Year',
      'meta_keywords' => 'Meta Keywords',
      'meta_description' => 'Meta Description',
      'meta_author' => 'Meta Author',
      'name' => 'Name',
      'about' => 'About',
    );
  }

  /**
   * Retrieves a list of models based on the current search/filter conditions.
   * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
   */
  public function search()
  {
    // Warning: Please modify the following code to remove attributes that
    // should not be searched.

    $criteria=new CDbCriteria;

    $criteria->compare('id',$this->id,true);
    $criteria->compare('visitors_a_hour',$this->visitors_a_hour,true);
    $criteria->compare('visitors_a_day',$this->visitors_a_day,true);
    $criteria->compare('support_email',$this->support_email,true);
    $criteria->compare('birth_year',$this->birth_year,true);
    $criteria->compare('meta_keywords',$this->meta_keywords,true);
    $criteria->compare('meta_description',$this->meta_description,true);
    $criteria->compare('meta_author',$this->meta_author,true);
    $criteria->compare('name',$this->name,true);
    $criteria->compare('about',$this->about,true);

    return new CActiveDataProvider(get_class($this), array(
      'criteria'=>$criteria,
    ));
  }
}