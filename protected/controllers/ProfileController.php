<?php

class ProfileController extends Controller
{
    /**
     * @return array action filters
     */
    public function filters()
    {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }
        
    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules()
    {
    return array(
        array('allow',  // allow all users to perform 'index' and 'view' actions
            'actions' => array('index','view'),
            'users' => array('@'),
        ),
        array('allow', // allow admin user to perform actions
            'controllers' => array('profile'),
            'actions' => array('create', 'update', 'delete', 'sendSignUpEmail'),
            'expression' => '$user->isAdmin'
        ),
        array('deny',  // deny all users
            'users' => array('*'),
        ),
    );
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id)
    {
        $this->render('view',array(
            'model' => $this->loadModel($id),
        ));
    }

    /**
     * Lists all models.
     */
    public function actionIndex()
    {
        $criteria = new CDbCriteria();
        $count = Profile::model()->count($criteria);
        $pages = new CPagination($count);
        $pages->pageSize=10;
        $pages->applyLimit($criteria);
        $profiles = Profile::model()->findAll($criteria);
        $this->render('index',array(
                'profiles' => $profiles,
                'pages' => $pages,
                'colunms' => 2,
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate()
    {
        $model = new Profile;
        if(isset($_POST['Profile']))
        {
            $model->attributes = $_POST['Profile'];
            $rnd = rand(0,9999);  // generate random number between 0-9999
            $uploadedFile = CUploadedFile::getInstance($model,'image');
            $fileName = "{$rnd}-{$uploadedFile}";  // random number + file name
            $model->image = $fileName;
            if($model->save()){
                if (!empty($uploadedFile)){
                    $uploadedFile->saveAs(Yii::app()->basePath.'/../images/'.$fileName); // image will upload to rootDirectory/images/
                }
                $this->redirect(array('view','id' => $model->id));
            }
        }
        $this->render('create',array(
            'model' => $model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);
        if(isset($_POST['Profile']))
        {
            $rnd = rand(0,9999);
            $model->attributes = $_POST['Profile'];
            $uploadedFile = CUploadedFile::getInstance($model,'image');
            $model->image = "{$rnd}-{$uploadedFile}";
            if($model->save()){
                if (!empty($uploadedFile)){
                $uploadedFile->saveAs(Yii::app()->basePath.'/../images/'.$model->image);
                }
                $this->redirect(array('view','id' => $model->id));
            }
        }
        $this->render('update',array(
            'model' => $model,
        ));
    }

    public function actionDelete($id)
    {
        $this->loadModel($id)->delete();
        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if(!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Profile the loaded model
     * @throws CHttpException
     */
    public function loadModel($id)
    {
        $model = Profile::model()->findByPk($id);
        if($model === null)
            throw new CHttpException(404,'The requested page does not exist.');
        return $model;
    }

    public function actionSendSignUpEmail($id) {
        $profile = Profile::model()->findByPk($id);
        if ($profile != null && $profile->sendSignUpEmail()) {
            Yii::app()->user->setFlash('sucessful', 'Sign up email has been sent to '.$profile->email);
        }
        $this->redirect(array('profile/index'));
    }
}
