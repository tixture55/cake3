<?php
namespace App\Controller;


define('DB_NAME', 'data1');
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', 'xg23y91a');

require_once('DbConfig.php');

class ModelBase implements DbConfig{

				protected $db;
				protected $name;

				public function __construct(){
								$this->initDb();
				}

				public function initDb(){
								try{
									$dsn = sprintf(
									  'mysql:host=%s;dbname=%s;port=3306;charset=utf8',
									  DB_HOST,
									  DB_NAME);
								    $option = array(
												PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
												PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
												PDO::ATTR_EMULATE_PREPARES => false
										);

										$this->db = new PDO($dsn,DB_USER, DB_PASS,$option);
										
						
			         	}catch(PDOException $e){
										echo $e->getMessage();
								}
        }
				public static function setConnectionInfo($connInfo)
				{
								self::$connInfo = $connInfo;
        }
								public function query($name){

								}
}
