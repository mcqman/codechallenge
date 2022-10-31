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

        $stmt = $dbcon->prepare("SELECT `employer`.*, `employee`.`name` as `employee_name`, `employee`.`age` as `employee_age` FROM `employer` JOIN(`employee`) ON (`employee`.`employer_id` = `employer`.`id`)");
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();

        echo 
        "<table>
        <thead>
          <tr>
            <td>Employer</td>
            <td>Employee Name</td>
            <td>Employee Age</td>
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
                    <p>{$row['employee_name']}</p>
                </td>

                <td>
                    <p>{$row['employee_age']}</p>
                </td>
              </div>
            </tr>
         ";
        }

        echo "</tbody></table>";
    ?>
</div>
<input type="button" value="Submit Another" onclick="window.location='/'"><br>
<input type="button" value="Show Employee Counts" onclick="window.location='/EmployeeCounts.php'">
</body>
</html>