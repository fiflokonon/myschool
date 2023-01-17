<?php
namespace App\Domain\Core\Repository ;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use PDO;
use Slim\Exception\HttpException;
use Symfony\Component\Config\Definition\Exception\Exception;

class Repository
{
    /**
     * @var PDO
     */
    protected PDO $connection;
    private $secret_key = "MYSCHOOL";

    /**
     * @param PDO $connection
     */
    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    /**
     * @param string $tablename
     * @return array|false
     */
    public function getAll(string $tablename)
    {
        $sql = "SELECT * FROM $tablename";
        return $this->connection->query($sql)->fetchAll();
    }

    /**
     * @param string $tablename
     * @param int $id
     * @return mixed|null
     */
    public function getOne(string $tablename, int $id)
    {
        $sql = "SELECT * FROM $tablename WHERE id = $id LIMIT 1";
        $result = $this->connection->query($sql)->fetchAll();
        #return $result[0];
        if ($result)
            return $result[0];
        else
            return null;
    }

    /**
     * @param string $tablename
     * @param int $id
     * @return array|false|mixed|string
     */
    public function deleteOne(string $tablename, int $id)
    {
        $sql = "DELETE FROM $tablename WHERE id = $id";
        $stmt = $this->connection->prepare($sql);
        return $this->exeStatement($stmt, ["success" => true]);
    }

    /**
     * @param $stmt
     * @param $response
     * @return array|false|mixed|string
     */
    public function exeStatement($stmt, $response)
    {
        try {
            if ($stmt->execute()) {
                return $response;
            } else {
                return json_encode([
                    "success" => false,
                    'message' => "An error occurs"
                ]);
            }
        } catch (HttpException $exception) {
            $statusCode = $exception->getCode();
            $errorMessage = sprintf('%s %s', $statusCode, $response->getReasonPhrase());
            return ["success" => false, "message" => $errorMessage];
        }
    }

    /**
     * @param $length
     * @return string
     * @throws \Exception
     */
    public function generateUniqueId($length)
    {
        $bytes = random_bytes($length);
        return strtoupper(bin2hex($bytes));
    }

    /**
     * @param array $data
     * @return string
     */
    public function generateToken(array $data): string
    {
        $issuer_claim = "payplus.africa"; // this can be the servername
        $issuedat_claim = time(); // issued at
        $notbefore_claim = $issuedat_claim + 5; //not before in seconds
        $expire_claim = $issuedat_claim + 3600; // expire time in seconds
        $token = array(
            "iss" => $issuer_claim,
            "iat" => $issuedat_claim,
            "nbf" => $notbefore_claim,
            "exp" => $expire_claim,
            "data" => $data
        );
        try {
            return JWT::encode($token, $this->secret_key, 'HS256');
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }

    /**
     * @param string $token
     * @return array|\stdClass
     */
    public function decodeToken(string $token)
    {
        try {
            return JWT::decode($token, new Key($this->secret_key, 'HS256'));
        } catch (Exception $exception) {
            if ($exception->getMessage() == 'Expired token') {
                return ["success" => false, 'message' => "reconnection"];
            } else {
                return ["success" => false, 'message' => $exception->getMessage()];
            }
        }
    }
}