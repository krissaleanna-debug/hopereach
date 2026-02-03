<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculating Radius</title>

 <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f6f8;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 10px;
            width: 350px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        h1 {
            margin-bottom: 20px;
            color: #333;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        input[type="number"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        .result {
            margin-top: 20px;
            color: #333;
            font-weight: bold;
        }

        .value {
        color: green;
        font-weight: bold;
        }

        .error {
            color: red;
            margin-top: 15px;
        
        }
    </style>
</head>
<body>
<div class="container">
    <h1> RADIUS OF CIRCLE </h1>   

    <form method="post">
    <label for="area">Enter Area:</label>
    <input type="number" step="any" id="area" name="area" required>
    <input type="submit" value="Calculate Radius">
    </form>

    <?php


    if (isset($_POST['area'])){
    $area=$_POST['area'];

    if($area<0)
    echo "<div class='error'>Area cannot be negative.</div>";
    else{
        $radius=sqrt($area/pi());
        $radius=round($radius,2);
        echo "<div class='result'>";
        echo "The Area of Circle is: <span class='value'>" . $area . "</span><br>";
        echo "The Radius of Circle is: <span class='value'>" . $radius . "</span>";
        echo "</div>";
    }
    }

    ?>
</div>
</body>
</html>