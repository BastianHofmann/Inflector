<?php

namespace Inflector;

class JsonProvider implements ProviderInterface {

    protected $nouns;

    public function plural($value)
    {
        $this->fetch();

        $value = strtolower($value);

        if(isset($this->nouns[$value]))
        {
            return $this->nouns[$value];
        }
    }

    public function singular($value)
    {
        $this->fetch();

        $value = strtolower($value);

        $nouns = array_flip($this->nouns);

        if(isset($nouns[$value]))
        {
            return $nouns[$value];
        }
    }

    protected function fetch()
    {
        if( ! $this->nouns)
        {
            $data = file_get_contents(__DIR__ . '/data.json');

            $this->nouns = json_decode($data, true);
        }
    }

}
