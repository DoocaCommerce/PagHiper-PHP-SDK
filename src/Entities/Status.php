<?php

namespace PagHipperSDK\Entities;

/**
 * Class Status - Somente para constantes de Status
 * @package PagHipperSDK\Entities
 */
class Status
{
    /**
     * @var string
     */
    const SUCCESS = 'success';

    /**
     * @var string
     */
    const REJECT = 'reject';

    /**
     * @var string
     */
    const PENDING = 'pending';

    /**
     * @var string
     */
    const CANCELED = 'canceled';

    /**
     * @var string
     */
    const COMPLETED = 'completed';

    /**
     * @var string
     */
    const PAID = 'paid';

    /**
     * @var string
     */
    const PROCESSING = 'processing';

    /**
     * @var string
     */
    const REFUNDED = 'refunded';
}
