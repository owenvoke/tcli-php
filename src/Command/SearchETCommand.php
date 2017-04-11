<?php

namespace pxgamer\Tcli\Command;

use pxgamer\TorrentParser as TP;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class SearchETCommand
 * @package pxgamer\Tcli\Command
 */
class SearchETCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('search:et')
            ->setDescription('Searches for torrents on ExtraTorrent.')
            ->setHelp('This command allows you to search for torrents on ExtraTorrent.')
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

        $results = [];

        // Fetch torrents from ExtraTorrent
        $result = TP\ExtraTorrent::search($query);
        $results = array_merge($results, (is_array($result) ? $result : []));

        unset($result);
        // Output results to console
        if (!empty($results)) {
            foreach ($results as $result) {
                $output->writeln([
                    ' ' . $result['title'],
                    ' ' . $result['info_hash'],
                    ' ' . $result['link'],
                    ''
                ]);
            }
        } else {
            $output->write('No torrents found.');
        }
    }
}