<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Demo Application</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
    <style type="text/css">
        .wrapper{
            margin-top: 50px;
        }
        input {
            width: 60%;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
    <?php
        
        require_once 'database.php'; 

        $stmt = $dbcon->prepare("SELECT COUNT(`employee`.`name`) as `count`, `employer`.*, `employee`.`name` as `employee_name` FROM `employer` JOIN(`employee`) ON (`employee`.`employer_id` = `employer`.`id`) GROUP BY `employer`.`name` ASC");
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();

        echo 
        "<table>
        <thead>
          <tr>
            <td>Employer</td>
            <td>Number Of Employees</td>
          </tr>
        </thead>
        <tbody>";

        while($row = $result->fetch_assoc())
        {
            
           echo "
              <tr>
                <td>
                    <p>{$row['name']}</p>
                </td>

                <td>
                    <p>{$row['count']}</p>
                </td>
              </div>
            </tr>
         ";
        }

        echo "</tbody></table>";
    ?>
</div>
<input type="button" value="Submit Another" onclick="window.location='/'"><br>
<input type="button" value="Show Employee List" onclick="window.location='/AllEmployees.php'">
</body>
</html>