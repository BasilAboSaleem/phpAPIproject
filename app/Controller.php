<?php

class Controller
{
    private $model;
    private $view;

    public function __construct($model, $view)
    {
        $this->model = $model;
        $this->view = $view;
    }

    public function handleRequest()
    {
        $requestMethod = $_SERVER['REQUEST_METHOD'];

        switch ($requestMethod) {
            case 'GET':
                $this->handleGetRequest();
                break;
            case 'POST':
                $this->handlePostRequest();
                break;
            case 'PUT':
                $this->handlePutRequest();
                break;
            case 'DELETE':
                $this->handleDeleteRequest();
                break;
            default:
                $this->view->renderMessage("Invalid request method.");
        }
    }

    private function handleGetRequest()
    {
        $cars = $this->model->getAllCars();
        $this->view->renderCars($cars);
    }

    private function handlePostRequest()
    {
        $car = $_POST; 
        $this->model->insertCar($car);
        $this->view->renderMessage("Car inserted successfully.");
    }

    private function handlePutRequest()
    {
        parse_str(file_get_contents('php://input'), $putData);
        $carId = $_GET['id']; 
        $this->model->updateCar($carId, $putData);
        $this->view->renderMessage("Car updated successfully.");
    }

    private function handleDeleteRequest()
    {
        $carId = $_GET['id']; 
        $this->model->deleteCar($carId);
        $this->view->renderMessage("Car deleted successfully.");
    }
}
