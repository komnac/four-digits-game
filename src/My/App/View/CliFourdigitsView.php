<?php

namespace My\App\View;

class CliFourdigitsView extends View
{
    public function show()
    {
        $this->writeLn(
            sprintf('Phone: %s',
                $this->data->phone
            )
        );

        $this->writeLn('');
        $this->writeLn('History: ');
        $this->writeLn('');

        for ($i = count($this->data->history); $i > 0; $i--) {
            $this->writeLn(
                sprintf('#%u %s', $i, $this->data->history[$i - 1])
            );
        }

        if ($this->data->win) {
            $this->writeLn("!!!!!!!! You WINNER !!!!!!!!");
        }
    }

    protected function writeLn($msg)
    {
        echo $msg . PHP_EOL;
    }
}
