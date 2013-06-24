<?php

class HomeController extends Controller
{
	public function actionIndex()
	{

            if (!Yii::app()->user->isAdmin){
                $timestamp = time();
                $user = User::model()->findByPk(Yii::app()->user->getId());
                $requests = $user->getCurrentRequests();
                $devices = Device::model()->newest()->findAll();
                $this->render('index',array(
                    'devices' => $devices, 'requests' => $requests, 'timestamp' => $timestamp
                ));
            } else {
                $timestamp = time();
                $criteria = new CDbCriteria;
                $criteria->order = 'id DESC';
                $all_requests = Request::model()->findAll($criteria);
                $new_requests = array();
                $unexpired_requests = array();
                $expired_requests = array();
                
                foreach ($all_requests as $request) {
                    if ($request->status == 0) {
                        array_push($new_requests, $request);
                    } elseif ($request->status == 1) {
                        if ($request->request_end_time === null) {
                            array_push($unexpired_requests, $request);
                        } else {
                            if (DateAndTime::getIntervalDays($request->request_end_time, $timestamp) < 0) {
                                array_push($expired_requests, $request);
                            } else {
                                array_push($unexpired_requests, $request);
                            }
                        }
                    }
                }

                $this->render('admin_page', 
                    array('new_requests' => $new_requests, 
                        'unexpired_requests' => $unexpired_requests,
                        'expired_requests' => $expired_requests,
                        'timestamp' => $timestamp)
                    );
            }
	}
        
        // Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}
?>
