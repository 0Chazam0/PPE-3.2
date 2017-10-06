<?php
class DBConnex extends PDO{

	private static $instance;

	public static function getInstance(){
		if ( !self::$instance ){
			self::$instance = new DBConnex();
		}
		return self::$instance;
	}

	function __construct(){
		try {
			parent::__construct(Param::$dsn ,Param::$user, Param::$pass);
		} catch (Exception $e) {
			echo $e->getMessage();
			die("Impossible de se connecter. " );
		}
	}

  public function queryFetchAll($sql){
		$sth  = $this -> query($sql);

		if ( $sth ){
			return $sth -> fetchAll(PDO::FETCH_ASSOC);
		}

		return false;
	}
		
	public function queryFetchFirstRow($sql){
		$sth    = $this -> query($sql);
		$result    = array();

		if ( $sth ){
			$result  = $sth -> fetch();
		}

		return $result;
	}


}
 ?>
