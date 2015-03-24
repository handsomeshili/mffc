<?php

/**
 * Article model
 * 文章例子模型
 * 
 * @author sily
 */
// use Illuminate\Database\Capsule\Manager as Capsule; 
class Article extends  Illuminate\Database\Eloquent\Model{
    protected $table = 'article';
    public $timestamps = false;
    // public static function first() {
    //     $connection = mysql_connect('localhost', 'root', '1234');
    //     if (!$connection) {
    //         echo 'can not connect to databases' . mysql_error();
    //         exit();
    //     }

    //     mysql_set_charset('utf-8', $connection);

    //     mysql_select_db('mffc');

    //     $result = mysql_query('select * from article limit 0,2');
    //     // var_dump($result);  ---->resource(15) of type (mysql result)

    //     $re = array();
    //     while ($row = mysql_fetch_array($result)) {
    //         // echo '<h1>' . $row['title'] . '</h1>';
    //         // echo '<p>' . $row['content'] . '</p>';
    //         $re[]['title'] = $row['title'];
    //         $re[]['content'] = $row['content'];
    //     }
    //     mysql_close($connection);
    //     return $re;
        // $article = Capsule::table('article')->get();
        // return $article;
    // }

    



}




?>