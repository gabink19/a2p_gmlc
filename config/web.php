<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';
$db2 = require __DIR__ . '/db2.php';


$config = [
    //'id' => 'basic',
    'id' => 'iCloudId',
    'name' => 'A2pGMLC',
    'homeUrl' => 'index.php?r=site/index',
    // 'getHomeUrl' => 'index.php?r=site/index',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'defaultRoute' => 'site/index',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',
    ],
    'modules' => [
        'gridview' => [
            'class' => '\kartik\grid\Module',
        ],
        'social' => [
            // the module class
            'class' => 'kartik\social\Module',

            // the global settings for the disqus widget
            'disqus' => [
                'settings' => ['shortname' => 'DISQUS_SHORTNAME'] // default settings
            ],

            // the global settings for the facebook plugins widget
            'facebook' => [
                'app_id' => 'FACEBOOK_APP_ID',
                'app_secret' => 'FACEBOOK_APP_SECRET',
            ],

            // the global settings for the google plugins widget
            'google' => [
                'clientId' => '731192615334-aqe8bkm08qca75una56ih0h8svo4beu4.apps.googleusercontent.com',
                'pageId' => 'GOOGLE_PLUS_PAGE_ID',
                'profileId' => 'GOOGLE_PLUS_PROFILE_ID',
            ],

            // the global settings for the google analytic plugin widget
            'googleAnalytics' => [
                'id' => 'TRACKING_ID',
                'domain' => 'TRACKING_DOMAIN',
            ],

            // the global settings for the twitter plugins widget
            'twitter' => [
                'screenName' => 'TWITTER_SCREEN_NAME'
            ],
        ],
    // your other modules
    ],
    'components' => [
        'authClientCollection' => [
            'class' => 'yii\authclient\Collection',
            'clients' => [
                'google' => [
                    'class' => 'yii\authclient\clients\Google',
                    'clientId' => '731192615334-aqe8bkm08qca75una56ih0h8svo4beu4.apps.googleusercontent.com',
                    'clientSecret' => 'G2W1hdkJ2Gqqb_KogqyTn-Vw'
                ]
                ]
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
        // uncomment if you want to cache RBAC items hierarchy
        // 'cache' => 'cache',
        ],
        'Common' => [
            'class' => 'app\components\Common'
        ],
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'F6LFk0Gmw7j7_wXa5UkvD6ArsLNTpI6-',
            'enableCsrfValidation' => false,
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => false,
            'transport' => [

            	'class' => 'Swift_SmtpTransport',

              	'host' =>  'smtp.gmail.com',//i.e the main  site on mine is mysite.org but the site that is sending emails is  mysite.com but it needs to be set to mail.mysite.org because that is the  main account on the shared hosting.

            	'username' => 'indocodetechnology',//NOT  an email account

            	'password' => 'vctdbiuwozrsarli',

            	'port' => '587',//need a port

            	'encryption' => 'tls',//must be lowercase for all encryption types or will throw cant find encryption type extension
                
                'streamOptions' => [ 
                        'ssl' => [ 
                            'allow_self_signed' => true,
                            'verify_peer' => false,
                            'verify_peer_name' => false,
                        ],
                    ]
        	],
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                    [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'formatter' => [
            'class' => 'yii\i18n\Formatter',
            'nullDisplay' => '',
        ],
        'db' => $db,
        'db2' => $db2,
    /*
      'urlManager' => [
      'enablePrettyUrl' => true,
      'showScriptName' => false,
      'rules' => [
      ],
      ], */
        
     
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    // $config['bootstrap'][] = 'debug';
    // $config['modules']['debug'] = [
    //     'class' => 'yii\debug\Module',
    //         // uncomment the following to add your IP if you are not connecting from localhost.
    //         'allowedIPs' => ['*'],
    // ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
        'allowedIPs' => ['*'],
        'generators' => [//here
            'crud' => [// generator name
                'class' => 'yii\gii\generators\crud\Generator', // generator class
                'templates' => [//setting for out templates
                    'DetailView' => '@app/myTemplates/crud/default', // template name => path to template
                //    'ActiveForm' => '@app/myTemplates/crud/activeform', // template name => path to template
                ]
            ],
            'model' => [// generator name
                'class' => 'yii\gii\generators\model\Generator', // generator class
                'templates' => [//setting for out templates
                    'myModel' => '@app/myTemplates/model/default', // template name => path to template
                ]
            ]
        ],
    ];
}


return $config;
