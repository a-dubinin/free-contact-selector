<?php

namespace ContactSelectorApplication;

use Silex\Application as SilexApplication;
use ContactSelectorApplication\Model\Entity\ContactEntity;
use ContactSelectorApplication\Model\Repository\ContactRepository;

/**
 * Class ContactSelector
 * @package ContactSelectorApplication
 */
class ContactSelector implements ContactSelectorInterface
{
    const ROUTE_MAIN            = '/';
    const ROUTE_OPERATOR        = '/{operatorId}';
    const ROUTE_MAIN_METHOD     = 'routeMain';
    const ROUTE_OPERATOR_METHOD = 'routeOperator';

    const HTTP_EXCEPTION_STATUS_CODE = 404;
    const MSG_WITHOUT_OPERATOR       = 'Please add operatorId as GET-parameter.';
    const MSG_NO_FREE_CONTACTS       = 'There are not any free contacts';

    /**
     * @var $application SilexApplication
     */
    protected $application;

    /**
     * ContactSelector constructor.
     */
    public function __construct()
    {
        $this->application = new SilexApplication();
    }

    /**
     * {@inheritDoc}
     */
    public function getContact()
    {
        $this->application->get(self::ROUTE_MAIN, [$this, self::ROUTE_MAIN_METHOD]);
        $this->application->get(self::ROUTE_OPERATOR, [$this, self::ROUTE_OPERATOR_METHOD]);

        $this->application->run();

        return;
    }

    /**
     * @param SilexApplication $application
     *
     * @return mixed
     */
    public function routeMain(SilexApplication $application)
    {
        $application->abort(self::HTTP_EXCEPTION_STATUS_CODE, self::MSG_WITHOUT_OPERATOR);

        return;
    }

    /**
     * @param string $operatorId
     *
     * @return string
     */
    public function routeOperator($operatorId)
    {
        $operatorId        = (int) $operatorId;
        $contactRepository = new ContactRepository();

        /**
         * Check processed contact for the operator
         */
        $processedContact = $contactRepository->getContactByOperatorId($operatorId);
        if ($processedContact instanceof ContactEntity) {
            return $processedContact->getPhoneNumber();
        }

        /**
         * Get new free contact for the operator
         */
        $freeContact = $contactRepository->getFreeContactForOperator($operatorId);
        if ($freeContact instanceof ContactEntity) {
            return $freeContact->getPhoneNumber();
        } else {
            return self::MSG_NO_FREE_CONTACTS;
        }
    }
}
