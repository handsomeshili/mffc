<?php 
/**
 * class UserController
 * user控制器
 *
 * @author sily
 */
class UserController extends BaseController {

    /**
     * Method index
     *
     * @author sily
     */
    public function index() {
        $this->view = $this->getView('User')->with('user','sily');

    }
}



 ?>