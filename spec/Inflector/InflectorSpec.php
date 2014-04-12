<?php

namespace spec\Inflector;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class InflectorSpec extends ObjectBehavior {

    function it_can_convert_a_simple_singular_noun_to_its_plural()
    {
        self::plural('Tree')->shouldBe('Trees');
        self::plural('Ladder')->shouldBe('Ladders');
    }

    function it_can_convert_a_simple_plural_to_singular()
    {
        self::singular('Trees')->shouldBe('Tree');
        self::singular('Ladders')->shouldBe('Ladder');
    }

    function it_converts_singulars_to_plurals_repeatedly()
    {
        self::plural('Tree')->shouldBe('Trees');
        self::plural('Tree')->shouldBe('Trees');
    }

    function it_converts_plurals_to_singulars_repeatedly()
    {
        self::singular('Trees')->shouldBe('Tree');
        self::singular('Trees')->shouldBe('Tree');
    }

    function it_can_convert_nouns_ending_in_an_silibal_sound_to_plural()
    {
        self::plural('Fox')->shouldBe('Foxes');
        self::plural('Kiss')->shouldBe('Kisses');
        self::plural('Dish')->shouldBe('Dishes');
        self::plural('Church')->shouldBe('Churches');
        self::plural('Buzz')->shouldBe('Buzzes');
        self::plural('Bus')->shouldBe('Buses');
    }

    function it_can_inflect_singular_nouns_ending_in_y()
    {
        self::plural('Country')->shouldBe('Countries');
        self::plural('Fly')->shouldBe('Flies');
    }

    function it_can_convert_nouns_ending_in_an_silibal_sound_to_singular()
    {
        self::singular('Foxes')->shouldBe('Fox');
        self::singular('Kisses')->shouldBe('Kiss');
        self::singular('Dishes')->shouldBe('Dish');
        self::singular('Churches')->shouldBe('Church');
        self::singular('Buzzes')->shouldBe('Buzz');
        self::singular('Buses')->shouldBe('Bus');
    }

    function it_can_convert_plurals_ending_in_ies_to_singular()
    {
        self::singular('Flies')->shouldBe('Fly');
        self::singular('Countries')->shouldBe('Country');
    }

    function it_can_convert_singulars_ending_in_vowel_y()
    {
        self::plural('Play')->shouldBe('Plays');
        self::plural('Toy')->shouldBe('Toys');
    }

    function it_can_convert_plurals_with_singulars_ending_in_vowel_y()
    {
        self::singular('Plays')->shouldBe('Play');
        self::singular('Toys')->shouldBe('Toy');
    }

    function it_inflects_non_italian_origin_singulars_ending_in_o()
    {
        self::plural('Hero')->shouldBe('Heroes');
        self::plural('Potato')->shouldBe('Potatoes');
    }

    function it_inflects_nouns_ending_in_quy()
    {
        self::plural('Soliloquy')->shouldBe('Soliloquies');
        self::singular('Soliloquies')->shouldBe('Soliloquy');
    }

    function it_can_inflect_nouns_with_identical_singulars_and_plurals()
    {
        self::singular('bison')->shouldBe('bison');
        self::plural('bison')->shouldBe('bison');
        self::singular('squid')->shouldBe('squid');
        self::plural('squid')->shouldBe('squid');
    }

    function it_convert_irregular_singulars_to_plurals()
    {
        self::plural('Goose')->shouldBe('Geese');
    }

    function it_convert_irregular_plurals_to_singulars()
    {
        self::singular('Geese')->shouldBe('Goose');
    }

    function it_can_provide_irregulars()
    {
        self::setProvider(new \Inflector\JsonProvider);

        self::plural('Cactus')->shouldBe('Cacti');
    }

}
