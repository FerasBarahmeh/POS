<?php

namespace APP\Enums;

class PaymentStatus extends AbstractionEnum
{
    /**
     * This is a payment that has begun, but is not complete
     * @var int
     */
    public int $complete = 0;
    /**
     * If a Pending payment is never completed it becomes Abandoned after a week.
     * @var int
     */
    public int $abandoned = 1;
    /**
     * This is a payment where money has been transferred back to the customer and the customer no longer has access to
     * the product
     * @var int
     */
    public int $refunded = 2;
    /**
     * This is a payment where the payment process failed, whether it be a credit card rejection or some other error.
     * @var int
     */
    public int $failed = 3;
    /**
     * Cancelled is used in two different scenarios. One deals with  Recurring Payments. When a subscription is
     * cancelled then the original payment gets set to cancelled as well.
     * @var int
     */
    public int $cancelled = 4;


    public static mixed $default = 0;
}