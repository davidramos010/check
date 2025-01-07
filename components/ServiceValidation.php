<?php

namespace app\components;

use GuzzleHttp\Client;
use Yii;
use yii\db\Exception;
use yii\db\mssql\PDO;

class ServiceValidation
{

    /**
     * Realiza un ping a la dirección IP o URL dada y valida si está disponible.
     *
     * @param string $host La IP o URL a verificar.
     * @return bool True si el host responde, false en caso contrario.
     */
    public function validarHost(string $host): bool
    {
        $host = preg_replace('#^https?://#', '', rtrim($host, '/'));
        $url = "http://$host";
        $client = new Client();

        try {
            // Realiza una solicitud HEAD a la URL
            $response = $client->head($url);
            // Verifica el código de estado de la respuesta
            return $response->getStatusCode() === 200;
        } catch (RequestException $e) {
            // Si hay un error, puedes manejarlo aquí
            return false;
        }
    }

    /**
     * Realiza una solicitud HTTP al host dado y verifica si responde correctamente.
     *
     * @param string $url La URL del host a verificar.
     * @return bool True si el host responde con un código 200, false en caso contrario.
     */
    public function validarApi(string $url): bool
    {
        // Inicializa una solicitud cURL
        $ch = curl_init($url);

        // Configura la solicitud para solo obtener el encabezado (HEAD request)
        curl_setopt($ch, CURLOPT_NOBODY, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 5); // Tiempo de espera de 5 segundos

        // Ejecuta la solicitud y obtiene el código de respuesta HTTP
        curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        // Verifica si el código de respuesta es 200 (OK)
        return $httpCode === 200;
    }

    /**
     * Verifica si se puede establecer una conexión con la base de datos.
     *
     * @param string $host     El nombre del host de la base de datos.
     * @param string $user     El nombre de usuario de la base de datos.
     * @param string $password La contraseña del usuario de la base de datos.
     * @param string $dbname   El nombre de la base de datos (opcional).
     * @param int $port     El puerto en el que se está ejecutando la base de datos.
     *
     * @return bool true si la conexión es exitosa, false en caso contrario.
     */
    public function validarConexionBD(string $host, string $user, string $password, string $dbname = '', int $port = 3306): bool
    {
        try {
            $dsn = "mysql:host=$host;port=$port;dbname=$dbname";
            $options = [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_TIMEOUT            => 5,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ];

            // Intentar crear una nueva conexión PDO
            $pdo = new PDO($dsn, $user, $password, $options);
            // Cerramos la conexión
            $pdo = null;
            return true;
        } catch (\Exception $e) {
            // Manejar errores de conexión aquí si es necesario
            return false;
        }
    }
}