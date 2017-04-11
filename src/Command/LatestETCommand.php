<?php

namespace pxgamer\Tcli\Command;

use pxgamer\TorrentParser as TP;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class LatestETCommand
 * @package pxgamer\Tcli\Command
 */
class LatestETCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('latest:et')
            ->setDescription('Gets the latest torrents on ExtraTorrent.')
            ->setHelp('This command allows you to get the latest torrents from ExtraTorrent.');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|null|void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln([
            ' Latest Torrents from ExtraTorrent',
            ' ==================================',
            '',
        ]);

        $results = [];

        // Fetch torrents from ExtraTorrent
        $result = TP\ExtraTorrent::latest();
        $results = array_merge($results, (is_array($result) ? $result : []));

        unset($result);
        // Output results to console
        foreach ($results as $result) {
            $output->writeln([
                ' ' . $result['title'],
                ' ' . $result['info_hash'],
                ' ' . $result['link'],
                ''
            ]);
        }
    }
}