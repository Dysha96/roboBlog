<?php

namespace App\Template;

function render($path, $variables)
{
    $template = 'resources' . DIRECTORY_SEPARATOR . 'views'. DIRECTORY_SEPARATOR . $path . '.phtml';
    extract($variables);
    ob_start();
    include $template;
    return ob_get_clean();
}
