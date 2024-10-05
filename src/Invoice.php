<?php

declare(strict_types=1);

class Invoice
{
    private const DEFAULT_DATE_FORMAT = 'F d, Y';

    private DateTimeImmutable $invoiceDate;
    private DateTimeImmutable $billedStartDate;
    private DateTimeImmutable $billedEndDate;

    /** @var InvoiceItem[]|array  */
    private array $items = [];
    private float $totalValue = 0.0;

    public function __construct(string $invoiceDate)
    {
        $this->invoiceDate = new \DateTimeImmutable($invoiceDate);
    }

    public function getInvoiceNumber(): string
    {
        return sprintf(
            '%s',
            $this->invoiceDate->format(Config::getInvoiceIdFormat()),
        );
    }

    public function getInvoiceFormattedDate(string $format = self::DEFAULT_DATE_FORMAT): string
    {
        return $this->invoiceDate->format($format);
    }

    public function getInvoiceRangeStartFormatted(string $format = self::DEFAULT_DATE_FORMAT): string
    {
        return $this->billedStartDate->format($format);
    }

    public function getInvoiceRangeEndFormatted(string $format = self::DEFAULT_DATE_FORMAT): string
    {
        return $this->billedEndDate->format($format);
    }

    public function addItem(
        string $title,
        float $hours,
        int $pricePerHour,
    ): void
    {
        $item = new InvoiceItem(
            $title,
            $hours,
            $pricePerHour,
        );
        $this->items[] = $item;

        $this->totalValue += $item->getPrice();
    }

    /**
     * @return array|InvoiceItem[]
     */
    public function getItems(): array
    {
        return $this->items;
    }

    public function getTotalValue(): float
    {
        return $this->totalValue;
    }

    public function setBilledDate(int $month, int $year): void
    {
        $month = $month < 10 ? "0{$month}" : $month;
        $this->billedStartDate = new \DateTimeImmutable("{$year}-{$month}-01");
        $this->billedEndDate = new \DateTimeImmutable($this->billedStartDate->format('Y-m-t'));
    }
}
