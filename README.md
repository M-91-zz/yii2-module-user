# Configure [DbManager](https://www.yiiframework.com/doc/guide/2.0/en/security-authorization#using-db-manager)

Add `authManager` component:
```
return [
    // ...
    'components' => [
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
            // uncomment if you want to cache RBAC items hierarchy
            // 'cache' => 'cache',
        ],
        // ...
    ],
];
```
Run migrations
```
yii migrate --migrationPath=@yii/rbac/migrations
```

# User identity
Define `User` identity
```
// ...
'user' => [
    'identityClass' => 'M91\UserModule\models\User',
    'enableAutoLogin' => true,
],
// ...
```

# User Module
```
'modules' => [
    'user-module' => [
        'class' => 'M91\UserModule\Module',
    ]
]
```