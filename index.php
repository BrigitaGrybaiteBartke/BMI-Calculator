<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">

</head>

<body>
    <div class="container">
        <h2 class="text-center mt-3 mb-3">BMI calculator</h2>
        <form action="" method="POST">
            <div class="form-control d-flex align-items-center justify-content-evenly">
                <!-- Height -->
                <div class="col-xs-3">
                    <label for="height" class="form-label">Height:</label>
                    <input type="text" name="height" value="<?php if (isset($_POST['height'])) print($_POST['height']) ?>" placeholder="Enter your height" class="form-control">
                </div>
                <!-- Weight -->
                <div class="col-xs-3">
                    <label for="weight" class="form-label">Weight:</label>
                    <input type="text" name="weight" value="<?php if (isset($_POST['weight'])) print($_POST['weight']) ?>" placeholder="Enter your weight" class="form-control">
                </div>
                <div class="col-xs-3">
                    <input type="submit" value="Submit" class="btn btn-dark">
                </div>
            </div>
            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $height = $_POST["height"];
                $weight = $_POST["weight"];
                $message = '';

                if (empty($_POST["height"]) or empty($_POST["weight"])) {
                    $message = '<p style="color: red">The input values are required!</p>';
                } elseif (filter_var($height, FILTER_VALIDATE_FLOAT) === false or filter_var($weight, FILTER_VALIDATE_FLOAT) === false) {
                    $message = '<p style="color: red">The input value must be a number only!</p>';
                } else {
                    $normalizedHeight = $height / 100;
                    $bmiIndex = round($weight / ($normalizedHeight * $normalizedHeight), 2);
                    // Set message
                    if ($bmiIndex < 18.5) {
                        $message = "<p class='mt-3'>You are underweight!</p><p>BMI: <strong>{$bmiIndex}</strong></p>";
                    } else if ($bmiIndex >= 18.5 and $bmiIndex <= 24.9) {
                        $message = "<p class='mt-3'>You have normal weight!</p><p>BMI: <strong>{$bmiIndex}</strong></p>";
                    } else {
                        $message = "<p class='mt-3'>You are obese!</p><p>BMI: <strong>{$bmiIndex}</strong></p>";
                    }
                }

                $arr = array(
                    "bmi" => $bmiIndex,
                    "message" => $message,
                );

                print($arr["message"]);
            }
            ?>
        </form>
    </div>
</body>

</html>