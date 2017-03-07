<?php

class Register extends BasicPage {

    private $defaults = [
        'first_name' => 'First Name',
        'last_name' => 'Last Name',
        'email' => 'Email',
        'username' => 'Username',
        'password' => 'Password',
        'password_two' => 'Repeat Password',
        'street' => 'Street',
        'city' => 'City',
        'state' => 'State',
        'country' => 'Country',
        'zip' => 'Zip Code',
        'ph_no' => 'Phone Number'
    ];

    private $values = array();

    private function verify() {
        $errors = array();

        $required = ['first_name', 'last_name', 'email',
            'username', 'password', 'password_two',
            'street', 'city', 'state', 'country', 'zip'];


        foreach ($required as $field) {
            if (!isset($_POST[$field]) || strlen($_POST[$field]) == 0)
                $errors[] = $this->defaults[$field] . ' is required!';
            else
                $this->values[$field] = $_POST[$field];
        }

        if(count($errors) == 0) {
            if($_POST['password'] != $_POST['password_two'])
                $errors[] = 'Passwords do not match!';
            else if(strlen($_POST['password']) < 6)
                $errors[] = 'Password length must be greater than 6!';
            else if(strlen($_POST['username']) < 4)
                $errors[] = 'Username must be more than 3 characters!';

        }

        return $errors;
    }


    public function render() {
        $this->setTitle('Register');

        $errors = array();
        $success = "";
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $errors = $this->verify();

            if(count($errors) == 0) {
                $result = User::insertUser($_POST);
                if(is_int($result) && $result != 0)
                    $success = "Successfully registered!";
                else if(is_int($result) && $result == 0)
                    $errors[] = "An Error Occurred!";
                else {
                    if(strstr($result, '23000') && strstr($result, 'email'))
                        $errors[] = 'User with this email already exists!';
                    else if(strstr($result, '23000') && strstr($result, 'username'))
                        $errors[] = 'Username is already registered!';
                    else {
                        $this->values = array();
                        $success = "Successfully registered!";
                    }
                }
            }
        }

        Renderer::render('register.php', [
            'errors' => $errors,
            'defaults' => $this->defaults,
            'values' => $this->values,
            'success' => $success
        ]);
    }
}