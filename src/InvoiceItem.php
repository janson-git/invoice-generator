<?php

declare(strict_types=1);

class InvoiceItem
{
    private float $price;

    public function __construct(
        private string $title,
        private float $hours,
        private int $costPerHour,
    ) {
        $this->price = $this->hours * $this->costPerHour;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function getCostPerHour(): int
    {
        return $this->costPerHour;
    }

    public function getHours(): float
    {
        return $this->hours;
    }
}
