<?php

/**
 *  HomeController
 *
 */

class HomeController extends BaseController {

    public function index() {
        check();
        BaseRedis::set('name', 'sily', 1, 'm');
        echo BaseRedis::get('name');die;
        $module_name = $this->getModule();
        var_dump($module_name);die;
        $this->redirect('home');
    }

    public function home() {
        // echo 'Homecontroller initlized success!';
        $article = Article::get();
        $all = Article::all();
        // var_dump($all);
        $this->view = $this->getView('home')->with('article',$article);
        //require 载入外部文件，相当于在当前脚本require此行插入外部文件的所有代码.
        // require dirname(__FILE__) . '/../views/home.html';
    }




}



?>
