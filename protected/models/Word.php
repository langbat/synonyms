<?php

/**
 * This is the model class for table "word".
 *
 * The followings are the available columns in table 'word':
 * @property integer $id
 * @property string $word
 * @property string $alias
 * @property integer $id_language
 * @property integer $id_antonyms
 *
 * The followings are the available model relations:
 * @property Definition[] $definitions
 * @property WordMeanings[] $wordMeanings
 */
class Word extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Word the static model class
     */
    public $definition, $meaning;
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'word';
    }

    public function behaviors() {
        return array('datetimeI18NBehavior' => array('class' => 'ext.DateTimeI18NBehavior'));
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('word, id_language', 'required'),
            array('id_language', 'numerical', 'integerOnly'=>true),
            array('word,alias', 'length', 'max' => 50),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, word, definition, meaning,alias, id_language, id_antonyms', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'definitions' => array(self::HAS_MANY, 'Definition', 'id_word'),
            'idLanguage' => array(self::BELONGS_TO, 'Languages', 'id_language'),
            'wordMeanings' => array(self::HAS_MANY, 'WordMeanings', 'id_word'),

        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => Yii::t('global', 'ID'),
            'word' => Yii::t('global', 'Word'),
            'id_language' => Yii::t('global', 'Id Language'),
            'alias' => Yii::t('global', 'Alias'),
            'meaning' => Yii::t('global', ' Meaning'),
            'antonyms' => Yii::t('global', ' Antonym'),
            'definition' => Yii::t('global', 'Definition'),
            'id_antonyms' => Yii::t('global', 'Antonyms'),
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search() {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;
        $criteria->together = true;
        $criteria->with = array('wordMeanings.idMeaning');
        $criteria->compare('id', $this->id);
        $criteria->compare('word', $this->word, true);
        $criteria->compare('alias',$this->alias,true);
        $criteria->compare('id_language',$this->id_language);
        //$criteria->compare('definitions.definition',$this->definition,true);
        $criteria->compare('idMeaning.meaning', $this->meaning, true);
        if($this->id_antonyms) {
            $sql = 'SELECT  id FROM word WHERE word LIKE  "%'.$this->id_antonyms.'%"';
            $antonyms =   Yii::app()->db->createCommand($sql)->queryAll();
            $result = array();
            foreach ($antonyms as $key => $meaning) {
                $result[]=$meaning['id'];
            }
            $criteria->addCondition("t.id_antonyms IN (".implode(',', ($result)? $result : array(0) ).")");

        }
       /* if($this->antonyms) {
            $sql = 'SELECT  wm.id FROM word_meanings wm JOIN  word w ON wm.id_word = w.id WHERE w.word LIKE  "%'.$this->antonyms.'%"';
            $antonyms =   Yii::app()->db->createCommand($sql)->queryAll();

            $result = array();
            foreach ($antonyms as $key => $meaning) {
                $result[]=$meaning['id'];
            }

            $sql2 = 'SELECT wm.id_word as id FROM  word_meanings wm JOIN antonyms a ON a.word_meanings_id1 = wm.id WHERE word_meanings_id2 IN('.implode(',', ($result)? $result : array(0) ).') ';
            $antonyms2 =   Yii::app()->db->createCommand($sql2)->queryAll();
            $result2 = array();
            foreach ($antonyms2 as $key => $meaning) {
                $result2[]=$meaning['id'];
            }

            $criteria->addCondition("t.id IN (".implode(',', ($result2)? $result2 : array(0) ).")");

        }*/
        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'sort' => array(
                'attributes' => array(
                    'meaning' => array(
                        'asc' => 'idMeaning.meaning',
                        'desc' => 'idMeaning.meaning DESC',
                    ),
                    '*',
                ),
            )
        ));
    }

    public function getMeaning($id) {
        $allMeaning = WordMeanings::model()->findAllByAttributes(array('id_word' => $id));
        $means = '';
        foreach ($allMeaning as $key => $meaning) {
            if ($key == 0) {
                $means.=" " . ucfirst($meaning['idMeaning']['meaning']);
            } else {
                $means.=" ," . ucfirst($meaning['idMeaning']['meaning']);
            }
        }
        return $means;
    }
    /*public function getAntonym($id) {
        $sql = 'SELECT word_meanings_id2,word_meanings_id1 FROM word_meanings wm JOIN antonyms a ON  wm.id = a.word_meanings_id1  WHERE wm.id_word ='.$id;
        $antonyms_id1 =   Yii::app()->db->createCommand($sql)->queryAll();
        $sql = 'SELECT word_meanings_id2,word_meanings_id1 FROM word_meanings wm JOIN antonyms a ON  wm.id = a.word_meanings_id2  WHERE wm.id_word ='.$id;
        $antonyms_id2=   Yii::app()->db->createCommand($sql)->queryAll();
        $antonyms_id = array_merge($antonyms_id1,$antonyms_id2);
        $means = '';
        if($antonyms_id !='' ){
            $result = array();
            foreach ($antonyms_id as $key => $item) {
                if(isset($item['word_meanings_id1']) &&  isset($item['word_meanings_id2'])){
                    $result[]=$item['word_meanings_id1'];
                    $result[]=$item['word_meanings_id2'];
                }
            }
            $sql2 = 'SELECT w.word,w.id FROM word w JOIN word_meanings wm ON w.id = wm.id_word WHERE wm.id IN( '.implode(',', ($result)? $result : array(0) ).')';
            $antonyms =   Yii::app()->db->createCommand($sql2)->queryAll();
            foreach ($antonyms as $key => $meaning) {
                if($meaning['id'] != $id){
                    $means.=" " . ucfirst($meaning['word']);
                }

            }
        }

        return $means;
    }*/
    public function getWordRelative( $checksearch, $keyword ){
        $sqlcount =  "SELECT COUNT(id) FROM ( ";
        if( $keyword == '' )
        {
           $sql = " SELECT id, word , alias, id_antonyms FROM word " ; 
        }
        else
        {
           $sql = " SELECT id, word, alias, id_antonyms FROM word WHERE word LIKE '%".$keyword."%' ";
        }
        $sqlcount .= $sql. ') as total';
          
        $dataProvider   =   new CSqlDataProvider( $sql, array(
            'totalItemCount'=>$sqlcount,
            'sort'=>array(
            'attributes'=>array(
                    'id', 'word', 'alias', 'id_antonyms'
                ),
            ),
            'pagination'=>array(
                'pageSize'=>10,
            ),
        ));
        
        return  $dataProvider;  

    }

    public function getAntonym($id) {
        $antonyms = self::model()->findByPk($id);
        return ucfirst($antonyms['word']);
    }

    /*public function getAntonymID($id){
        $sql = 'SELECT word_meanings_id2,word_meanings_id1 FROM word_meanings wm JOIN antonyms a ON  wm.id = a.word_meanings_id1  WHERE wm.id_word ='.$id;
        $antonyms_id1 =   Yii::app()->db->createCommand($sql)->queryAll();
        $sql = 'SELECT word_meanings_id2,word_meanings_id1 FROM word_meanings wm JOIN antonyms a ON  wm.id = a.word_meanings_id2  WHERE wm.id_word ='.$id;
        $antonyms_id2=   Yii::app()->db->createCommand($sql)->queryAll();
        $antonyms_id = array_merge($antonyms_id1,$antonyms_id2);
        $means = '';
        if($antonyms_id !='' ){
            $result = array();
            foreach ($antonyms_id as $key => $item) {
                if(isset($item['word_meanings_id1']) &&  isset($item['word_meanings_id2'])){
                    $result[]=$item['word_meanings_id1'];
                    $result[]=$item['word_meanings_id2'];
                }
            }
            $sql2 = 'SELECT w.word,w.id FROM word w JOIN word_meanings wm ON w.id = wm.id_word WHERE wm.id IN( '.implode(',', ($result)? $result : array(0) ).')';
            $antonyms =   Yii::app()->db->createCommand($sql2)->queryAll();
            foreach ($antonyms as $key => $meaning) {
                if($meaning['id'] != $id){
                    $means=$meaning['id'];
                }
            }
        }
        return $means;
    }*/

    public function getDefinition($id) {
        $allDefinition = Definition::model()->findAllByAttributes(array('id_word' => $id));
        $define = '';
        foreach ($allDefinition as $key => $definition) {
            if ($key == 0) {
                $define.=" " . ucfirst($definition['definition']);
            } else {
                $define.=" ,<br/>" . ucfirst($definition['definition']);
            }
        }
        return $define;
    }

    public function getListWordByAnpha( $word ){
         $tableWord = self::tableName();
         $sql = " SELECT id, word, alias, id_antonyms FROM ".$tableWord." WHERE word LIKE '".$word."%' ";
         return Yii::app()->db->createCommand($sql)->queryAll();
    }
    
    function languageButton($alias,$lang,$region){
        $model = self::model()->findByAttributes(array(
            'alias'=>$alias,
            'id_language' => $lang
        ));
        if ($model){
            return '<a href="'.Yii::app()->createUrl('admin/word/update', array('id' => $model->id)).'" class="tipb" data-original-title="'.Yii::t('global', 'Edit').'">
                <img src="/assets/images/update.png" />
            </a><a href="'.Yii::app()->createUrl('admin/word/view', array('id' => $model->id)).'" class="tipb" data-original-title="'.Yii::t('global', 'View').'">
                <img src="/assets/images/view.png" />
            </a>';
        }
        else{
            return '<a href="'.Yii::app()->createUrl('admin/word/create', array('languages'=> $region,'alias'=>$alias)).'" class="tipb" data-original-title="'.Yii::t('global', 'Add').'">
                <i class="icon-plus"></i>
            </a>';
        }
    }
    public function SeoUrlTitle( $value = _Space ){
        #---------------------------------a
        $value = str_replace("á", "a", $value);
        $value = str_replace("à", "a", $value);
        $value = str_replace("ả", "a", $value);
        $value = str_replace("ã", "a", $value);
        $value = str_replace("ạ", "a", $value);
        $value = str_replace("â", "a", $value);
        $value = str_replace("ă", "a", $value);
        #---------------------------------A
        $value = str_replace("Á", "a", $value);
        $value = str_replace("À", "a", $value);
        $value = str_replace("Ả", "a", $value);
        $value = str_replace("Ã", "a", $value);
        $value = str_replace("Ạ", "a", $value);
        $value = str_replace("Â", "a", $value);
        $value = str_replace("Ă", "a", $value);
        #---------------------------------a^
        $value = str_replace("ấ", "a", $value);
        $value = str_replace("ầ", "a", $value);
        $value = str_replace("ẩ", "a", $value);
        $value = str_replace("ẫ", "a", $value);
        $value = str_replace("ậ", "a", $value);
        #---------------------------------A^
        $value = str_replace("Ấ", "a", $value);
        $value = str_replace("Ầ", "a", $value);
        $value = str_replace("Ẩ", "a", $value);
        $value = str_replace("Ẫ", "a", $value);
        $value = str_replace("Ậ", "a", $value);
        #---------------------------------a(
        $value = str_replace("ắ", "a", $value);
        $value = str_replace("ằ", "a", $value);
        $value = str_replace("ẳ", "a", $value);
        $value = str_replace("ẵ", "a", $value);
        $value = str_replace("ặ", "a", $value);
        #---------------------------------A(
        $value = str_replace("Ắ", "a", $value);
        $value = str_replace("Ằ", "a", $value);
        $value = str_replace("Ẳ", "a", $value);
        $value = str_replace("Ẵ", "a", $value);
        $value = str_replace("Ặ", "a", $value);
        #---------------------------------e
        $value = str_replace("é", "e", $value);
        $value = str_replace("è", "e", $value);
        $value = str_replace("ẻ", "e", $value);
        $value = str_replace("ẽ", "e", $value);
        $value = str_replace("ẹ", "e", $value);
        $value = str_replace("ê", "e", $value);
        #---------------------------------E
        $value = str_replace("É", "e", $value);
        $value = str_replace("È", "e", $value);
        $value = str_replace("Ẻ", "e", $value);
        $value = str_replace("Ẽ", "e", $value);
        $value = str_replace("Ẹ", "e", $value);
        $value = str_replace("Ê", "e", $value);
        #---------------------------------e^
        $value = str_replace("ế", "e", $value);
        $value = str_replace("ề", "e", $value);
        $value = str_replace("ể", "e", $value);
        $value = str_replace("ễ", "e", $value);
        $value = str_replace("ệ", "e", $value);
        #---------------------------------E^
        $value = str_replace("Ế", "e", $value);
        $value = str_replace("Ề", "e", $value);
        $value = str_replace("Ể", "e", $value);
        $value = str_replace("Ễ", "e", $value);
        $value = str_replace("Ệ", "e", $value);
        #---------------------------------i
        $value = str_replace("í", "i", $value);
        $value = str_replace("ì", "i", $value);
        $value = str_replace("ỉ", "i", $value);
        $value = str_replace("ĩ", "i", $value);
        $value = str_replace("ị", "i", $value);
        #---------------------------------I
        $value = str_replace("Í", "i", $value);
        $value = str_replace("Ì", "i", $value);
        $value = str_replace("Ỉ", "i", $value);
        $value = str_replace("Ĩ", "i", $value);
        $value = str_replace("Ị", "i", $value);
        #---------------------------------o^
        $value = str_replace("ố", "o", $value);
        $value = str_replace("ồ", "o", $value);
        $value = str_replace("ổ", "o", $value);
        $value = str_replace("ỗ", "o", $value);
        $value = str_replace("ộ", "o", $value);
        #---------------------------------O^
        $value = str_replace("Ố", "o", $value);
        $value = str_replace("Ồ", "o", $value);
        $value = str_replace("Ổ", "o", $value);
        $value = str_replace("Ô", "o", $value);
        $value = str_replace("Ộ", "o", $value);
        #---------------------------------o*
        $value = str_replace("ớ", "o", $value);
        $value = str_replace("ờ", "o", $value);
        $value = str_replace("ở", "o", $value);
        $value = str_replace("ỡ", "o", $value);
        $value = str_replace("ợ", "o", $value);
        #---------------------------------O*
        $value = str_replace("Ớ", "o", $value);
        $value = str_replace("Ờ", "o", $value);
        $value = str_replace("Ở", "o", $value);
        $value = str_replace("Ỡ", "o", $value);
        $value = str_replace("Ợ", "o", $value);
        #---------------------------------u*
        $value = str_replace("ứ", "u", $value);
        $value = str_replace("ừ", "u", $value);
        $value = str_replace("ử", "u", $value);
        $value = str_replace("ữ", "u", $value);
        $value = str_replace("ự", "u", $value);
        #---------------------------------U*
        $value = str_replace("Ứ", "u", $value);
        $value = str_replace("Ừ", "u", $value);
        $value = str_replace("Ử", "u", $value);
        $value = str_replace("Ữ", "u", $value);
        $value = str_replace("Ự", "u", $value);
        #---------------------------------y
        $value = str_replace("ý", "y", $value);
        $value = str_replace("ỳ", "y", $value);
        $value = str_replace("ỷ", "y", $value);
        $value = str_replace("ỹ", "y", $value);
        $value = str_replace("ỵ", "y", $value);
        #---------------------------------Y
        $value = str_replace("Ý", "y", $value);
        $value = str_replace("Ỳ", "y", $value);
        $value = str_replace("Ỷ", "y", $value);
        $value = str_replace("Ỹ", "y", $value);
        $value = str_replace("Ỵ", "y", $value);
        #---------------------------------DD
        $value = str_replace("Đ", "d", $value);
        $value = str_replace("Đ", "d", $value);
        $value = str_replace("đ", "d", $value);
        #---------------------------------o
        $value = str_replace("ó", "o", $value);
        $value = str_replace("ò", "o", $value);
        $value = str_replace("ỏ", "o", $value);
        $value = str_replace("õ", "o", $value);
        $value = str_replace("ọ", "o", $value);
        $value = str_replace("ô", "o", $value);
        $value = str_replace("ơ", "o", $value);
        #---------------------------------O
        $value = str_replace("Ó", "o", $value);
        $value = str_replace("Ò", "o", $value);
        $value = str_replace("Ỏ", "o", $value);
        $value = str_replace("Õ", "o", $value);
        $value = str_replace("Ọ", "o", $value);
        $value = str_replace("Ô", "o", $value);
        $value = str_replace("Ơ", "o", $value);
        #---------------------------------u
        $value = str_replace("ú", "u", $value);
        $value = str_replace("ù", "u", $value);
        $value = str_replace("ủ", "u", $value);
        $value = str_replace("ũ", "u", $value);
        $value = str_replace("ụ", "u", $value);
        $value = str_replace("ư", "u", $value);
        #---------------------------------U
        $value = str_replace("Ú", "u", $value);
        $value = str_replace("Ù", "u", $value);
        $value = str_replace("Ủ", "u", $value);
        $value = str_replace("Ũ", "u", $value);
        $value = str_replace("Ụ", "u", $value);
        $value = str_replace("Ư", "u", $value);
        $value = str_replace("Ñ", "Nn", $value);

        #---------------------------------
        $value = str_replace("%"," ", $value);
        $value = str_replace("#"," ", $value);
        $value = str_replace("."," ", $value);
        $value = str_replace(","," ", $value);
        $value = str_replace("!"," ", $value);
        $value = str_replace("?"," ", $value);
        $value = str_replace(":", " ", $value);
        $value = str_replace("'", " ", $value);
        $value = str_replace("&#039;", " ", $value);
        $value = str_replace("&quot;", " ", $value);
        $value = str_replace("&amp;","va", $value);
        $value = str_replace("(", " ", $value);
        $value = str_replace(")", " ", $value);
        $value = str_replace("-", " ", $value);
        $value = str_replace("   ", " ", $value);
        $value = str_replace("  ", " ", $value);
        $value = str_replace("/", " ", $value);
        return str_replace(" ","-",trim($value));
    }

}