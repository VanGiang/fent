<?php

class AdminController extends Controller
{
    public function actionIndex()
    {
        $requests = Request::model()->findAll();
        $this->render('index', array(
            'requests' => $requests
        ));
    }
}
?>
