<?php

namespace spec\Pluralizer;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class NounSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Pluralizer\Noun');
    }

    function it_can_convert_a_simple_singular_noun_to_its_plural()
    {
        $this->plural('Tree')->shouldBe('Trees');
        $this->plural('Ladder')->shouldBe('Ladders');
    }

    function it_can_convert_a_simple_plural_to_singular()
    {
        $this->singular('Trees')->shouldBe('Tree');
        $this->singular('Ladders')->shouldBe('Ladder');
    }

    function it_converts_singulars_to_plurals_repeatedly()
    {
        $this->plural('Tree')->shouldBe('Trees');
        $this->plural('Tree')->shouldBe('Trees');
    }

    function it_converts_plurals_to_singulars_repeatedly()
    {
        $this->singular('Trees')->shouldBe('Tree');
        $this->singular('Trees')->shouldBe('Tree');
    }

    function it_can_convert_nouns_ending_in_an_silibal_sound_to_plural()
    {
        $this->plural('Fox')->shouldBe('Foxes');
        $this->plural('Kiss')->shouldBe('Kisses');
        $this->plural('Dish')->shouldBe('Dishes');
        $this->plural('Church')->shouldBe('Churches');
        $this->plural('Buzz')->shouldBe('Buzzes');
        $this->plural('Bus')->shouldBe('Buses');
    }

    function it_can_inflect_singular_nouns_ending_in_y()
    {
        $this->plural('Country')->shouldBe('Countries');
        $this->plural('Fly')->shouldBe('Flies');
    }

    function it_can_convert_nouns_ending_in_an_silibal_sound_to_singular()
    {
        $this->singular('Foxes')->shouldBe('Fox');
        $this->singular('Kisses')->shouldBe('Kiss');
        $this->singular('Dishes')->shouldBe('Dish');
        $this->singular('Churches')->shouldBe('Church');
        $this->singular('Buzzes')->shouldBe('Buzz');
        $this->singular('Buses')->shouldBe('Bus');
    }

    function it_can_convert_plurals_ending_in_ies_to_singular()
    {
        $this->singular('Flies')->shouldBe('Fly');
        $this->singular('Countries')->shouldBe('Country');
    }

    function it_can_convert_singulars_ending_in_vowel_y()
    {
        $this->plural('Play')->shouldBe('Plays');
        $this->plural('Toy')->shouldBe('Toys');
    }

    function it_can_convert_plurals_with_singulars_ending_in_vowel_y()
    {
        $this->singular('Plays')->shouldBe('Play');
        $this->singular('Toys')->shouldBe('Toy');
    }

    function it_inflects_non_italian_origin_singulars_ending_in_o()
    {
        $this->plural('Hero')->shouldBe('Heroes');
        $this->plural('Potato')->shouldBe('Potatoes');
    }

    function it_inflects_nouns_ending_in_quy()
    {
        $this->plural('Soliloquy')->shouldBe('Soliloquies');
        $this->singular('Soliloquies')->shouldBe('Soliloquy');
    }

    function it_can_inflect_nouns_with_identical_singulars_and_plurals()
    {
        $this->singular('bison')->shouldBe('bison');
        $this->plural('bison')->shouldBe('bison');
        $this->singular('squid')->shouldBe('squid');
        $this->plural('squid')->shouldBe('squid');
    }

    function it_convert_irregular_singulars_to_plurals()
    {
        $this->plural('Goose')->shouldBe('Geese');
    }

    function it_convert_irregular_plurals_to_singulars()
    {
        $this->singular('Geese')->shouldBe('Goose');
    }

}
