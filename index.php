<!DOCTYPE html>
<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<title>ECharts</title>
<script src = "echarts.js"></script>
</head>
<body>
<form id = "submitform">
    From: <input type="date" id="from">
    To: <input type="date" id="to">
    Parameter ID: <input list = "values" id="parameter" placeholder="Enter the name of graph">
    <datalist id = "values">
    <option value="All_Graphs">
    <option value="Motor_Temperature">
    <option value="Battery_Voltage">
    <option value="Motor_Current">
    <option value="Motor_Power">
    <option value="Load">
    <option value="Hydraulic_Pressure">
    </datalist>
    <button type="button" id="day">1 day</button> 
    <button type="button" id="week">7 days</button> 
    <button type="button" id="month">1 month</button> 
    <button type="button" id="year">1 year</button> 
    <button type="button" id="years">5 years</button> 
    <button type="submit">Load Data</button>
    </form>
    <div id = "main" style="width: 100%;height: 800px;;"></div>
    <script type = "text/javascript" src="loadData.js">
    
    </script>
  </body>
</html>
