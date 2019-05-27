<?php
// Database Structure 
$searchTerm = $_GET['term'];


$connect = mysqli_connect("localhost", "root", "", "fatdb");


$query ="select concat(HacoSoftnumber,'   ', nazwisko_imie) as HacoSoftnumber from fat.cards_name_surname_nrhacosoft
		       where HacoSoftnumber <> 0 and( HacoSoftnumber like '%$searchTerm%' or fat.cards_name_surname_nrhacosoft.nazwisko_imie
		        like '%$searchTerm%')";
			   
 $result = mysqli_query($connect, $query);
			   
while ($row=mysqli_fetch_array($result)) 
{
 $data[] = $row['HacoSoftnumber'];
}
//return json data
echo json_encode($data);
?>