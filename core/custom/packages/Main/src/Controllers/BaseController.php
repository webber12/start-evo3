<?php
namespace EvolutionCMS\Main\Controllers;

//Базовый класс который занимается обработкой/кэшированием и прочими вещами.

class BaseController
{
    public $data = [];

    public function __construct()
    {
        //этот блок по желанию "на любителя" - кому как удобнее использовать
        $this->evo = evolutionCMS();
        $this->docid = $this->evo->documentIdentifier;
        ksort($_GET);
        $this->cacheid = md5(json_encode($_GET));

        //в этом методе собираем в массив $this->data данные, общие для всего сайта
        //называть его можно как угодно
        $this->setCommonData();

        //в этом методе собираем в массив $this->data данные для конкретного шаблона
        // (это метод, который надо переопределять в каждом контроллере)
        $this->setPageData();

        //отправляем наш собранный массив $this->data во вьюху - он должен быть обязательно
        $this->sendToView();
    }

    public function setCommonData()
    {
        $this->data['testbase'] = 'данные из базового контроллера';
    }

    public function sendToView()
    {
        $this->evo->addDataToView($this->data);
    }

    protected function setPageData()
    {
        //в базовом контроллере оставляем пустым, он для переопределения данных в каждом контроллере
    }

}

