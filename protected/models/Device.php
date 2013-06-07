<?php

/**
 * This is the model class for table "device".
 *
 * The followings are the available columns in table 'device':
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property string $serial
 * @property string $status
 * @property integer $updated_at
 * @property integer $created_at
 * @property integer $category_id
 */
class Device extends CActiveRecord 
{

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Device the static model class
     */
    public static function model($className = __CLASS__) 
    {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() 
    {
        return 'device';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() 
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('name, serial, category_id', 'required'),
            array('updated_at, created_at, category_id', 'numerical', 'integerOnly' => true),
            array('name, serial, status', 'length', 'max' => 45),
            array('description', 'length', 'max' => 255),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, name, description, serial, status, updated_at, created_at, category_id', 'safe', 'on' => 'search'),
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
            'name' => 'Name',
            'description' => 'Description',
            'serial' => 'Serial',
            'status' => 'Status',
            'updated_at' => 'Updated At',
            'created_at' => 'Created At',
            'category_id' => 'Category',
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

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('description', $this->description, true);
        $criteria->compare('serial', $this->serial, true);
        $criteria->compare('status', $this->status, true);
        $criteria->compare('updated_at', $this->updated_at);
        $criteria->compare('created_at', $this->created_at);
        $criteria->compare('category_id', $this->category_id);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

}