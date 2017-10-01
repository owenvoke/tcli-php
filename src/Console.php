<?php

namespace pxgamer\Tcli;

use pxgamer\Tcli\Command;
use Symfony\Component\Console\Application;

/**
 * Class Console
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
        $Application->add(new Command\WorldWideTorrents\LatestCommand());
        $Application->add(new Command\RARBG\LatestCommand());

        // Register Search Commands
        $Application->add(new Command\SearchCommand());
        $Application->add(new Command\WorldWideTorrents\SearchCommand());
    }
}