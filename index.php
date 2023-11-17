<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estaciones meteorologicas</title>
</head>
<body>
<form action="" method="POST">
    Introduce el num de estacion:(0-3)<input type="number" name="e1" id="e1">
    <input type="submit" value="Buscar">
</form>

<?php
  $meteorologicalData = [
    [
        'station' => 'Catarroja',
        'temperature' => 15,
        'humidity' => 85,
        'atmosphericPressure' => 1024
    ],
    [
        'station' => 'Alzira',
        'temperature' => 35,
        'humidity' => 75,
        'atmosphericPressure' => 1000
    ],
    [
        'station' => 'Almussafes',
        'temperature' => 17,
        'humidity' => 95,
        'atmosphericPressure' => 950
    ],
    [
        'station' => 'Carlet',
        'temperature' => 31,
        'humidity' => 55,
        'atmosphericPressure' => 850
    ]
  ];

  echo "<br>";

  mostrar($meteorologicalData);
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $estacion = $_POST['e1'];
    echo "Esstaciones con presion modificada: ", "<br>", "<br>";
    $meteorologicalData=fixPressure($estacion, $meteorologicalData);
    echo "La temperatura media total es de: " , averageTemperature($meteorologicalData);
  }

  function fixPressure($e1, $datos) {
    if ($datos[$e1]['temperature'] < 30) {
        $datos[$e1]['atmosphericPressure'] = $datos[$e1]['atmosphericPressure'] - (15*$datos[$e1]['atmosphericPressure'] / 100);
    } elseif ($datos[$e1]['temperature'] >= 30) {
        $datos[$e1]['atmosphericPressure'] = $datos[$e1]['atmosphericPressure'] - (25*$datos[$e1]['atmosphericPressure'] / 100);
    }
    echo "Datos modificados:";
    mostrar($datos);
    return $datos;
  }

  function mostrar($datos) {
    for ($i=0; $i < count($datos); $i++) { 
      echo "Estacion: " , $datos[$i]['station'], "<br>";
      echo "Temperature: " ,$datos[$i]['temperature'], "<br>";
      echo "Humedad: " ,$datos[$i]['humidity'], "<br>";
      echo "Presion atmosferica: " ,$datos[$i]['atmosphericPressure'], "<br>", "<br>";
    }
  }

  function averageTemperature($data) {
    $suma = 0;
    for ($i=0; $i < count($data); $i++) { 
        $suma+=$data[$i]['temperature'];
    }
    $media = $suma / count($data);
    return $media;
  }

?>

</body>
</html>