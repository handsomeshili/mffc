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
        $con = getConfByName('config_name');
        var_dump($con);
        $this->view = $this->getView('User')->with('user','sily');

    }
}



 ?>