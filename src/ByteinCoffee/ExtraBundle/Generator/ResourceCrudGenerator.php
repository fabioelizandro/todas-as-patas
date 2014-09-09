<?php

namespace ByteinCoffee\ExtraBundle\Generator;

use Doctrine\ORM\Mapping\ClassMetadataInfo;
use RuntimeException;
use Sensio\Bundle\GeneratorBundle\Generator\DoctrineCrudGenerator;
use Symfony\Component\HttpKernel\Bundle\BundleInterface;

/**
 * Gerador de CRUD para resources
 *
 * @author Fábio Lemos Elizandro <fabio@elizandro.com.br>
 */
class ResourceCrudGenerator extends DoctrineCrudGenerator
{

    /**
     * Generate the CRUD controller.
     *
     * @param BundleInterface   $bundle           A bundle object
     * @param string            $entity           The entity relative class name
     * @param ClassMetadataInfo $metadata         The entity class metadata
     * @param string            $format           The configuration format (xml, yaml, annotation)
     * @param string            $routePrefix      The route name prefix
     * @param array             $needWriteActions Wether or not to generate write actions
     *
     * @throws RuntimeException
     */
    public function generate(BundleInterface $bundle, $entity, ClassMetadataInfo $metadata, $format, $routePrefix, $needWriteActions, $forceOverwrite)
    {
        $this->routePrefix = $routePrefix;
        $this->routeNamePrefix = "app_" . str_replace('/', '_', $routePrefix);
        $this->actions = $needWriteActions ? array('index', 'show', 'new', 'edit', 'delete') : array('index', 'show');

        if (count($metadata->identifier) > 1) {
            throw new RuntimeException('The CRUD generator does not support entity classes with multiple primary keys.');
        }

        if (!in_array('id', $metadata->identifier)) {
            throw new RuntimeException('The CRUD generator expects the entity object has a primary key field named "id" with a getId() method.');
        }

        $this->entity = $entity;
        $this->bundle = $bundle;
        $this->metadata = $metadata;
        $this->setFormat($format);

        $this->generateControllerClass($forceOverwrite);

        $dir = sprintf('%s/Resources/views/Backend/%s', $this->bundle->getPath(), str_replace('\\', '/', $this->entity));

        if (!file_exists($dir)) {
            $this->filesystem->mkdir($dir, 0777);
        }

        $this->generateIndexView($dir);

        if (in_array('show', $this->actions)) {
            $this->generateShowView($dir);
        }

        if (in_array('new', $this->actions)) {
            $this->generateNewView($dir);
        }

        if (in_array('edit', $this->actions)) {
            $this->generateEditView($dir);
        }

        $this->generateTestClass();
        $this->generateConfiguration();
    }

    protected function getDirViews()
    {
        return sprintf('%s/Resources/views/Backend%s', $this->bundle->getPath(), str_replace('\\', '/', $this->entity));
    }

    /**
     * Generates the controller class only.
     *
     */
    protected function generateControllerClass($forceOverwrite)
    {
        $dir = $this->bundle->getPath();

        $parts = explode('\\', $this->entity);
        $entityClass = array_pop($parts);
        $entityNamespace = implode('\\', $parts);

        $target = sprintf(
                '%s/Controller/%s/%sController.php', $dir, str_replace('\\', '/', $entityNamespace), $entityClass
        );

        if (!$forceOverwrite && file_exists($target)) {
            throw new \RuntimeException('Unable to generate the controller as it already exists.');
        }

//        $this->renderFile('crud/controller.php.twig', $target, array(
//            'actions'           => $this->actions,
//            'route_prefix'      => $this->routePrefix,
//            'route_name_prefix' => $this->routeNamePrefix,
//            'bundle'            => $this->bundle->getName(),
//            'entity'            => $this->entity,
//            'entity_class'      => $entityClass,
//            'namespace'         => $this->bundle->getNamespace(),
//            'entity_namespace'  => $entityNamespace,
//            'format'            => $this->format,
//        ));
    }

    /**
     * Generates the functional test class only.
     *
     */
    protected function generateTestClass()
    {
        $parts = explode('\\', $this->entity);
        $entityClass = array_pop($parts);
        $entityNamespace = implode('\\', $parts);

        $dir = $this->bundle->getPath() . '/Tests/Controller';
        $target = $dir . '/' . str_replace('\\', '/', $entityNamespace) . '/' . $entityClass . 'ControllerTest.php';

//        $this->renderFile('crud/tests/test.php.twig', $target, array(
//            'route_prefix'      => $this->routePrefix,
//            'route_name_prefix' => $this->routeNamePrefix,
//            'entity'            => $this->entity,
//            'bundle'            => $this->bundle->getName(),
//            'entity_class'      => $entityClass,
//            'namespace'         => $this->bundle->getNamespace(),
//            'entity_namespace'  => $entityNamespace,
//            'actions'           => $this->actions,
//            'form_type_name'    => strtolower(str_replace('\\', '_', $this->bundle->getNamespace()).($parts ? '_' : '').implode('_', $parts).'_'.$entityClass.'Type'),
//        ));
    }

    /**
     * Sets the configuration format.
     *
     * @param string $format The configuration format
     */
    private function setFormat($format)
    {
        switch ($format) {
            case 'yml':
            case 'xml':
            case 'php':
            case 'annotation':
                $this->format = $format;
                break;
            default:
                $this->format = 'yml';
                break;
        }
    }

    /**
     * Generates the routing configuration.
     *
     */
    protected function generateConfiguration()
    {
        if (!in_array($this->format, array('yml', 'xml', 'php'))) {
            return;
        }

        $target = sprintf(
                '%s/Resources/config/routing/backend/%s.%s', $this->bundle->getPath(), strtolower(str_replace('\\', '_', $this->entity)), $this->format
        );

        $parts = explode('\\', $this->entity);
        $entityClass = array_pop($parts);
        $formTypeClass = $entityClass . 'Type';
        $metadata = $this->metadata;
        /* @var $metadata ClassMetadataInfo */
        $entityNameSpace = \explode("\\", $metadata->getName());
        $entityBundleNameSpace = $entityNameSpace[0] . "\\" . $entityNameSpace[1];


        $this->renderFile('crud/config/routing.' . $this->format . '.twig', $target, array(
            'actions' => $this->actions,
            'route_prefix' => $this->routePrefix,
            'route_name_prefix' => $this->routeNamePrefix,
            'bundle' => $this->bundle->getName(),
            'entity' => $this->entity,
            'form_type_name' => strtolower(str_replace('\\', '_', $entityBundleNameSpace) . ($parts ? '_' : '') . implode('_', $parts) . '_' . substr($formTypeClass, 0, -4))
        ));
    }

}
