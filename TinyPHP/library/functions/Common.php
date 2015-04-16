<?php
/**
 * 全局公共函数库
 */

/**
 * 重写var_dump()
 *
 */

function dump() {
    $argument = func_get_args();
    echo '<pre>';
    foreach($argument as $key => $value) {
        if (is_array($value)) {
            print_r($value);
        } else {
            echo $value;
        }
    }
    echo '</pre><br />';
}

/**
 * method debug
 * 自定义调试文件
 * 
 */
function debug() {
    $arg_list = func_get_args();

    $called = debug_backtrace();

    echo '</pre>' . PHP_EOL;

    foreach ($arg_list as $value) {
        echo '<strong>' . $called[0]['file'] . ' (line ' . $called[0]['line'] . ')</strong> ' . PHP_EOL;

        if (is_array($value)) {
            print_r($value);
        } else {
            var_dump($value);
        }

        echo PHP_EOL;
    }
    echo '</pre>' . PHP_EOL;
    exit();
}

/**
 * Method getConfByName
 * 根据配置项名称返回配置项的值
 * @param string $name
 * @return string $conf_value | 'no suck config option'
 */
function getConfByName($index, $name) {
    $config = Application::getSysConfig();
    if (isset($config[$index][$name])) {
        return $config[$index][$name];
    } else {
        return 'no suck config option';
    }
}


function is_url($variable = '') {
    $pattern = '/^(?:https?):\/\/(?:[a-z0-9]+\-?[a-z0-9]+\.)*([a-z0-9]+(?:\-?[a-z0-9])*\.[a-z]{2,})(?:\/?.*)$/is';

    if (preg_match($pattern, trim($variable))) {
        return true;
    } else {
        return false;
    }
}


function check() {
    echo 'check common funcitons here';
}


/**
 * 验证数是否相等
 * @param int $value1
 * @param int $value2
 * @return bool
 *
 */
function is_number_equal($value1, $value2) {
    return abs($value1 - $value2) < 0.00000001;
}


/**
 * 时间验证
 * @param string $time
 * @param string $date_delimiter
 * @return bool
 *
 */
function is_date($time, $date_delimiter = '-') {
    $timestamp = strtotime($time);

    $date = date("Y{$date_delimiter}m{$date_delimiter}d", $timestamp);

    if ($time === $date) {
        return true;
    } else {
        return false;
    }
}


/**
 * 验证是否今天
 * @param string $time
 * @return bool
 */
function is_today($time){
    $current = date('Ymd', time());


    $check_time = date('Ymd', strtotime($time));

    if ((int)$check_time === (int)$current) {
        return true;
    } else {
        return false;
    }
}


/**
 * Method  underline_to_camel
 * 下划线转驼峰
 *
 * @param string $string
 * @param bool   $is_ignore_uppercase
 *
 * @return string
 */
function underline_to_camel($string, $is_ignore_uppercase = false) {
    if (false === $is_ignore_uppercase) {
        return preg_replace('/_([a-zA-Z])/e', "strtoupper('\\1')", $string);
    } else {
        return preg_replace('/_([a-z])/e', "strtoupper('\\1')", $string);
    }
}

/**
 * Method  camel_to_underline
 * 驼峰转下划线
 *
 * @param $string
 *
 * @return string
 */
function camel_to_underline($string) {
    $pattern = '/(?!^)(?=[A-Z])/';
    return strtolower(preg_replace($pattern, '_', $string));
}


/**
 * Method  get_client_ip
 * 获取客户端IP
 *
 * @return bool|string
 */
function get_client_ip() {
    //验证HTTP头中是否有REMOTE_ADDR
    if (!isset($_SERVER['REMOTE_ADDR'])) {
        return '127.0.0.1';
    }

    //验证是否为非私有IP
    if (filter_var($_SERVER['REMOTE_ADDR'], FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE)) {
        return $_SERVER['REMOTE_ADDR'];
    }

    //验证HTTP头中是否有HTTP_X_FORWARDED_FOR   参考http://segmentfault.com/q/1010000000686700
    if (!isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        return $_SERVER['REMOTE_ADDR'];
    }

    //定义客户端IP
    $client_ip = '';

    //获取", "的位置
    $position = strrpos($_SERVER['HTTP_X_FORWARDED_FOR'], ', ');

    //验证$position
    if (false === $position) {
        $client_ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $client_ip = substr($_SERVER['HTTP_X_FORWARDED_FOR'], $position + 2);
    }



    //验证$client_ip是否为合法IP
    if (filter_var($client_ip, FILTER_VALIDATE_IP)) {
        return $client_ip;
    } else {
        return false;
    }
}


/**
* 获取安全的参数，在向数据库中插入和更新字符串数据时需要
* 通过这个方法过滤插入内容
*/
function getSafeString($value, $is_html=false) {
    $str = array(">", "<", "'", "\"", "\\");
    $value = trim($value);
    if ($is_html == false) {
        $value = strip_tags($value);
    } else {
        $value = preg_replace("/<(script.*?)>(.*?)<(\/script.*?)>/si","",$value) ;
        $value = preg_replace("/<(iframe.*?)(.*?)<(\/iframe.*?)>/si","",$value);
        $value = preg_replace("/<(iframe.*?)(.*?)\/>/si","",$value);
    }
    $value = trim($value);
    $value = addslashes($value);
    $value = str_replace($str, '', $value);
        
    return $value;
}

?>