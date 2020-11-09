<?php

namespace FS\SolrBundle\Command;

use FS\SolrBundle\SolrException;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Command clears the whole index
 */
class ClearIndexCommand extends Command
{
    /**
     * @var \FS\SolrBundle\Solr
     */
    private $solr;

    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('solr:index:clear')
            ->setDescription('Clear the whole index');
    }

    public function __construct(string $name = null, \FS\SolrBundle\Solr $solr)
    {
        parent::__construct($name);
        $this->solr = $solr;
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $solr = $this->solr;

        try {
            $solr->clearIndex();
        } catch (SolrException $e) {
            $output->writeln(sprintf('A error occurs: %s', $e->getMessage()));
        }

        $output->writeln('<info>Index successful cleared.</info>');
    }
}
