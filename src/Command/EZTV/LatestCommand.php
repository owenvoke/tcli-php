<?php

namespace pxgamer\Tcli\Command\EZTV;

use pxgamer\TorrentParser as TP;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class LatestCommand
 */
class LatestCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('latest:eztv')
            ->setDescription('Gets the latest torrents on EZTV.')
            ->setHelp('This command allows you to get the latest torrents from EZTV.');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|null|void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln([
            ' Latest Torrents from EZTV',
            ' ==================================',
            '',
        ]);

        // Fetch torrents from EZTV
        $results = TP\EZTV::latest();

        if (!$results->isEmpty()) {
            /** @var TP\Torrent $result */
            foreach ($results as $result) {
                $output->writeln([
                    ' ' . $result->title,
                    ' ' . $result->link,
                    ''
                ]);
            }
        } else {
            $output->write(' No torrents found.');
        }
    }
}
