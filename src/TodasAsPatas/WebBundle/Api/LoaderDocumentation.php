<?php

namespace TodasAsPatas\WebBundle\Api;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\Config\Loader\FileLoader;
use Symfony\Component\Yaml\Yaml;

/**
 * @author Fábio Lemos Elizandro <fabio@elizandro.com.br>
 */
class LoaderDocumentation extends FileLoader
{

    function __construct()
    {
        parent::__construct(new FileLocator());
    }

    /**
     * {@inheritdoc}
     */
    public function load($resource, $type = null)
    {
        $doc = Yaml::parse($resource);

        $this->setCurrentDir(\pathinfo($resource, PATHINFO_DIRNAME));

        if (\array_key_exists("imports", $doc)) {
            foreach ($doc['imports'] as $import) {
                $docImported = $this->import($import['resource']);
                $doc['doc'] = \array_merge($doc['doc'], $docImported['doc']);
            }

            unset($doc['imports']);
        }

        if (\array_key_exists("imports", $doc['doc']['groups'])) {
            $imports = $doc['doc']['groups']['imports'];
            foreach ($imports as $import) {
                $groupImported = Yaml::parse(\pathinfo($resource, PATHINFO_DIRNAME) . '/' . $import['resource']);
                $doc['doc']['groups'] = \array_merge($doc['doc']['groups'], $groupImported);
            }

            unset($doc['doc']['groups']['imports']);
        }
        return $doc;
    }

    /**
     * Verifica se é um recurso e se é um yml
     * 
     * {@inheritdoc}
     */
    public function supports($resource, $type = null)
    {
        $rc = \trim($resource);

        return \is_string($rc) && \substr($rc, -3) === "yml";
    }

}
