<?php
				$value_date = $_POST['xz'];       		// <- limit, ile danych ma zostac pobranych 10 100 brak ...
				$value_haco = $_POST['xx'];
		
			$connect = mysqli_connect("localhost", "root", "", "fatdb");
			
			$query = "select  distinct  fat.access.akcja, fat.access.`data`
			from fat.access
			left join fat.cards_name_surname_nrhacosoft
			on fat.access.id_karty = fat.cards_name_surname_nrhacosoft.id_karty
			where fat.cards_name_surname_nrhacosoft.HacoSoftnumber = '$value_haco'
			and fat.access.`data` like '$value_date%'
			and fat.access.akcja = 'wyjscie'
			order by fat.access.`data` desc limit 1";
				
			$result = mysqli_query($connect, $query);
			$row = mysqli_fetch_row($result);
			$dataWej = $row[1];
			
			$date1 = new DateTime($dataWej);   
		
				$datt = $date1->getTimestamp();		
				$d =   $datt .  '000';
				echo $d;
	
		?>