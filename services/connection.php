<?php
class Connection
{
   public $hostname = 'localhost';
    public $database    = 'LV_Production_Bangi_East';
    public $username     = 'postgres';
    public $password     = 'Admin123';
    //public $password     = '123';
	public $port="5433";
    public $conDB;

    public function connectionDB(){
        

        $this->conDB = pg_connect("host=$this->hostname dbname=$this->database user=$this->username password=$this->password port=$this->port");

        if(!$this->conDB)
        {
            die("connection failed");
        }
    }
    public function closeConnection(){
        pg_close($this->conDB);
    }
}

$con = new Connection();
echo $con->connectionDB();
?>