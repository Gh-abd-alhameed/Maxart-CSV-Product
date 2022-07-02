<?php



defined("ABSPATH") or die('');

class MaxartCsvRoute
{
    public function post($routePath, $callback)
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') :
            return  false;
        endif;
        $uri =  $_SERVER['REQUEST_URI'];
        if ($uri == $routePath) :
            if (is_string($callback)) :
                return $this->string_handler($callback);
            else :
                $this->handled = true;
                $callback($callback);
            endif;
        endif;
    }
    private function string_handler($string)
    {
        if (strpos($string, '@')) {
            return $this->class_handeler($string);
        } else {
            $this->handled = true;
            return $string;
        }
    }
    private function class_handeler($callback)
    {
        $exp = explode('@', $callback);
        $className = $exp[0];
        $fanction = $exp[1];
        $this->handled = true;
        require_once __DIR__ . '/' . $className . '.php';
        $class = new $className;
        return  $class->$fanction();
    }
    function __destruct()
    {
        die;
    }
}
