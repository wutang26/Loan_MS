<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <title>Member Statics</title>

  <!-- Optional CSS -->
  <style>
    body {
      font-family: Arial, sans-serif;
      padding: 20px;
    }
    .highcharts-figure {
      width: 80%;
      max-width: 800px;
      margin: 0 auto;
    }
    #container {
      height: 400px;
    }
    .highcharts-description {
      text-align: center;
      margin-top: 10px;
      font-size: 14px;
      color: #555;
    }
  </style>
</head>
<body>

  <figure class="highcharts-figure">
    <div id="container"></div>
    <p class="highcharts-description">
      A basic column chart comparing estimating Number of Joined Members
    </p>
  </figure>

  <!-- Highcharts Library -->
  <script src="https://code.highcharts.com/highcharts.js"></script>

  <!-- Chart Script -->
  <script>
    Highcharts.chart('container', {
      chart: { type: 'column' },
      title: { text: 'Joined Members in 2026' },
      subtitle: {
        text: 'Company: <a target="_blank" href="#">Tukashira</a>'
      },
      xAxis: {
        categories: ['Temeke', 'Mufindi', 'Mvomero', 'Lindi', 'Nyegezi', 'Nzega'],
        crosshair: true
      },
      yAxis: {
        min: 0,
        title: { text: 'Population: 1,000 People' }
      },
      tooltip: { valueSuffix: ' (1000 MT)' },
      plotOptions: {
        column: { pointPadding: 0.2, borderWidth: 0 }
      },
      series: [
        { name: 'Region', data: [387749, 280000, 129000, 64300, 54000, 34300] },
        { name: 'District', data: [45321, 140000, 10000, 140500, 19500, 113500] }
      ]
    });
  </script>

</body>
</html>
