<?php
namespace app\widgets;

use Yii;

/**
 * Alert widget renders a message from session flash. All flash messages are displayed
 * in the sequence they were assigned using setFlash. You can set message as following:
 *
 * ```php
 * Yii::$app->session->setFlash('error', 'This is the message');
 * Yii::$app->session->setFlash('success', 'This is the message');
 * Yii::$app->session->setFlash('info', 'This is the message');
 * ```
 *
 * Multiple messages could be set as follows:
 *
 * ```php
 * Yii::$app->session->setFlash('error', ['Error 1', 'Error 2']);
 * ```
 *
 * @author Kartik Visweswaran <kartikv2@gmail.com>
 * @author Alexander Makarov <sam@rmcreative.ru>
 */
class Alert extends \yii\bootstrap\Widget
{
    /**
     * @var array the alert types configuration for the flash messages.
     * This array is setup as $key => $value, where:
     * - key: the name of the session flash variable
     * - value: the bootstrap alert type (i.e. danger, success, info, warning)
     */
    public $alertTypes = [
        'error'   => 'alert-danger',
        'danger'  => 'alert-danger',
        'success' => 'alert-success',
        'info'    => 'alert-info',
        'warning' => 'alert-warning'
    ];
    public $logoFlash =['error'=>"<h4><span class='glyphicon glyphicon-exclamation-sign'></span> <b>Error!</h4></b><hr>",
                        'danger'=>"<h4><span class='glyphicon glyphicon-alert'></span> <b>Notification!</b></h4><hr>",
                        'success'=>"<h4><span class='glyphicon glyphicon-ok-sign'></span> <b>Success!</h4></b><hr>",
                        'info'=>"<h4><span class='glyphicon glyphicon-info-sign'></span> <b>Info!</h4></b><hr>",
                        'warning'=>"<h4><span class='glyphicon glyphicon-warning-sign'></span> <b>Warning!</h4></b><hr>"
                        ];

    /**
     * @var array the options for rendering the close button tag.
     * Array will be passed to [[\yii\bootstrap\Alert::closeButton]].
     */
    public $closeButton = ['error'=>['id'=>'closed-flash-error'],
                           'danger'=>['id'=>'closed-flash-danger'],
                           'success'=>['id'=>'closed-flash-success'],
                           'info'=>['id'=>'closed-flash-info'],
                           'warning'=>['id'=>'closed-flash-warning']
                        ];
    
    /**
     * {@inheritdoc}
     */
    public function run()
    {
        $session = Yii::$app->session;
        $flashes = $session->getAllFlashes();
        $appendClass = isset($this->options['class']) ? ' ' . $this->options['class'] : '';

        foreach ($flashes as $type => $flash) {
            if (!isset($this->alertTypes[$type])) {
                continue;
            }

            foreach ((array) $flash as $i => $message) {
                echo \yii\bootstrap\Alert::widget([
                    'body' => $this->logoFlash[$type].$message,
                    'closeButton' => $this->closeButton[$type],
                    'options' => array_merge($this->options, [
                        'id' => $this->getId() . '-' . $type . '-' . $i,
                        'class' => $this->alertTypes[$type] . $appendClass,
                    ]),
                ]);
            }

            $session->removeFlash($type);
        }
    }
}
