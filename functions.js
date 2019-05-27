function funkcja_ajax(data_przedzial,nazwisko_imie, ile_row,NazwaTabeli)
{
	  document.getElementById("demo").innerHTML = "Work bonn for HacoSoftnumber: " + nazwisko_imie + ".";
	  
	 console.log("dataPrzedzial " + data_przedzial + " nazwisko_imie : " + nazwisko_imie + ",  ile_row : " + ile_row + ", nawatabeli: "+ NazwaTabeli);
	  
	   $.ajax({
                type: "POST",   			// 	post i get dzialaja
                url: "databaseFetch_BonnWorkers.php" ,
                data:  {d: data_przedzial,
						n: nazwisko_imie
						},
                success : function(result) { 
				
				console.log("arraj sprawdzic pustki: "+ result);
					var arr=JSON.parse(result);
					
					
					console.log("array length:" + Object.keys(arr.rows).length)
					
					
					// jezeli sa puste komorki w tabeli, wyszukaj i usun 
					if(Object.keys(arr.rows).length == 0 )
					{
						document.getElementById(NazwaTabeli).rows[ile_row].deleteCell(0);					
					}
					// jesli w komorce jest jakas data to nie usuwaj i wypelnij googlechartem
					if(Object.keys(arr.rows).length >  0)
					{

															
					 google.charts.load("current", {packages:["timeline"]});
					  google.charts.setOnLoadCallback(drawChart);
					  function drawChart() 
					  {					   // tutaj sprawdzic jak usunac te rowy gdzie nie bedzie danych z jquery
						var container = document.getElementById(NazwaTabeli).rows[ile_row];
						

						
						
						var chart = new google.visualization.Timeline(container);
						var dataTable = new google.visualization.DataTable();
						var data = new google.visualization.DataTable(result);

						
					
			 var return_first = function () {
				 
				var tmp = null;
				$.ajax({
					async: false,
					type: "POST", 
					url: "testPHP.php",
					datatype: "json",
					data:  {d: data_przedzial,
							xx:nazwisko_imie},
					success: function (data) {
						
						var q=JSON.parse(data);
						tmp = q;
					}
				});
				return tmp;
			};
			
			var return_last = function () {
				 			
				var tmp = null;
				$.ajax({
					async: false,
					type: "POST", 
					url: "testPHP2.php",
					datatype: "json",
					data:  {xz: data_przedzial,
							xx: nazwisko_imie},
					success: function (data) {
						
						var q=JSON.parse(data);
						tmp = q;
					}
					
				});
				return tmp;
			};
				
		
	data.addRows([[  'WorkTime ',data_przedzial, new Date(return_first()), new Date(return_last()) ]]);
						
		  var options = {
						 hAxis: { format: 'HH:mm' }
					  };  
						
			chart.draw(data,options);
				    }
                
					}
				}
            });	  
}


function funkcja_ajax_werkbon(nazwisko_imie)
{	 	  
	   $.ajax({
                type: "POST",   		
                url: "GetByBonnNumber.php" ,
                data:  {d: nazwisko_imie
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
						height: 450,
						timeline: {
						  groupByRowLabel: true
						}
					  };
	
				chart.draw(data,options);
				    }
                }
            });	  
}


function funkcja_ajax_ilosc_sztuk(werkbon)
{	  
	   $.ajax({
                type: "POST",   			// 	post i get dzialaja
                url: "fetch_ilosc_sztuk.php" ,
                data:  {d: werkbon
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
		console.log("xxxxx: " + xx[1]);
			
		var hacoN = document.getElementById("HacoSoftnumber").value;
		
		var fields = hacoN.split("  ");
		
		console.log("hacoSoft NUmber uciete: "+ fields[0]);
		
		for(index = 0; index < diffDays+1; index++)
		{
			funkcja_ajax(xx[index],hacoN,index, 'myTable');
		}
		
		zmniejszIloscCell();
	}

	
	function zmienRozmiar()
	{
		 var div = document.getElementById("wrapper");
				if(div) {
					div.style.height = "600px";
				}
	}
	
	function zmniejszIloscCell()
	{
		  var table = document.getElementById('myTable');
			for (var r = 0, n = table.rows.length; r < n; r++) {
				for (var c = 0, m = table.rows[r].cells.length; c < m; c++) {
					console.log("Sprawdzenie "+ c + "  " + table.rows[r].cells[c].innerHTML);
        }
    }
	}
	
	
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
	
	
	function PieChartTest(Bonn)
{															
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
							  data: { x: Bonn },					
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

		
		
function hide(idDiva, minH, maxH,buttonHide)
{
	  var x = document.getElementById(idDiva);
		  if (x.style.display === "none") {
			x.style.display = "block";
			document.getElementById(buttonHide).textContent = "Hide";
			

			var div = document.getElementById("wrapper");
				if(div) {
					div.style.height = maxH;
				}
	
			
		  } else {
			x.style.display = "none";
			document.getElementById(buttonHide).textContent = "Show";

				var div = document.getElementById("wrapper");
				if(div) {
					div.style.height = minH;
				}
		  }
}





            
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
				
				
			//	var projekt = '190517'
				var projekt = document.getElementById("ProjectNumber").value;
				console.log(projekt);
				
				$.ajax({
                type: "GET",   			// 	post i get dzialaja
                url: "fetch_database_by_project_number.php" ,
                data:  {xxx: projekt
						},
						
                success : function(result) { 
							
					var arr=JSON.parse(result);

					var arr_length = arr.rows.length; // dobrze
					
					
						// usuniecie wszystkich poprzednich przed dodaniem
						var Parent = document.getElementById("table1");
						while(Parent.hasChildNodes())
							{
							   Parent.removeChild(Parent.firstChild);
							}
						
							
			 // cos jak TH ale zbudowane na Cell
				var table = document.getElementById("table1");
						var row = table.insertRow(0);
						  
						  var cell1 = row.insertCell(0);
						  var cell2 = row.insertCell(1);
						  var cell3 = row.insertCell(2);
						  var cell4 = row.insertCell(3);
						  var cell5 = row.insertCell(4);
						  
						   cell1.style.height = "20px";
						  cell2.style.height = "20px";
						  cell3.style.height = "20px";
						  cell4.style.height = "20px";
						  cell5.style.height = "20px";
						  
							cell1.innerHTML ="Project";
					    	 cell2.innerHTML = "Werkbonnumber";
							cell3.innerHTML = "Status";
							cell4.innerHTML = "HOEVEELHEID";
							cell5.innerHTML = "Txt";
					
					var j = 0;
					for(var i = 1 ; i < arr_length ; i++)
					{
						
						  var table = document.getElementById("table1");
							// 	var row   = table.insertRow(0); row.insertCell(0).outerHTML = "<th>First</th>";  // rather than innerHTML		  
						  var row = table.insertRow(1);
						  
						  var cell1 = row.insertCell(0);
						  var cell2 = row.insertCell(1);
						  var cell3 = row.insertCell(2);
						  var cell4 = row.insertCell(3);
						  var cell5 = row.insertCell(4);
						  
						 console.log("result: " +" i: "+ i + " -- "+ arr.rows[i].c[j].v);
						  
						  
						  cell1.innerHTML = arr.rows[i].c[0].v;
					    	 cell2.innerHTML = arr.rows[i].c[1].v
					      cell3.innerHTML = arr.rows[i].c[2].v
						  cell4.innerHTML = arr.rows[i].c[3].v
						  cell5.innerHTML = arr.rows[i].c[4].v
						  
						  cell1.style.height = "20px";
						//	cell1.onclick = function(){testfun(3+1);};
						  cell2.style.height = "20px";
						  cell3.style.height = "20px";
						  cell4.style.height = "20px";
						  cell5.style.height = "20px";
						  
						  cell1.style.textAlign = "center";
						  cell2.style.textAlign = "center";
						  cell3.style.textAlign = "center";
						  cell4.style.textAlign = "center";
						  cell5.style.textAlign = "center";

						  

				  
					}			
                }
            });  
			}
            

			
			
  function testfun(komorka)
   {
	   console.log("test + ktora komorka: "+ komorka);
					var table = document.getElementById("table1");
							// 	var row   = table.insertRow(0); row.insertCell(0).outerHTML = "<th>First</th>";  // rather than innerHTML		  
						  var row = table.insertRow(komorka);
						  
						  var cell1 = row.insertCell(0);
						//  cell1.style.width = "200px";
						  cell1.colSpan = 5;
						  funkcja_ajax("2019-05-06",48321, 4, 'table1');
					//	  var cell2 = row.insertCell(1);
					//	  var cell3 = row.insertCell(2);
					//	  var cell4 = row.insertCell(3);
						//  var cell5 = row.insertCell(4);
   }			