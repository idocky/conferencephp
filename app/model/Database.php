<?php
namespace model;

use PDO;

class Database
{
    private $link;

    public  function __construct()
    {
        $this->connect();
    }

    private function connect()
    {
        $config = require_once 'config.php';
        $dsn ='mysql:host='.$config['host'].';dbname='.$config['db_name'].';charset='.$config['charset'];
        $this->link = new PDO($dsn, $config['username'], $config['password']);

        return $this;
    }

    public  function execute($sql)
    {
        $sth = $this->link->prepare($sql);

        return $sth->execute();
    }

    public function query($sql){
        $sth = $this->link->prepare($sql);

        $sth->execute();

        $res = $sth->fetchAll(PDO::FETCH_ASSOC);

        if($res === false){
            return[];
        }

        return $res;
    }


    //Country

    public function getCountries(){
        $sql = 'select * from country order by name_country asc';
        $stmt = $this->query($sql);
        return $stmt;
    }

    public function getCountryByName($name){
        $sql = "select * from country where name_country = '".$name."'";
        $stmt = $this->query($sql);
        return $stmt;
    }

    public function getCountryByID($country_id){
        $sql = "select * from country where country_id = '".$country_id."'";
        $stmt = $this->query($sql);
        return $stmt;
    }



    //Conference

    public function getConferences(){
        $sql = "select * from conference";
        $stmt = $this->query($sql);
        return $stmt;
    }

    public function getConfBySlug($slug){
        $sql = "select * from conference where slug = '".$slug."'";
        $stmt = $this->query($sql);
        return $stmt;
    }

    public function deleteConference($slug){
        $sql = 'delete from conference where slug = "'.$slug.'"';
        $this->query($sql);
    }


}