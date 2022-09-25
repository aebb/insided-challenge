<?php

namespace InSided\Solution\Unit\Repository;

use InSided\Solution\Entity\Community;
use InSided\Solution\Repository\CommunityRepositoryInMemory;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass \InSided\Solution\Repository\CommunityRepositoryInMemory
 */
class CommunityRepositoryInMemoryTest extends TestCase
{
    private CommunityRepositoryInMemory $sut;

    public function setUp(): void
    {
        $this->sut = new CommunityRepositoryInMemory();
    }

    /**
     * @covers ::findCommunityById
     * @covers ::save
     */
    public function testSaveAndFetch()
    {
        $id = 123;
        $community = new Community('demo', [], $id);

        $this->sut->save($community);

        $this->assertEquals($community, $this->sut->findCommunityById($id));

        $this->assertNull($this->sut->findCommunityById('1234'));
    }
}
