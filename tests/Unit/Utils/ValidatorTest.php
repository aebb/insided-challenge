<?php

namespace InSided\Solution\Unit\Utils;


use InSided\Solution\Entity\User;
use InSided\Solution\Request\Base\AbstractCommand;
use InSided\Solution\Request\Post\Article\ListArticleCommand;
use InSided\Solution\Utils\Validator;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass \InSided\Solution\Utils\Validator
 */
class ValidatorTest extends TestCase
{
    /**
     * @covers ::__construct
     * @covers ::validate
     */
    public function testSuccess()
    {
        $sut = new Validator();
        $obj = new ListArticleCommand($this->createMock(User::class), 1);

        $sut->validate($obj);
        $this->assertInstanceOf(AbstractCommand::class, $obj);
    }
}
