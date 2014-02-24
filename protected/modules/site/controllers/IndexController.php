<?php
/**
 * Index controller Home page
 */
class IndexController extends SiteBaseController {
	
	const PAGE_SIZE = 16;

	/**
	 * Controller constructor
	 */
    public function init()
    {
        parent::init();
    }
	
	/**
	 * List of available actions
	 */
	public function actions()
	{
	   return array(
	      'captcha' => array(
	         'class' => 'CCaptchaAction',
	         'backColor' => 0xFFFFFF,
		     'minLength' => 3,
		     'maxLength' => 7,
			 'testLimit' => 3,
			 'padding' => array_rand( range( 2, 10 ) ),
	      ),
	   );
	}
	
	/**
	 * Index action
	 */
    public function actionindex() {

		$this->pageTitle[] =  Yii::t('global','Sinónimo.com - Thesaurus in Spanish - Synonyms index title') ;//Tesauro en español
        Yii::app()->clientScript->registerMetaTag('Sinónimo.com - Thesaurus in Spanish Synonym definition antonym Suggest List of synonyms of', 'description');
        Yii::app()->clientScript->registerMetaTag('Sinónimo.com, hesaurus in Spanish, Synonym, definition, antonym, Suggest, List of synonyms of,best translate, translate', 'keywords');
        $this->render('index');
    }
    public function actionsinonimo() {
	    $sinonimo          = isset($_POST['sinonimo'])?$_POST['sinonimo']:'';
    	$checksearch       = isset($_POST['checksearch'])?$_POST['checksearch']:'';
        if($sinonimo ==''){
            $sinonimo = isset($_GET['sinonimo'])? $_GET['sinonimo']:'';
        }
        $this->pageTitle[] =  Yii::t('global','Sinónimo.com - Thesaurus in Spanish - Synonyms search title : ').$sinonimo ;
        Yii::app()->clientScript->registerMetaTag('Sinónimo.com - Thesaurus in Spanish - Synonyms search title '.$sinonimo, 'description');
        Yii::app()->clientScript->registerMetaTag('Synonyms, search, Sinónimo, '.$sinonimo, 'keywords');
        $meaningword       = WordMeanings::model()->getMeanByWork( $sinonimo );
		//echo '<pre>';
		//var_dump($meaningword);die;
		
        if( $checksearch   == 'on' ){
            $option        = 1;
            $wordRelative  = Word::model()->getWordRelative( $checksearch, $sinonimo );
            $this->render( 'sinonimo', compact( 'sinonimo', 'meaningword', 'wordRelative', 'checksearch', 'option' ) );
        }
        else{
            $option        = 0;
            $this->render( 'sinonimo', compact( 'sinonimo', 'meaningword', 'option' ) );
        }
	}
     public function actiondefinicion() {
        $definicion     = isset($_POST['definicion'])?$_POST['definicion']:'';
        $checksearch    = isset($_POST['checksearch'])?$_POST['checksearch']:'';
         if($definicion ==''){
             $definicion = isset($_GET['definicion'])? $_GET['definicion']:'';
         }
        $this->pageTitle[] =  Yii::t('global','Sinónimo.com - Thesaurus in Spanish - Definitios search title : ' ).$definicion ;
        Yii::app()->clientScript->registerMetaTag('Sinónimo.com - Thesaurus in Spanish - Definitios search title :'.$definicion, 'description');
        Yii::app()->clientScript->registerMetaTag('Synonyms, search, Definitios, '.$definicion, 'keywords');
        $definicionword = Definition::model()->getDefinitionByWork( $definicion );
         if( $checksearch   == 'on' ){
             $option        = 1;
             $wordRelative  = Word::model()->getWordRelative( $checksearch, $definicion );
             $this->render( 'definicion', compact( 'definicion', 'meaningword', 'wordRelative', 'checksearch', 'option' ) );
         }
         else{
             $option        = 0;
             $this->render('definicion', compact('definicion', 'definicionword', 'option' ) );
         }

     }
      public function actionantonimos() {
	    $antonimos = isset($_POST['antonimos'])?$_POST['antonimos']:'';
          if($antonimos ==''){
              $antonimos = isset($_GET['antonimos'])? $_GET['antonimos']:'';
          }
        $checksearch    = isset($_POST['checksearch'])?$_POST['checksearch']:'';
        $this->pageTitle[] =  Yii::t('global','Sinónimo.com - Thesaurus in Spanish - Antonyms search title : ' ).$antonimos ;
        Yii::app()->clientScript->registerMetaTag('Sinónimo.com - Thesaurus in Spanish - Antonyms search title :'.$antonimos, 'description');
        Yii::app()->clientScript->registerMetaTag('Synonyms, search, Antonyms, '.$antonimos, 'keywords');
        $antonimosword = Antonyms::model()->getAntonymsByWork( $antonimos );
          if( $checksearch   == 'on' ){
              $option        = 1;
              $wordRelative  = Word::model()->getWordRelative( $checksearch, $antonimos );
              $this->render( 'antonimos', compact( 'antonimos', 'antonimosword', 'wordRelative', 'checksearch', 'option' ) );
          }
          else{
              $option        = 0;
              $this->render('antonimos', compact('antonimos', 'antonimosword', 'option' ) );
          }

	 }
     public function actionsuggest(){
        $model = new UserFeedback();
         $type = $_GET['type'];
         $search = $_GET['search'];
         $searched = $_GET['searched'];
       	if( isset($_POST['SuggestForm']) )
		{
            $model->user_email = $_POST['SuggestForm']['email'];
            $model->user_search=$searched;
            $model->feedback_text = $_POST['SuggestForm']['suggest'];
            $model->id_search_type  = SearchType::model()->getSearch($search);
            $model->id_feedback_type = FeedbackType::model()->getType($type);
            $model->id_user_feedback_status =UserFeedbackStatus::model()->getStatus('Not Checked');
			if( $model->save() )
			{	
                // Redirect
                Yii::app()->user->setFlash('success', Yii::t('global', 'Thank you your suggest '));
                $this->redirect('/');
			}
		}
         if($type =='suggest'){
             $this->pageTitle[] =  Yii::t('global','Sinónimo.com - Thesaurus in Spanish - Suggest' );
         } else {
             $this->pageTitle[] =  Yii::t('global','Sinónimo.com - Thesaurus in Spanish - Report fail' );
         }

        Yii::app()->clientScript->registerMetaTag('Sinónimo.com - Thesaurus in Spanish - Suggest', 'description');
        Yii::app()->clientScript->registerMetaTag('Synonyms, search, Suggest', 'keywords');
        $this->renderPartial( 'suggest', array('model'=>$model,'type'=>$type,'search'=>$search,'searched'=>$searched) );
     }
     public function actionlistapalabras(){
        $optionlist = 1;
        $alpha = addslashes($_GET['id']);
        $this->pageTitle[] =  Yii::t('global','Sinónimo.com - Thesaurus in Spanish - List of synonyms of : ' ).$alpha ;
        Yii::app()->clientScript->registerMetaTag('Sinónimo.com - Thesaurus in Spanish - List of synonyms of :'.$alpha, 'description');
        Yii::app()->clientScript->registerMetaTag('Synonyms, search, List of synonyms of, '.$alpha, 'keywords');
        $wordAnpha = Word::model()->getListWordByAnpha( $alpha );
        $this->render( 'listapalabras', compact( 'wordAnpha', 'optionlist', 'alpha' ) );
     }
     public function actionListapalabrasIndex(){
        $this->pageTitle[] =  Yii::t('global','Sinónimo.com - Thesaurus in Spanish - Synonyms index title') ;//Tesauro en español
        Yii::app()->clientScript->registerMetaTag('Sinónimo.com - Thesaurus in Spanish Synonym definition antonym Suggest List of synonyms of', 'description');
        Yii::app()->clientScript->registerMetaTag('Sinónimo.com, hesaurus in Spanish, Synonym, definition, antonym, Suggest, List of synonyms of,best translate, translate', 'keywords');
        $this->render('listapalabras_index');
     }
     public function actionSaveSuggest(){
         $searched = $_GET['searched'];
         $search = $_GET['search'];
         $type = $_GET['type'];
         $email = $_GET['email'];
         $content = $_GET['content'];
         $model = new UserFeedback();
         $model->user_email = $email;
         $model->user_search=$searched;
         $model->feedback_text = $content;
         $model->id_search_type  = SearchType::model()->getSearch($search);
         $model->id_feedback_type = FeedbackType::model()->getType($type);
         $model->id_user_feedback_status =UserFeedbackStatus::model()->getStatus('Not Checked');
         if( $model->save() )
         {
             if($model->id_feedback_type ==1){
                 echo Yii::t('global', 'Thank you for your suggest ');
             } else {
                 echo Yii::t('global', 'Thank you your report a fail ');
             }

         }
     }

}