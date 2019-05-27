
<html>
 <head>
 
 <link rel="stylesheet" href="styles.css" type="text/css">
 
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


	<script type="text/javascript" href="functions.js"></script>

<style>
	table, td {
	  border: 1px solid black;
	  height:170px;
	}
</style>


<script type="text/javascript">

$(function() 
{
	
 $( '#HacoSoftnumber').autocomplete({
	 minLength: 2,
	 source: 'autocomplete.php'
  
 });
});

</script>


<script type="text/javascript">

$(function() 
{
	
 $( '#ProjectNumber').autocomplete({
	 minLength: 2,
	 source: 'autocomplete_Project.php'
  
 });
});

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
					<button onclick="hide('myTable','350','700','button_Hide')" id="button_Hide" class="HideItButton">Hide it</button>

	</div>
	
	<div class="divTwo" id ="ChartTable">
	
			<p id="demo"></p> 

	
		<table ng-app="autoRefreshApp" ng-controller="autoRefreshController" id="myTable" class="fixed_header"></table>
	</div>
</div>


		<p id="tekst_chart1" style="display: none;">Werkbon chart divided by the number of worked hours on a given day </p>

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
	   	<div  ng-app="autoRefreshApp" ng-controller="autoRefreshController"id="chart" style="width: 100%; height: 21%; margin-left:auto; margin-right:auto"></div>

		
		
		
		
		
		
		
	<div id="divProjectNumber">
             ProjectNumber <input type="text" name="age" id="ProjectNumber" value="190517"/><br/><br/>
        <button onclick="addRowJQuery();">Try ProjectNr</button>
		<button onclick="hide('table1','350','700','hidePrNumber')" id="hidePrNumber">hide</button><br/><br/>
        <table ng-app="autoRefreshApp" ng-controller="autoRefreshController" id ="table1"  border="1" >
            
        </table>
		<br/>
		<br/><br/><br/><br/><br/><br/><br/><br/>
	</div>	
			
	
 </body> 
</html>