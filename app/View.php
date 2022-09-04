<?php

class View
{

    protected string $name;

    protected array $data = [];

    public function __construct(string $name, array $data = [])
    {
        $this->name = $name;
        $this->data = $data;
    }

    public function render()
    {
        // Extract array items to variables
        // extract(['x' => 1, 'b' => 'string']) -> echo $x, $b
        extract($this->data);

        $view = __DIR__ . "/../views/{$this->name}.php";
        include __DIR__  . "/../views/layout.php";
        //
    }

    public function flashMessage($name)
    {
        if (isset($_SESSION['flash-messages'][$name])) {
            $message = $_SESSION['flash-messages'][$name];
            unset($_SESSION['flash-messages'][$name]);
            return $message;
        }
    }
}