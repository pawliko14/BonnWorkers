<?php
		$Bonn_value = $_POST['d'];       		// <- limit, ile danych ma zostac pobranych 10 100 brak ...

		
			$connect = mysqli_connect("localhost", "root", "", "fatdb");
			
			$query = "select STATUS  from rejestracja where WERKBON = '$Bonn_value' and status = 90";
				
			$result = mysqli_query($connect, $query);
			$row_1 = mysqli_fetch_row($result);
			$dataWej = $row_1[0];
			
			if($dataWej == '90')
			{
				$query2 = "select distinct 
		       (werkbon.HOEVEELHEID * werkbon.WERKMINUTEN) + werkbon.INSTELMINUTEN as CzasTeoretyczny,
		       (select sum(TIJDGEPRESTEERDH* 60 + TIJDGEPRESTEERDM60) from werkuren where WERKBONNUMMER ='$Bonn_value') as CzasRzeczywisty,
		      (((werkbon.HOEVEELHEID * werkbon.WERKMINUTEN + werkbon.INSTELMINUTEN) ) / ((select sum(TIJDGEPRESTEERDH* 60 + TIJDGEPRESTEERDM60) from werkuren where WERKBONNUMMER ='$Bonn_value'))) * 100
		      as 'wydajnosc' 
		      from werkuren
		       left join werkbon
		       on werkuren.WERKBONNUMMER = werkbon.WERKBONNUMMER
		       left join rejestracja
		       on werkuren.WERKBONNUMMER = rejestracja.WERKBON
		       where werkuren.WERKBONNUMMER = '$Bonn_value'
		       order by rejestracja.DATUM";
				
				$result2 = mysqli_query($connect, $query2);

				   $rows = array();
                        $table = array();
                             $table['cols'] = array(
							   array('label' => 'CzasTeoretyczny', 'type' => 'string'),
                               array('label' => 'CzasRzeczywisty', 'type' => 'string'),
							   array('label' => 'wydajnosc', 'type' => 'string')							   
                             );
							 
							 
			 while($row = mysqli_fetch_array($result2))
				 {			
						$temp = array();
					    $temp[] = array('v' => (string) $row['CzasTeoretyczny']);
                        $temp[] = array('v' => (string) $row['CzasRzeczywisty']);
						$temp[] = array('v' => (string) $row['wydajnosc']);
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