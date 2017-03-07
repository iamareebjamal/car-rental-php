<?php

class Profile extends BasicPage {

    public function render() {
        $this->setTitle('Profile');

        $user = '';
        $rentals = [];
        $admin = false;

        $id = $this->getLoginInfo();
        if($id != 0 ){
            $user = User::getUserDetails($id);
            $admin = User::isUserAdmin($id);

            if($admin) {
                if($_SERVER['REQUEST_METHOD'] == 'POST') {
                    if (isset($_POST['transaction_id']) && strlen($_POST['transaction_id']) != 0) {
                        RentalService::removeRental($_POST['transaction_id']);
                    }
                }

                $rentals = RentalService::getRentals();
            }
        }

        Renderer::render("profile.php", [
            'user' => $user,
            'admin' => $admin,
            'rentals' => $rentals
        ]);
    }

}