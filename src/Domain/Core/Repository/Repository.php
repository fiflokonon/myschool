<?php
namespace App\Domain\Core\Repository ;

use PDO;

class Repository
{
    /**
     * @var PDO
     */
     protected PDO $connection;

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
            }
            else {
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

}