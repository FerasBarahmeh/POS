<?php

namespace APP\Enums;

class PaymentStatus extends AbstractionEnum
{
    public int $sent = 0;
    public int $draft = 1;
    public int $paid = 2;
    public static mixed $default = 0;
}