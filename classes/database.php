<?php 
class Database
{
	private $server="localhost";
	private $username="root";
	private $pass="";
	private $database="groupprojectucsc";
	private $con="";

	public function __construct()
	{
		try
		{
			$this->con=mysqli_connect($this->server, $this->username, $this->pass);
			mysqli_select_db($this->con,$this->database);
		}
		catch (Exception $e)
		{
			echo "Connection Failed: ".$e->getMessage();
			die();
		}
	}
	public function insert_update_delete($query)
	{
		try
		{
			$result= mysqli_query($this->con, $query);
			if ($result>0)
				return 1;
			else 
				return 0;
		}
		catch (Exception $e) 
		{
            return 0;
            echo $e;
        }
	}
	public function getData($query)
	{
		try
		{
			$result= mysqli_query($this->con, $query);
		}
		catch (Exception $e) {
            $result = null;
            echo $e;
        }
        return $result;
	}
}
?>