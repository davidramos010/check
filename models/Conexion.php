<?php

namespace app\models;

use Yii;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "conexion".
 *
 * @property int $id
 * @property string $nombre
 * @property string|null $detalle
 * @property int $user_id
 * @property int $tipo_id
 * @property string $host
 * @property string|null $user
 * @property string|null $password
 * @property string|null $db
 * @property string|null $attributes
 * @property int|null $estado 1:activo, 0:inactivo
 * @property string|null $created_at
 * @property string|null $updated_at
 *
 * @property Log[] $logs
 * @property Tipo $tipo
 * @property User $user0
 */
class Conexion extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return 'conexion';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['nombre', 'user_id', 'tipo_id', 'host'], 'required'],
            [['user_id', 'tipo_id', 'estado'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['nombre'], 'string', 'max' => 250],
            [['detalle'], 'string', 'max' => 500],
            [['host', 'user', 'password', 'db', 'attributes'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
            [['tipo_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tipo::class, 'targetAttribute' => ['tipo_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'nombre' => 'Nombre',
            'detalle' => 'Detalle',
            'user_id' => 'User ID',
            'tipo_id' => 'Tipo ID',
            'host' => 'Host',
            'user' => 'User',
            'password' => 'Password',
            'db' => 'Db',
            'attributes' => 'Attributes',
            'estado' => 'Estado',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[Logs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLogs(): ActiveQuery
    {
        return $this->hasMany(Log::class, ['conexion_id' => 'id']);
    }

    /**
     * Gets query for [[Tipo]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTipo(): ActiveQuery
    {
        return $this->hasOne(Tipo::class, ['id' => 'tipo_id']);
    }

    /**
     * Gets query for [[User0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser(): ActiveQuery
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
}
