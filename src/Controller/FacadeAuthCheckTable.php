<?php
namespace App\Controller;
require_once('ModelBase.php');

class FacadeAuthCheckTable extends ModelBase{

	protected $name;
	protected $list;

	public function getList($user,$pass){
		if(isset($user) && $user !='' && isset($pass)){
			$sql = $this->db->prepare("SELECT id,SID,username FROM Auth where username=:user AND pass=:pass");

		}else{

		}
		$sql->bindParam(':user',$user);
		$sql->bindParam(':pass',$pass);
		$sql->execute();
		while($row = $sql->fetch()) {
			$id = $row['id'];
			$sid = $row['SID'];
			$name = $row['username'];
			$list = array('ID'=>$id, 'SID'=>$sid, 'NAME'=>$name); 

		}
		$this->list = $list;
		return $this->list;
	}
	public function updateAccountMoney($id,$output){

		if(isset($id) && $id !=''){

			try{  
				$this->db->beginTransaction();
				$sql3 = "SELECT account_balance FROM AccountMoney WHERE SID=:sid FOR UPDATE";
				$sql = $this->db->prepare("UPDATE AccountMoney SET account_balance = account_balance -:output WHERE SID=:sid");
				$sql2 = "SELECT account_balance FROM AccountMoney WHERE SID=:sid";
				$stmt2 = $this->db->prepare($sql3);
				$stmt3 = $this->db->prepare($sql2);
				$sql->bindParam(':sid',$id);
				$stmt2->bindParam(':sid',$id);
				$stmt3->bindParam(':sid',$id);
				$sql->bindParam(':output',$output);
				$stmt2->execute();
				$stmt3->execute();
				$sql->execute();
				$stmt2->closeCursor(); 
				$stmt3->closeCursor(); 
				$sql->closeCursor(); 
				$this->db->commit();
						$result = $stmt3->fetchAll();
						
						while($row = $stmt3->fetch()) {
							  $balance = $row['account_balance'];

			      }
			}catch(PDOException $e){
				$this->db->rollback();
			}

	}





}
}
