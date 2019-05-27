<?php

$werkbonn = $_POST['d'];       		// <- limit, ile danych ma zostac pobranych 10 100 brak ...

//$werkbonn = '927776';

$connect = mysqli_connect("localhost", "root", "", "fatdb");

try
{
                $query = "select concat(werkuren.afdeling,'/', werkuren.AFDELINGSEQ, ' : ', werkuren.CFWERKNEMERNAAM) as merged,
					   concat(werkuren.DATUM ,' ',
					   CASE WHEN length(werkuren.BEGINTIJDH) < 2 then concat(0, werkuren.BEGINTIJDH) else werkuren.BEGINTIJDH end ,':',
					   case when werkuren.BEGINTIJDM60  >=60 then werkuren.BEGINTIJDM60  = 59 else (CASE WHEN length(werkuren.BEGINTIJDM60)  < 2 then concat(0, werkuren.BEGINTIJDM60)  else werkuren.BEGINTIJDM60  end) end , ':',
					   case when werkuren.BEGINTIJDM100 >=60 then concat(5,9) else (CASE WHEN length(werkuren.BEGINTIJDM100) < 2 then concat(0, werkuren.BEGINTIJDM100) else werkuren.BEGINTIJDM100  end ) end ) 
					   as BeginDate,
					   concat(werkuren.DATUM,' ',
					   CASE WHEN length(werkuren.EINDTIJDH) < 2 then concat(0, werkuren.EINDTIJDH) else werkuren.EINDTIJDH end ,':',
					   case when werkuren.EINDTIJDM60 >=60 then concat(5,9) else (CASE WHEN length(werkuren.EINDTIJDM60) < 2 then concat(0, werkuren.EINDTIJDM60) else werkuren.EINDTIJDM60  end )end , ':',
					   case when werkuren.EINDTIJDM100 >=60 then concat(5,9) else (CASE WHEN length(werkuren.EINDTIJDM100) < 2 then concat(0, werkuren.EINDTIJDM100) else werkuren.EINDTIJDM100  end )  end )
					   as EndDate
					   from werkuren
					   left join werkbon
					   on werkuren.WERKBONNUMMER = werkbon.WERKBONNUMMER
					   where werkuren.WERKBONNUMMER = '$werkbonn'
					   order by werkuren.DATUM ";
									   
				$result = mysqli_query($connect, $query);


                        $rows = array();
                        $table = array();
                             $table['cols'] = array(
                               array('label' => 'Godina', 'type' => 'string'),
							    array('label' => 'dd', 'type' => 'string'),
                               array('label' => 'Odluka', 'type' => 'date'),
                               array('label' => 'glasnik', 'type' => 'date')
                             );

                 while($row = mysqli_fetch_array($result))
				 {
                   $date1 = new DateTime($row['BeginDate']);
                   $date2 = "Date(".date_format($date1, 'Y').", ".((int) date_format($date1, 'm') ).", ".date_format($date1, 'd').", ".date_format($date1, 'H').", ".date_format($date1, 'i').", ".date_format($date1, 's').")";

                    $date3 = new DateTime($row['EndDate']);			
					$date4 = "Date(".date_format($date3, 'Y').", ".((int) date_format($date3, 'm') ).", ".date_format($date3, 'd').", ".date_format($date3, 'H').", ".date_format($date3, 'i').", ".date_format($date3	, 's').")";

					$duppa = date_format($date1, 'Y')."-".((int) date_format($date3, 'm') )."-".date_format($date3, 'd');
					
					$temp = array();
                        $temp[] = array('v' => (string) $row['merged']);
						$temp[] = array('v' => (string) $duppa);
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
