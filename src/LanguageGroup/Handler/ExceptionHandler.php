<?php declare(strict_types=1);

namespace LanguageGroup\Handler;

use LanguageGroup\Exception\ValidationFailedException;
use LanguageGroup\Service\ConfigServiceInterface;

final readonly class ExceptionHandler
{
    public function __construct(private ConfigServiceInterface $configService)
    {
    }

    public function report(\Throwable $exception): void
    {
        $message = $exception->getMessage();

        if ($exception instanceof ValidationFailedException) {
            echo $message . PHP_EOL;
        } else {
            $logFile = $this->configService->getErrorLogFile();
            error_log($message . PHP_EOL, 3, $logFile);
            echo sprintf('Exception occurred! Please check errors log file: %s%s', $logFile, PHP_EOL);
        }
    }
}
