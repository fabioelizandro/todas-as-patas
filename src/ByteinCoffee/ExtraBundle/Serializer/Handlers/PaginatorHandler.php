<?php

namespace ByteinCoffee\ExtraBundle\Serializer\Handlers;

use JMS\Serializer\Context;
use JMS\Serializer\GraphNavigator;
use JMS\Serializer\Handler\SubscribingHandlerInterface;
use JMS\Serializer\VisitorInterface;
use Pagerfanta\Pagerfanta;

/**
 * @author Fábio Lemos Elizandro <fabio@elizandro.com.br>
 */
class PaginatorHandler implements SubscribingHandlerInterface
{

    public function paginatorSerializer(VisitorInterface $visitor, Pagerfanta $pager, array $type, Context $context)
    {
        $type['name'] = 'array';

        $pagerArray = array(
            'count' => $pager->count(),
            'current_page' => $pager->getCurrentPage(),
            'current_page_offset_end' => $pager->getCurrentPageOffsetEnd(),
            'current_page_offset_start' => $pager->getCurrentPageOffsetStart(),
            'max_per_page' => $pager->getMaxPerPage(),
            'nb_pages' => $pager->getNbPages(),
            'nb_results' => $pager->getNbResults(),
            'next_page' => $pager->hasNextPage() ? $pager->getNextPage() : null,
            'previous_page' => $pager->hasPreviousPage() ? $pager->getPreviousPage() : null,
            'resources' => $pager->getIterator()->getArrayCopy()
        );

        return $visitor->visitArray($pagerArray, $type, $context);
    }

    public function paginatorDeserialization(VisitorInterface $visitor, $data, array $type, Context $context)
    {
        $type['name'] = 'array';

        return new \Doctrine\Common\Collections\ArrayCollection($visitor->visitArray($data, $type, $context));
    }

    public static function getSubscribingMethods()
    {
        $methods = array();
        $formats = array('json', 'xml', 'yml');

        foreach ($formats as $format) {
            $methods[] = array(
                'direction' => GraphNavigator::DIRECTION_SERIALIZATION,
                'format' => $format,
                'type' => 'Pagerfanta\Pagerfanta',
                'method' => 'paginatorSerializer',
            );

            $methods[] = array(
                'direction' => GraphNavigator::DIRECTION_DESERIALIZATION,
                'format' => $format,
                'type' => 'Pagerfanta\Pagerfanta',
                'method' => 'paginatorDeserialization',
            );
        }

        return $methods;
    }

}
