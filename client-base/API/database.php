<?php 

	include 'credenciales.php';

	/**
	 * Objeto DataBase
	 */
	class DataBase
	{
		private $handle;

		function __construct()
		{
			$this->handle = new mysqli(HOST, USER, PASS, DB, PORT);

			if(!$this->handle){
				die("Errno: ". $this->handle->errno . "error: ". $this->handle->error);
			}
		}


		public function query($ssql)
		{
			$res = $this->handle->query($ssql);

			if(!$res){
				die("Errno: ". $this->handle->errno . "error: ". $this->handle->error);
			}

			if(substr_count($ssql, "INSERT") >= 1){
				$res = $this->handle->insert_id;
			}

			return $res;
		}

		function __destruct(){

			$this->handle->close();
		}
	}

 ?>