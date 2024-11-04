<?php declare(strict_types=1);

namespace LanguageGroup\Handler;

use LanguageGroup\Service\ConfigServiceInterface;

/**
 * Class ExceptionHandler
 * @package LanguageGroup\Handler
 */
final readonly class ExceptionHandler
{
    /**
     * ExceptionHandler constructor.
     * @param ConfigServiceInterface $configService
     */
    public function __construct(private ConfigServiceInterface $configService)
    {
    }

    /**
     * @param \Throwable $e
     */
    public function report(\Throwable $e): void
    {
        $message = $e->getMessage();
        $logFile = $this->configService->getErrorLogFile();

        error_log($message . PHP_EOL, 3, $logFile);

        echo 'Exception occurred! Please check errors log file.' . PHP_EOL;
    }
}
