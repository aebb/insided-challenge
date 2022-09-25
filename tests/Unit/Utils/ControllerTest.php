<?php

namespace InSided\Solution\Unit\Utils;

use Exception;
use InSided\Solution\Entity\Model;
use InSided\Solution\Utils\AppException;
use InSided\Solution\Utils\Controller;
use InSided\Solution\Utils\ValidatorInterface;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;

/**
 * @coversDefaultClass \InSided\Solution\Utils\Controller
 */
class ControllerTest extends TestCase
{
    private ValidatorInterface $validator;
    private ResponseFactoryInterface $responseFactory;
    private Controller $sut;
    private ResponseInterface $response;
    private StreamInterface $stream;

    public function setUp(): void
    {
        parent::setUp();

        $this->validator = $this->createMock(ValidatorInterface::class);
        $this->responseFactory  = $this->createMock(ResponseFactoryInterface::class);

        $this->sut = new Controller(
            $this->validator,
            $this->responseFactory
        );

        $this->response = $this->createMock(ResponseInterface::class);

        $this->stream = $this->createMock(StreamInterface::class);

        $this->response->expects($this->once())
            ->method('getBody')->willReturn($this->stream);

        $this->stream->expects($this->once())
            ->method('write');
    }

    /**
     * @covers ::__construct
     * @covers ::execute
     */
    public function testSuccess()
    {
        $this->responseFactory->expects($this->once())
            ->method('createResponse')
            ->with(200)
            ->willReturn($this->response);

        $this->assertInstanceOf(
            ResponseInterface::class,
            $this->sut->execute(function () {
                return $this->createMock(Model::class);
            })
        );
    }

    /**
     * @covers ::__construct
     * @covers ::execute
     */
    public function testAppException()
    {
        $this->responseFactory->expects($this->once())
            ->method('createResponse')
            ->with(401)
            ->willReturn($this->response);

        $this->assertInstanceOf(
            ResponseInterface::class,
            $this->sut->execute(function () {
                throw new AppException('error', 401);
            })
        );
    }

    /**
     * @covers ::__construct
     * @covers ::execute
     */
    public function testException()
    {
        $this->responseFactory->expects($this->once())
            ->method('createResponse')
            ->with(500)
            ->willReturn($this->response);

        $this->assertInstanceOf(
            ResponseInterface::class,
            $this->sut->execute(function () {
                throw new Exception();
            })
        );
    }
}
