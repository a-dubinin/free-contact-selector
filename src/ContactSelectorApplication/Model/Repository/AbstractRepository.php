<?php

namespace ContactSelectorApplication\Model\Repository;

use ContactSelectorApplication\Model\StorageManager;
use ContactSelectorApplication\Exception\StorageConnectionException;

/**
 * Class AbstractRepository
 * @package ContactSelectorApplication\Model\Repository
 */
abstract class AbstractRepository
{
    /**
     * @var $connection \PDO
     */
    protected $connection;

    /**
     * AbstractRepository constructor.
     */
    public function __construct()
    {
        $this->initConnection();
    }

    /**
     * @return void
     *
     * @throws StorageConnectionException
     */
    protected function initConnection()
    {
        try {
            $this->connection = new \PDO(
                StorageManager::HOSTNAME,
                StorageManager::LOGIN,
                StorageManager::PASSWORD
            );
        } catch (\PDOException $e) {
            throw new StorageConnectionException(
                sprintf(StorageConnectionException::MESSAGE, $e->getMessage())
            );
        }

        return;
    }
}
