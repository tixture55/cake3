<?php
namespace App\Controller;

require_once('ModelBase.php');
require_once('getFromDb.php');

class FacadeBalanceTable extends ModelBase implements getFromDb{

	protected $name;
	protected $list;

	public function getList($id,$type){
		if(isset($id) && $id !='' && $type == 1){

			$sql = $this->db->prepare("SELECT SID,name,account_balance,last_modify FROM AccountMoney WHERE SID=:sid");

			$sql->bindParam(':sid',$id);
			$sql->execute();
			while($row = $sql->fetch()) {
				$id = $row['SID'];
				$id = intval($id);
				$name = $row['name'];
				$account_balance = $row['account_balance'];
				$last_modify = $row['last_modify'];
				$list = array('ID'=>$id, 'NAME'=>$name,  'BALANCE'=>$account_balance, 'LAST_MODIFY'=>$last_modify); 

			}
			$this->list = $list;
			return $this->list;
		}
	}
	public function history_getter($id){
		if(isset($id) && $id !=''){
			$sql = $this->db->prepare("SELECT id,CustomerID,output_value,output_date FROM output_history WHERE CustomerID=:sid");
			$sql->bindParam(':sid',$id);
			$sql->execute();
			
			$entire_list = array();
			
			while($row = $sql->fetch()) {
				$id = $row['id'];
				$customerID = $row['CustomerID'];
				$output_value = $row['output_value'];
				$output_date = $row['output_date'];
				$list = array('ID'=>$id, 'customerID'=>$customerID,  'output_value'=>$output_value, 'output_date'=>$output_date); 
			}
			$this->list = $list;
			return $this->list;


		}	
	}

	public function updateAccountMoney($id,$output){
		if(isset($id) && $id !=''){

			try{  
				$sql3 = "SELECT * FROM AccountMoney WHERE SID=:sid";
				$stmt2 = $this->db->prepare($sql3);
				$stmt2->bindParam(':sid',$id);
				$stmt2->execute();
				while($row = $stmt2->fetch()) {
					$account = $row['account_balance'];
				}
				if($account < $output){
					//tran_flg:1 残高不足
					$tran_flg = 1;	
					return $tran_flg;	
				}
				$this->db->beginTransaction();
				$sql3 = "SELECT * FROM AccountMoney WHERE SID=:sid FOR UPDATE";
				$sql = $this->db->prepare("UPDATE AccountMoney SET account_balance = account_balance -:output WHERE SID=:sid");
				$sql4 = "insert into output_history (id,CustomerID,output_value,output_date) values(null,:sid,:output,now())";
				$sql2 = "SELECT account_balance FROM AccountMoney WHERE SID=:sid";
				$stmt2 = $this->db->prepare($sql3);
				$stmt3 = $this->db->prepare($sql2);
				$stmt4 = $this->db->prepare($sql4);
				$sql->bindParam(':sid',$id);
				$stmt2->bindParam(':sid',$id);
				$stmt3->bindParam(':sid',$id);
				$sql->bindParam(':output',$output);
				$stmt4->bindParam(':sid',$id);
				$stmt4->bindParam(':output',$output);
				$stmt2->execute();
				$stmt3->execute();
				$stmt4->execute();
				$sql->execute();
				$stmt2->closeCursor(); 
				$stmt3->closeCursor(); 
				$stmt4->closeCursor(); 
				$sql->closeCursor(); 
				$this->db->commit();
				//tran_flg; 0 トランザクション正常完了
				$tran_flg = 0;
				return $tran_flg;
			}catch(PDOException $e){
				$this->db->rollback();
			}

		}




	}
}
