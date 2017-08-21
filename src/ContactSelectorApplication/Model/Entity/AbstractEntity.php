<?php

namespace ContactSelectorApplication\Model\Entity;

/**
 * Class AbstractEntity
 * @package ContactSelectorApplication\Model\Entity
 */
abstract class AbstractEntity
{
    /**
     * AbstractEntity constructor.
     */
    public function __construct()
    {
        $this->init();
    }

    /**
     * @return void
     */
    abstract protected function init();
}
