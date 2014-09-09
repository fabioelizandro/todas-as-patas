<?php

namespace TodasAsPatas\ApiBundle\Command;

use FOS\OAuthServerBundle\Entity\Client;
use FOS\OAuthServerBundle\Model\ClientManagerInterface;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Cria um cliente via command line
 */
class ClientPromoteCommand extends ContainerAwareCommand
{

    protected function configure()
    {
        $this
                ->setName('todasaspatas:oauth-server:client:promote')
                ->setDescription('Promote a client')
                ->addArgument('public_id', InputArgument::REQUIRED, 'Public id of client', null)
                ->addArgument('grant_type', InputArgument::REQUIRED, 'Grant type for add', null)
                ->setHelp(<<<EOT
        The <info>%command.name%</info>command promote a client.

        <info>php %command.full_name% public_id grant_type</info>
EOT
        );
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $clientManager = $this->getContainer()->get('fos_oauth_server.client_manager.default');
        /* @var $clientManager ClientManagerInterface */
        $client = $clientManager->findClientByPublicId($input->getArgument('public_id'));
        /* @var $client Client */
        $client->setAllowedGrantTypes(array_merge($client->getAllowedGrantTypes(), array($input->getArgument('grant_type'))));
        $clientManager->updateClient($client);
        $output->writeln(sprintf('Promote a client client with name <info>%s</info> and public id <info>%s</info>.', $client->getName(), $client->getPublicId()));
    }

}
