<?php

declare(strict_types=1);

namespace App\Handler;

use App\Entity\UrlClick;
use Cli\Entity\Task\SendDataToAnalyticsServiceTask;
use Laminas\Diactoros\Response\RedirectResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use System\Http\Response\ResponseFactory;
use System\Service\BeanstalkService;
use System\Service\RedisService;

class RedirectHandler implements RequestHandlerInterface
{
    private RedisService $redisService;
    private BeanstalkService $beanstalkService;

    public function __construct(RedisService $redisService, BeanstalkService $beanstalkService)
    {
        $this->redisService = $redisService;
        $this->beanstalkService = $beanstalkService;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $urlId = $request->getAttribute('urlId');
        $url = $this->redisService->getData($urlId);
        if ($url === '') {
            return ResponseFactory::createJsonErrorResponse('Url not found');
        }
        $ipAddress = $request->getServerParams()['REMOTE_ADDR'] ?? '';
        $userAgent = $request->getHeaderLine('user-agent') ?? '';
        $referer = $request->getHeaderLine('referer') ?? '';
        $urlClick = UrlClick::builder()
            ->longUrl($url)
            ->urlId($urlId)
            ->ipAddress($ipAddress)
            ->userAgent($userAgent)
            ->referer($referer)
            ->build();
        $this->beanstalkService->addTask(new SendDataToAnalyticsServiceTask($urlClick->toArray()));

        return new RedirectResponse($url);
    }
}
