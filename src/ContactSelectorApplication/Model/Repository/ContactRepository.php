<?php

namespace ContactSelectorApplication\Model\Repository;

use ContactSelectorApplication\Model\Entity\ContactEntity;
use ContactSelectorApplication\Exception\FreeContactSelectException;

/**
 * Class ContactRepository
 * @package ContactSelectorApplication\Model\Repository
 */
class ContactRepository extends AbstractRepository
{
    /**
     * @param int $operatorId
     *
     * @return mixed
     */
    public function getContactByOperatorId($operatorId)
    {
        if (!($this->connection instanceof \PDO)) {
            $this->initConnection();
        }

        $stmtSelect = $this->connection->prepare(
            'SELECT * FROM contact
                WHERE operatorId = ?
                LIMIT 1'
        );
        $stmtSelect->bindValue(1, $operatorId, \PDO::PARAM_INT);
        $stmtSelect->execute();

        return $stmtSelect->fetchObject(ContactEntity::class);
    }

    /**
     * @param int $operatorId
     *
     * @return mixed
     *
     * @throws FreeContactSelectException
     */
    public function getFreeContactForOperator($operatorId)
    {
        if (!($this->connection instanceof \PDO)) {
            $this->initConnection();
        }

        try {
            $this->connection->beginTransaction();

            /**
             * Take possession of contact
             */
            $stmtUpdate = $this->connection->prepare(
                'UPDATE contact
                    SET operatorId = ?
                    WHERE statusId != (
                        SELECT id FROM status WHERE `value` = ?
                    )
                    AND operatorId IS NULL
                    LIMIT 1'
            );
            $stmtUpdate->bindValue(1, $operatorId, \PDO::PARAM_INT);
            $stmtUpdate->bindValue(2, StatusRepository::VALUE_CLOSED);
            $stmtUpdate->execute();

            /**
             * Get the contact
             */
            $result = $this->getContactByOperatorId($operatorId);

            $this->connection->commit();
        } catch (\Exception $e) {
            $this->connection->rollBack();
            throw new FreeContactSelectException(
                sprintf(FreeContactSelectException::MESSAGE, $e->getMessage())
            );
        }

        return $result;
    }
}
