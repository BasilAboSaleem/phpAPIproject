<?php

class View
{
    public function renderCars($cars)
    {

        if (count($cars) > 0) {
            foreach ($cars as $car) {
                echo "Car ID: " . $car['id'] . "<br>";
                echo "Type: " . $car['type'] . "<br>";
                echo "Price: " . $car['price'] . "<br>";
                echo "Production Date: " . $car['production_date'] . "<br>";
                echo "Manufacturer: " . $car['manufacturer'] . "<br>";
                echo "<br>";
            }
        } else {
            echo "No cars found.";
        }
    }

    public function renderMessage($message)
    {
        echo $message;
    }
}
