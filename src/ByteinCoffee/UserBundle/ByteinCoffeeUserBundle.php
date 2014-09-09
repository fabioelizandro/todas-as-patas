<?php

namespace ByteinCoffee\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class ByteinCoffeeUserBundle extends Bundle
{
    public function getParent()
    {
        return "FOSUserBundle";
    }
}
