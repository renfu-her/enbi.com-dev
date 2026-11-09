<?php

/*
Class：
  MyDB

Extends：
  none

Attributes:
  none

Operators:
  建構式->建立與MySQL的連線，以及設定語系。
  Resource SqlQuery(string sql)->執行SQL語法。
  Resource FetchObj(string sql)->傳回一個SQL執行物件。
  Resource FetchAry(string sql)->傳回一個SQL執行陣列。
  Int NumRows(resource query)->傳回執行總筆數。
  Int NumFields(resource query)->傳回欄位總數。
  Int FieldsName(resource query)->傳回欄位名稱。
  Booleen DataSeek(resource query,int int)->傳回一個SQL執行的結果且將指標移至int。
  String Safe(string data)->跳脫特殊字元。
  Int InsertId(string sql)->傳回上一筆寫入資料庫的Id。
  解構式->關閉與MySQL的連線。
*/


class MyDB{

	private $mysqli;
	private $result;

	function __construct($host , $db , $user , $pass , $charset = 'utf8'){

		$this->mysqli = new mysqli($host , $user , $pass, $db);
		if ($this->mysqli instanceof mysqli && !$this->mysqli->connect_errno && $charset !== '') {
			$this->mysqli->set_charset($charset);
		}

	}

	function SqlQuery($sql){

		$this->result = $this->mysqli->query($sql);

		return $this->result;

	}

	function FetchObj($sql){//in fact, type of $sql is 'resource'

		return mysqli_fetch_object($sql);

	}

	function FetchAry($sql){

		return $this->result->fetch_array(MYSQLI_ASSOC);
	}


	function NumRows($query){

		return mysqli_num_rows($query);
	}


	function NumFields($query){

		return mysqli_num_fields($query);

	}


	function FieldName($query , $int){

		$field = mysqli_fetch_field_direct($query , $int);
		return ($field && isset($field->name)) ? $field->name : null;

	}


	function DataSeek($query , $int){

		return mysqli_data_seek($query , $int);

	}


	function Safe($content){

		if (is_array($content)) {
			foreach ($content as $key=>$value) {
				$content[$key] = mysqli_real_escape_string($this->mysqli, (string) $value);
			}
		}else{
			$content = mysqli_real_escape_string($this->mysqli, (string) $content);
		}
		return $content;

	}


	function InsertId(){

		return mysqli_insert_id($this->mysqli);

	}


	function __destruct(){

		if ($this->mysqli instanceof mysqli) {
			mysqli_close($this->mysqli);
		}

	}



}
?>
