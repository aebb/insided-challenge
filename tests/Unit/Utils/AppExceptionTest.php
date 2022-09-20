<?php

namespace InSided\Solution\Unit\Utils;

use InSided\Solution\Utils\AppException;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass \InSided\Solution\Utils\AppException
 */
class AppExceptionTest extends TestCase
{
    /**
     * @covers ::__construct
     * @covers ::getStatusCode
     * @covers ::jsonSerialize
     */
    public function testAppException()
    {
        $sut = new AppException();
        $expected = ['error' => 'Unexpected error'];

        $this->assertEquals(500, $sut->getStatusCode());
        $this->assertEquals($expected, $sut->jsonSerialize());
    }
}
