<?php
/**
 * class Logs
 * 全局日志操作类
 * @author sily
 */

class Logs {

    public $logfile_path;

    const LOGFILE_PATH = 'logs/';

    public function __construct() {
        $path = func_get_arg(0);
        if (is_file($path)) {
            $this->logfile_path = $path;
        }
    }


    /**
     * method write
     * 写进日志文件
     * @param string $type              指定日志类型，alert、error、access等
     * @param string $timestamp        日期
     * @return string $log_content_str
     */
    public function read($type, $timestamp) {
        $timestamp = strtotime($timestamp);
        if (!$type) {
            //自定义日志文件路径
            $log_content_str = file_get_contents($this->logfile_path);
        } else {
            $logfile = APPLICATION_PATH . 'logs/' . $type . '.log';
            $log_content_str = file_get_contents($logfile);
        }
        $log_content_arr = explode('--', $log_content_str);
        foreach ($log_content_arr as $log_k => $log_v) {
            $front = strpos($log_v, '[');
            $back = strpos($log_v, ']');
            $log_time = substr($log_v, $front + 1, $back - $front - 1);
            if ($timestamp == strtotime($log_time)) {
                $log_content = substr($log_v, $back + 1);
            }
        }
        // dump($log_content_arr);
        return $log_content;
    }



    /**
     * method read
     * 读取日志中内容
     * @param string $type              指定日志类型，alert、error、access等
     * @param string $timestamp        日期
     * @param string $role              操作者
     * @param string $do                 操作类型
     * @param string $something         具体操作
     * 
     * @return bool
     * @author sily
     */
    public function write($type, $timestamp, $role, $do, $something) {
        $timestamp = date('Y-m-d H:i:s', $timestamp);
        $log_content_str = "--[" . $timestamp . "]\n" . $role . ' ' . $do . ' ' . $something . "\n";
        if ($this->logfile_path !== null) {
            file_put_contents($this->logfile_path, $log_content_str, FILE_APPEND);
            return true;
        } else {
            file_put_contents(APPLICATION_PATH . self::LOGFILE_PATH . $type . '.log', $log_content_str, FILE_APPEND);
            return true;
        }
        return false;
    }


    /** 
     * method clearlog
     * 清除某一类的日志
     * @param string $type          指定日志类型，alert、error、access等
     * @return bool
     *
     * @author sily
     */
    public function clearlog($type) {}


    /**
     * method clearall
     * 清除所有日志
     * @return bool
     * @author sily
     */
    public function clearall() {}



}


?>