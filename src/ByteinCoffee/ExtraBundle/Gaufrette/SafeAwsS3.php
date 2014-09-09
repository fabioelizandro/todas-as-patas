<?php

namespace ByteinCoffee\ExtraBundle\Gaufrette;

use Gaufrette\Adapter\AwsS3;

/**
 * 
 * Safe local adapter that encodes key to avoid the use of the directories
 * structure
 * 
 * @author Fábio Lemos Elizandro <fabio@elizandro.com.br>
 */
class SafeAwsS3 extends AwsS3
{

    /**
     * {@inheritDoc}
     */
    protected function computePath($key)
    {
        return parent::computePath(\base64_encode($key));
    }

    /**
     * {@inheritDoc}
     */
    public function listKeys($prefix = '')
    {
        $options = array('Bucket' => $this->bucket);
        if ((string) $prefix != '') {
            $options['Prefix'] = parent::computePath($prefix);
        } elseif (!empty($this->options['directory'])) {
            $options['Prefix'] = $this->options['directory'];
        }

        $keys = array();
        $iter = $this->service->getIterator('ListObjects', $options);
        foreach ($iter as $file) {
            $keys[] = $this->computePath($file['Key']);
        }

        return $keys;
    }

}
