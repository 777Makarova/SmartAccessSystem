<?php

namespace App\DataFixtures\ORM;


use Hautelook\AliceBundle\Alice\DataFixtureLoader;
use Nelmio\Alice\Fixtures;

use Doctrine\Common\Persistence\ObjectManager;
use Nelmio\Alice\Loader\NativeLoader;

class AppFixtures
{

    protected function getFixtures(): array
    {
        return  array(
            __DIR__ . '/test.yml',
        );
    }

}