<?php  
    require_once ('config.php');
	class Balance extends Connect
	{
		
		public function fetch($studentNumber){

            $data=array();
            $sql = "SELECT * FROM enrollbalance WHERE studnumber = ? LIMIT 5 ";
			$stmt = $this->db->prepare($sql);
			$stmt->execute([$studentNumber]);
			$data = $stmt->fetchAll();
			
			return $data;
        }

		
		public function balanceValidation($studentNumber,$syear,$semester,$balance)
		{
			
			$legendData=array();
			$clearBalanceData=array();
			$legendSql = "SELECT * FROM enrollbalance 
			INNER JOIN legend ON 
			enrollbalance.syear = legend.schoolyear 
			AND enrollbalance.semester = legend.semester
			WHERE enrollbalance.studnumber = ?";
			$legendStmt = $this->db->prepare($legendSql);
			$legendStmt->execute([$studentNumber]);
			$legendData = $legendStmt->fetch(PDO::FETCH_ASSOC);
			if($legendData > 0)
			{
				return  1;
			}
			else
			{
				$balanceSql = "SELECT * FROM enrollbalance WHERE studnumber = ?";
				$balanceStmt = $this->db->prepare($balanceSql);
				$balanceStmt->execute([$studentNumber]);
				$balanceData = $balanceStmt->fetch(PDO::FETCH_ASSOC);
				if($balanceData <= 0)
				{
					return  2;
				}
				else
				{
					$scholarshipSql= "SELECT * FROM enrollbalance INNER JOIN `enrollfeesummary`
					ON enrollbalance.studnumber = enrollfeesummary.studnumber
					WHERE enrollbalance.syear = enrollfeesummary.syear 
					AND enrollbalance.semester = enrollfeesummary.semester
					AND enrollfeesummary.scholarship != 'RA 10931' AND enrollbalance.balance != '0.00'
					AND enrollbalance.studnumber =?";
					$scholarshipStmt = $this->db->prepare($scholarshipSql);
					$scholarshipStmt->execute([$studentNumber]);
					$scholarshipData = $scholarshipStmt->fetch(PDO::FETCH_ASSOC);
					if($scholarshipData > 0)
					{
						return  3;
					}	
					else{
						return 0;
					}
				}

			}
		}

		function update($studentNumber,$syear,$semester,$timeStamp){
			$sql = "DELETE FROM enrollbalance WHERE `studnumber`=?";
			$stmt = $this->db->prepare($sql);
			$stmt->execute([$studentNumber]);
			if($stmt)
			{
				$addData=[];
				$addData=[
					'studentNumber'=>$studentNumber,
					'syear'=>$syear,
					'semester'=>$semester,
					'timeStamp'=> $timeStamp
				];
				$sql = "INSERT INTO enrollcleared(`studnumber`,`syear`,`semester`,`datecleared`)
				VALUES (:studentNumber,:syear,:semester,:timeStamp)";
				$stmt = $this->db->prepare($sql);
				$stmt->execute($addData);
				if($stmt) return 1;
				else return 0;
			}
			else return 0;
           
		}

		// function delete($programId)
		// {
		// 	$sql = "DELETE FROM program WHERE `id`=?";
		// 	$stmt = $this->db->prepare($sql);
		// 	$stmt->execute([$programId]);
		// 	if($stmt) return 1;
		// 	else return 0;
		// }

		// function getProgram($id)
		// {
		// 	$data=array();
        //     $sql = "SELECT * FROM program WHERE `id`=?";
		// 	$stmt = $this->db->prepare($sql);
		// 	$stmt->execute([$id]);
		// 	$data = $stmt->fetch();
		// 	if($data>0) return $data;
        //     else return "0"; 
		// }
        
	}	
?>