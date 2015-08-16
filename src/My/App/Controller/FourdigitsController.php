<?php
/**
 * Created by PhpStorm.
 * User: komnac
 * Date: 16.08.15
 * Time: 13:24
 */

namespace My\App\Controller;

use My\App\Model\FourdigitsModel;
use My\App\View\Factory as ViewFactory;
use My\App\Application;

class FourdigitsController extends Controller
{
    public function exec()
    {
        $viewData = new \stdClass();
        $request = $this->getRequest();

        $model = new FourdigitsModel($request->phone);
        $game = $model->findGame();
        if ($game === false) {
            $game = $model->newGame();
        }

        $viewData->win = $game->play($request->message);
        $viewData->history = $game->getHistory();
        $viewData->phone = $request->phone;

        ViewFactory::factory('Fourdigits', Application::isCli() ? 'cli' : 'html')
            ->setData($viewData)
            ->show();
    }
}
