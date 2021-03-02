<?php
namespace EvolutionCMS\Main\Controllers;

//контроллер для страниц с алиасом шаблона home, отправляющий данные в view блейда с именем home.blade.php

class HomeController extends BaseController
{

    protected function setPageData()
    {
        /*в этом методе устанавливаем в массив $this->data специфические
        для данной страницы данные*/

        $this->data['testhome'] = 'данные из контроллера страницы шаблона home';
    }
}

