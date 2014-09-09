<?php

namespace ByteinCoffee\ExtraBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\PropertyAccess\PropertyAccessor;
use Symfony\Component\Yaml\Yaml;

/**
 * @author Fábio Lemos Elizandro <fabio@elizandro.com.br>
 */
class ParametersSetCommand extends ContainerAwareCommand
{

    /**
     * @see Command
     */
    protected function configure()
    {
        $this
                ->setDefinition(array(
                    new InputArgument('parameter', InputArgument::REQUIRED, 'Parameter name'),
                    new InputArgument('value', InputArgument::REQUIRED, 'Parameter value'),
                    new InputArgument('path', InputArgument::OPTIONAL, 'Parameter path within root dir', '/config/parameters.yml'),
                ))
                ->setDescription('Set a parameter in the configuration file!')
                ->setHelp(<<<EOT
The <info>byteincoffee:parameters:set</info> Set a parameter in the configuration file!
    sub type to pass parameters with periods between parents and children as well: database.name
EOT
                )
                ->setName('byteincoffee:parameters:set')
                ->setAliases(array('byteincoffee:parameters:set'))
        ;
    }

    /**
     * @see Command
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $parametersDir = $this->getContainer()->getParameter('kernel.root_dir') . $input->getArgument('path');
        $parametersArray = Yaml::parse(\file_get_contents($parametersDir));
        $accessor = new PropertyAccessor();
        $accessor->setValue($parametersArray, '[parameters]' . $input->getArgument('parameter'), $input->getArgument('value'));
        $parametersString = Yaml::dump($parametersArray);
        \file_put_contents($parametersDir, $parametersString);

        $output->write($input->getArgument('parameter') . '=' . $input->getArgument('value'));
    }

}
