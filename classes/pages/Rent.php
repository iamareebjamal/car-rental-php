<?php

class Rent extends BasicPage {

    private $car_id;
    private $values = array();

    public function __construct($id) {
        parent::__construct();

        $this->car_id = $id;
    }

    private function verify() {
        $errors = array();

        $required = ['mode',  'value'];

        foreach ($required as $field) {
            if (!isset($_POST[$field]) || strlen($_POST[$field]) == 0)
                $errors[] = $field . ' is required!';
            else
                $this->values[$field] = $_POST[$field];
        }

        return $errors;
    }

    public function render() {
        $this->setTitle('Rent');

        $user = '';

        if($this->getLoginInfo() != 0 ){
            $user = User::getUserInfo($this->getLoginInfo());
        } else {
            $errors[] = 'User does not exist! Please register first!';
        }

        $errors = array();
        $success = "";

        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $errors = $this->verify();
            if(count($errors) == 0) {
                $result = RentalService::insertRental([
                    'car_id' => $this->car_id,
                    'user_id' => $this->getLoginInfo(),
                    'mode' => $this->values['mode'],
                    'value' => $this->values['value']
                ]);

                if($result != 0) {
                    $success = 'Car Rented!';
                } else {
                    $errors[] = 'Car rental failed';
                }
            }
        }

        Renderer::render("rent.php", [
            'user' => $user,
            'car' => RentalService::getCarDetails($this->car_id),
            'values' => $this->values,
            'errors' => $errors,
            'success' => $success
        ]);
    }

}