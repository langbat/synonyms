<?php

class WordController extends AdminBaseController {

    public function init() {
        parent::init();

        $this->breadcrumbs[Yii::t('global', 'Words')] = array('word/index');
        $this->pageTitle[] = Yii::t('global', 'Words');
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new Word;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Word'])) {
            $model->attributes = $_POST['Word'];
            $model->id_language = Languages::model()->getCurrentLanguage($_GET['languages']);
            $model->id_antonyms = $_POST['Word']['id_antonyms'];
            if ($model->save())
                if(isset($_GET['alias'])){
                    $model->alias = $_GET['alias'];
                } else{
                    $model->alias= $model->id;
                }
                $model->save();
                if($_POST['Word']['meaning'] !=''){
                    $meanings = explode('#',$_POST['Word']['meaning']);
                    Meaning::model()->saveMeanings($meanings,$model->id);
                }
                if($_POST['Word']['definition'] !=''){
                    $definitions = explode('#',$_POST['Word']['definition']);
                    Definition::model()->saveDefinition($definitions,$model->id);
                }
                if($_POST['Word']['id_antonyms'] !=''){

                    $antonyms = $this->loadModel($model->id_antonyms);
                    $antonyms->id_antonyms = $model->id;
                    $antonyms->save();
                }
                $this->redirect(array('view', 'id' => $model->id));
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Word'])) {

            $model->attributes = $_POST['Word'];
            $model->id_antonyms = $_POST['Word']['id_antonyms'];
            if ($model->save()){

                if($_POST['Word']['meaning'] !=''){
                    $meanings = explode('#',$_POST['Word']['meaning']);
                    Meaning::model()->updateMeaning($meanings,$model->id);
                }
                if($_POST['Word']['definition'] !=''){
                    $definitions = explode('#',$_POST['Word']['definition']);
                    Definition::model()->updateDefinition($definitions,$model->id);
                }
                if($_POST['Word']['id_antonyms'] !=''){

                    $antonyms = $this->loadModel($model->id_antonyms);
                    $antonyms->id_antonyms = $model->id;
                    $antonyms->save();
                }


                $this->redirect(array('view', 'id' => $model->id));
            }
        }
        $this->render('update', array(
            'model' => $model,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        if (Yii::app()->request->isPostRequest) {
            // we only allow deletion via POST request
            $this->loadModel($id)->delete();

            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if (!isset($_GET['ajax']))
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
        }
        else
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $model = new Word('search');
        $model->unsetAttributes();  // clear any default values

       $model->id_language = Languages::model()->getCurrentLanguage();
        if (isset($_GET['Word']))
            $model->attributes = $_GET['Word'];

        $this->render('index', array(
            'model' => $model,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $dataProvider = new CActiveDataProvider('Word');
        $this->render('admin', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id) {
        $model = Word::model()->findByPk((int) $id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'word-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
