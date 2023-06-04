<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/css/bootstrap.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>
    <title>Document</title>
  </head>

  <body class="text-light">
  
    <canvas id="myChart"></canvas>

    <?php 
  require 'sglconnection.php';

  // get the number of consultations by specialty
  $sql = "SELECT COUNT(*) AS voyage, agance.nomVoyage FROM association
          JOIN agence ON association.idAgence = agence.idAgence
          GROUP BY agance.nomVoyage";
  $statement = $connexion->prepare($sql);
  $statement->execute();
  $results = $statement->fetchAll(PDO::FETCH_ASSOC);

  // create arrays to hold the data for the chart
  $labels = array();
  $data = array();
  $colors = array();
  $borderColors = array();
  foreach ($results as $result) {
    $labels[] = $result['nomVoyage'];
    $data[] = $result['voyage'];
    // generate a random color for each specialty
    $colors[] = 'rgba(' . rand(0,255) . ', ' . rand(0,255) . ', ' . rand(0,255) . ', 0.2)';
    $borderColors[] = 'rgba(' . rand(0,255) . ', ' . rand(0,255) . ', ' . rand(0,255) . ', 1)';
  }
?>

<script>
  var ctx = document.getElementById('myChart').getContext('2d');
  var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: <?php echo json_encode($labels); ?>,
      datasets: [
        {
          label: 'association',
          data: <?php echo json_encode($data); ?>,
          backgroundColor: <?php echo json_encode($colors); ?>,
          borderColor: <?php echo json_encode($borderColors); ?>,
          borderWidth: 1,
        },
      ],
    },
    options: {
      scales: {
        yAxes: [
          {
            ticks: {
              beginAtZero: true,
            },
          },
        ],
      },
    },
  });
</script>
<!-- <a href="index.php" class="btn btn-secondary">next page</a>
        <a href="index.php" class="btn btn-warning">RETOUR</a>    -->

  </body>
</html>
