<?php

class NotFound extends BasicPage {

    public function render() {
        $this->setTitle('Not Found');

        Renderer::render("not_found.php");
    }

}