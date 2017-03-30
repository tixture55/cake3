<?php
namespace App\Controller;
		require_once('ModelBase.php');
		require_once('getFromDb.php');
		
		class FacadeBookTable extends ModelBase implements getFromDb{
		
				protected $name;
        protected $list;

				public function getList($id, $type){
						if(isset($id) && $id !=''){

$sql = $this->db->prepare("SELECT * FROM Customer left join Teletype on Customer.Telephone = Teletype.telephone left join board_status on Customer.SID = board_status.UserID WHERE SID=:sid order by Customer.SID limit 50");

						}else{
							$sql = $this->db->prepare("SELECT * FROM Customer where Customer.SID = 10 limit 50");
							
						}
						$sql->bindParam(':sid',$id);
						$sql->execute();
				    $flg = 0;
						while($row = $sql->fetch()) {
							  $id = $row['SID'];
						    $id = intval($id);
								$lastname = $row['Last_Name'];
						    $firstname = $row['First_Name'];
						    $tele = $row['Telephone'];
						    $job = $row['Job'];
						    if(isset($row['type'])){
										$type = $row['type'];
										if(is_null($type)) $type= '-';
								}
						    if(isset($row['type'])){
										$list = array('ID'=>$id, 'LASTNAME'=>$lastname, 'FNAME'=>$firstname, 'TELE'=>$tele, 'JOB'=>$job, 'TYPE'=>$type); 
								}else{
										$list[] = array('ID'=>$id, 'LASTNAME'=>$lastname, 'FNAME'=>$firstname, 'TELE'=>$tele, 'JOB'=>$job, 'TYPE'=>'-'); 

								}
						}
						$this->list = $list;
						return $this->list;
				}





		}
