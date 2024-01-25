<?php

namespace App\Tests;

use App\Entity\UserCar;
use App\Service\SpamChecker;
use Couchbase\User;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpClient\MockHttpClient;
use Symfony\Component\HttpClient\Response\MockResponse;
use Symfony\Contracts\HttpClient\ResponseInterface;

class SpamCheckerTest extends TestCase
{
    public function testSpamScoreWithInvalidRequest(): void
    {
        $userCar = new UserCar();
        $context = [];
        
        $client = new MockHttpClient([new MockResponse('invalid', ['response_headers' => ['x-akismet-debug-help: Invalid key']])]);
        $checker = new SpamChecker($client, 'abcde');
        
        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage('Unable to check for spam: invalid (Invalid key).');
        $checker->getSpamScore($userCar, $context);
    }

    /**
     * @dataProvider provideComments
     */
    public function testSpamScore(int $expectedScore, ResponseInterface $response, UserCar $userCar, array $context)
    {
        $client = new MockHttpClient([$response]);
        $checker = new SpamChecker($client, 'abcde');

        $score = $checker->getSpamScore($userCar, $context);
        $this->assertSame($expectedScore, $score);
    }

    public static function provideComments(): iterable
    {
        $userCar = new Usercar();
        $context = [];

        $response = new MockResponse('', ['response_headers' => ['x-akismet-pro-tip: discard']]);
        yield 'blatant_spam' => [2, $response, $userCar, $context];

        $response = new MockResponse('true');
        yield 'spam' => [1, $response, $userCar, $context];

        $response = new MockResponse('false');
        yield 'ham' => [0, $response, $userCar, $context];
    }
    
}
