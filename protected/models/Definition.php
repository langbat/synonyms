<?php

/**
 * This is the model class for table "definition".
 *
 * The followings are the available columns in table 'definition':
 * @property integer $id
 * @property integer $id_word
 * @property string $definition
 * @property integer $order
 *
 * The followings are the available model relations:
 * @property Word $idWord
 */
class Definition extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Definition the static model class
	 */
    public $word;
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'definition';
	}
    public function behaviors()
    {
        return array('datetimeI18NBehavior' => array('class' => 'ext.DateTimeI18NBehavior')); 
    }

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_word, definition', 'required'),
			array('id_word, order', 'numerical', 'integerOnly'=>true),
			array('definition', 'length', 'max'=>1000),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, id_word, definition,word, order', 'safe', 'on'=>'search'),
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
			'idWord' => array(self::BELONGS_TO, 'Word', 'id_word'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('global', 'ID'),
			'id_word' => Yii::t('global', 'Id Word'),
			'definition' => Yii::t('global', 'Definition'),
			'order' => Yii::t('global', 'Order'),
			'word' => Yii::t('global', 'Word'),
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
        $currentLang = Languages::model()->getCurrentLanguage();
		$criteria=new CDbCriteria;
        $criteria->with ='idWord' ;
		$criteria->compare('id',$this->id);
		$criteria->compare('idWord.word',$this->word);
		$criteria->compare('definition',$this->definition,true);
		$criteria->compare('order',$this->order);
		$criteria->compare('idWord.id_language',$currentLang,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

    public function getDefinitionById($id){
        $definitions = $this->findAllByAttributes(array('id_word'=>$id));
        $result=array();
        if($definitions){
            $result = array();
            foreach($definitions as $definition){
                $result[]=$definition->definition;
            }
        }
        return $result;
    }

    public function getDefinition(){
        $allDefinition = $this->findAll();
        $result = array();
        if($allDefinition){
            foreach($allDefinition as $definition){
                $result[]= $definition['definition'];
            }
        }
        return $result;
    }

    public function saveDefinition($definitions,$word_id){
        foreach($definitions as $definition){
            $newDefinition = new Definition();
            $newDefinition->definition = $definition;
            $newDefinition->id_word = $word_id;
            $newDefinition->order = 1;
            $newDefinition->save();
        }
    }
    
     public function getDefinitionByWork( $keyword ){
        $sql = "SELECT definition.definition
                FROM word 
                INNER JOIN definition
                ON word.id = definition.id_word
                WHERE word.word = '".$keyword."' AND word.id_language= (SELECT id FROM languages WHERE region_code='".Yii::app()->language."' )" ;
        $result = Yii::app()->db->createCommand($sql)->queryAll();
        return $result;
    }

    public function updateDefinition($definitions,$word_id){
        $oldDefinition = $this->getDefinitionById($word_id);
        $mergeDefinition =  array_unique(array_merge($oldDefinition,$definitions));
        $definitionRemoves = array_diff($mergeDefinition,$definitions);
        $meaningAdds = array_diff($mergeDefinition,$oldDefinition);
        $this->saveDefinition($meaningAdds,$word_id);
        foreach($definitionRemoves as $definitionRemove){
            Definition::model()->removedWordDefinition($word_id,$definitionRemove);
        }
    }
    public function removedWordDefinition($word_id,$definition){
        $criteria=new CDbCriteria;
        $criteria->condition = 'id_word='.$word_id.' AND definition="'.$definition.'"';
        $removedDef = Definition::model()->find($criteria);
        $removedDef->delete();
    }
}