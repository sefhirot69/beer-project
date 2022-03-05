<?php

declare(strict_types=1);

namespace App\Tests\EndToEnd;

use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
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
     * @When I send a :method request to :path
     */
    public function iSendARequestTo(string $method, string $path)
    {
        $this->response = $this->kernel->handle(Request::create($path, $method));
    }

    /**
     * @Then response code should be :code
     */
    public function responseCodeShouldBe(int $code)
    {
        if (null === $this->response) {
            throw new \RuntimeException('No response received');
        }

        Assert::assertEquals($code, $this->response->getStatusCode());
        Assert::assertJson($this->response->getContent());
    }

    /**
     * @When I send a :method request to :path with values:
     */
    public function iSendAGetRequestToWithValues($method, $path, TableNode $table)
    {
        foreach ($table as $row) {
            $request[$row['name']] = $row['value'];
        }
        $queryString = http_build_query($request);
        $this->response = $this->kernel->handle(Request::create("$path?$queryString", $method));
    }

    /**
     * @Then the response should contain json:
     */
    public function theResponseShouldContainJson(PyStringNode $string)
    {
        Assert::assertJson($this->response->getContent());
        Assert::assertEquals(
            json_decode($this->response->getContent(), true),
            json_decode($string->getRaw(), true)
        );
    }
}
