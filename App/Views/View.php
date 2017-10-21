<?php

namespace App\Views;

use App\Components\Magic;

class View
    implements \Countable
{
    use Magic;

    /**
     * @param $template string Путь к шаблону
     */
    public function render($template, $layout)
    {

        ob_start();
        foreach ($this->date as $prop => $value) {
            $$prop = $value;
        }
        include $template;
        $content = ob_get_contents();
        ob_end_clean();

        ob_start();
        include $layout;
        $page = ob_get_contents();
        ob_end_clean();
        return $page;
    }

    /**
     * @param $template string Путь к шаблону
     */
    public function display($template, $layout = __DIR__ . '/../layouts/index.php')
    {
        echo $this->render($template, $layout);
    }

    /**
     * Count elements of an object
     * @link http://php.net/manual/en/countable.count.php
     * @return int The custom count as an integer.
     * </p>
     * <p>
     * The return value is cast to an integer.
     * @since 5.1.0
     */
    public function count()
    {
        return count($this->date);
    }
}