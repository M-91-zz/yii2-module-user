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
        $this->registerTranslations();
    }

    public function registerTranslations()
    {
        Yii::$app->i18n->translations['id5/rbac/*'] = [
            'class' => 'yii\i18n\PhpMessageSource',
            'sourceLanguage' => 'pt-br',
            'basePath' => '@vendor/id5/yii2-rbac/src/messages',
            'fileMap' => [
                'app' => 'app.php',
            ],
        ];
    }

    public static function t($category, $message, $params = [], $language = null)
    {
        return Yii::t('app', $message, $params, $language);
    }
}
