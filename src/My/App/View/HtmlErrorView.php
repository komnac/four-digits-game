<?php

namespace My\App\View;

class HtmlErrorView extends ViewHtml
{
    protected function getTemplate()
    {
        return __DIR__ . DIRECTORY_SEPARATOR . 'Html' . DIRECTORY_SEPARATOR . 'ErrorTmpl.php';
    }
}
