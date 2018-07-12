<?php
class DataBase {
    private $login = 'm3wsmap9_db_i'; // ВАШ ЛОГИН К БАЗЕ ДАННЫХ
    private $pass = 'C7Ao*n&Y'; // ВАШ ПАРОЛЬ К БАЗЕ ДАННЫХ
    private $db_name = 'm3wsmap9_db_i'; // НАЗВАНИЕ БАЗЫ ДЛЯ САЙТА
    private $host='localhost';
    private $db;

    /**
     * DataBase constructor.
     */
    public function __construct()
    {
        $this->db = mysqli_connect($this->host,$this->login,$this->pass,$this->db_name);
    }

    /**
     * @return mysqli
     */
    public function getDb()
    {
        return $this->db;
    }

    public function __destruct()
    {
        // TODO: Implement __destruct() method.
        mysqli_close($this->db);
    }


}