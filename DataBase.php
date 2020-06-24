<?php

class DataBase{


    private static $db = null;
    private $mysqli;

    public static function getDB() {
        if (self::$db == null) self::$db = new DataBase();
        return self::$db;
    }

    private function __construct() {
        $this->mysqli = new mysqli("localhost", "root", "", "testDB");
        $this->mysqli->query("SET lc_time_names = 'ru_RU'");
        $this->mysqli->query("SET NAMES 'utf8'");
    }



    public function Select($table, $rows='*', $where=null, $order=null)
    {
        $q = 'SELECT'.$rows.' FROM '.$table;
        if($where != null)
        {
            $q .= ' WHERE '.$where;
        }
        if($order != null)
            $q .= ' ORDER BY '.$order;

        $result = $this->mysqli->query($q);
        $posts = array();
        while($tmp = $result->fetch_assoc()) {
            $posts[] = $tmp;
        }
        $result->close();

        return $posts;

    }

    public function Insert($table,$values,$rows = null)
    {

        $insert = 'INSERT INTO '.$table;
        if($rows != null)
        {
            $insert .= ' ('.$rows.')';
        }

        for($i = 0; $i < count($values); $i++)
        {
            if(is_string($values[$i]))
                $values[$i] = '"'.$values[$i].'"';
        }

        $values = implode('\',\'',$values);
        $values = '\''.$values.'\'';
        $insert .= ' VALUES (null,'.$values.')';
        $ins = $this->mysqli->query($insert);

        if($ins)
        {
            return true;
        }
        else
        {
            return false;
        }

    }

    public function DeleteFromTable($table, $where=null)
    {
        if($where == null)
        {
            $delete = 'DELETE '.$table;
        }
        else
        {
            $delete = 'DELETE FROM'.$table.' WHERE '.$where;
        }
        $del = $this->mysqli->query($delete);
        if($del)
        {
            return true;
        }
        else
        {
            return false;
        }
    }


}