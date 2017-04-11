<?php

namespace pxgamer\Tcli\Command;

use pxgamer\TorrentParser as TP;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class LatestCommand
 * @package pxgamer\Tcli\Command
 */
class LatestCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('latest')
            ->setDescription('Gets the latest torrents.')
            ->setHelp('This command allows you to get the latest torrents across multiple torrent sites.');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|null|void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln([
            ' Latest Torrents',
            ' ==================================',
            '',
        ]);

        $results = [];

        // Fetch torrents from WorldWideTorrents
        $result = TP\WorldWideTorrents::latest();
        $results = array_merge($results, (is_array($result) ? $result : []));

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