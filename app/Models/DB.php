<?php

// namespace app\Models;

class DB {
	private $conn;

	public function __construct() {
		$this->conn = new \PDO("mysql:host=". SERVER .";dbname=". DATABASE .";charset=utf8", USERNAME, PASSWORD);
		$this->conn->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_OBJ);
		$this->conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
	}

	public function execute_query($query)
	{
		return $this->conn->query($query)->fetchAll();
	}

	public function execute_param_query($query, $params)
	{
		$prepare = $this->conn->prepare($query);
		// return $prepare;
		$prepare->execute($params);
		return $prepare->fetchAll();
	}

	public function execute_select_one($query, $params = [])
	{
		$prepare = $this->conn->prepare($query);
		
		$prepare->execute($params);
		return $prepare->fetch();
	}

	public function execute_insert($query, $info)
	{
		# provera ako vec ima i vracanje koda
		$prepare = $this->conn->prepare($query);
		$rezultat = $prepare->execute($info);
		return $rezultat;
	}

	public function execute_update($query, $params)
	{
		$prepare = $this->conn->prepare($query);
		$rezultat = $prepare->execute($params);
		return $rezultat;
	}

	public function execute_delete($query)
	{
		$prepare = $this->conn->prepare($query);
		$rezultat = $prepare->execute($params);
		return $rezultat;
	}
}
