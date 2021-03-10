<?php namespace EvolutionCMS\Main;

class Chunk
{
    protected function __construct()
    {

    }

    public static function __callStatic($name, $arguments)
    {
        return (new self)->parseChunk($name, $arguments);
    }

    public function parseChunk($name, $arguments)
    {
        $params = !empty($arguments[0]) ? $arguments[0] : [];
        $out = evolutionCMS()->parseChunk($name, $params, '[+', '+]');
        return $out;
    }

}
