<?php
class ViewRenderer
{
    public static function render($view, $data = [])
    {
        extract($data);
        require "views/$view.php";
    }
}
