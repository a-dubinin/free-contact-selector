<?php

namespace ContactSelectorApplication\Model\Entity;

/**
 * Class StatusEntity
 * @package ContactSelectorApplication\Model\Entity
 */
class StatusEntity extends AbstractEntity
{
    /**
     * @var $id int
     */
    protected $id;

    /**
     * @var $code int
     */
    protected $code;

    /**
     * @var $value string
     */
    protected $value;

    /**
     * {@inheritDoc}
     */
    protected function init()
    {
        $this->id   = (int) $this->id;
        $this->code = (int) $this->code;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param int $code
     */
    public function setCode($code)
    {
        $this->code = $code;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param mixed $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }
}
