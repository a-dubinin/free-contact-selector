<?php

namespace ContactSelectorApplication\Exception;

/**
 * Class StorageConnectionException
 * @package ContactSelectorApplication\Exception
 */
class StorageConnectionException extends \Exception
{
    const MESSAGE = 'Connection failed: %s';
}
