<?php

namespace ByteinCoffee\ExtraBundle\Form\Transformer;

use Doctrine\Common\Persistence\ObjectRepository;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;
use Symfony\Component\Form\Exception\UnexpectedTypeException;
use Symfony\Component\PropertyAccess\PropertyAccess;

/**
 * Object to id transformer.
 *
 * @author Fábio Lemos Elizandro <fabio@elizandro.com.br>
 */
class ObjectToIdentifierTransformer implements DataTransformerInterface
{

    /**
     * Repository.
     *
     * @var ObjectRepository
     */
    protected $repository;

    /**
     * Identifier.
     *
     * @var string
     */
    protected $identifier;

    /**
     * Constructor.
     *
     * @param ObjectRepository $repository
     * @param string           $identifier
     */
    public function __construct(ObjectRepository $repository, $identifier = 'id')
    {
        $this->repository = $repository;
        $this->identifier = $identifier;
    }

    /**
     * {@inheritdoc}
     */
    public function transform($value)
    {
        if (null === $value) {
            return '';
        }

        $class = $this->repository->getClassName();

        if (!$value instanceof $class) {
            \var_dump($value);
            \var_dump($class);
            die();
            throw new UnexpectedTypeException($value, $class);
        }

        $accessor = PropertyAccess::createPropertyAccessor();

        return $accessor->getValue($value, $this->identifier);
    }

    /**
     * {@inheritdoc}
     */
    public function reverseTransform($value)
    {
        if (!$value) {
            return null;
        }

        if (null === $entity = $this->repository->findOneBy(array($this->identifier => $value))) {
            throw new TransformationFailedException(sprintf(
                    'Object "%s" with identifier "%s"="%s" does not exist.', $this->repository->getClassName(), $this->identifier, $value
            ));
        }

        return $entity;
    }

}
