<?php

/**
 * This is the model class for table "tbl_user".
 *
 * The followings are the available columns in table 'tbl_user':
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $email
 */
class User extends CActiveRecord
{
  /**
   * Returns the static model of the specified AR class.
   * @return User the static model class
   */
  public static function model($className=__CLASS__)
  {
    return parent::model($className);
  }

  /**
   * @return string the associated database table name
   */
  public function tableName()
  {
    return 'site_user';
  }
  public function hashPassword ($password ) {
    return hash( 'sha1', $password  );
  }

  public function findByLoginPassword ( $login, $password ) {
    return $this->findByAttributes(
      array ( 'login' => $login,
              'password' => $this->hashPassword( $password ) )
    );
  }
  public function acted(){
    $this->last_login_at = Yii::app()->controller->now;
    $this->update( array ( 'last_login_at' )  );
  }
  
  public function logouted(){
    $this->acted();
    $this->online = 0;
    $this->update( array  ( 'online' ) ) ;    
  }
  public function logined(){
    $this->last_login_at = Yii::app()->controller->now; 
    $this->online = true;
    $this->auth_attempts = 0;
    $this->update( array ( 'last_login_at', 'online', 'auth_attempts' ) ) ;
  }

  /**
   * @return array validation rules for model attributes.
   */
  public function rules()
  {
    // NOTE: you should only define rules for those attributes that
    // will receive user inputs.
    return array(
      array('username, password, email', 'required'),
      array('username, password, email', 'length', 'max'=>128),
      // The following rule is used by search().
      // Please remove those attributes that should not be searched.
      array('id, username, password, email', 'safe', 'on'=>'search'),
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
      'username' => 'Username',
      'password' => 'Password',
      'email' => 'Email',
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

    $criteria->compare('id',$this->id);
    $criteria->compare('username',$this->username,true);
    $criteria->compare('password',$this->password,true);
    $criteria->compare('email',$this->email,true);

    return new CActiveDataProvider(get_class($this), array(
      'criteria'=>$criteria,
    ));
  }
}