<?php

namespace pxgamer\Tcli\Command;

use Illuminate\Support\Collection;
use pxgamer\TorrentParser as TP;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class SearchCommand
 */
class SearchCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('search')
            ->setDescription('Searches for torrents from all available torrent sites.')
            ->setHelp('This command allows you to search for torrents across multiple torrent sites.')
            ->addArgument('query', InputArgument::REQUIRED, 'The query to search for.');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|null|void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $query = $input->getArgument('query');
        $output->writeln([
            ' Searching for torrents containing: `' . $query . '`',
            ' ==================================',
            '',
        ]);

        // Fetch torrents from all sites
        $results = new Collection();
        $results = $results->concat(TP\WorldWideTorrents::search($query));

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