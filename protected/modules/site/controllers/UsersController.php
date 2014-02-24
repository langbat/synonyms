<?php

/**
 * User controller Home page
 */
class UsersController extends SiteBaseController {

    const PAGE_SIZE = 50;

    /**
     * Controller constructor
     */
    public function init() {
        parent::init();
    }

    /**
     * List of available actions
     */
    public function actions() {
        return array(
            'captcha' => array(
                'class' => 'CCaptchaAction',
                'backColor' => 0xFFFFFF,
                'minLength' => 3,
                'maxLength' => 7,
                'testLimit' => 3,
                'padding' => array_rand(range(2, 10)),
            ),
        );
    }

    /**
     * Show all users
     */

    /**
     * Logout action
     */
    public function actionlogout() {
        // Guests are not allowed
        if (Yii::app()->user->isGuest) {
            $this->redirect(Yii::app()->homeUrl);
        }
        $session_id = session_id();

        Yii::app()->user->logout(true);
        Yii::app()->user->setFlash('success', Yii::t('global', 'You are now logged out.'));
        $this->redirect(Yii::app()->homeUrl);
    }

    /**
     * Admin Login action
     */
    public function actionadmin() {
        if (Yii::app()->user->role == 'admin')
            $this->redirect('/admin');
        $model = new LoginForm;

        if (isset($_POST['LoginForm'])) {
            $model->attributes = $_POST['LoginForm'];
            if ($model->validate()) {
                // Login
                $identity = new InternalIdentity($model->email, $model->password);
                if ($identity->authenticate()) {
                    // Member authenticated, Login
                    Yii::app()->user->setFlash('success', Yii::t('login', 'Thanks. You are now logged in.'));
                    Yii::app()->user->login($identity, (Yii::app()->params['loggedInDays'] * 60 * 60 * 24));
                } else {
                    Yii::app()->user->setFlash('error', $identity->errorMessage);
                }

                // Redirect
                if (Yii::app()->user->role == 'admin')
                    $this->redirect('/admin');
                else
                    $this->redirect(Yii::app()->homeUrl);
            }
        }

        // Add page breadcrumb and title
        $this->pageTitle[] = Yii::t('global', 'Login');
        // $this->breadcrumbs[ Yii::t('global', 'Login') ] = '';

        $this->renderPartial('admin', array('model' => $model));
    }

}