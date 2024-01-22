<?php

namespace App\Service;

use App\Entity\UserCar;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class SpamChecker
{
    private string $endpoint;

    public function __construct(
        private HttpClientInterface $client,
        #[Autowire('%env(AKISMET_KEY)%')] string $akismetKey
    ) {
        $this->endpoint = sprintf('https://%s.rest.akismet.com/1.1/comment-check', $akismetKey);
    }

    public function getSpamScore(UserCar $userCar, array $context)
    {
        $response = $this->client->request('POST', $this->endpoint, [
            'body' => array_merge($context, [
                'blog' => 'https://www.nicolasperrot.com',
                'comment_type' => 'comment',
                'comment_author' => $userCar->getOwner(),
                'comment_author_email' => $userCar->getOwnerEmail(),
                'comment_content' => $userCar->getText(),
                'blog_lang' => 'fr_fr',
                'blog_charset' => 'UTF-8',
            ]),
        ]);

        $headers = $response->getHeaders();

        if ('discard' === ($headers['x-akismet-pro-tip'][0] ?? '')) {
            return 2;
        }

        $content = $response->getContent();
        if (isset($headers['x-akismet-debug-help'][0])) {
            throw new \RuntimeException(sprintf('Unable to check for spam: %s (%s).', $content, $headers['x-akismet-debug-help'][0]));
        }

        return 'true' === $content ? 1 : 0;
    }
}