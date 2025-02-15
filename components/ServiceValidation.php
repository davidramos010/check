<?php

namespace app\components;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use PDO;

class ServiceValidation
{
    private const TIMEOUT = 5;
    private const HTTP_OK = 200;

    /**
     * Valida la disponibilidad de una URL.
     */
    public function validarHost(string $host): bool
    {
        $url = $this->formatearUrl($host);
        $client = new Client(['timeout' => self::TIMEOUT]);

        try {
            $response = $client->head($url);
            return $response->getStatusCode() === self::HTTP_OK;
        } catch (RequestException $e) {
            return false;
        }
    }

    /**
     * Valida la disponibilidad de un endpoint de API.
     */
    public function validarApi(string $url): bool
    {
        if (!$ch = curl_init($url)) {
            return false;
        }

        curl_setopt_array($ch, [
            CURLOPT_NOBODY => true,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => self::TIMEOUT
        ]);

        curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        return $httpCode === self::HTTP_OK;
    }

    /**
     * Valida la conexión a una base de datos.
     */
    public function validarConexionBD(string $host, string $user, string $password, string $dbname = '', int $port = 3306): bool
    {
        $dsn = "mysql:host={$host};port={$port}" . ($dbname ? ";dbname={$dbname}" : '');
        
        try {
            $pdo = new PDO($dsn, $user, $password, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_TIMEOUT => self::TIMEOUT,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ]);
            $pdo = null;
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * Formatea una URL eliminando el protocolo si existe.
     */
    private function formatearUrl(string $url): string
    {
        $host = preg_replace('#^https?://#', '', rtrim($url, '/'));
        return "http://{$host}";
    }
}