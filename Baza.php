<?php

/**
 * Created by PhpStorm.
 * User: Lovro
 * Date: 11.1.2017.
 * Time: 21:45
 */
class Baza
{
    private $db_host = "localhost";
    private $db_name = "TBP";
    private $db_username = "postgres";
    private $db_password = "user";

    public function connectionDB()
    {
        return pg_connect("host=$this->db_host dbname=$this->db_name user=$this->db_username password=$this->db_password");
    }

    public function queryDB($query)
    {
        $connection = $this->connectionDB();
        $return_query = pg_query($connection, $query);
        pg_close($connection);
        return $return_query;
    }
}