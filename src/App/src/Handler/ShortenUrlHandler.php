<?php

declare(strict_types=1);

namespace App\Handler;

use App\InputFilter\ShortenUrlInputFilter;
use App\Service\ShortenUrlService;
use Laminas\InputFilter\InputFilterPluginManager;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use System\Http\Response\ResponseFactory;

class ShortenUrlHandler implements RequestHandlerInterface
{
    private ShortenUrlService $shortenUrlService;
    private InputFilterPluginManager $inputFilterPluginManager;

    public function __construct(
        ShortenUrlService $shortenUrlService,
        InputFilterPluginManager $inputFilterPluginManager
    ) {
        $this->shortenUrlService = $shortenUrlService;
        $this->inputFilterPluginManager = $inputFilterPluginManager;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $body = $request->getBody()->getContents();
        $data = json_decode($body, true);
        $inputFilter = $this->inputFilterPluginManager->get(ShortenUrlInputFilter::class);
        if (!$inputFilter->setData($data)->isValid()) {
            return ResponseFactory::createJsonErrorResponse('Invalid url provided');
        }
        $url = $inputFilter->getValue('url');
        $urlId = $this->shortenUrlService->shortenUrl($url);

        return ResponseFactory::createJsonSuccessResponse(['urlId' => $urlId]);
    }
}
