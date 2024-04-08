$(document).ready(function(){
    var week = 0;
      $('#submitform').submit(function(event){
          event.preventDefault();
          var from = $('#from').val();
          var to = $('#to').val();
          var parameter = $('#parameter').val();
          $('#day').click(function(){
            week = 1;
          fetchData(from,to,parameter,week);
          });
          $('#week').click(function(){
              week = 2;
          fetchData(from,to,parameter,week);
          });
          $('#month').click(function(){
            week = 3;
          fetchData(from,to,parameter,week);
          });
          $('#year').click(function(){
            week = 4;
          fetchData(from,to,parameter,week);
          });
          $('#years').click(function(){
            week = 5;
          fetchData(from,to,parameter,week);
          });
              
          fetchData(from,to,parameter,week);
      })
      function fetchData(from,to,parameter,week){
      var method = from||parameter ? 'POST':'GET';
      $.ajax({
      method: method,
      url: 'db.php',
      data: { from: from, to: to ,parameter: parameter ,week:week},
      success: function(response) {
      console.log("Data collected between " + from + " and " + to + ":with parameter id of "+ parameter);
      console.log(response);
      var data_from_backend = JSON.parse(response);
      var value = data_from_backend.jsonvalue
      var date = data_from_backend.jsondate
      console.log("date where taken from db "+date);
      console.log("values where taken from db "+value);
      var myChart = echarts.init(document.getElementById('main'));
      var chartDom = document.getElementById('main');
      var myChart = echarts.init(chartDom);
      var option;
      if(parameter == 'Motor_Temperature'){
        Text = 'Motor Temperature';
        degreeFormat = '{value} °C';
        yAxisname = 'Temperature in C'
      }else if(parameter == 'Battery_Voltage'){
        Text = 'Battery Voltage'
        degreeFormat = '{value} v'
        yAxisname = 'Voltage in v'
      }else if(parameter == 'Motor_Current'){
        Text = 'Motor Current'
        degreeFormat = '{value} A'
        yAxisname = 'current in A'
      }else if(parameter == 'Motor_Power'){
        Text = 'Motor Power'
        degreeFormat = '{value} W'
        yAxisname = 'Power in w'
      }else if(parameter == 'Load'){
        Text = 'Load'
        degreeFormat = '{value} kg'
        yAxisname = 'load in kg'
      }else if(parameter == 'Hydraulic_Pressure'){
        Text = 'hydralyic pressure'
        degreeFormat = '{value} psi'
        yAxisname = 'pressure in psi'
      }else{
        Text = 'Sensor Values of Vehicles'
        degreeFormat = '{value}'
        yAxisname = 'Value'
      }
option = {
    title: {
        text: Text,
        left: '45%'
      },
      xAxis: [
    {
      type: 'category',
      axisTick: {
        alignWithLabel: true
      },
      axisLabel: {
        rotate: 0
      },
      data: date
      /////////////////////////////////////////////////////////////
    }
  ],
  grid: {
        left: '15%',
        right: '15%',
        bottom: '10%'
      },
      yAxis: [
    {
      type: 'value',
      name: yAxisname,
      position: 'left',
      axisLabel: {
        formatter: degreeFormat
      },
      data: value
    }
  ],
 

  tooltip: {
    trigger: 'axis',
    axisPointer: {
      type: 'cross',
      label: {
        backgroundColor: '#6a7985'
      }
    }
  },
  dataZoom: [
        {
          startValue: '2024-01-11'
        },
        {
          type: 'inside'
        }
      ],
  visualMap: {
        top: 50,
        right: 10,
        pieces: [
          {
            gt: 0,
            lte: 50,
            color: '#93CE07'
          },
          {
            gt: 50,
           
            color: '#AC3B2A'
          }
        ],
        outOfRange: {
          color: '#999'
        }
      },
  series: [
   
    {
      symbolSize: 13,
      data: value,
      //data:[15,32,76,9,33,11,23,14, 43,13, 65,10, 43,14, 98,12, 56,9, 34,16, 68,3, 12,12, 16,2, 18,1, 65,4, 43,6, 25,12, 54,12, 46,7, 32,5, 21],
      type: 'scatter'
    }
  ]
};

option && myChart.setOption(option);
                },
                error: function(xhr, status, error) {
                    console.error("Error:", error);
                }
              },
              alert("successfully grabbed the data"));
        }
    });