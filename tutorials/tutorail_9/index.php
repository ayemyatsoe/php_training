<?php 
require_once("phpChart_Lite/conf.php");
	$db = mysqli_connect('localhost', 'root', 'root', 'db_crud');
    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
    $results = mysqli_query($db, "SELECT phone FROM tb_crud");
    $age = array();
    while ($row = mysqli_fetch_assoc($results)) {
        $age[] = $row['phone']; 
    }
    $pc = new C_PhpChartX(array($age),'basic_chart');
    $pc->set_animate(true);
    $pc->set_title(array('text'=>'Age Chart'));
    $pc->draw();
    $result1 = mysqli_query($db, "SELECT name,phone FROM tb_crud");
    $name = array();
    $ageb = array();
    while ($row = mysqli_fetch_assoc($result1)) {
        $name[]=$row['name'];
        $ageb[] = $row['phone']; 
    }
?>
<html>

<head>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    <script type="text/javascript">
    google.charts.load('current', {
        'packages': ['corechart']
    });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {

        var data = google.visualization.arrayToDataTable([
            ['name', 'phone'],
            <?php 
            $results = mysqli_query($db, "SELECT * FROM tb_crud");
            while ($row = mysqli_fetch_assoc($results)) {
                echo "['".$row['name']."',".$row['phone']."],";
            }
            ?>
            //['Work', 11],
            //['Eat', 2],
            //['Commute', 2],
            //['Watch TV', 2],
            //['Sleep', 7]
        ]);
        var options = {
            title: 'Name And Age '
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
    }
    </script>

</head>

<body>
    <div id="piechart" style="width: 900px; height: 500px;"></div>
    <h1>Age</h1>
    <div style="width:600px">
        <canvas id="mycanvas"></canvas>
    </div>
    <script>
    const age = <?php echo json_encode($ageb); ?>;
    const name = <?php echo json_encode($name); ?>;
    const data = {
        labels: name,
        datasets: [{
            label: 'Age',
            data: age,
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(255, 159, 64, 0.2)',
                'rgba(255, 205, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(201, 203, 207, 0.2)'
            ],
            borderColor: [
                'rgb(255, 99, 132)',
                'rgb(255, 159, 64)',
                'rgb(255, 205, 86)',
                'rgb(75, 192, 192)',
                'rgb(54, 162, 235)',
                'rgb(153, 102, 255)',
                'rgb(201, 203, 207)'
            ],
            borderWidth: 1
        }]
    };

    const config = {
        type: 'bar',
        data,
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        },
    };
    const myChart = new Chart(
        document.getElementById('mycanvas'),
        config
    );
    </script>
</body>

</html>