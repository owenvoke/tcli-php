<?php

namespace pxgamer\Tcli\Command\WorldWideTorrents;

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
            ->setName('search:wwt')
            ->setDescription('Searches for torrents on WorldWideTorrents.')
            ->setHelp('This command allows you to search for torrents on WorldWideTorrents.')
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

        // Fetch torrents from WorldWideTorrents
        $results = TP\WorldWideTorrents::search($query);

        if (!$results->isEmpty()) {
            /** @var TP\Torrent $result */
            foreach ($results as $result) {
                $output->writeln([
                    ' ' . $result->title,
                    ' ' . $result->hash,
                    ' ' . $result->link,
                    ''
                ]);
            }
        } else {
            $output->write(' No torrents found.');
        }
    }
}
