<!DOCTYPE html>
<html lang="en">
<head>
    <title>Resistance Calculator</title>

    <link rel="stylesheet" href="main.css">

    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

</head>
<body>

<?php

//define variables and set to empty
$powerSupplyErr = $powerDropErr = $ledCurrentErr = $ledAmountErr = $seriesOrParallel = "";
$powerSupply = $powerDrop = $ledCurrent = $ledAmount = $seriesOrParallelErr = "";
$powerSupplyCorr = $powerDropCorr  = $ledCurrentCorr = $ledAmountCorr = $seriesOrParallelCorr = "";
$firstNumber = $secondNumber = $thirdNumber = "";
$roundedValue = "";
$seriesStatus = $parallelStatus = "";

//checking if parallel or series is already checked
if ($_POST['calculate']) {
    $selectedRadio = $_POST['seriesOrParallel'];
    if ($selectedRadio == "series") {
        $seriesStatus = "checked";
    } elseif ($selectedRadio == "parallel") {
        $parallelStatus = "checked";
    } else {
        $seriesStatus = "";
        $parallelStatus = "";
    }
} else {
    $seriesStatus = "";
    $parallelStatus = "";
}

//checking empty fields and whether the values are correct
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    //Power Supply
    if (empty($_POST["powerSupply"])) {
        $powerSupplyErr = "*Please fill in this field.";
    } elseif ($_POST["powerSupply"] < 3 || $_POST["powerSupply"] > 24) {
        $powerSupplyErr = "*The power supply needs to have a value between 3 and 24.";
    } else {
        $powerSupplyCorr = true;
        $powerSupply = $_POST["powerSupply"];
    }

    //Power Drop
    if (empty($_POST["powerDrop"])) {
        $powerDropErr = "*Please fill in this field.";
    } elseif ($_POST["powerDrop"] < 1.6 || $_POST["powerDrop"] > 4) {
        $powerDropErr = "*The power drops need to have a value between 1.6 and 4.";
    } else {
        $powerDropCorr = true;
        $powerDrop = $_POST["powerDrop"];
    }

    //LED Current
    if (empty($_POST["ledCurrent"])) {
        $ledCurrentErr = "*Please fill in this field.";
    } elseif ($_POST["ledCurrent"] < 2 || $_POST["ledCurrent"] > 70) {
        $ledCurrentErr = "*The LED current needs to have a value between 2 and 70.";
    } else {
        $ledCurrentCorr = true;
        $ledCurrent = $_POST["ledCurrent"];
    }

    //Amount of LED's
    if (empty($_POST["ledAmount"])) {
        $ledAmountErr = "*Please fill in this field.";
    } elseif ($_POST["ledAmount"] < 1 || $_POST["ledAmount"] > 99) {
        $ledAmountErr = "*The number of LED's needs to be between 1 and 99.";
    } else {
        $ledAmountCorr = true;
        $ledAmount = $_POST["ledAmount"];
    }

    //Series or parallel
    if (empty($_POST["seriesOrParallel"])) {
        $seriesOrParallelErr = "*Please select one of the options.";
    } else {
        $seriesOrParallelCorr = true;
    }
}

?>

<h1>Resistance Calculator</h1>
<div class="resistanceForm">
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="formCalc">

    <!-- Standard form fields with error handling -->

        <!-- Power Supply input -->
        <div>
            <p>Power supply (P):</p>
            <label>
                <input type="number" placeholder="3 - 24 " step="0.01" name="powerSupply" min=3 max=24 value="<?= $powerSupply; ?>" class="
                    <?php
                    if ($powerSupplyCorr == true) {
                        echo "";
                    } else {
                        echo "inputIncorrect";
                    }
                    ?>">
            </label>
        </div>

        <!-- Power Supply error -->
        <span class="<?php
        //check if there's an error, assign class depending on outcome
        if ($powerSupplyErr == true) {
            echo "error";
        } else {
            echo "correct";
        }
        ?>"> <?= $powerSupplyErr; ?></span>

        <!-- Power Drop input -->
        <div>
            <p>Power drop (V):</p>
            <label>
                <input type="number" placeholder="1.6 - 4" step="0.01" name="powerDrop" min=1.6 max=4 value="<?= $powerDrop; ?>" class="
                    <?php
                    if ($powerDropCorr == true) {
                        echo "";
                    } else {
                        echo "inputIncorrect";
                    }
                    ?>">
            </label>
        </div>

        <!-- Power Drop error -->
        <span class="<?php
        //check if there's an error, assign class depending on outcome
        if ($powerDropErr == true) {
            echo "error";
        } else {
            echo "correct";
        }
        ?>"> <?= $powerDropErr; ?></span>

        <!-- LED Current input -->
        <div>
            <p>LED Current (mA):</p>
            <label>
                <input type="number" placeholder="2 - 70" step="0.01" name="ledCurrent" min=2 max=70 value="<?= $ledCurrent; ?>" class="
                    <?php
                    if ($ledCurrentCorr == true) {
                        echo "";
                    } else {
                        echo "inputIncorrect";
                    }
                    ?>">
            </label>
        </div>

        <!-- LED Current error -->
        <span class="<?php
        //check if there's an error, assign class depending on outcome
        if ($ledCurrentErr == true) {
            echo "error";
        } else {
            echo "correct";
        }
        ?>"> <?= $ledCurrentErr; ?></span>

        <!-- Number of LED's input -->
        <div>
            <p>Number of LEDs:</p>
            <label>
                <input type="number" placeholder="1 - 99" step="1" name="ledAmount"  min=1 max=99 value="<?= $ledAmount; ?>" class="
                    <?php
                    if ($ledAmountCorr == true) {
                        echo "inputCorrect";
                    } else {
                        echo "inputIncorrect";
                    }
                    ?>">
            </label>
        </div>

        <!-- Number of LED's error -->
        <span class="<?php
        //check if there's an error, assign class depending on outcome
        if ($ledAmountErr == true) {
            echo "error";
        } else {
            echo "correct";
        }
        ?>"> <?= $ledAmountErr; ?><br></span>
        <br style="<?php
            if ($ledAmountErr == true) {
                echo "display:block";
            } else {
                echo "display:none";
            }
        ?>">


        <!-- Series or Parallel input -->


        <label class="radiolabel">
            <input type="radio" name="seriesOrParallel"
                   <?php if (isset($seriesOrParallel) && $seriesOrParallel=="series") echo "checked";?> <?= $seriesStatus ?>
                   value="series">
            Series
        </label>
        <label class="radiolabel">
            <input type="radio" name="seriesOrParallel"
                   <?php if (isset($seriesOrParallel) && $seriesOrParallel=="parallel") echo "checked";?> <?= $parallelStatus ?>
                   value="parallel">
            Parallel
        </label>
        <br>


        <!-- Series or Parallel error -->
        <span class="<?php
        //check if there's an error, assign class depending on outcome
        if ($seriesOrParallelErr == true) {
            echo "error";
        } else {
            echo "correct";
        }
        ?>"> <?= $seriesOrParallelErr; ?></span>
        <br>

    <!--Calculate button-->
        <input type="submit" value="Calculate" name="calculate">
    </form>

<?php

//Calculating the value
    $calcValue = 0;
    if ($powerSupplyCorr === true && $powerDropCorr === true && $ledCurrentCorr === true && $ledAmountCorr === true && $seriesOrParallelCorr === true) {
        if ($_POST['seriesOrParallel']=="series") {
            $calcValue = 1000 * (($powerSupply - ( $powerDrop * $ledAmount )) / ( $ledCurrent ));
        } elseif ($_POST['seriesOrParallel']=="parallel") {
            $calcValue = ( $powerSupply - $powerDrop ) / ( $ledCurrent * $ledAmount / 1000 );
        } else {
            $calcValue = "";
        }
    } else {
        $calcValue = "";
    }

?>

<!--Calculated value-->
<p class="value_result">Calculated value: <?= $calcValue; ?></p>


<?php
// Calculating the colours

// Check if the value is in the array
$possibleValues = array (0, 0.5, 1, 1.2, 1.5, 1.8, 2.2, 2.7, 3.3, 3.9, 4.7, 6.8, 8.2, 10, 10.2, 10.5, 10.7, 11, 11.3, 11.5, 11.8, 12, 12.1, 12.4, 12.7, 13, 13.3, 13.7, 14, 14.3, 14.7, 15, 15, 15.4, 15.8, 16.2, 16.5, 16.9, 17.4, 17.8, 18, 18.2, 18.7, 19.1, 19.6,  20, 20.5, 21, 21.5, 22, 22.1, 22.6, 23.2, 23.7, 24.3, 24.9, 25.5, 26.1, 26.7, 27, 27.4, 28, 28.7, 29.4, 30.1, 30.9, 31.6, 32.4, 33, 33.2, 34, 34.8, 35.7, 36.5, 37.4, 38.3, 39, 39.2, 40.2, 41.2, 42.2, 43.2, 44.2, 45.3, 46.4, 47, 47.5, 48.7, 49.9, 51.1, 52.3, 53.6, 54.9, 56, 56.2, 57.6, 59, 60.4, 61.9, 63.4, 64.9, 66.5, 68, 68.1, 69.8, 71.5, 73.2 , 75, 76.8, 78.7, 80.6, 82, 82.5, 84.5, 86.6, 88.7, 90.9, 93.1, 95.3, 97.6, 100, 120, 150, 181, 220, 270, 330, 390, 470, 560, 680, 820, 1000, 1200, 1800, 2200, 2700, 3300, 3900, 4700, 5600, 6800, 8200, 10000, 12000, 15000, 18000, 22000, 27000, 33000, 39000, 47000, 56000, 68000, 82000, 1000000, 1500000, 1800000, 2200000, 2700000, 3300000, 3900000, 4700000);
if (in_array($calcValue, $possibleValues, true )) {
    $isInArray = true;
} else {
    $isInArray = false;
}

/*
First step: layering the calculated value depending on how high or how low it is. This helps with the amount of calculations.
Second step: Rounding the value down and adding a certain amount up to the point where it is found in the array.
Third step: When found in the array, return the number that was found
*/
if ($isInArray == false) {
    if ($calcValue <= 0) {
        $roundedValue = 0;
        $resistorColours = "Black";
    } elseif ($calcValue < 100) {
        $roundedValue = round($calcValue, 1, PHP_ROUND_HALF_DOWN);
        do {
            $roundedValue += 0.1;
            //return $roundedValue;
        } while (in_array($roundedValue, $possibleValues) == false);
    } elseif ($calcValue < 200) {
        $roundedValue = round($calcValue, 0, PHP_ROUND_HALF_DOWN);
        do {
            $roundedValue += 1;
            //return $roundedValue;
        } while (in_array($roundedValue, $possibleValues) == false);
    } elseif ($calcValue < 1000) {
        $roundedValue = round($calcValue, -1, PHP_ROUND_HALF_DOWN);
        do {
            $roundedValue += 10;
            //return $roundedValue;
        } while (in_array($roundedValue, $possibleValues) == false);
    } elseif ($calcValue < 10000) {
        $roundedValue = round($calcValue, -2, PHP_ROUND_HALF_DOWN);
        do {
            $roundedValue += 100;
            //return $roundedValue;
        } while (in_array($roundedValue, $possibleValues) == false);
    } elseif ($calcValue < 1000000) {
        $roundedValue = round($calcValue, -3, PHP_ROUND_HALF_DOWN);
        do {
            $roundedValue += 1000;
            //return $roundedValue;
        } while (in_array($roundedValue, $possibleValues) == false);
    } elseif ($calcValue < 4700000) {
        $roundedValue = round($calcValue, -4, PHP_ROUND_HALF_DOWN);
        do {
            $roundedValue += 10000;
            //return $roundedValue;
        } while (in_array($roundedValue, $possibleValues) == false);
    } else {
        $resistorColours = "There is no resistor for this setup.";
    }
} else {
    $resistorColours = "Colour found!";
}

// Getting the values of the colours
$firstNumber = substr($roundedValue, 0, 1);
$secondNumber = substr($roundedValue, 1, 1);

// Rounding the number to whole numbers to calculate the third colour
$roundedValueThird = round($roundedValue,0);

// Calculating the third number
if (strlen($roundedValueThird) < 3) {
    $thirdNumber = 0;
} else {
    $thirdNumber = strlen($roundedValueThird) - 2;
}

// Converting the values into colours

// First Number
if ($firstNumber == 0) {
    $firstColour = "Black";
} elseif ($firstNumber == 1) {
    $firstColour = "Brown";
} elseif ($firstNumber == 2) {
    $firstColour = "Red";
} elseif ($firstNumber == 3) {
    $firstColour = "Orange";
} elseif ($firstNumber == 4) {
    $firstColour = "Yellow";
} elseif ($firstNumber == 5) {
    $firstColour = "Green";
} elseif ($firstNumber == 6) {
    $firstColour = "Blue";
} elseif ($firstNumber == 7) {
    $firstColour = "Purple";
} elseif ($firstNumber == 8) {
    $firstColour = "Grey";
} elseif ($firstNumber == 9) {
    $firstColour = "White";
} else { 
    $firstColour = "Error: Invalid number";
}

// Second Number
if ($secondNumber == 0) {
    $secondColour = "Black";
} elseif ($secondNumber == 1) {
    $secondColour = "Brown";
} elseif ($secondNumber == 2) {
    $secondColour = "Red";
} elseif ($secondNumber == 3) {
    $secondColour = "Orange";
} elseif ($secondNumber == 4) {
    $secondColour = "Yellow";
} elseif ($secondNumber == 5) {
    $secondColour = "Green";
} elseif ($secondNumber == 6) {
    $secondColour = "Blue";
} elseif ($secondNumber == 7) {
    $secondColour = "Purple";
} elseif ($secondNumber == 8) {
    $secondColour = "Grey";
} elseif ($secondNumber == 9) {
    $secondColour = "White";
} else {
    $secondColour = "Error: Invalid number";
}

// third Number
if ($thirdNumber == 0) {
    $thirdColour = "Black";
} elseif ($thirdNumber == 1) {
    $thirdColour = "Brown";
} elseif ($thirdNumber == 2) {
    $thirdColour = "Red";
} elseif ($thirdNumber == 3) {
    $thirdColour = "Orange";
} elseif ($thirdNumber == 4) {
    $thirdColour = "Yellow";
} elseif ($thirdNumber == 5) {
    $thirdColour = "Green";
} elseif ($thirdNumber == 6) {
    $thirdColour = "Blue";
} elseif ($thirdNumber == 7) {
    $thirdColour = "Purple";
} elseif ($thirdNumber == 8) {
    $thirdColour = "Grey";
} elseif ($thirdNumber == 9) {
    $thirdColour = "White";
} else {
    $thirdColour = "Error: Invalid number";
}

?>

<!-- Calculated resistor colour -->

<!--<p>Rounded value: <?= $roundedValue ?></p>-->
<p class="colour_result">Resistor: <?= "$firstColour, $secondColour, $thirdColour" ?></p>
</div>

</body>
</html>
