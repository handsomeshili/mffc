<?php

/**
 *  HomeController
 *
 */

class HomeController extends BaseController {
    public function home() {
        // echo 'Homecontroller initlized success!';
        var_dump($_GET);

        $article = Article::get();
        $this->view = View::make('home')->with('article',$article);
        //require 载入外部文件，相当于在当前脚本require此行插入外部文件的所有代码.
        // require dirname(__FILE__) . '/../views/home.html';
    }
}



?>
