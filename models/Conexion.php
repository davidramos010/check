<?php

namespace app\models;

use app\components\ServiceValidation;
use Yii;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

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

    const ID_CONEXION_HOST = 1;
    const ID_CONEXION_API = 2;
    const ID_CONEXION_DB = 3;
    const ID_CODE_OK = 200;
    const ID_CODE_KO = 400;
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
            [['bd', 'user', 'password'], 'required', 'when' => function($model) {
                return $model->tipo_id == self::ID_CONEXION_DB;
            }, 'whenClient' => "function (attribute, value) {
                return $('#conexion-tipo_id').val() == ".self::ID_CONEXION_DB.";
            }"],
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
            'user_id' => 'User ID',
            'tipo_id' => 'Tipo Conexión',
            'host' => 'Host',
            'user' => 'User',
            'password' => 'Password',
            'db' => 'Base de Datos',
            'attributes' => 'Atributos Adicionales',
            'estado' => 'Estado',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[Logs]].
     *
     * @return ActiveQuery
     */
    public function getLogs(): ActiveQuery
    {
        return $this->hasMany(Log::class, ['conexion_id' => 'id']);
    }

    /**
     * Gets query for [[Tipo]].
     *
     * @return ActiveQuery
     */
    public function getTipo(): ActiveQuery
    {
        return $this->hasOne(Tipo::class, ['id' => 'tipo_id']);
    }

    /**
     * Gets query for [[User0]].
     *
     * @return ActiveQuery
     */
    public function getUser(): ActiveQuery
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    public static function getTipoConexiones(): array
    {
        return ArrayHelper::map(Tipo::find(['estado' => 1])
            ->select('id,UPPER(nombre) as nombre')->all(), 'id', 'nombre');
    }

    public function getHostCheck(): array
    {
        $arrResult = [];
        $arrHosts = self::find()->where(['tipo_id'=> self::ID_CONEXION_HOST])->with('user','tipo')->all();
        $serviceValidator = new ServiceValidation();
        foreach ($arrHosts as $valueHost){
            $bolHost = $serviceValidator->validarHost($valueHost['host']);
            $arrResult[$valueHost['nombre']] = $bolHost ? 'OK':'KO';
            self::saveLog($valueHost['id'], $valueHost['host'], $bolHost ? 'OK' : 'KO', $bolHost ? self::ID_CODE_OK : self::ID_CODE_KO);
        }

        return $arrResult;
    }

    public function getApiCheck(): array
    {
        $arrResult = [];
        $arrHosts = self::find()->where(['tipo_id'=> self::ID_CONEXION_API])->with('user','tipo')->all();
        $serviceValidator = new ServiceValidation();
        foreach ($arrHosts as $valueHost){
            $bolHost = $serviceValidator->validarApi($valueHost['host']);
            $arrResult[$valueHost['nombre']] = $bolHost ? 'OK':'KO';
            self::saveLog($valueHost['id'], $valueHost['host'], $bolHost ? 'OK' : 'KO', $bolHost ? self::ID_CODE_OK : self::ID_CODE_KO);
        }

        return $arrResult;
    }

    /**
     * @return array
     */
    public function getDataBaseCheck(): array
    {
        $arrResult = [];
        $arrHosts = self::find()->where(['tipo_id' => self::ID_CONEXION_DB])->with('user', 'tipo')->all();
        $serviceValidator = new ServiceValidation();
        foreach ($arrHosts as $valueHost) {
            $port = $valueHost['attributes']['port'] ?? 3306;
            $bolHost = $serviceValidator->validarConexionBD(
                $valueHost['host'], $valueHost['user'], $valueHost['password'], $valueHost['db'], $port);
            $arrResult[$valueHost['nombre']] = $bolHost ? 'OK' : 'KO';
            self::saveLog($valueHost['id'], $valueHost['nombre'], $bolHost ? 'OK' : 'KO', $bolHost ? self::ID_CODE_OK : self::ID_CODE_KO);
        }
        return $arrResult;
    }

    public function saveLog(int $strConexion, string $strPeticion, string $strRespuesta, int $numCode): bool
    {
        $newLog = new Log();
        $newLog->conexion_id = $strConexion;
        $newLog->user_id = Yii::$app->user->identity->id;
        $newLog->peticion = $strPeticion;
        $newLog->respuesta = $strRespuesta;
        $newLog->codigo = $numCode;
        return $newLog->validate() && $newLog->save();
    }

    /**
     * Consultar datos de la ultima ejecución
     * @return array|null
     */
    public static function getLogLast(): ?array
    {
        $subQuery = Log::find()
            ->select(['MAX(id) AS id', 'conexion_id'])
            ->groupBy('conexion_id');

        $query = Log::find()
            ->select(['c.nombre AS conexion_nombre', 'tp.nombre AS tipo_nombre', 'u.username', 'lg.*'])
            ->from(['lg' => Log::tableName()])
            ->innerJoin(['sub' => $subQuery], 'lg.id = sub.id')
            ->innerJoin(['c' => Conexion::tableName()], 'c.id = lg.conexion_id')
            ->innerJoin(['tp' => Tipo::tableName()], 'tp.id = c.tipo_id')
            ->innerJoin(['u' => User::tableName()], 'u.id = lg.user_id');

        return $query->all();
    }



}
