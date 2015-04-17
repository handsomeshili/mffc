<?php

/**
 *  HomeController
 *
 */

use System\Serve;

class HomeController extends BaseController {

    public function init() {
        //load models
        $this->loadModelByName('Article');
        $this->loadServiceByName('UserService');
    }

    public function index() {
        dump(getConfByName('database','host'));
        $this->view = $this->getView('index')->with('content', 'hello Tinyphp');
    }

    // public function index() {
    //     $this->init();
    //     $redis = BaseRedis::getInstance();
    //     $redis->set('name', 'append2');
    //     dump($redis->get('name'));
    //     $redis->set('num', 12);
    //     $redis->incr('num');
    //     dump($redis->get('num'));
    //     $module_name = $this->getModule();
    //     var_dump($module_name);die;
    //     $this->redirect('home');
    // }

    public function home() {
        $this->init();
        $service = new UserService();
        $service->index();
        // echo 'Homecontroller initlized success!';
        $article = Article::get();
        // $all = Article::all();
        // var_dump($all);
        $this->view = $this->getView('home')->with('article',$article);
        //require 载入外部文件，相当于在当前脚本require此行插入外部文件的所有代码.
        // require dirname(__FILE__) . '/../views/home.html';
    }

    public function writeLog() {
        $logger_path = APPLICATION_PATH . 'logs/alert.log';
        $logger = new Logs($logger_path);
        $logger->write('error', time(), 'sb', 'delete', 'something');
        exit;
    }
    public function readLog(){
        $logger_path = APPLICATION_PATH . 'logs/alert.log';
        $logger = new Logs($logger_path);
        // $logger->write('error', time(), 'sb', 'delete', 'something');
        $content = $logger->read('', "2015-04-10 18:29:32");

        dump($content);

        exit;
    }
}



