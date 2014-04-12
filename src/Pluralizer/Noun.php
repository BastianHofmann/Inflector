<?php

namespace Pluralizer;

class Noun {

    protected $plural = [
        '/(.*)(qu)y$/i' => '$1$2ies',
        '/(.*)[aeiou]y$/i' => '$0s',
        '/(.*)y$/i' => '$1ies',
        '/(x|z|s|ss|ch|sh)$/i' => '$0es',
        '/$/i' => '$0s'
    ];

    protected $pluralCache;

    protected $singular = [
        '/quies$/i' => '$1quy',
        '/(.*)ies$/i' => '$1y',
        '/(x|z|s|ss|ch|sh)es$/i' => '$1',
        '/s$/i' => ''
    ];

    protected $singularCache;

    protected $irregulars = [
        'goose' => 'geese',
        'hero' => 'heroes',
        'potato' => 'potatoes',
        'calf' => 'calves',
        'child' => 'children',
        'goose' => 'geese',
        'half' => 'halves',
        'leaf' => 'leaves',
        'louse' => 'lice',
        'life' => 'lives',
        'man' => 'men',
        'mouse' => 'mice',
        'person' => 'people',
        'shelf' => 'shelves',
        'tooth' => 'teeth',
        'wife' => 'wives',
        'woman' => 'women'
    ];

    protected $identicals = [
        'bison',
        'buffalo',
        'deer',
        'duck',
        'fish',
        'moose',
        'pike',
        'sheep',
        'species',
        'salmon',
        'trout',
        'swine',
        'plankton',
        'squid'
    ];

    public function plural($value)
    {
        if(isset($this->pluralCache[$value]))
        {
            return $this->pluralCache[$value];
        }

        $result = $this->inflect($value, $this->plural, $this->irregulars);

        return $this->pluralCache[$value] = $result ?: $value;
    }

    public function singular($value)
    {
        if(isset($this->singularCache[$value]))
        {
            return $this->singularCache[$value];
        }

        $irregulars = array_flip($this->irregulars);

        $result = $this->inflect($value, $this->singular, $irregulars);

        return $this->singularCache[$value] = $result ?: $value;
    }

    protected function inflect($value, $rules, $irregulars = [])
    {
        foreach($irregulars as $noun => $inflected)
        {
            if(strtolower($value) == $noun)
            {
                return $this->matchCase($value, $inflected);
            }
        }

        foreach($this->identicals as $identical)
        {
            if(strtolower($value) == $identical)
            {
                return $this->matchCase($value, $identical);
            }
        }

        foreach($rules as $pattern => $replacement)
        {
            if(preg_match($pattern, $value))
            {
                return preg_replace($pattern, $replacement, $value);
            }
        }
    }

    protected function matchCase($compare, $match)
    {
        if(ucfirst($compare) == $compare)
        {
            return ucfirst($match);
        }

        return $match;
    }

}
