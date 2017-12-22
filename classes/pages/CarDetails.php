<?php

class CarDetails extends BasicPage {
    private $car_id;

    public function __construct($id) {
        parent::__construct();

        $this->car_id = $id;
    }

    public function render() {
        $this->setTitle('Car');

        Renderer::render("car.php", [
            'car' => RentalService::getCarDetails($this->car_id)
        ]);
    }

}