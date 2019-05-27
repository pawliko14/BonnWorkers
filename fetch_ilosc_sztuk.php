<?php

$werkbon = $_POST['d'];       		// <- limit, ile danych ma zostac pobranych 10 100 brak ...

//$werkbon = '922588';

$connect = mysqli_connect("localhost", "root", "", "fatdb");

try
{
                $query = "select werkuren.DATUM as merged,
								concat(werkuren.GOEDGEKEURD,' sztuk') as GOEDGEKEURD ,
							   concat(
							   CASE WHEN length(werkuren.BEGINTIJDH) < 2 then concat(0, werkuren.BEGINTIJDH) else werkuren.BEGINTIJDH end ,':',
							   case when werkuren.BEGINTIJDM60  >=60 then werkuren.BEGINTIJDM60  = 59 else (CASE WHEN length(werkuren.BEGINTIJDM60)  < 2 then concat(0, werkuren.BEGINTIJDM60)  else werkuren.BEGINTIJDM60  end) end , ':',
							   case when werkuren.BEGINTIJDM100 >=60 then concat(5,9) else (CASE WHEN length(werkuren.BEGINTIJDM100) < 2 then concat(0, werkuren.BEGINTIJDM100) else werkuren.BEGINTIJDM100  end ) end ) 
							   as BeginDate,
							   concat(
							   CASE WHEN length(werkuren.EINDTIJDH) < 2 then concat(0, werkuren.EINDTIJDH) else werkuren.EINDTIJDH end ,':',
							   case when werkuren.EINDTIJDM60 >=60 then concat(5,9) else (CASE WHEN length(werkuren.EINDTIJDM60) < 2 then concat(0, werkuren.EINDTIJDM60) else werkuren.EINDTIJDM60  end )end , ':',
							   case when werkuren.EINDTIJDM100 >=60 then concat(5,9) else (CASE WHEN length(werkuren.EINDTIJDM100) < 2 then concat(0, werkuren.EINDTIJDM100) else werkuren.EINDTIJDM100  end )  end )
							   as EndDate
								 from werkuren
						   left join werkbon
						   on werkuren.WERKBONNUMMER = werkbon.WERKBONNUMMER
						   where werkuren.WERKBONNUMMER = '$werkbon'
						   order by werkuren.DATUM";
									   
				$result = mysqli_query($connect, $query);


                        $rows = array();
                        $table = array();
                             $table['cols'] = array(
                               array('label' => 'Time', 'type' => 'string'),
                               array('label' => 'quantity', 'type' => 'string'),
							   array('label' => 'BeginDate', 'type' => 'date'),
                               array('label' => 'EndDate', 'type' => 'date')
                             );

                 while($row = mysqli_fetch_array($result))
				 {
                   $date1 = new DateTime($row['BeginDate']);
                   $date2 = "Date(".date_format($date1, 'Y').", ".((int) date_format($date1, 'm') - 1).", ".date_format($date1, 'd').", ".date_format($date1, 'H').", ".date_format($date1, 'i').", ".date_format($date1, 's').")";

                    $date3 = new DateTime($row['EndDate']);			
					$date4 = "Date(".date_format($date3, 'Y').", ".((int) date_format($date3, 'm') - 1).", ".date_format($date3, 'd').", ".date_format($date3, 'H').", ".date_format($date3, 'i').", ".date_format($date3	, 's').")";

					$goedgekuerd = $row['GOEDGEKEURD'];
					if($goedgekuerd == '0 sztuk')
					{
						$goedgekuerd = "0 sztuk";
					}
					else if($goedgekuerd == '1 sztuk')
					{
						$goedgekuerd = "1 sztuka";
					}
					else if($goedgekuerd == '2 sztuk')
					{
						$goedgekuerd = "2 sztuki";
					}
					else if($goedgekuerd == '3 sztuk')
					{
						$goedgekuerd = "3 sztuki";
					}
					else if($goedgekuerd == '4 sztuk')
					{
						$goedgekuerd = "4 sztuki";
					}
					
	
					$temp = array();
                        $temp[] = array('v' => (string) $row['merged']);
						 $temp[] = array('v' => (string) $goedgekuerd );
                        $temp[] = array('v' => (string) $date2);
                        $temp[] = array('v' => (string) $date4);
                        $rows[] = array('c' => $temp);
				 }

			$table['rows'] = $rows;
			$jsonTable = json_encode($table);

			echo $jsonTable;
		}
		catch(PDOException $e) {
               echo 'ERROR: ' . $e->getMessage();
                   }
				   
				   
?>
