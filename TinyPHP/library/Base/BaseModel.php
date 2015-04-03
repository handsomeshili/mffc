<?php 

/**
  * class BaseModel
  * 全局model基类
  *
  *@author sily
  */

class BaseModel extends Illuminate\Database\Eloquent\Model{

    protected $_model;
    protected $table;




    /**
     * 构造器
     */
    public function __construct(){
      // $this->table = $tabl_name;
    }

    // public static function setT($tabl_name) {
    //     $this->table = $tabl_name;
    // }

    // public static function getAll(){
    //   return BaseModel::all();
    // }
}








 ?>