<?php

class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex() {
		$model = new JohariModel;
		
		if (!empty($_POST['voter']) && !empty($_POST['features'])) {
			if (empty($_POST['name']) && $model->nameExists($_POST['voter'])) {
				$json['error'] = 'This name is already in database, try another';
			} else {
				$model->saveResults($_POST);
				$json['success'] = true;
			}
			die(json_encode($json));
		}
		
		if (isset($_GET['name'])) {
			$name = $_GET['name'];
		} elseif (isset($_GET['view'])) {
			$name = $_GET['view'];
		}
		
		if (empty($name)) {
			$title = $tpl['name'] = '';
		} else {
			$title = $name . '\'s ';
			$tpl['name'] = $name;
		}
		
		$tpl['base'] = Yii::app()->request->baseUrl;
		
		$title .= 'Johari Window';
		
		$this->pageTitle = $tpl['h1'] = $title;
		
		if (!empty($_GET['view'])) {
			$exclude = $known_self = $known_others = array();
			
			foreach ($model->getResults($_GET['view']) as $result) {
				if ($result['name'] === $result['voter']) {
					$known_self[] = $result['feature'];
				} else {
					$known_others[] = $result['feature'];
				}
				
				$exclude[] = $result['feature_id'];
			}
			
			$known_self = array_unique($known_self);
			$known_others = array_unique($known_others);
			
			$table['arena'] = array_intersect($known_self, $known_others);
			$table['blind_spot'] = array_diff($known_others, $known_self);
			$table['facade'] = array_diff($known_self, $known_others);
			$table['unknown'] = array();
			
			foreach ($model->getUnknown(implode(',', array_unique($exclude))) as $unknown) {
				$table['unknown'][] = $unknown['feature'];
			}
			
			foreach ($table as $key => $values) {
				$tpl[$key] = implode(', ', $values);
			}
			
			$this->render('view', $tpl);
			die;
		}
		
		$tpl['features'] = $model->getFeatures();
		
		$this->render('index', $tpl);
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-type: text/plain; charset=UTF-8";

				mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
}