<?php
/**
 * View
 */


class View
{
  const VIEW_BASE_PATH =  'views/';

  public $view;
  public $data;

  public function __construct($view)
  {
    $this->view = $view;
  }

  public static function make($viewName = null)
  {
    if ( ! $viewName ) {
      throw new InvalidArgumentException("视图名称不能为空！");
    } else {
      
      $viewFilePath = self::getFilePath($viewName);

      if ( is_file($viewFilePath) ) {
        return new View($viewFilePath);
      } else {
        throw new UnexpectedValueException("视图文件不存在！");
      }
    }
  }

  public function with($key, $value = null)
  {
    $this->data[$key] = $value;
    return $this;
  }

  private static function getFilePath($viewName)
  {

    //考虑多模块的时候这里需要修改----done
    $module_name = BaseController::$_module;

    $filePath = str_replace('.', '/', $viewName);

    if ($module_name == 'Index') {
        //默认的mudule下
        $view_path = APPLICATION_PATH.self::VIEW_BASE_PATH.$filePath.'.html';
    } else {
        //非默认的mudule下
        $view_path = APPLICATION_PATH . 'modules/' . $module_name . '/' . self::VIEW_BASE_PATH.$filePath.'.html';
    }
    // var_dump($view_path);die;
    return $view_path;
  }

  public function __call($method, $parameters)
  {
    if (starts_with($method, 'with'))
    {
      return $this->with(snake_case(substr($method, 4)), $parameters[0]);
    }

    throw new BadMethodCallException("方法 [$method] 不存在！.");
  }
}