<?php
class DB
{
    private static $db_instances = array();

    /**
     * @var PDO
     */
    protected $pdo;

    /**
     * @var PDOStatement
     */
    protected $st;

    private function __construct($dsn, $username, $password, $driver_options)
    {
        $this->pdo = new PDO($dsn, $username, $password, $driver_options);
    }

    /**
     * @return DB
     */
    public static function conn()
    {
        if (!isset(self::$db_instances[DB_DSN])) {
            self::$db_instances[DB_DSN] = new static(DB_DSN, DB_USERNAME, DB_PASSWORD, array(PDO::ATTR_TIMEOUT => DB_ATTR_TIMEOUT));
        }

        return self::$db_instances[DB_DSN];
    }

    public function query($sql, $params = array())
    {
        $this->st = $this->pdo->prepare($sql, $params);
        $execute_status = $this->st->execute($params);
        if (!$execute_status) {
            throw new PDOException("Query failed : {$sql}");
        }
    }

    public function row($sql, $params = array())
    {
        $this->query($sql, $params);
        return $this->st->fetch(PDO::FETCH_ASSOC);
    }

    public function rows($sql, $params = array())
    {
        $this->query($sql, $params);
        return $this->st->fetchAll(PDO::FETCH_ASSOC);
    }

    public function rowCount()
    {
        $this->st->rowCount();
    }

    public function lastInsertId($name = null)
    {
        $this->pdo->lastInsertId($name);
    }

    public function begin()
    {
        $this->query('BEGIN');
    }

    public function rollback()
    {
        $this->query('ROLLBACK');
    }

    public function commit()
    {
        $this->query('COMMIT');
    }
}