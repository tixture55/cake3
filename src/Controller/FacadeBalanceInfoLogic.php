<?php
namespace App\Controller;

require_once('FacadeBookTable.php');
require_once('FacadeBalanceTable.php');

class FacadeBalanceInfoLogic{

	protected $name;
	protected $list;
	protected $history;
	protected $type;

	public function tableSearch($name,$type){

		$this->name = $name;
		$this->type= $type;


		try{


			//type:1は残高テーブルの参照
			if($this->type == 1){
				$list = new FacadeBalanceTable();
				$get_list = $list->getList($this->name,$this->type);

			}elseif($this->type == 2){
				$list = new FacadeBalanceTable();
				$list->updateAccountMoney($this->name,$this->outputMoney);

			}elseif($this->type == 3){
				$list = new FacadeBalanceTable();
				$get_list = $list->history_getter($this->name);
			}else{	
				$list = new FacadeBookTable();
				$get_list = $list->getList($this->name,$this->type);
			}
		}catch (Exception $e){
			echo "Error " . htmlspecialchars($e->getMessage());
		}
		return $get_list;
	}


}
