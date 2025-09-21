<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */

namespace App\Exception\Handler;

use Hyperf\Context\Context;
use Hyperf\Contract\StdoutLoggerInterface;
use Hyperf\ExceptionHandler\ExceptionHandler;
use Hyperf\HttpMessage\Exception\NotFoundHttpException;
use Hyperf\HttpMessage\Stream\SwooleStream;
use Psr\Http\Message\MessageInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Throwable;

class AppExceptionHandler extends ExceptionHandler
{
    public function __construct(protected StdoutLoggerInterface $logger)
    {
    }

    public function handle(Throwable $throwable, ResponseInterface $response): MessageInterface|ResponseInterface
    {
//        print_r(['服务异常']);
        $msg = '服务异常';
        $code = 0;
        if ($throwable instanceof NotFoundHttpException){
            // 抛出404路径
            $request = Context::get(ServerRequestInterface::class);
            $requestPath = $request ? $request->getUri()->getPath() : '未知路径';
            $requestMethod = $request ? $request->getMethod() : '未知方法';
            $requestUri = $request ? (string)$request->getUri() : '未知URI';

            // 打印404日志信息
            print_r([
                '404错误' => [
                    '请求方法' => $requestMethod,
                    '请求路径' => $requestPath,
                    '完整URI' => $requestUri,
                    '时间' => date('Y-m-d H:i:s'),
                    '异常信息' => $throwable->getMessage()
                ]
            ]);

            $msg = "This is the abyss - 请求路径: {$requestPath}";
            $code = 404;
        } else{
            $code = 500;
            $msg = 'Internal Server Error';
            $this->logger->error(sprintf('%s[%s] in %s', $throwable->getMessage(), $throwable->getLine(), $throwable->getFile()));
            $this->logger->error($throwable->getTraceAsString());
        }
        $body = json_encode([
            'code' => $code,
            'msg' => $msg
        ], JSON_UNESCAPED_UNICODE);
        return $response->withHeader('Content-Type', 'text/html;charset=utf-8')->withStatus(200)->withBody(new SwooleStream($body));
    }

    public function isValid(Throwable $throwable): bool
    {
        return true;
    }
}
