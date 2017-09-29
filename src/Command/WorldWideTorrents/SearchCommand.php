<?php

namespace pxgamer\Tcli\Command\WorldWideTorrents;

use pxgamer\TorrentParser as TP;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class SearchCommand
 * @package pxgamer\Tcli\Command\WorldWideTorrents
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

        $results = [];

        // Fetch torrents from WorldWideTorrents
        $result = TP\WorldWideTorrents::search($query);
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