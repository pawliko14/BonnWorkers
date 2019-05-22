
<html>
 <head>
 
 <link rel="stylesheet" href="style.css" type="text/css">
 
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
   <meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<script type="text/javascript" src="functions.js"></script>
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
   
   
   <!--do skryptu z autouzupelnianiem -->
	<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>

<style>
table, td {
  border: 1px solid black;
  height:200px;
}

.usersData {
	display:inline-block;
}

#wrapper {
  display: flex;
}
#wrapper2 {
	display: flex;
}

.divOne {
	
text-align: center;

 margin: auto;
  width: 60%;
  padding: 10px;
	
  flex: 0 0 15%;

}
.divTwo {
   flex: 1;
    overflow: auto;
}

.divTwo2 {
	
	text-align: center;
vertical-align: middle;
	
   flex: 1;
	height: 600px;
}

#werkbonSumbit
{
	margin-top:20px;
}


.divThree
{
  
  font-size: 28px;
  font-style: oblique;
  color: #000;
  text-align: center;
  margin-top: 20px;
  margin-left: 5px;
  display: table-cell;
  vertical-align: middle;
	flex: 20%;
}




.dataOd
{
	width:100%;
	text-align:center;
	font-size:20px;
}
.dataDo
{
	width:100%;
	text-align:center;
		font-size:20px;

}
.workerID
{
	width:100%;
	text-align:center;
	word-wrap: normal;
}
		


.fixed_header {
	height: 500px;
	width:98%;
	margin-left:5px;
}

.fixed_header tbody{
  overflow: auto;
  height: 100px;
}

.fixed_header thead {
  background: black;
  color:#fff;
}

.fixed_header th, .fixed_header td {
  padding: 5px;
  text-align: left;
}

.workerID {
	  margin-bottom: 20px;
}
.dataOd {
	margin-bottom: 40px;
}

.dataDo {
	margin-bottom: 40px;
}
.TryItButton{
  padding: 8px 18px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 20px;
  margin: 2px 1px;
  cursor: pointer;
}

.HideItButton
{
  padding: 8px 18px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 20px;
  margin: 2px 1px;
  cursor: pointer;
}
.TryWerkbonButton
{
  padding: 12px 26px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 20px;
  margin: 2px 1px;
  cursor: pointer;	
}

#tekst_chart1
{
	font-size:32px;
	text-align:center;
	margin: 4px 2px;
	padding:10px 16px;
}
#tekst_chart2
{
	font-size:32px;
	text-align:center;
	margin: 4px 2px;
	padding:10px 16px;
}
#tekst_chart3
{
	font-size:32px;
	text-align:center;
	margin: 4px 2px;
	padding:10px 16px;
}

.werkbonnumberInput
{
	text-align:center;
}

</style>
  
	
	
	
<script>

function funkcja_ajax(data,nazwisko_imie, ile)
{
	  document.getElementById("demo").innerHTML = "Work bonn for HacoSoftnumber: " + nazwisko_imie + ".";
	  
	  var duppa = data;
	  var duppa2 = nazwisko_imie;
	  
	   $.ajax({
                type: "POST",   			// 	post i get dzialaja
                url: "databaseFetch_BonnWorkers.php" ,
                data:  {d: duppa,
						n: duppa2
						},
                success : function(result) { 
				
				
					var arr=JSON.parse(result);
					console.log(arr);

															
					 google.charts.load("current", {packages:["timeline"]});
					  google.charts.setOnLoadCallback(drawChart);
					  function drawChart() 
					  {					  
						var container = document.getElementById('myTable').rows[ile];
						var chart = new google.visualization.Timeline(container);
						var dataTable = new google.visualization.DataTable();
						var data = new google.visualization.DataTable(result);

						
					
			 var return_first = function () {
				 
				var pipi =  duppa;	
				var nrHaco = duppa2;
				var tmp = null;
				$.ajax({
					async: false,
					type: "POST", 
					url: "testPHP.php",
					datatype: "json",
					data:  {d: pipi,
							xx:nrHaco},
					success: function (data) {
						
						var q=JSON.parse(data);
						tmp = q;
					}
				});
				return tmp;
			};
			
			var return_last = function () {
				 
				var omg =  duppa;
				var nrHaco = duppa2;
				
				var tmp = null;
				$.ajax({
					async: false,
					type: "POST", 
					url: "testPHP2.php",
					datatype: "json",
					data:  {xz: omg,
							xx: nrHaco},
					success: function (data) {
						
						var q=JSON.parse(data);
						tmp = q;
					}
				});
				return tmp;
			};
				
		
	data.addRows([[  'WorkTime ',duppa, new Date(return_first()), new Date(return_last()) ]]);
						
		  var options = {
						 hAxis: { format: 'HH:mm' }
					  };  
						
			chart.draw(data,options);
				    }
                }
            });
	  
	  
}

</script>


<script>

function funkcja_ajax_werkbon(nazwisko_imie)
{
	  
	  var duppa = nazwisko_imie;
	  
	   $.ajax({
                type: "POST",   			// 	post i get dzialaja
                url: "GetByBonnNumber.php" ,
                data:  {d: duppa
						},
                success : function(result) { 
				
				
					var arr=JSON.parse(result);
					console.log("test: " + arr);

															
					 google.charts.load("current", {packages:["timeline"]});
					  google.charts.setOnLoadCallback(drawChart);
					  function drawChart() 
					  {					  
						var container = document.getElementById('chart');
						
						
						var chart = new google.visualization.Timeline(container);
						var dataTable = new google.visualization.DataTable();
						var data = new google.visualization.DataTable(result);

					 var options = {
						 hAxis: { format: 'HH:mm' }
					  };
	
				chart.draw(data,options);
				    }
                }
            });
	  
	  
}


function funkcja_ajax_ilosc_sztuk(werkbon)
{
	  
	  var werk = werkbon;
	  
	   $.ajax({
                type: "POST",   			// 	post i get dzialaja
                url: "fetch_ilosc_sztuk.php" ,
                data:  {d: werk
						},
                success : function(result) { 
				
				
					var arr=JSON.parse(result);
					console.log("test: " + arr);

															
					 google.charts.load("current", {packages:["timeline"]});
					  google.charts.setOnLoadCallback(drawChart);
					  function drawChart() 
					  {					  
						var container = document.getElementById('ilosc_sztuk');
						
						
						var chart = new google.visualization.Timeline(container);
						var dataTable = new google.visualization.DataTable();
						var data = new google.visualization.DataTable(result);

					 var options = {
						 hAxis: { format: 'HH:mm' }
					  };
	
				chart.draw(data,options);
				    }
                }
            });
	  
	  
}


</script>



<script>

	function submit()
	{
		zmienRozmiar();
		
		var index;
		var dataPocz = document.getElementById("dataDnia").value;
		var dataKon = document.getElementById("dataDniaKoniec").value;

		var dateP = new Date(dataPocz);
		var dateK = new Date(dataKon);
		
		var diff = Math.abs(dateK-dateP);
		var diffDays = diff/86400000; // bedzie zawsze o 1 mniejsze
		
		// usuniecie wszystkich poprzednich przed dodaniem
		var Parent = document.getElementById("myTable");
			while(Parent.hasChildNodes())
			{
			   Parent.removeChild(Parent.firstChild);
			}
		
			// dodanei rowow w zaleznosci od ilosci dni
				for(i = 0 ; i < diffDays+1;i++ )
				{	
				  var table = document.getElementById("myTable");
				// 	var row   = table.insertRow(0); row.insertCell(0).outerHTML = "<th>First</th>";  // rather than innerHTML		  
				  var row = table.insertRow(0);
				  var cell1 = row.insertCell(0);
				  cell1.innerHTML = "NEW CELL1";
				  
				}
		
		var datePTimesTamp = dateP.getTime();
		var dateKTimesTamp = dateK.getTime();
		console.log("timestamp: "+ datePTimesTamp);
		
		var xx = [];
		for(var i = 0 ; i < diffDays+1 ; i++)
		{
			var d = datePTimesTamp+ (86400000*i);
			
				var todate=new Date(d).getDate();
								
					if(todate.length = 1)
					{
						todate = '0' + todate;
						todate = todate.slice(-2)
					}
					
				var tomonth=new Date(d).getMonth()+1;
					if(tomonth.length = 1)
					{
						tomonth = '0' + tomonth;
					}
				var toyear=new Date(d).getFullYear();
				var original = toyear+'-'+tomonth+'-'+todate;
				
				
			
			xx.push(original);
		}		
			
		var hacoN = document.getElementById("HacoSoftnumber").value;
		
		var fields = hacoN.split("  ");
		
		console.log("hacoSoft NUmber uciete: "+ fields[0]);
		
		for(index = 0; index < diffDays+1; index++)
		{
			funkcja_ajax(xx[index],hacoN,index)
		}
		
				
	}

	
	function zmienRozmiar()
	{
		 var div = document.getElementById("wrapper");
				if(div) {
					div.style.height = "600px";
				}
	}
	
</script>


	
<script>

function submit_by_werkbon()
	{
			
		var w = document.getElementById('WerkbonNumber').value;

		document.getElementById('tekst_chart1').style.display = "inline-block";
		document.getElementById('tekst_chart2').style.display = "inline-block";
		document.getElementById('tekst_chart3').style.display = "inline-block";

		console.log(w);
		
		funkcja_ajax_werkbon(w)
		
		PieChartTest(w);
		
		funkcja_ajax_ilosc_sztuk(w);
		
		czas_teo_rze(w);
		
		czas_teo_rze_bez_install(w);
	}

</script>



<script>

function PieChartTest(Bonn)
{
	var duppa = Bonn;															
						google.charts.load("current", {packages:["corechart"]});
						google.charts.setOnLoadCallback(drawChart);
						function drawChart() 
						{
						var dataTable = new google.visualization.DataTable();
						
						 var jsonData = $.ajax({
							  type: "POST",
							  url: "PieChart.php",
							  dataType: "json",
							  async: false,
							  data: { x: duppa },					
							  }).responseText;
							  
					if(jsonData == 'Bon pracy NIE JEST  na 90')
					{
					document.getElementById('Piechart').innerHTML= "Bon pracy NIE JEST  na 90";

					}
							  
					else	
					{
					 // konwersja na floatval
							 var arr = JSON.parse(jsonData);
							 for(var i = 0;i <Object.keys(arr.rows).length;i++){
								arr.rows[i].c[1].v= parseFloat(arr.rows[i].c[1].v)
								console.log(arr.rows[i].c[1].v)	;
							}
							 
							 console.log(jsonData);
							 data2 = new google.visualization.DataTable(arr);

						
					var options = {
						  title: 'Employee effenciency'
						   ,chartArea:{left:100,width:"100%",height:"70%"}
						  , legend: { position: 'right', alignment: 'start' }
						  ,height: 600
						  ,width: 700
						  ,is3D:true
						 
						};
					
				
					var chart = new google.visualization.PieChart(document.getElementById('Piechart'));
					chart.draw(data2,options);
					
				    }	
					}						
						
													 
							
}

</script>

<script>

	function czas_teo_rze(werkbon){
		
		  $.ajax({
                type: "POST",   			// 	post i get dzialaja
                url: "Czas_teo_rze.php" ,
                data:  {d:werkbon
						},
						
                success : function(result) { 
							
					var arr=JSON.parse(result);

					var teoret =timeConvert(arr.rows[0].c[0].v);
					var rzecz =timeConvert(arr.rows[0].c[1].v);
					var procent = (arr.rows[0].c[2].v + "%");

											

				document.getElementById('teoretyczny').innerHTML= "Czas teoretyczny: " + "<br />" + teoret;
				document.getElementById('rzeczywisty').innerHTML= "Czes rzeczywisty: "+ "<br />" +rzecz;
				document.getElementById('skutecznosc').innerHTML= "wydajnosc pracownika: "+ "<br />" + procent;

							
                }
            });  
		
		
	}
	
	function czas_teo_rze_bez_install(werkbon){
		
		  $.ajax({
                type: "POST",   			// 	post i get dzialaja
                url: "Czas_teo_rze_bez_Instalminuten.php" ,
                data:  {d:werkbon
						},
						
                success : function(result) { 
						
					var arr=JSON.parse(result);				

					var teoret =timeConvert(arr.rows[0].c[0].v);
					var rzecz =timeConvert(arr.rows[0].c[1].v);
					var procent = (arr.rows[0].c[2].v + "%");

											

			//	document.getElementById('teoretycznyBez').innerHTML= "Czas teoretyczny bez: " + "<br />" + teoret;
			//	document.getElementById('rzeczywistyBez').innerHTML= "Czes rzeczywisty bez: "+ "<br />" +rzecz;
				document.getElementById('skutecznoscBez').innerHTML= "wydajnosc pracownika bez ustawiania maszyny: "+ "<br />" + procent;

							
                }
            });  
		
		
	}
	
	function timeConvert(n) {
		var num = n;
		var hours = (num / 60);
		var rhours = Math.floor(hours);
		var minutes = (hours - rhours) * 60;
		var rminutes = Math.round(minutes);
		return  rhours + " hour(s) and " + rminutes + " minute(s).";
		}
	

</script>

<script type="text/javascript">

$(function() 
{
	
 $( '#HacoSoftnumber').autocomplete({
	 minLength: 2,
	 source: 'autocomplete.php'
  
 });
});

</script>

<script>

function hide()
{
	  var x = document.getElementById("myTable");
		  if (x.style.display === "none") {
			x.style.display = "block";
			document.getElementById("button_Hide").textContent = "Hide";
			

			var div = document.getElementById("wrapper");
				if(div) {
					div.style.height = "700px";
				}
	
			
		  } else {
			x.style.display = "none";
			document.getElementById("button_Hide").textContent = "Show";

				var div = document.getElementById("wrapper");
				if(div) {
					div.style.height = "350px";
				}
		  }
}




</script>

  <script>
            
            function addRow()
            {
                // get input values
                var fname = document.getElementById("fname").value;
                 var lname = document.getElementById("lname").value;
                  var age = document.getElementById("age").value;
                  
                  // get the html table
                  // 0 = the first table
                  var table = document.getElementById("table1");
                  
                  // add new empty row to the table
                  // 0 = in the top 
                  // table.rows.length = the end
                  // table.rows.length/2+1 = the center
                  var newRow = table.insertRow(0);
                  
                  // add cells to the row
                  var cel1 = newRow.insertCell(0);
               //   var cel2 = newRow.insertCell(1);
              //    var cel3 = newRow.insertCell(2);
                  
                  // add values to the cells
                  cel1.innerHTML = fname;
               //   cel2.innerHTML = lname;
                //  cel3.innerHTML = age;
            }
			function addRowJQuery()
			{
				var projekt = '190517'
				
				$.ajax({
                type: "POST",   			// 	post i get dzialaja
                url: "fetch_database_by_project_number.php" ,
                data:  {d:projekt
						},
						
                success : function(result) { 
							
					var arr=JSON.parse(result);

					var arr_length = arr.rows.length; // dobrze
					
					
					for(var i = 0 ; i < arr_length ; i++)
					{
						  var table = document.getElementById("table1");
							// 	var row   = table.insertRow(0); row.insertCell(0).outerHTML = "<th>First</th>";  // rather than innerHTML		  
						  var row = table.insertRow(0);
						  
						  var cell1 = row.insertCell(0);
						  var cell2 = row.insertCell(1);
						  var cell3 = row.insertCell(2);
						  var cell4 = row.insertCell(3);
						  var cell5 = row.insertCell(4);
						  
						 // console.log("result: " + arr.rows[0].c[i].v);
						  
						  var m = arr.rows[0].c[i].v[0];
						  cell1.innerHTML = arr.rows[0].c[i].v;
						//  cell2.innerHTML = arr.rows[1].c[i].v
					//	  cell3.innerHTML = arr.rows[2].c[i].v
					//	  cell4.innerHTML = arr.rows[3].c[i].v
					//	  cell5.innerHTML = arr.rows[4].c[i].v
				  
					}
					console.log(arr);
					console.log(arr_length);
							console.log(arr.rows[1].c[1].v + " " + arr.rows[1].c[0].v + " " + arr.rows[1].c[2].v)				

			//	document.getElementById('teoretyczny').innerHTML= "Czas teoretyczny: " + "<br />" + teoret;
			//	document.getElementById('rzeczywisty').innerHTML= "Czes rzeczywisty: "+ "<br />" +rzecz;
			//	document.getElementById('skutecznosc').innerHTML= "wydajnosc pracownika: "+ "<br />" + procent;

							
                }
            });  
			}
            
   </script>

 <body>
 <div id="wrapper">
	 <div class="divOne" id ="usersData">
			<form action="">
				Worker full name: <input type="text" class="workerID" id="HacoSoftnumber" name="q" value="48321"></input>
				Starting Date  <input type="date" class="dataOd" id="dataDnia" name="workerDataInCompany" value="2019-05-04"></input>
				Ending Date  <input type="date" class="dataDo" id="dataDniaKoniec" name="workerDataInCompanyKoniec" value="2019-05-12"></input>
			</form>
					<button onclick="submit()" id="button_sumbit" class="TryItButton">Try it</button>
					<button onclick="hide()" id="button_Hide" class="HideItButton">Hide it</button>

	</div>
	<div class="divTwo" id ="ChartTable">
	
			<p id="demo"></p>

	
		<table ng-app="autoRefreshApp" ng-controller="autoRefreshController"id="myTable" class="fixed_header">

		</table>
	</div>
</div>


		<p id="tekst_chart1" style="display: none;">Werkbon chart divided by the number of hours worked on a given day </p>

	<div id="wrapper2">	
		
		<div class="divOne">
			Werkbon Number: <input type="text" id="WerkbonNumber" name="q" value="893785" class="werkbonnumberInput"></input>
			<button onclick="submit_by_werkbon()" id ="werkbonSumbit" class="TryWerkbonButton">Try Werkbon</button>			
		</div>
	
		
		<div class="divTwo2">
			<div  ng-app="autoRefreshApp" ng-controller="autoRefreshController"id="Piechart"></div>
		</div>
		
		<div class="divThree">
	
					<p id="teoretyczny"></p>	
					<p id="rzeczywisty"></p>	
					<p id="skutecznosc"></p>
					
					<p id="teoretycznyBez"></p>	
					<p id="rzeczywistyBez"></p>	
					<p id="skutecznoscBez"></p>
		</div>

</div>
				<p id="tekst_chart2" style="display: none;"> Workbon in Timeline chart with the number of pieces made on a given day </p>
		<div  ng-app="autoRefreshApp" ng-controller="autoRefreshController"id="ilosc_sztuk" style="width: 100%; height:30%; margin-left:auto; margin-right:auto"></div>

		
		<p id="tekst_chart3" style="display: none;"> Workbon in Timeline chart for specific person</p>
	   	<div  ng-app="autoRefreshApp" ng-controller="autoRefreshController"id="chart" style="width: 100%; height: 20%; margin-left:auto; margin-right:auto"></div>

		
		
		
		
		
		
		
		     First Name: <input type="text" name="fname" id="fname" /><br/><br/>
              Last Name: <input type="text" name="lname" id="lname" /><br/><br/>
             Age: <input type="text" name="age" id="age" /><br/><br/>
        <button onclick="addRowJQuery();">Add Row</button><br/><br/>

        <table id ="table1" border="1" >
            
            <tr>
                <th>Project</th>
                <th>Werkbonnumber</th>
                <th>Status</th>
				<th>HOEVEELHEID</th>
				<th>Txt</th>
            </tr>
            
            <tr>
                <td>2/190517</td>
                <td>922057</td>
                <td>90</td>
				<td> 1 </td>
				<td> Grawerka itd.. </td>
            </tr>
            
            
        </table>
		
		
		
		
	
 </body>
 
 
 
 
 
 
</html>