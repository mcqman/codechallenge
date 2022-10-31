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
    <form action="process-form.php?step=2" method="post">
        <p><input type="text" name="name" placeholder="Employee Name" required></p>
        <p><input type="number" name="age" placeholder="Employee Age" required></p>
        <p><input type="submit" value="Add Employee"></p>
    </form>
</div>
</body>
</html>