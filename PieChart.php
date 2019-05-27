<?php

		$Bonn_value = $_POST['x'];       		// <- limit, ile danych ma zostac pobranych 10 100 brak ...
	//	$Bonn_value = '915296';
		
		
			$connect = mysqli_connect("localhost", "root", "", "fatdb");
			
			$query = "select STATUS  from rejestracja where WERKBON = '$Bonn_value' and status = 90";
				
			$result = mysqli_query($connect, $query);
			$row_1 = mysqli_fetch_row($result);
			$dataWej = $row_1[0];
			
			if($dataWej == '90')
			{
				$query2 = "select concat(DATUM,'   ',BEGINTIJDH,':',BEGINTIJDM60, ' - ' ,EINDTIJDH, ':',EINDTIJDM60, '(', (TIJDGEPRESTEERDH * 60) + TIJDGEPRESTEERDM60,' minut)') as DATUM, (((TIJDGEPRESTEERDH * 60) + TIJDGEPRESTEERDM60)/ (select sum((TIJDGEPRESTEERDH * 60) + TIJDGEPRESTEERDM60) from werkuren where WERKBONNUMMER = '$Bonn_value')*100) 
							as 'CzasuRzeczywistego'
							from werkuren where WERKBONNUMMER = '$Bonn_value' order by DATUM";
				
				$result2 = mysqli_query($connect, $query2);

				   $rows = array();
                        $table = array();
                             $table['cols'] = array(
							   array('label' => 'Datum', 'type' => 'string'),
                               array('label' => 'RealTime', 'type' => 'string')		   
                             );
							 
							 
			 while($row = mysqli_fetch_array($result2))
				 {

				$zmienna =$row["CzasuRzeczywistego"] ;	
					$temp = array();
                        $temp[] = array('v' => (string) $row["DATUM"]);
                        $temp[] = array('v' => (string) $zmienna);
                        $rows[] = array('c' => $temp);				 
				 }	

				$table['rows'] = $rows;
				$jsonTable = json_encode($table);

			echo $jsonTable;
				 
			}
			else
			{
				echo "Bon pracy NIE JEST  na 90";
			}
			
		?>