<?php

class SiteController extends CController
{
    public function actionError()
    {
        if($error = Yii::app()->errorHandler->error)
        {
            if(Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->render('error', $error);
        }else{
            $this->render('error', 500);
        }
    }
}
