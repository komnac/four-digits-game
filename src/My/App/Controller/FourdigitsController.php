<?php
/**
 * Created by PhpStorm.
 * User: komnac
 * Date: 16.08.15
 * Time: 13:24
 */

namespace My\App\Controller;

use My\App\View\Factory as ViewFactory;
use My\App\Application;

class FourdigitsController extends Controller
{
    public function exec()
    {
        ViewFactory::factory('Fourdigits', Application::isCli() ? 'cli' : 'html')
            ->show();
    }
}
