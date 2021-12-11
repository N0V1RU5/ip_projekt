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
        <title>Seznam zaměstnanců</title>
    </head>
    <body class="container">
        <div>

        <?php
        $order = filter_input(INPUT_GET, 'order');

        echo "<h1>Seznam zaměstnanců <i class='bi bi-people-fill'></i></h1><table class='table table-light'><thead><tr>
        <td>Jméno<a href='employees.php?order=name_asc'><span class='glyphicon glyphicon-arrow-down' aria-hidden='true'></span></a><a href='employees.php?order=name_desc'><span class='glyphicon glyphicon-arrow-up' aria-hidden='true'></span></a></td>
        <td>Místnost<a href='employees.php?order=room_asc'><span class='glyphicon glyphicon-arrow-down' aria-hidden='true'></span></a> <a href='employees.php?order=room_desc'><span class='glyphicon glyphicon-arrow-up' aria-hidden='true'></span></a></td>
        <td>Telefon<a href='employees.php?order=phone_asc'><span class='glyphicon glyphicon-arrow-down' aria-hidden='true'></span></a> <a href='employees.php?order=phone_desc'><span class='glyphicon glyphicon-arrow-up' aria-hidden='true'></span></a></td>
        <td>Pozice<a href='employees.php?order=job_asc'><span class='glyphicon glyphicon-arrow-down' aria-hidden='true'></span></a> <a href='employees.php?order=job_desc'><span class='glyphicon glyphicon-arrow-up' aria-hidden='true'></span></a></td>
        </tr></thead><tbody>";

        switch($order){
            case "name_asc": $stmt = $pdo->query('SELECT e.employee_id, e.name AS ename, e.surname, e.job, e.wage, e.room, r.no, r.name AS rname, r.phone FROM employee e INNER JOIN room r ON e.room=r.room_id ORDER BY e.surname ASC'); break;
            case "name_desc": $stmt = $pdo->query('SELECT e.employee_id, e.name AS ename, e.surname, e.job, e.wage, e.room, r.no, r.name AS rname, r.phone FROM employee e INNER JOIN room r ON e.room=r.room_id ORDER BY e.surname DESC'); break;
            case "room_asc": $stmt = $pdo->query('SELECT e.employee_id, e.name AS ename, e.surname, e.job, e.wage, e.room, r.no, r.name AS rname, r.phone FROM employee e INNER JOIN room r ON e.room=r.room_id ORDER BY r.name ASC'); break;
            case "room_desc": $stmt = $pdo->query('SELECT e.employee_id, e.name AS ename, e.surname, e.job, e.wage, e.room, r.no, r.name AS rname, r.phone FROM employee e INNER JOIN room r ON e.room=r.room_id ORDER BY r.name DESC'); break;
            case "phone_asc": $stmt = $pdo->query('SELECT e.employee_id, e.name AS ename, e.surname, e.job, e.wage, e.room, r.no, r.name AS rname, r.phone FROM employee e INNER JOIN room r ON e.room=r.room_id ORDER BY r.phone ASC'); break;
            case "phone_desc": $stmt = $pdo->query('SELECT e.employee_id, e.name AS ename, e.surname, e.job, e.wage, e.room, r.no, r.name AS rname, r.phone FROM employee e INNER JOIN room r ON e.room=r.room_id ORDER BY r.phone DESC'); break;
            case "job_asc": $stmt = $pdo->query('SELECT e.employee_id, e.name AS ename, e.surname, e.job, e.wage, e.room, r.no, r.name AS rname, r.phone FROM employee e INNER JOIN room r ON e.room=r.room_id ORDER BY e.job ASC'); break;
            case "job_desc": $stmt = $pdo->query('SELECT e.employee_id, e.name AS ename, e.surname, e.job, e.wage, e.room, r.no, r.name AS rname, r.phone FROM employee e INNER JOIN room r ON e.room=r.room_id ORDER BY e.job DESC'); break;
            default: $stmt = $pdo->query('SELECT e.employee_id, e.name AS ename, e.surname, e.job, e.wage, e.room, r.no, r.name AS rname, r.phone FROM employee e INNER JOIN room r ON e.room=r.room_id ORDER BY e.surname ASC'); break;
        }

        while ($row = $stmt->fetch()){

            $EID = $row['employee_id'];
            $Ename = $row['ename'];
            $Esurname = $row['surname'];
            $Ejob = $row['job'];
            $Ewage = $row['wage'];
            $Eroom = $row['room'];

            $Rnumber = $row['no'];
            $Rname = $row['rname'];
            $Rphone = $row['phone'];

            echo "<tr><td><a style='text-decoration:none' href='employee.php?employeeId=$EID'>$Esurname $Ename</a></td><td>$Rname</td><td>$Rphone</td><td>$Ejob</td></tr>";
        }
        echo "</tbody></table><br>";
        echo "<h3><a style='text-decoration:none' href=index.php><i class='bi bi-house-fill'></i> Zpět na \"Prohlížeč databáze\"</a></h3>";
        unset($stmt);
        ?>
        </div>
    </body>
</html>