<?php


$ProjectN = $_GET['xxx'];       		// <- limit, ile danych ma zostac pobranych 10 100 brak ...

//$ProjectN = '190520';

$connect = mysqli_connect("localhost", "root", "", "fatdb");

try
{
                $query = "select concat(afdeling,'/',AFDELINGSEQ) as PROJECT ,WERKBONNUMMER,STATUS,HOEVEELHEID,concat(OPERATIE,' - ' ,CFTEKST) as txt
				from werkbon where AFDELINGSEQ like '%$ProjectN%' ";
									   
				$result = mysqli_query($connect, $query);


                        $rows = array();
                        $table = array();
                             $table['cols'] = array(
                               array('label' => 'Project', 'type' => 'string'),
							    array('label' => 'WERKBONNUMMER', 'type' => 'string'),
                               array('label' => 'status', 'type' => 'string'),
                               array('label' => 'HOEVEELHEID', 'type' => 'string'),
							   array('label' => 'txt', 'type' => 'string')
                             );

                 while($row = mysqli_fetch_array($result))
				 {
               
					$temp = array();
                        $temp[] = array('v' => (string) $row['PROJECT']);
						$temp[] = array('v' => (string) $row['WERKBONNUMMER']);
                        $temp[] = array('v' => (string) $row['STATUS']);
                        $temp[] = array('v' => (string) $row['HOEVEELHEID']);
						$temp[] = array('v' => (string) $row['txt']);
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
