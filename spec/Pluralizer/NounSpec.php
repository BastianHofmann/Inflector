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
}
