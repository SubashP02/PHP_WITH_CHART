<?php
$link = mysqli_connect("35.213.182.112", "uiqbfkitr4vck", "lpqu4bjvwaea");
mysqli_select_db($link,"dbsdxhahexslqm");
$from = $_POST['from'];
$to = $_POST['to'];
$parameter = $_POST['parameter'];
$week = $_POST['week'];
if($parameter=='All_Graphs'){
  $parameter=0;
}elseif($parameter=='Motor_Temperature'){
  $parameter=1;
}
elseif($parameter=='Battery_Voltage'){
  $parameter=2;
}
elseif($parameter=='Motor_Current'){
  $parameter=3;
}
elseif($parameter=='Motor_Power'){
  $parameter=4;
}
elseif($parameter=='Load'){
  $parameter=5;
}
elseif($parameter=='Hydraulic_Pressure'){
  $parameter=6;
}
if($from>0&&$to>0&&$parameter){
    $res = mysqli_query($link,"SELECT *, DATE(device_event_time) AS event_date FROM vehicle_telemetry_poc where DATE(device_event_time) between '$from' and  '$to' AND p_id = '$parameter'");
    $value = array();
    $date = array();
    while($row=mysqli_fetch_array($res)){
      $value[]=$row["sensor_value"];
      $date[] =$row["event_date"];
  }
}
elseif($from && !$to){
    $res = mysqli_query($link,"SELECT *, DATE(device_event_time) AS event_date 
    FROM vehicle_telemetry_poc 
    WHERE DATE(device_event_time) BETWEEN '$from' AND (SELECT MAX(DATE(device_event_time)) FROM vehicle_telemetry_poc);
    ");
     $value = array();
     $date = array();
     while($row=mysqli_fetch_array($res)){
       $value[]=$row["sensor_value"];
       $date[] =$row["event_date"];
   }
}
elseif($from&&$to){
  $res = mysqli_query($link,"SELECT *, DATE(device_event_time) AS event_date FROM vehicle_telemetry_poc where DATE(device_event_time) between '$from' and  '$to'");
  $value = array();
  $date = array();
  while($row=mysqli_fetch_array($res)){
      $value[]=$row["sensor_value"];
      $date[] =$row["event_date"];
  }
}
else if($week==1&&$parameter){
  $res = mysqli_query($link,"SELECT *, TIME_FORMAT(device_event_time, '%h:%i:%s %p') AS event_time_12hr 
  FROM vehicle_telemetry_poc vtp 
  WHERE DATE(device_event_time) BETWEEN DATE_SUB('2024-03-30', INTERVAL 1 DAY) AND '2024-03-30' 
  AND p_id = '$parameter';
  ");
  $value = array();
  $date = array();
  while($row=mysqli_fetch_array($res)){
    $value[]=$row["sensor_value"];
    $date[] =$row["event_time_12hr"];
}
}
else if($week==2&&$parameter){
  $res = mysqli_query($link,"SELECT *, 
  CONCAT(DATE(device_event_time), ' ', TIME_FORMAT(device_event_time, '%h:%i %p')) AS event_datetime 
FROM vehicle_telemetry_poc vtp 
WHERE DATE(device_event_time) BETWEEN DATE_SUB('2024-03-30', INTERVAL 7 DAY) AND '2024-03-30' 
AND p_id = '$parameter';");
  $value = array();
  $date = array();
  while($row=mysqli_fetch_array($res)){
    $value[]=$row["sensor_value"];
    $date[] =$row["event_datetime"];
}
}
else if($week==3&&$parameter){
  $res = mysqli_query($link,"SELECT *, DATE(device_event_time) AS event_date FROM vehicle_telemetry_poc vtp
   WHERE DATE(device_event_time) BETWEEN DATE_SUB('2024-03-30', INTERVAL 1 MONTH) AND '2024-03-30' AND p_id = '$parameter';");
  $value = array();
  $date = array();
  while($row=mysqli_fetch_array($res)){
    $value[]=$row["sensor_value"];
    $date[] =$row["event_date"];
}
}
else if($week==4&&$parameter){
  $res = mysqli_query($link,"SELECT *, DATE(device_event_time) AS event_date FROM vehicle_telemetry_poc vtp
   WHERE DATE(device_event_time) BETWEEN DATE_SUB('2024-03-30', INTERVAL 1 YEAR) AND '2024-03-30' AND p_id = '$parameter';");
  $value = array();
  $date = array();
  while($row=mysqli_fetch_array($res)){
    $value[]=$row["sensor_value"];
    $date[] =$row["event_date"];
}
}
else if($week==5&&$parameter){
  $res = mysqli_query($link,"SELECT *, DATE(device_event_time) AS event_date FROM vehicle_telemetry_poc vtp 
  WHERE DATE(device_event_time) BETWEEN DATE_SUB('2024-03-30', INTERVAL 5 YEAR) AND '2024-03-30' AND p_id = '$parameter';");
  $value = array();
  $date = array();
  while($row=mysqli_fetch_array($res)){
    $value[]=$row["sensor_value"];
    $date[] =$row["event_date"];
}
}
else if($week==1&&$parameter==0){
  $res = mysqli_query($link,"SELECT *, DATE(device_event_time) AS event_date FROM vehicle_telemetry_poc vtp 
  WHERE DATE(device_event_time) BETWEEN DATE_SUB('2024-03-30', INTERVAL 1 DAY) AND '2024-03-30';");
  $value = array();
  $date = array();
  while($row=mysqli_fetch_array($res)){
    $value[]=$row["sensor_value"];
    $date[] =$row["event_date"];
}
}
else if($week==2&&$parameter==0){
  $res = mysqli_query($link,"SELECT *, DATE(device_event_time) AS event_date FROM vehicle_telemetry_poc vtp 
  WHERE DATE(device_event_time) BETWEEN DATE_SUB('2024-03-30', INTERVAL 7 DAY) AND '2024-03-30';");
  $value = array();
  $date = array();
  while($row=mysqli_fetch_array($res)){
    $value[]=$row["sensor_value"];
    $date[] =$row["event_date"];
}
}
else if($week==3&&$parameter==0){
  $res = mysqli_query($link,"SELECT *, DATE(device_event_time) AS event_date FROM vehicle_telemetry_poc vtp 
  WHERE DATE(device_event_time) BETWEEN DATE_SUB('2024-03-30', INTERVAL 1 MONTH) AND '2024-03-30';");
  $value = array();
  $date = array();
  while($row=mysqli_fetch_array($res)){
    $value[]=$row["sensor_value"];
    $date[] =$row["event_date"];
}
}
else if($week==4&&$parameter==0){
  $res = mysqli_query($link,"SELECT *, DATE(device_event_time) AS event_date FROM vehicle_telemetry_poc vtp 
  WHERE DATE(device_event_time) BETWEEN DATE_SUB('2024-03-30', INTERVAL 1 YEAR) AND '2024-03-30';");
  $value = array();
  $date = array();
  while($row=mysqli_fetch_array($res)){
    $value[]=$row["sensor_value"];
    $date[] =$row["event_date"];
}
}
else if($week==5&&$parameter==0){
  $res = mysqli_query($link,"SELECT *, DATE(device_event_time) AS event_date FROM vehicle_telemetry_poc vtp 
  WHERE DATE(device_event_time) BETWEEN DATE_SUB('2024-03-30', INTERVAL 5 YEAR) AND '2024-03-30';");
  $value = array();
  $date = array();
  while($row=mysqli_fetch_array($res)){
    $value[]=$row["sensor_value"];
    $date[] =$row["event_date"];
}
}
else if($parameter){
  $res = mysqli_query($link,"SELECT *, DATE(device_event_time) AS event_date FROM vehicle_telemetry_poc 
  where p_id = '$parameter'");
  $value = array();
  $date = array();
  while($row=mysqli_fetch_array($res)){
    $value[]=$row["sensor_value"];
    $date[] =$row["event_date"];
}

}

else{
  $value = array();
  $date = array();
  $res = mysqli_query($link,"SELECT *, DATE(device_event_time) AS event_date FROM vehicle_telemetry_poc");
  while($row=mysqli_fetch_array($res)){
    $value[]=$row["sensor_value"];
    $date[] =$row["event_date"];
}
  }

$total_jsondata=array(
  "jsonvalue" => $value,
  "jsondate" => $date,
  "week" => $week,
  "from" => $from,
  "to" => $to,
);

echo json_encode($total_jsondata);

?>