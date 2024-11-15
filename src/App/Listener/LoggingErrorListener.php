<?php

namespace App\Listener;

use Laminas\Log\LoggerInterface;
// use Psr\Log\LoggerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Throwable;

class LoggingErrorListener
{
    /**
     * Log format for messages:
     *
     * STATUS [METHOD] path: message
     */
    const LOG_FORMAT = '%d [%s] %s: %s';

    private $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function __invoke(Throwable $error, ServerRequestInterface $request, ResponseInterface $response)
    {
        // $this->logger->err(sprintf(
        //     self::LOG_FORMAT,
        //     $response->getStatusCode(),
        //     'Method:' . $request->getMethod(),
        //     'Uri:' . (string) $request->getUri(),
        //     'Message:' . $error->getMessage() . ' File:' . $error->getFile() . ' Line:' . $error->getLine()
        // ));
    }
}
