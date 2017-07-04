<?php

return [
    [
        'username' => $faker->userName,
        'auth_key' => Yii::$app->getSecurity()->generateRandomString(),
        'password_hash' => Yii::$app->getSecurity()->generatePasswordHash('password_' . $index),
        'created_at' => $faker->time(),
        'updated_at' => $faker->time(),
        'email' => $faker->email,
    ],
];
