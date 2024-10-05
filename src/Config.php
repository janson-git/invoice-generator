<?php

declare(strict_types=1);

class Config
{
    private static bool $initialized = false;
    private static array $settings = [];

    public static function init(string $pathToConfig): void
    {
        self::$settings = include($pathToConfig);
        self::$initialized = true;
    }

    private static function checkInitialized(): void
    {
        if (!self::$initialized) {
            throw new \Exception('Config is not initialized! Path to config file is invalid.');
        }
    }

    public static function getProjectList(): array
    {
        self::checkInitialized();
        return self::$settings['project_list'] ?? [];
    }

    public static function getInvoiceIdFormat(): string
    {
        self::checkInitialized();
        return self::$settings['invoice_id_pattern'] ?? 'ymd';
    }
}
