<?php

namespace ByteinCoffee\ExtraBundle\Command;

use Sensio\Bundle\GeneratorBundle\Command\GenerateDoctrineFormCommand;
use Sensio\Bundle\GeneratorBundle\Command\Validators;
use Sensio\Bundle\GeneratorBundle\Generator\DoctrineFormGenerator;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Command para gerar formulários para o resource bundle 
 *
 * @author Fábio Lemos Elizandro <fabio@elizandro.com.br>
 */
class GenerateResourceFormCommand extends GenerateDoctrineFormCommand
{

    /**
     * @see Command
     */
    protected function configure()
    {
        $this
                ->setDefinition(array(
                    new InputArgument('entity', InputArgument::REQUIRED, 'O nome da classe da entidade para inicializar (shortcut notation)'),
                ))
                ->setDescription('Gera um form type para uma entidade doctrine')
                ->setHelp(<<<EOT
The <info>doctrine:generate:form</info> command generates a form class based on a Doctrine entity.

<info>php app/console doctrine:generate:form AcmeBlogBundle:Post</info>

Every generated file is based on a template. There are default templates but they can be overriden by placing custom templates in one of the following locations, by order of priority:

<info>BUNDLE_PATH/Resources/SensioGeneratorBundle/skeleton/form
APP_PATH/Resources/SensioGeneratorBundle/skeleton/form</info>

You can check https://github.com/sensio/SensioGeneratorBundle/tree/master/Resources/skeleton
in order to know the file structure of the skeleton
EOT
                )
                ->setName('byteincoffee:resource:form')
                ->setAliases(array('byteincoffee:resource:form'))
        ;
    }

    /**
     * @see Command
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $entity = Validators::validateEntityName($input->getArgument('entity'));
        list($bundle, $entity) = $this->parseShortcutNotation($entity);

        $entityClass = $this->getContainer()->get('doctrine')->getAliasNamespace($bundle) . '\\' . $entity;
        $metadata = $this->getEntityMetadata($entityClass);
        $bundle = $this->getApplication()->getKernel()->getBundle($bundle);

        $generator = new DoctrineFormGenerator($this->getContainer()->get('filesystem'));
        $generator->setSkeletonDirs($this->getSkeletonDirs($bundle));
        $generator->generate($bundle, $entity, $metadata);

        $output->writeln(sprintf(
                        'The new %s.php class file has been created under %s.', $generator->getClassName(), $generator->getClassPath()
        ));
    }

    protected function getEntityMetadata($entity)
    {
        return $this->getContainer()->get("doctrine")->getManager()->getClassMetadata($entity);
    }

}
