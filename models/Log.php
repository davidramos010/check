<?php

namespace app\models;

use Yii;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "log".
 *
 * @property int $id
 * @property int $conexion_id
 * @property int $user_id
 * @property string|null $peticion
 * @property string|null $respuesta
 * @property int $codigo
 * @property string $created_at
 *
 * @property Conexion $conexion
 * @property User $user
 */
class Log extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return 'log';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['conexion_id', 'user_id', 'codigo'], 'required'],
            [['conexion_id', 'user_id', 'codigo'], 'integer'],
            [['created_at'], 'safe'],
            [['peticion', 'respuesta'], 'string', 'max' => 500],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
            [['conexion_id'], 'exist', 'skipOnError' => true, 'targetClass' => Conexion::class, 'targetAttribute' => ['conexion_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'conexion_id' => 'conexion ID',
            'user_id' => 'User ID',
            'peticion' => 'Peticion',
            'respuesta' => 'Respuesta',
            'codigo' => 'Codigo',
            'created_at' => 'Created At',
        ];
    }

    /**
     * Gets query for [[conexion]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getConexion(): ActiveQuery
    {
        return $this->hasOne(Conexion::class, ['id' => 'conexion_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser(): ActiveQuery
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
}
