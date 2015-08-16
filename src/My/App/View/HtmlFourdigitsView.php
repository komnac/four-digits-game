<?php

namespace My\App\View;

class HtmlFourdigitsView extends ViewHtml
{
    protected function getTemplate()
    {
        return __DIR__ . DIRECTORY_SEPARATOR . 'Html' . DIRECTORY_SEPARATOR . 'FourDigitsTmpl.php';
    }
}
