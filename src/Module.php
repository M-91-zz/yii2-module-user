<?php

namespace id5\rbac;

use Yii;

/**
 * rbac module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'id5\rbac\controllers';

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();
        $this->i18n();
    }

    public function i18n()
    {
        Yii::$app->i18n->translations['id5.rbac'] = [
            'class' => 'yii\i18n\PhpMessageSource',
            'sourceLanguage' => 'pt-br',
            'basePath' => '@vendor/id5/yii2-rbac/src/messages',
            'fileMap' => [
                'id5.rbac' => 'id5.rbac.php',
            ],
            
        ];
    }

    public static function t($category, $message, $params = [], $language = null)
    {
        return Yii::t('id5.rbac', $message, $params, $language);
    }
}
