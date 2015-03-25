<?php 

/**
  * class BaseModel
  * 全局model基类
  *
  *@author sily
  */

class BaseModel extends Illuminate\Database\Eloquent\Model {

    public $timestamps = false;

    /**
     * 构造器
     */
    public function __construct() {
        //codes...
        parent::__construct();
    }
}








 ?>