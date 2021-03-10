<?php namespace EvolutionCMS\Main;

class Snippet
{
    protected function __construct()
    {

    }

    public static function __callStatic($name, $arguments) {
        return (new self)->runSnippet($name, $arguments);
    }

    public function runSnippet($name, $arguments)
    {
        $params = !empty($arguments[0]) ? $arguments[0] : [];
        $cacheTime = isset($arguments[1]) && $arguments[1] !== false ? $arguments[1] : false;
        $cacheKey = isset($arguments[2]) && $arguments[2] !== false ? $arguments[2] : false;
        $out = evolutionCMS()->runSnippet($name, $params, $cacheTime, $cacheKey);
        $out = $this->prepareResult($name, $params, $out);
        return $out;
    }

    protected function prepareResult($name, $params, $out)
    {
        if(is_callable([$this, 'prepareResult' . $name])) {
            $method = 'prepareResult' . $name;
            $out = $this->$method($params, $out);
        }
        return $out;
    }

    protected function prepareResultDocLister($params, $out) {
        if(!empty($params['api'])) {
            if (!empty($out)) {
                $out = json_decode($out, true);
            }
        }
        return $out;
    }

    protected function prepareResultDLMenu($params, $out) {
        if(!empty($params['api'])) {
            if (!empty($out)) {
                $out = json_decode($out, true);
                if(!empty($out[0])) $out = $out[0];
            }
        }
        return $out;
    }

    protected function prepareResultmultiTV($params, $out)
    {
        if(!empty($params['toJson']) && $params['toJson'] === true) {
            if (!empty($out)) {
                $out = json_decode($out, true);
            } else {
                $out = [];
            }
        }
        return $out;
    }


}
