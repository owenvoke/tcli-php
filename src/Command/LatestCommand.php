<?php

namespace pxgamer\Tcli\Command;

use Illuminate\Support\Collection;
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
            ->setName('latest')
            ->setDescription('Gets the latest torrents from all available torrent sites.')
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

        // Fetch torrents from all sites
        $results = new Collection();
        $results = $results->concat(TP\WorldWideTorrents::latest());
        $results = $results->concat(TP\RARBG::latest());
        $results = $results->concat(TP\EZTV::latest());
        $results = $results->concat(TP\LimeTorrents::latest());

        /** @var Collection $results */
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
