<?php
				$value_date = $_POST['d'];       		// <- limit, ile danych ma zostac pobranych 10 100 brak ...
				$value_haco = $_POST['xx'];

		
			$connect = mysqli_connect("localhost", "root", "", "fatdb");
			
			$query = "select  distinct  fat.access.akcja, fat.access.`data`
				from fat.access
				left join fat.cards_name_surname_nrhacosoft
				on fat.access.id_karty = fat.cards_name_surname_nrhacosoft.id_karty
				where fat.cards_name_surname_nrhacosoft.HacoSoftnumber = '$value_haco'
				and fat.access.`data` like '$value_date%'
				and fat.access.akcja = 'wejscie'
				order by fat.access.`data` asc limit 1";
				
			$result = mysqli_query($connect, $query);
			$row = mysqli_fetch_row($result);
			$dataWej = $row[1];
			
			$date1 = new DateTime($dataWej);   
		
				$datt = $date1->getTimestamp();		
				$z =  $datt .  '000';
				echo $z;
	
			
		//	$date_test = $date1->format('y-m-d H:i:s'); 

			// m - leading - ,,, n - without 0
			//$my_date = date('Y,m,d,H,i,s', strtotime('-1 months' , strtotime($date_test)));
	
			//echo ($my_date);	
			//echo(1553256400000);
			
		?>