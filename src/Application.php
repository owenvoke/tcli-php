<?php

namespace pxgamer\Tcli;

use pxgamer\Tcli\Command;
use Symfony\Component\Console\Application as BaseApplication;

/**
 * Class Application
 */
class Application extends BaseApplication
{
    public const NAME = 'Tcli';
    public const VERSION = '@git-version@';

    /**
     * Application constructor.
     *
     * @param null $name
     * @param null $version
     */
    public function __construct($name = null, $version = null)
    {
        parent::__construct(
            $name ?: static::NAME,
            $version ?: (static::VERSION === '@' . 'git-version@' ? 'source' : static::VERSION)
        );
    }

    /**
     * @return array|\Symfony\Component\Console\Command\Command[]
     */
    protected function getDefaultCommands()
    {
        $commands = parent::getDefaultCommands();

        // Register Latest Commands
        $commands[] = new Command\LatestCommand();
        $commands[] = new Command\WorldWideTorrents\LatestCommand();
        $commands[] = new Command\RARBG\LatestCommand();
        $commands[] = new Command\EZTV\LatestCommand();
        $commands[] = new Command\LimeTorrents\LatestCommand();

        // Register Search Commands
        $commands[] = new Command\SearchCommand();
        $commands[] = new Command\WorldWideTorrents\SearchCommand();

        return $commands;
    }
}
