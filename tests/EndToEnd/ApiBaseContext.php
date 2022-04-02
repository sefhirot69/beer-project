<?php

declare(strict_types=1);

namespace App\Tests\EndToEnd;

use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\PyStringNode;
use PHPUnit\Framework\Assert;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\KernelInterface;

class ApiBaseContext implements Context
{
    protected KernelInterface $kernel;
    protected $response;

    public function __construct(KernelInterface $kernel)
    {
        $this->kernel = $kernel;
    }

    /**
     * @Then response code should be :code
     */
    public function responseCodeShouldBe(int $code): void
    {
        if (null === $this->response) {
            throw new \RuntimeException('No response received');
        }

        Assert::assertEquals($code, $this->response->getStatusCode());
        Assert::assertJson($this->response->getContent());
    }

    /**
     * @When I send a :method request to :path:
     */
    public function iSendARequestTo($method, $path): void
    {
        $this->response = $this->kernel->handle(Request::create($path, $method));
    }

    /**
     * @When I send a :arg2 request to :arg1
     */
    public function iSendARequestTo2($arg1, $arg2): void
    {
        $this->response = $this->kernel->handle(Request::create($arg1, $arg2));
    }

    /**
     * @Then the response should contain json:
     */
    public function theResponseShouldContainJson(PyStringNode $string): void
    {
        Assert::assertJson($this->response->getContent());
        Assert::assertEquals(
            json_decode($this->response->getContent(), true, 512, JSON_THROW_ON_ERROR),
            json_decode($string->getRaw(), true, 512, JSON_THROW_ON_ERROR)
        );
    }
}
