<?php 
/**
 * class Validate
 * 数据验证封装类
 * 
 * @author sily
 */


class Validator {

    public function __construct() {
        //
    }

    /**
     * function _isInteger
     * 验证整数
     *
     * @param int $int_var  需要验证的数值
     * @param array $int_option 需要验证的数值的大小范围等
     * @return bool 
     */
    public static function _isInteger($int_var, $int_option) {
        if (!filter_var($int_var, FILTER_VALIDATE_INT, $int_option)) {
            return false;
        } else {
            return true;
        }
    }

    /**
     * function _sanitizeString()
     * 过滤器去除或编码不需要的字符 : 
     *
     * @param string $str
     * @return string | bool
     */
    public static function _sanitizeString($str) {
        if ($str === '') {
            return false;
        }
        return filter_var($str, FILTER_SANITIZE_STRING);
    }

    public static function _isIpv4($ip) {
        if ($ip === '') {
            return false;
        }

        if (!filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
            return false;
        } else {
            return true;
        }
    }

    public static function _isIpv6($ip) {
        if ($ip === '') {
            return false;
        }

        if (!filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)) {
            return false;
        } else {
            return true;
        }
    }

    public static function _isEmail($email) {
        if ($email === '') {
            return false;
        }

        if (! filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return false;
        } else {
            return true;
        }
    }

    /**
     * function _validateUrl
     * 验证url是否符合要求
     *
     * @param string $url   需要验证的url
     * @param string $option
     * @return bool
     */
    public static function _validateUrl($url, $option) {
        /**
         * $option 的值包括： 
         * SCHEME : 要求url是RFC兼容URL，例如http://example
         * HOST : 要求URL包含主机名，例如http://www.example.com
         * PATH : 要求URL在主机名后包含资源路径了，例如htttp://www.eg.com/example1/
         * QUERY : 要求URL存在查询字符串，例如eg.php?age=12 
         */
        $option = strtoupper($option);
        $rule = 'FILTER_FLAG_' . $option . '_REQUIRED';
        if (!filter_var($url, FILTER_VALIDATE_URL, $rule)) {
            return false;
        } else {
            return true;
        }
    }



}




 ?>