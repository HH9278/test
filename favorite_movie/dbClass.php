<?php
	Class DbControl
	{
		// DBへ接続する
		private function dbConnect(){
			$dsn = 'mysql:dbname=favorite_movie;host=localhost;charset=utf8';
			$user = 'root';
			$password = '';
			$dbh = new PDO($dsn, $user, $password);
			$dbh->query('SET NAMES utf8');
			$dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
			return $dbh;
		}
		
		// DB全体をSELECTする
		public function dbSelectAll(){
			$dbh = $this->dbConnect();
			$sql = "SELECT * FROM inquiries ORDER BY day";
			$stmt = $dbh->query($sql);
			return $stmt;
		}
		
		// 日付指定してSELECTする
		public function dbSelectByDay($day){
			$dbh = $this->dbConnect();
			$sql = "SELECT * FROM inquiries WHERE day= '".$day."'";
			$stmt = $dbh->query($sql);
			return $stmt;
		}
		
		// DBへデータを挿入する
		public function dbInsertDat($day, $ifm, $cmt){
			$dbh = $this->dbConnect();
			$sql = 'INSERT INTO inquiries (day, ifm, cmt) VALUES (?, ?, ?)';
			$stmt = $dbh->prepare($sql);
			$stmt->bindValue(1, $day, PDO::PARAM_STR);
			$stmt->bindValue(2, $ifm, PDO::PARAM_STR);
			$stmt->bindValue(3, $cmt, PDO::PARAM_STR);
			$stmt->execute();
			$dbh = null;
		}
	}
?>