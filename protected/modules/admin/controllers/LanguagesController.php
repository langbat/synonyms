<?php

class LanguagesController extends AdminBaseController {
    const PAGE_SIZE = 10;
    const PAGE_SIZE_LARGE = 20;
    public function init()
	{
		parent::init();
		
		$this->breadcrumbs[ Yii::t('global', 'Languages') ] = array('languages/index');
		$this->pageTitle[] = Yii::t('global', 'Languages');
	}
    
	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Languages;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Languages']))
		{
			$model->attributes=$_POST['Languages'];
            $uploadedFile=CUploadedFile::getInstance($model,'icon');
            if(!empty($uploadedFile)) {
                $rnd = rand(0,9999);
                $fileName = "{$rnd}-{$uploadedFile}";  // random number + file name
                $model->icon = $fileName;
            }
            else{
                $fileName = '';
            }
			if($model->save()) {
                if(!empty($uploadedFile)) {
                    $uploadedFile->saveAs(Yii::app()->basePath.'/../uploads/flag/'.$fileName);
                }
                $this->redirect(array('view','id'=>$model->id));
            }

		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Languages']))
		{
            $icon  = $model->icon;
			$model->attributes=$_POST['Languages'];
            if($_POST['Languages']['icon'] =='')
                $model->icon = $icon;
            $uploadedFile=CUploadedFile::getInstance($model,'icon');
            if(!empty($uploadedFile)) {
                $rnd = rand(0,9999);
                $fileName = "{$rnd}-{$uploadedFile}";  // random number + file name
                $model->icon = $fileName;
            }
            else{
                $fileName = '';
            }

			if($model->save()){
                if(!empty($uploadedFile)) {
                    $uploadedFile->saveAs(Yii::app()->basePath.'/../uploads/flag/'.$fileName);
                }
                $this->redirect(array('view','id'=>$model->id));
            }

		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

    function actionDeleteString(){
        $message = Message::model()->deleteAll('id = '.$_GET['id']);

        $message = SourceMessage::model()->findByPk($_GET['id']);
        if ($message) $message->delete();
    }



	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$model=new Languages('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Languages']))
			$model->attributes=$_GET['Languages'];

		$this->render('index',array(
			'model'=>$model,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$dataProvider=new CActiveDataProvider('Languages');
		$this->render('admin',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Languages::model()->findByPk((int)$id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='languages-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

    public function actionSetting() {

        // Perms
        if( !Yii::app()->user->checkAccess('op_lang_translate') )
        {
            throw new CHttpException(403, Yii::t('error', 'Sorry, You don\'t have the required permissions to enter this section'));
        }

        $totalStringsInSource = SourceMessage::model()->count();

        $this->render('setting', array( 'totalStringsInSource' => $totalStringsInSource ));
    }

    public function actiontranslateneeded()
    {
        // Perms
        if( !Yii::app()->user->checkAccess('op_lang_translate') )
        {
            throw new CHttpException(403, Yii::t('error', 'Sorry, You don\'t have the required permissions to enter this section'));
        }

        $id = Yii::app()->request->getParam('id', 0);

        // Check if it exists
        $allLang = Languages::model()->findAll();
        if( !in_array($id, array_keys($allLang)) )
        {
            Yii::app()->user->setFlash('error', Yii::t('adminlang', 'That language is not supported.'));
            $this->redirect(array('setting'));
        }

        // Did we submit?
        if( isset($_POST['submit']) && $_POST['submit'] )
        {
            // Update the strings
            if( isset($_POST['strings']) && count($_POST['strings']) )
            {
                foreach( $_POST['strings'] as $stringid => $stringvalue )
                {
                    // Update each one
                    Message::model()->updateAll(array('translation'=>$stringvalue), 'language=:lang AND id=:id', array(':id' => $stringid, ':lang'=>$id));
                }

                Yii::app()->user->setFlash('success', Yii::t('adminlang', 'Strings Updated.'));

            }
        }

        $ids = $this->getStringNotTranslated( $id );

        // Grab the language data
        $criteria = new CDbCriteria;
        $criteria->condition = "language='$id' AND id IN (".implode(',', $ids).")";
        if (isset($_GET['translation'])){
            $criteria->addCondition("translation LIKE '%".$_GET['translation']."%'");
            $count = Message::model()->count("language='$id' AND id IN (".implode(',', $ids).") AND translation LIKE '%".$_GET['translation']."%'");
        }
        else{
            $count = Message::model()->count("language='$id' AND id IN (".implode(',', $ids).")");
        }
        $criteria->params = array(":lang"=>$id, ':ids' => implode(',', $ids));


        $pages = new CPagination($count);
        $pages->pageSize = self::PAGE_SIZE_LARGE;

        $pages->applyLimit($criteria);

        $sort = new CSort('Message');
        $sort->defaultOrder = 'id ASC';
        $sort->applyOrder($criteria);

        $sort->attributes = array(
            'id'=>'id',
            'translation'=>'translation',
        );

        $strings = Message::model()->findAll($criteria);

        $this->breadcrumbs[ Yii::t('adminlang', 'Translate') ] = array('languages/translate');
        $this->pageTitle[] = Yii::t('adminlang', 'Translate');

        $this->render('strings', array( 'strings'=>$strings, 'count'=>$count, 'pages'=>$pages, 'sort'=>$sort ));
    }

    /**
     *
     */
    public function actiontranslate()
    {
        // Perms
        if( !Yii::app()->user->checkAccess('op_lang_translate') )
        {
            throw new CHttpException(403, Yii::t('error', 'Sorry, You don\'t have the required permissions to enter this section'));
        }

        $id = Yii::app()->request->getParam('id', 0);

        // Check if it exists
        $allLang = Languages::model()->findAll();
        if( !in_array($id, array_keys($allLang)) )
        {
            Yii::app()->user->setFlash('error', Yii::t('adminlang', 'That language is not supported.'));
            $this->redirect(array('setting'));
        }

        // Did we submit?
        if( isset($_POST['submit']) && $_POST['submit'] )
        {
            // Update the strings
            if( isset($_POST['strings']) && count($_POST['strings']) )
            {
                foreach( $_POST['strings'] as $stringid => $stringvalue )
                {
                    // Update each one
                    Message::model()->updateAll(array('translation'=>$stringvalue), 'language=:lang AND id=:id', array(':id' => $stringid, ':lang'=>$id));
                }

                Yii::app()->user->setFlash('success', Yii::t('adminlang', 'Strings Updated.'));

            }
        }

        // Grab the language data
        $criteria = new CDbCriteria;
        $criteria->condition = 'language=:lang';
        $criteria->params = array(":lang"=>$id);

        if (isset($_GET['translation'])){
            if (isset($_GET['source'])){
                $ids = $this->getSourceIdsFilter();
                $criteria->addCondition("translation LIKE '%".$_GET['translation']."%' AND id IN (".implode(',', $ids).")");
                $count = Message::model()->count("language='$id' AND id IN (".implode(',', $ids).") AND translation LIKE '%".$_GET['translation']."%'");
            }
            else{
                $criteria->addCondition("translation LIKE '%".$_GET['translation']."%'");
                $count = Message::model()->count("language='$id' AND translation LIKE '%".$_GET['translation']."%'");
            }

        }
        else{
            if (isset($_GET['source'])){
                $ids = $this->getSourceIdsFilter();
                $criteria->addCondition("id IN (".implode(',', $ids).")");
                $count = Message::model()->count("language='$id' AND id IN (".implode(',', $ids).")");
            }
            else{
                $count = Message::model()->count('language=:lang', array( ':lang' => $id ));
            }


        }


        $pages = new CPagination($count);
        $pages->pageSize = self::PAGE_SIZE;

        $pages->applyLimit($criteria);

        $sort = new CSort('Message');
        $sort->defaultOrder = 'id ASC';
        $sort->applyOrder($criteria);

        $sort->attributes = array(
            'id'=>'id',
            'translation'=>'translation',
        );

        $strings = Message::model()->findAll($criteria);

        $this->breadcrumbs[ Yii::t('adminlang', 'Translate') ] = array('languages/translate');
        $this->pageTitle[] = Yii::t('adminlang', 'Translate');

        $this->render('strings', array( 'strings'=>$strings, 'count'=>$count, 'pages'=>$pages, 'sort'=>$sort ));
    }

    /**
     * Revert a string to it's original form
     */
    public function actionrevert()
    {
        // Perms
        if( !Yii::app()->user->checkAccess('op_lang_translate') )
        {
            throw new CHttpException(403, Yii::t('error', 'Sorry, You don\'t have the required permissions to enter this section'));
        }

        $id = Yii::app()->request->getParam('id', 0);
        $string = Yii::app()->request->getParam('string', 0);

        // Check if it exists
        $allLang = Languages::model()->findAll();
        if( !in_array($id, array_keys($allLang)) )
        {
            Yii::app()->user->setFlash('error', Yii::t('adminlang', 'That language is not supported.'));
            $this->redirect(array('setting'));
        }

        // Grab the string and source
        $source = SourceMessage::model()->findByPk($string);
        $stringdata = Message::model()->find('language=:lang AND id=:id', array( ':id' => $string,  ':lang'=>$id));

        if( ( !$source || !$stringdata ) )
        {
            Yii::app()->user->setFlash('error', Yii::t('adminlang', 'That language string was not found.'));
            $this->redirect(array('setting'));
        }

        // Update the stringdata based on the soruce
        Message::model()->updateAll(array('translation'=>$source->message), 'language=:lang AND id=:id', array( ':id' => $string,  ':lang'=>$id));

        Yii::app()->user->setFlash('success', Yii::t('adminlang', 'String Reverted.'));
        $this->redirect(array('languages/translate', 'id'=>$id));
    }

    /**
     * Copy missing language strings from source into this language
     */
    public function actioncopystrings()
    {
        // Perms
        if( !Yii::app()->user->checkAccess('op_lang_copy_strings') )
        {
            throw new CHttpException(403, Yii::t('error', 'Sorry, You don\'t have the required permissions to enter this section'));
        }

        $id = Yii::app()->request->getParam('id', 0);
        // Check if it exists
        $allLang = Languages::model()->findAll();

        if( !in_array($id, array_keys($allLang)) )//Yii::app()->params['languages']
        {
            Yii::app()->user->setFlash('error', Yii::t('adminlang', 'That language is not supported.'));
            $this->redirect(array('setting'));
        }

        // Grab all soruce language strings
        $sourcestrings = SourceMessage::model()->findAll();

        $totaladded = 0;

        if( $sourcestrings )
        {
            foreach( $sourcestrings as $string )
            {
                // Do we have it already?
                if( !Message::model()->exists('language=:lang AND id=:id', array( ':lang' => $id, ':id' => $string->id )) )
                {
                    // Doesn't then add it
                    $newstring = new Message;
                    $newstring->id = $string->id;
                    $newstring->language = $id;
                    $newstring->translation = $string->message;
                    $newstring->save();
                    $totaladded++;
                }
            }
        }

        // Done
        Yii::app()->user->setFlash('success', Yii::t('adminlang', 'Copy completed! Total of {number} missing strings copied.', array('{number}'=>$totaladded)));
        $this->redirect(array('setting'));
    }

    /**
     * Get ids of translation that were not translated
     */
    public function getStringNotTranslated( $language )
    {
        if (isset($_GET['source'])){
            $origs = SourceMessage::model()->findAll("message LIKE '%".$_GET['source']."%'");
        }
        else{
            $origs = SourceMessage::model()->findAll();
        }


        $translated = array(0);
        if( count( $origs ) )
        {
            foreach( $origs as $orig )
            {
                // Grab the translation from the messages table
                $message = Message::model()->find('language=:lang AND id=:id', array( ':lang' => $language, ':id' => $orig->id ));
                if( $message )
                {
                    if( $message->translation == '' || $message->translation == $orig->message )
                    {
                        $translated[] = $message->id;
                    }
                }
            }
        }
        return $translated;
    }

    /**
     * Get number of strings that were already translated
     */
    public function getStringTranslationDifference( $language )
    {
        $origs = SourceMessage::model()->findAll();
        $translated = 0;
        if( count( $origs ) )
        {
            foreach( $origs as $orig )
            {
                // Grab the translation from the messages table
                $message = Message::model()->find('language=:lang AND id=:id', array( ':lang' => $language, ':id' => $orig->id ));
                if( $message )
                {
                    if( $message->translation != $orig->message )
                    {
                        $translated++;
                    }
                }
            }
        }
        return $translated;
    }

    function getSourceIdsFilter(){
        if (isset($_GET['source'])){
            $origs = SourceMessage::model()->findAll("message LIKE '%".$_GET['source']."%'");
        }
        else{
            $origs = SourceMessage::model()->findAll();
        }
        $ids = array(0);
        foreach( $origs as $orig ){
            $ids[] = $orig->id;
        }
        return $ids;
    }

    function actionDeleteSetting(){
        $message = Message::model()->deleteAll('id = '.$_GET['id']);

        $message = SourceMessage::model()->findByPk($_GET['id']);
        if ($message) $message->delete();
    }
}
