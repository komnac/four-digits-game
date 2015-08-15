<?php

namespace My\App\View;

abstract class View {
    protected $data;

    /**
     * Setup data for View.
     *
     * @param mixed $data
     *
     * @return self
     */
    public function setData($data)
    {
        $this->data = $data;

        return $this;
    }

    /**
     * Output View.
     *
     * @return void
     */
    abstract public function show();
}
