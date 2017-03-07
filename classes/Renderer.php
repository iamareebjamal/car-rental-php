<?php

class Renderer {

    private static $injection = array();

    public static function inject($key, $value){
        self::$injection[$key] = $value;
    }

    public static function render($contentFile, $variables = array()) {

        $contentFileFullPath = "../templates/" . $contentFile;

        // making sure passed in variables are in scope of the template
        // each key in the $variables array will become a variable
        if (count($variables) > 0) {
            foreach ($variables as $key => $value) {
                if (strlen($key) > 0) {
                    ${$key} = $value;
                }
            }
        }

        foreach (self::$injection as $key => $value) {
            if (strlen($key) > 0) {
                ${$key} = $value;
            }
        }

    require_once("../templates/components/header.php");

    echo "\n<div class=\"container\">\n";

    if (file_exists($contentFileFullPath)) {
        require_once($contentFileFullPath);
    } else {
        require_once("../templates/error.php");
    }

    // close container div
    echo "</div>\n";

    require_once("../templates/components/footer.php");
}

}