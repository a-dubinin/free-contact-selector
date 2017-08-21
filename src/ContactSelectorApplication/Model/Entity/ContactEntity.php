<?php

namespace ContactSelectorApplication\Model\Entity;

/**
 * Class ContactEntity
 * @package ContactSelectorApplication\Model\Entity
 */
class ContactEntity extends AbstractEntity
{
    /**
     * @var $id int
     */
    protected $id;

    /**
     * @var $phoneNumber string
     */
    protected $phoneNumber;

    /**
     * @var $statusId int
     */
    protected $statusId;

    /**
     * @var $operatorId mixed
     */
    protected $operatorId;

    /**
     * {@inheritDoc}
     */
    protected function init()
    {
        $this->id       = (int) $this->id;
        $this->statusId = (int) $this->statusId;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }

    /**
     * @param string $phoneNumber
     */
    public function setPhoneNumber($phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;
    }

    /**
     * @return int
     */
    public function getStatusId()
    {
        return $this->statusId;
    }

    /**
     * @param int $statusId
     */
    public function setStatusId($statusId)
    {
        $this->statusId = $statusId;
    }

    /**
     * @return mixed
     */
    public function getOperatorId()
    {
        return $this->operatorId;
    }

    /**
     * @param mixed $operatorId
     */
    public function setOperatorId($operatorId)
    {
        $this->operatorId = $operatorId;
    }
}
