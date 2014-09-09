<?php

namespace ByteinCoffee\ExtraBundle\Twig;

use ByteinCoffee\ExtraBundle\Gaufrette\ResolverDelegate;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Form\Extension\Core\DataTransformer\MoneyToLocalizedStringTransformer;
use Twig_Extension;
use Twig_SimpleFilter;

/**
 * @author Fábio Lemos Elizandro <fabio@elizandro.com.br>
 */
class ByteinCoffeeExtraExtension extends Twig_Extension
{

    /**
     *
     * @var ContainerInterface
     */
    private $container;

    function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function getFilters()
    {
        return array(
            'resolve' => new Twig_SimpleFilter('gaufrette_resolve', array($this, 'gaufretteResolve')),
            'currency' => new Twig_SimpleFilter('currency', array($this, 'currencyFormat')),
            'humanizeBoolean' => new Twig_SimpleFilter('humanize_boolean', array($this, 'humanizeBoolean')),
        );
    }

    /**
     * Caminho da imagem
     * 
     * @param string $path
     * 
     * @return string
     */
    public function gaufretteResolve($path, $resolver = null)
    {
        /* @var $delegate ResolverDelegate */
        if ($path === null) {
            return '';
        }

        $delegate = $this->container->get('bytein_coffee_extra.gaufrette.resolver_delegate');
        $resolver = $delegate->getResolver($resolver);

        return $resolver->resolve($path);
    }

    public function currencyFormat($value, $precision = 2, $currency = 'BRL', $grouping = true, $divisor = 1, $compound = false)
    {
        if (null === $value) {
            $value = 0;
        }
        $transformer = new MoneyToLocalizedStringTransformer($precision, $grouping, null, $divisor);

        return $transformer->transform($value);
    }

    public function humanizeBoolean($boolean, $true = 'Sim', $false = 'Não')
    {
        return $boolean ? $true : $false;
    }

    public function getName()
    {
        return 'byteincoffee_extra_extension';
    }

}
