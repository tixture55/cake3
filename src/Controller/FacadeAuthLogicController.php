<?php

require_once('FacadeAuthCheckTable.php');

Class FacadeAuthLogicController{

	protected $name;
	protected $pass;
	protected $list;
	protected $fact;


	public function __construct(FacadeAuthCheckTable $fact = null) {
		$this->fact = $fact ? $fact : new FacadeAuthCheckTable();
	}


	public function authCompare($name,$pass){
		$this->name = $name;
		$this->pass = $pass;

		$this->list = $this->fact->getList($this->name,$this->pass);
		return $this->list;
	}

}
