<?php

namespace App\Service;

use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerAwareTrait;
use Psr\Log\LoggerInterface;

class LuckyNumberGenerator implements LoggerAwareInterface
{
    use LoggerAwareTrait;

    private $globalMinNumber;

    public function __construct(int $globalMinNumber)
    {
        $this->globalMinNumber = $globalMinNumber;
    }

    public function getRandomNumber(int $max): int
    {
        $this->logger->info('I\'m logging!');

        return random_int($this->globalMinNumber, $max);
    }

}
