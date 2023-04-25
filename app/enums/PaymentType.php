<?php

namespace APP\Enums;

class PaymentType extends AbstractionEnum
{
    public int $cash = 0;
    public int $checks = 1;
    public int $DebitCards = 2;
    public int $CreditCards = 3;
    public int $ElectronicBankTransfers = 4;
    public static mixed $default = 0;
}