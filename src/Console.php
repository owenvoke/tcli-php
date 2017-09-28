<?php

namespace pxgamer\Tcli;

use pxgamer\Tcli\Command;
use Symfony\Component\Console\Application;

/**
 * Class Console
 * @package pxgamer\Tcli
 */
class Console
{
    /**
     * @param Application $Application
     */
    public static function register(Application $Application)
    {
        // Register Latest Commands
        $Application->add(new Command\LatestCommand());
        $Application->add(new Command\LatestWWTCommand());

        // Register Search Commands
        $Application->add(new Command\SearchCommand());
        $Application->add(new Command\SearchWWTCommand());
    }
}