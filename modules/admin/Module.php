<?php

namespace app\modules\admin;

class Module extends \yii\base\Module
{
    public $controllerNamespace = 'app\modules\admin\controllers';

    public function init()
    {
        parent::init();

        $this->setComponents([
	        'user' => [
	        	'class'=>'yii\web\User',
	            'identityClass' => 'app\modules\admin\models\User',
	            'enableAutoLogin' => true,
	            'identityCookie' => [
	                'name' => '_adminUser', // unique for frontend
	            ]
	        ],
	        'session' => [
	        	'class'=>'yii\web\Session',
	            'name' => 'PHPFRONTSESSID',
	            'savePath' => sys_get_temp_dir(),
	        ],
	        'request' => [
	        	'class'=>'yii\web\Request',
	            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
	            'cookieValidationKey' => '32r23r23r23r23r23r',
	            'csrfParam' => '_adminCSRF',
	        ]
	    ]);
    }
}
