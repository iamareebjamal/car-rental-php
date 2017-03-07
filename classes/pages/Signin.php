<?php

class Signin extends BasicPage {

    private $values = array();

    private function verify() {
        $errors = array();

        $required = ['username',  'password'];

        foreach ($required as $field) {
            if (!isset($_POST[$field]) || strlen($_POST[$field]) == 0)
                $errors[] = $field . ' is required!';
            else
                $this->values[$field] = $_POST[$field];
        }

        return $errors;
    }

    public function render() {
        $this->setTitle('Sign In');

        $errors = array();
        $success = "";
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $errors = $this->verify();

            if(count($errors) == 0) {
                $id = User::doesUserExist($_POST['username']);
                if ($id == 0) {
                    $errors[] = 'User does not exist! Please register first!';
                } else if(!User::verifyUser($id, $_POST['password'])) {
                    $errors[] = 'Wrong Password!';
                } else {
                    $this->values = [];
                    Utils::login($id);
                    $this->refreshStatus();
                    $success = "Successfully logged in!";
                }
            }
        }

        Renderer::render("signin.php", [
            'errors' => $errors,
            'values' => $this->values,
            'success' => $success
        ]);
    }

}