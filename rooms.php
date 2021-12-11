<?php
require_once("connect.php");
$pdo = DB::connect();
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.0/font/bootstrap-icons.css">
        <title>Seznam místností</title>
    </head>
    <body class="container">
        <div>

        <?php
        $order = filter_input(INPUT_GET, 'order');

        echo "<h1>Seznam místností <i class='bi bi-grid-fill'></i></h1><table class='table table-light'><thead><tr>
        <td>Název <a href='rooms.php?order=name_asc'><span class='glyphicon glyphicon-arrow-down' aria-hidden='true'></a> <a href='rooms.php?order=name_desc'><span class='glyphicon glyphicon-arrow-up' aria-hidden='true'></a></td>
        <td>Číslo <a href='rooms.php?order=number_asc'><span class='glyphicon glyphicon-arrow-down' aria-hidden='true'></a> <a href='rooms.php?order=number_desc'><span class='glyphicon glyphicon-arrow-up' aria-hidden='true'></a></td>
        <td>Telefon <a href='rooms.php?order=phone_asc'><span class='glyphicon glyphicon-arrow-down' aria-hidden='true'></a> <a href='rooms.php ?order=phone_desc'><span class='glyphicon glyphicon-arrow-up' aria-hidden='true'></a></td>
        </thead><tbody>";

        switch($order){
            case "name_asc": $stmt = $pdo->query('SELECT * FROM room r ORDER BY r.name ASC'); break;
            case "name_desc": $stmt = $pdo->query('SELECT * FROM room r ORDER BY r.name DESC'); break;
            case "number_asc": $stmt = $pdo->query('SELECT * FROM room r ORDER BY r.no ASC'); break;
            case "number_desc": $stmt = $pdo->query('SELECT * FROM room r ORDER BY r.no DESC'); break;
            case "phone_asc": $stmt = $pdo->query('SELECT * FROM room r ORDER BY r.phone ASC'); break;
            case "phone_desc": $stmt = $pdo->query('SELECT * FROM room r ORDER BY r.phone DESC'); break;
            default: $stmt = $pdo->query('SELECT * FROM room r ORDER BY r.name ASC'); break;
        }

            while ($row = $stmt->fetch()){
                $RID = $row['room_id'];
                $Rnumber = $row['no'];
                $Rname = $row['name'];
                $Rphone = $row['phone'];
    
                echo "<tr><td><a style='text-decoration:none' href='room.php?roomId=$RID'>$Rname</a></td><td>$Rnumber</td><td>".($Rphone ?: '&mdash;')."</td></tr>";
            }
            echo "</tbody></table><br>";
            echo "<h3><a style='text-decoration:none' href=index.php><i class='bi bi-house-fill'></i> Zpět na \"Prohlížeč databáze\"</a></h3>";
    
            unset($stmt);
        ?>
    </body>
</html>