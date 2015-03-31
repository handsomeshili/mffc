<?php

/**
 *  HomeController
 *
 */

class HomeController extends BaseController {

    public function init() {
        //load models
        $this->loadmodel('Article');    
    }

    public function index() {
        $this->init();
        $redis = BaseRedis::getInstance();
        $redis->set('name', 'append2');
        dump($redis->get('name'));
        $redis->set('num', 12);
        $redis->incr('num');
        dump($redis->get('num'));
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
