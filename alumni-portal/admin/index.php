<?php
include('security.php');
include('../includes/header.php');
include('../includes/navbar.php');
include "../dbconfig.php";
?>


<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

  <!-- Main Content -->
  <div id="content">

    <!-- Begin Page Content -->
    <div class="container-fluid">

      <!-- Page Heading -->
      <div class="d-sm-flex align-items-center justify-content-between">
        <!-- <h1 class="h3 mb-0 text-gray-800">Dashboard</h1> -->
        <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
      </div>


      <?php
      $connect = mysqli_connect("127.0.0.1", "root", "", "its-alumnitracking");
      // $query = "SELECT userData, count(*) as number FROM accounts GROUP BY userData";
      $query = "SELECT
      (SELECT COUNT(*) FROM admin) as admin_count, 
      (SELECT COUNT(*) FROM accounts) as account_count,
      (SELECT COUNT(*) FROM alumni) as student_count;";
      $result = mysqli_query($connect, $query);
      $row = mysqli_fetch_array($result);
      $data = [
        'userData' => [
          'Administrator',
          'Accounts',
          'Alumni'
        ],
        'Number' => [
          $row['admin_count'],
          $row['account_count'],
          $row['student_count'],
        ]
      ];
      ?>

      <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
      <script type="text/javascript">
        google.charts.load("current", {
          packages: ["corechart"]
        });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
          var data = google.visualization.arrayToDataTable([
            ['userData', 'Number'],

            <?php
            for ($i = 0; $i < 3; $i++) {
              echo "['" . $data["userData"][$i] . "', " . $data["Number"][$i] . "],";
            }
            ?>
          ]);


          var options = {
            title: 'Percentage of Accounts/Admins & Alumni',
            is3D: true,
          };

          var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
          chart.draw(data, options);
        }
      </script>

      <body>
        <div id="piechart_3d" style="width: 600px; height: 630px"></div>
      </body>


      <?php
      $connect = mysqli_connect("127.0.0.1", "root", "", "its-alumnitracking");
      $query = "SELECT TypeOfContent, count(*) as number FROM events GROUP BY TypeOfContent";
      $result = mysqli_query($connect, $query);
      ?>

      <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
      <script type="text/javascript">
        google.charts.load("current", {
          packages: ["corechart"]
        });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
          var data = google.visualization.arrayToDataTable([
            ['TypeOfContent', 'Number'],
            <?php
            while ($row = mysqli_fetch_array($result)) {
              echo "['" . $row["TypeOfContent"] . "', " . $row["number"] . "],";
            }
            ?>
          ]);

          var options = {
            title: 'Percentage of Jobs & Events',
            pieHole: 0.4,

          };

          var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
          chart.draw(data, options);
        }
      </script>

      <body>
        <div id="donutchart" style="width: 600px; height: 630px; position: absolute; top: 95px; right:25px"></div>

      </body>

      </html>