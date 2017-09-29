<?php

namespace pxgamer\Tcli\Command\RARBG;

use pxgamer\TorrentParser as TP;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class LatestCommand
 * @package pxgamer\Tcli\Command\RARBG
 */
class LatestCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('latest:rarbg')
            ->setDescription('Gets the latest torrents on RARBG.')
            ->setHelp('This command allows you to get the latest torrents from RARBG.');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|null|void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln([
            ' Latest Torrents from RARBG',
            ' ==================================',
            '',
        ]);

        $results = [];

        // Fetch torrents from WorldWideTorrents
        $result = TP\RARBG::latest();
        $results = array_merge($results, (is_array($result) ? $result : []));

        unset($result);
        // Output results to console
        foreach ($results as $result) {
            $regex = '/magnet:\?xt=urn:btih:([a-z0-9]{40})&dn=/';
            preg_match($regex, $result['link'], $matches);
            $result['info_hash'] = $matches[1] ?? null;

            $output->writeln([
                ' ' . $result['title'],
                ' ' . $result['info_hash'],
                ''
            ]);
        }
    }
}