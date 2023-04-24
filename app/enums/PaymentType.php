<?php

namespace APP\Enums;

class PaymentType extends AbstractionEnum
{
    public int $Cash = 0;
    public int $installments = 1;
    public int $visaCard = 2;
    public static mixed $default = 0;
}