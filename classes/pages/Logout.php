<?php

class Logout extends BasicPage {

    public function render() {
        $this->setTitle('Log Out');

        Utils::logout();
        $this->refreshStatus();

        Renderer::render("logout.php");
    }

}