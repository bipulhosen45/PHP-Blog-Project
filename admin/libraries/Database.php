<?php

class Database{

    private $dbhost=DB_HOST;
    private $dbName=DB_NAME;
    private $dbUser=DB_USER;
    private $dbPass=DB_PASS;

    private $statement;
    private $dbHandler;
    private $error;

    public function __construct()
    {
        try {
            /*set dsn*/
            $dsn ="mysql:host={$this->dbhost};dbname={$this->dbName};charset=utf8";
            $options =array(
                PDO::ATTR_PERSISTENT =>true,
                PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION
            );
            $this->dbHandler = new PDO($dsn,$this->dbUser,$this->dbPass,$options);
           // echo "DB connection successfully";
        } catch (PDOException $exception){
           echo $this->error = $exception->getMessage();
        }

    }

      public function query($sql)
    {
        $this->statement = $this->dbHandler->prepare($sql);
    }

    public function bind($param,$value,$type=null)
    {
        if (is_null($type)){
            switch (true){
                case is_int($value):
                    $type=PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type=PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type=PDO::PARAM_NULL;
                    break;
                default:
                    $type=PDO::PARAM_STR;
            }
        }
        $this->statement->bindValue($param,$value,$type);
    }

    public function execute()
    {
        return $this->statement->execute();

    }

    public function resultSet()
    {
        $this->execute();
        return $this->statement->fetchAll(PDO::FETCH_OBJ);
    }

    public function single()
    {
        $this->execute();
        return $this->statement->fetch(PDO::FETCH_OBJ);
    }

    public function lastInsertId()
    {
      return  $this->dbHandler->lastInsertId();
    }
    public function rowCount()
    {
        return $this->statement->rowCount();
    }


}