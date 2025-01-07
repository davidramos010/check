<?php

namespace app\models;

use Yii;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "tipo".
 *
 * @property int $id
 * @property string $nombre
 * @property string|null $detalle
 * @property int|null $estado 1:activo,0:inactivo
 * @property string|null $created_at
 * @property string|null $updated_at
 *
 * @property Conexion[] $conexions
 */
class Tipo extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return 'tipo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['nombre'], 'required'],
            [['estado'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['nombre'], 'string', 'max' => 100],
            [['detalle'], 'string', 'max' => 255],
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
            'detalle' => 'Descripción',
            'estado' => 'Estado',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[Conexions]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getConexions(): ActiveQuery
    {
        return $this->hasMany(Conexion::class, ['tipo_id' => 'id']);
    }
}
