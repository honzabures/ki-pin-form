<?php
namespace Database;
abstract class SQL
{
    private const
        DB_SERVER_NAME      = '127.0.0.1',
        DB_USERNAME         = 'root',
        DB_PASSWORD         = null,
        DB_NAME             = 'ki-pin';

    /** @var false|\mysqli|null  */
    private $conn;

    /**
     *
     */
    public function __construct()
    {
        $this->conn = mysqli_connect(self::DB_SERVER_NAME, self::DB_USERNAME, self::DB_PASSWORD, self::DB_NAME);
        if (!$this->conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
    }

    /**
     * @param $sql
     */
    public function insert($sql): void
    {
        if (!$this->conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
        if (!mysqli_query($this->conn, $sql)) {
            die("Error: " . $sql . "<br>" . mysqli_error($this->conn));
        }
        mysqli_close($this->conn);
    }

    /**
     * @param $sql
     * @return bool|\mysqli_result
     */
    public function select($sql)
    {
        $result = $this->conn->query($sql);
        mysqli_close($this->conn);
        return $result;
    }
}