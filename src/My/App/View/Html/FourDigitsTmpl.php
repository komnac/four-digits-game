<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap-theme.min.css">
    <script src="//code.jquery.com/jquery-2.1.4.min.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <title>Игра Быки и коровы</title>
</head>
<body>
<div class="container">
    <div class="page-header">
        <h1>Игра Быки и коровы</h1>
        <p class="lead">Я загадал четырехзначное число состоящее из уникальных цифр. Ваша задача его отгадать. На каждый из ваших вариантов, я отвечаю <strong>Бык</strong> если цифра совпала с позицией и <strong>Корова</strong> если цифра есть, но ее позиция не совпала.</p>
    </div>
    <div class="row">

    </div>
    <div class="row">
        <div class="col-md-3"></div>
        <form>
            <input type="hidden" id="tel" name="tel" value="<?php echo $this->data->phone ?>"/>
            <div class="col-md-4 col-xs-8 form-group">
                <input type="text" id="msg" name="msg" class="form-control" placeholder="Ответ">
            </div>
            <div class="col-md-2 col-xs-4">
                <button type="submit" class="btn btn-primary">Отправить</button>
            </div>
        </form>
        <div class="col-md-3"></div>
    </div>
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6 col-xs-12">
            <?php if ($this->data->win): ?>
            <div class="alert alert-success">
                Вы выиграли
            </div>
            <?php endif ?>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Ответ</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    for ($i = count($this->data->history); $i > 0; $i--) {
                        printf('<tr><th>%u</th><td>%s</td></tr>', $i, $this->data->history[$i - 1]);
                    }
                ?>
                </tbody>
            </table>
        </div>
        <div class="col-md-3"></div>
    </div>
</div>
</body>
</html>
