<?php

namespace Inflector;

class Inflector {

    protected static $plural = [
        '/(.*)(qu)y$/i' => '$1$2ies',
        '/(.*)[aeiou]y$/i' => '$0s',
        '/(.*)y$/i' => '$1ies',
        '/(x|z|s|ss|ch|sh)$/i' => '$0es',
        '/$/i' => '$0s'
    ];

    protected static $pluralCache;

    protected static $singular = [
        '/quies$/i' => '$1quy',
        '/(.*)ies$/i' => '$1y',
        '/(x|z|s|ss|ch|sh)es$/i' => '$1',
        '/s$/i' => ''
    ];

    protected static $singularCache;

    protected static $irregulars = [
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

    protected static $identicals = [
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

    protected static $provider;

    public static function plural($value)
    {
        if(isset(static::$pluralCache[$value]))
        {
            return static::$pluralCache[$value];
        }

        $result = static::inflect($value, static::$plural, static::$irregulars);

        if(self::$provider)
        {
            $provided = self::$provider->plural($value);

            $result = $provided ? static::matchCase($value, $provided) : $result;
        }

        return static::$pluralCache[$value] = $result ?: $value;
    }

    public static function singular($value)
    {
        if(isset(static::$singularCache[$value]))
        {
            return static::$singularCache[$value];
        }

        $irregulars = array_flip(static::$irregulars);

        $result = static::inflect($value, static::$singular, $irregulars);

        if(static::$provider)
        {
            $provided = static::$provider->singular($value);

            $result = $provided ? static::matchCase($value, $provided) : $result;
        }

        return static::$singularCache[$value] = $result ?: $value;
    }

    protected static function inflect($value, $rules, $irregulars = [])
    {
        foreach($irregulars as $noun => $inflected)
        {
            if(strtolower($value) == $noun)
            {
                return static::matchCase($value, $inflected);
            }
        }

        foreach(static::$identicals as $identical)
        {
            if(strtolower($value) == $identical)
            {
                return static::matchCase($value, $identical);
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

    protected static function matchCase($compare, $match)
    {
        if(ucfirst($compare) == $compare)
        {
            return ucfirst($match);
        }

        return $match;
    }

    public static function setProvider(ProviderInterface $provider)
    {
        self::$provider = $provider;
    }

    public static function getProvider()
    {
        return static::$provider;
    }

}
