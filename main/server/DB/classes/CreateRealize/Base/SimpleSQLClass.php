<?php //defined('INDEX') OR die('Прямой доступ к странице запрещён!');

// MYSQL
class MyDB 
{
	var $dblogin = 'm3wsmap9_db'; // ВАШ ЛОГИН К БАЗЕ ДАННЫХ
	var $dbpass = '*zTlB3kV'; // ВАШ ПАРОЛЬ К БАЗЕ ДАННЫХ
	var $db = 'm3wsmap9_db'; // НАЗВАНИЕ БАЗЫ ДЛЯ САЙТА
	var $dbhost='localhost';
/*
	var $dblogin = 'up'; // ВАШ ЛОГИН К БАЗЕ ДАННЫХ
	var $dbpass = 'up2018'; // ВАШ ПАРОЛЬ К БАЗЕ ДАННЫХ


*/
	var $link;
	var $query;
	var $err = 0;
	var $result;
	var $data;
	var $fetch;


    function connect() {
		$this->link = mysqli_connect($this->dbhost, $this->dblogin, $this->dbpass, $this->db);
	}

	function screening($data){
		return mysqli_real_escape_string($this->link, $data);
	}

	function last_insert_id() {
		return mysqli_insert_id($this->link);
	}
	

	function run($query) {
		$this->query = $query;//$this->screening($query) - не проканает
		$this->result = mysqli_query($this->link,$this->query);
		$this->err = mysqli_error($this->link);
	}
	
	function row($i) {
		$flag = mysqli_data_seek($this->result,$i);
		if(!$flag) {
			$this->err = "result or $i is invalid";	
			return null;	
		}
		$this->data = mysqli_fetch_array($this->result);
		return $this->data;
	}
	function num_rows() {		
		return mysqli_num_rows($this->result);
	}
	
	function fetch() {
		while ($this->data = mysqli_fetch_array($this->result)) {
			$this->fetch = $this->data;
			return $this->fetch;
		}
	}

	function getError() {
		if( $this->err === '' || !isset($this->err)  ) $this->err = 0;
		return $this->err;
	}

	function stop() {
		unset($this->data);
		unset($this->result);
		unset($this->fetch);
		unset($this->err);
		unset($this->query);
	}
	function close() {
		$this->stop();
		mysqli_close($this->link);
	}
}