<?php
/**
 * basecontroller
 */

class BaseController {
    protected $view;

    public function __construct() {
        // echo "BaseController initlized success!<br />";
    }

    public function __destruct(){
        $view = $this->view;

        if ($view instanceof View) {
            extract($view->data);

            require $view->view;
        }
    }
}



?>
