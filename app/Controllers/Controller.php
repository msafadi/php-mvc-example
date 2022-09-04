<?php

namespace Controllers;

use View;

class Controller
{
    public function view($name, $data = [])
    {
        $view = new View($name, $data);
        $view->render();
    }

    public function redirect($url)
    {
        header("Location: $url");
        exit;
    }

    public function flashMessage($name, $message)
    {
        $_SESSION['flash-messages'][$name] = $message;
    }
}