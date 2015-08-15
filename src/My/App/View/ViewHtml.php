<?php

namespace My\App\View;

abstract class ViewHtml extends View
{
    protected $data;

    /**
     * Setup html template.
     *
     * @return string path to HTML template
     */
    abstract protected function getTemplate();

    /**
     * {@inheritdoc}
     */
    public function show()
    {
        $template = $this->getTemplate();
        if (!file_exists($template)) {
            throw new \InvalidArgumentException(
                sprintf("Используемый шаблон '%s' не найден", $template)
            );
        }

        require_once $template;
    }
}
