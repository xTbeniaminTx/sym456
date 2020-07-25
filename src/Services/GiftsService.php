<?php


namespace App\Services;


use Psr\Log\LoggerInterface;

class GiftsService
{
    public $gifts = ["gift1", "gift2", "piano", "money"];

    public function __construct(LoggerInterface $logger)
    {
        $logger->info("Gifts are randomized");
        shuffle($this->gifts);
    }

}