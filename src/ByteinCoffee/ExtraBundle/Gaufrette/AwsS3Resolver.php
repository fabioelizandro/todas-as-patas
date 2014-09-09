<?php

namespace ByteinCoffee\ExtraBundle\Gaufrette;

use Aws\S3\Enum\CannedAcl;
use Aws\S3\S3Client;

/**
 * @author Fábio Lemos Elizandro <fabio@elizandro.com.br>
 */
class AwsS3Resolver implements ResolverInterface
{

    /**
     * @var S3Client
     */
    protected $storage;

    /**
     * @var string
     */
    protected $bucket;

    /**
     * @var string
     */
    protected $acl;

    /**
     * @var array
     */
    protected $objUrlOptions;

    /**
     * @var string
     */
    protected $prefix;

    /**
     * Constructs a no cache resolver storing images on Amazon S3.
     *
     * @param S3Client $storage The Amazon S3 storage API. It's required to know authentication information.
     * @param string $bucket The bucket name to operate on.
     * @param string $acl The ACL to use when storing new objects. Default: owner read/write, public read
     * @param array $objUrlOptions A list of options to be passed when retrieving the object url from Amazon S3.
     */
    public function __construct(S3Client $storage, $bucket, $acl = CannedAcl::PUBLIC_READ, array $objUrlOptions = array())
    {
        $this->storage = $storage;
        $this->bucket = $bucket;
        $this->acl = $acl;
        $this->objUrlOptions = $objUrlOptions;
    }

    /**
     * {@inheritDoc}
     */
    public function resolve($path)
    {
        if ($path === null) {
            return "";
        }

        return $this->getObjectUrl($this->getObjectPath($path));
    }

    /**
     * @param string $prefix
     */
    public function setPrefix($prefix)
    {
        $this->prefix = $prefix;
    }

    /**
     * Returns the object path within the bucket.
     *
     * @param string $path The base path of the resource.
     * @param string $filter The name of the imagine filter in effect.
     *
     * @return string The path of the object on S3.
     */
    protected function getObjectPath($path)
    {
        $path = $this->prefix ? sprintf('%s/%s', $this->prefix, $path) : sprintf('%s', $path);

        return str_replace('//', '/', $path);
    }

    /**
     * Returns the URL for an object saved on Amazon S3.
     *
     * @param string $path
     *
     * @return string
     */
    protected function getObjectUrl($path)
    {
        return $this->storage->getObjectUrl($this->bucket, $path, 0, $this->objUrlOptions);
    }

}
