<?php

class Model
{
    private $db;

    public function __construct()
    {
        $host = "localhost";
        $dbname = "car_exhibition";
        $username = "username";
        $password = "password";

        try {
            $this->db = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    public function insertCar($car)
    {
        $type = $car['type'];
        $price = $car['price'];
        $productionDate = $car['production_date'];
        $manufacturer = $car['manufacturer'];

        try {
            $stmt = $this->db->prepare("INSERT INTO cars (type, price, production_date, manufacturer) 
                                        VALUES (:type, :price, :production_date, :manufacturer)");
            $stmt->bindParam(':type', $type);
            $stmt->bindParam(':price', $price);
            $stmt->bindParam(':production_date', $productionDate);
            $stmt->bindParam(':manufacturer', $manufacturer);
            $stmt->execute();
        } catch (PDOException $e) {
            die("Error inserting car: " . $e->getMessage());
        }
    }

    public function getAllCars()
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM cars");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Error retrieving cars: " . $e->getMessage());
        }
    }

    public function deleteCar($carId)
    {
        try {
            $stmt = $this->db->prepare("DELETE FROM cars WHERE id = :id");
            $stmt->bindParam(':id', $carId);
            $stmt->execute();
        } catch (PDOException $e) {

            die("Error deleting car: " . $e->getMessage());
        }
    }

    public function updateCar($carId, $updatedCar)
    {
        $type = $updatedCar['type'];
        $price = $updatedCar['price'];
        $productionDate = $updatedCar['production_date'];
        $manufacturer = $updatedCar['manufacturer'];

        try {
            $stmt = $this->db->prepare("UPDATE cars SET type = :type, price = :price, 
                                        production_date = :production_date, manufacturer = :manufacturer 
                                        WHERE id = :id");
            $stmt->bindParam(':type', $type);
            $stmt->bindParam(':price', $price);
            $stmt->bindParam(':production_date', $productionDate);
            $stmt->bindParam(':manufacturer', $manufacturer);
            $stmt->bindParam(':id', $carId);
            $stmt->execute();
        } catch (PDOException $e) {

            die("Error updating car: " . $e->getMessage());
        }
    }
}
