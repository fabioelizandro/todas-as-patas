<?php

namespace ByteinCoffee\ExtraBundle\ParamConverter;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Request\ParamConverter\ParamConverterInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use DateTime;

/**
 * @author Fábio Lemos Elizandro <fabio@elizandro.com.br>
 */
class DateTimeParamConverter implements ParamConverterInterface
{

    /**
     * {@inheritdoc}
     *
     * @throws NotFoundHttpException When invalid date given
     */
    public function apply(Request $request, ParamConverter $configuration)
    {
        $param = $configuration->getName();

        if (null == $request->get($param)) {
            return false;
        }

        $options = $configuration->getOptions();
        $value = $request->get($param);

        if (!$value && $configuration->isOptional()) {
            return false;
        }

        $date = isset($options['format']) ? DateTime::createFromFormat($options['format'], $value) : new DateTime($value);

        if (!$date) {
            throw new NotFoundHttpException('Invalid date given.');
        }

        $request->attributes->set($param, $date);

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function supports(ParamConverter $configuration)
    {
        if (null === $configuration->getClass()) {
            return false;
        }

        return "DateTime" === $configuration->getClass();
    }

}
