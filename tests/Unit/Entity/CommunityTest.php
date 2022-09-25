<?php

namespace InSided\Solution\Unit\Entity;

use InSided\Solution\Entity\Article;
use InSided\Solution\Entity\Community;
use InSided\Solution\Entity\Conversation;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass \InSided\Solution\Entity\Community
 */
class CommunityTest extends TestCase
{
    /**
     * @covers ::__construct
     * @covers::savePost
     * @covers ::fetchPost
     */
    public function testSaveAndFetch()
    {
        $id = 123;
        $community = new Community('demo', []);
        $post = new Article('title', 'content', true, null, [], $id);

        $community->savePost($post);

        $this->assertEquals($post, $community->fetchPost($id));
        $this->assertNull($community->fetchPost($id . '321'));
    }

    /**
     * @covers ::__construct
     * @covers::listPosts
     */
    public function testList()
    {
        $community = new Community('demo', []);

        $community->savePost(new Conversation());
        $community->savePost(new Article());
        $community->savePost(new Article());
        $community->savePost(new Article());
        $community->savePost(new Conversation());

        $this->assertCount(2, $community->listPosts(Conversation::class));
    }

    /**
     * @covers ::__construct
     * @covers ::savePost
     * @covers ::fetchPost
     * @covers ::removePost
     */
    public function testRemove()
    {
        $id = 123;
        $community = new Community('demo', []);
        $post = new Article('title', 'content', true, null, [], $id);

        $community->savePost($post);

        $this->assertEquals($post, $community->fetchPost($id));
        $this->assertNull($community->fetchPost($id . '321'));

        $community->removePost($post);
        $this->assertNull($community->fetchPost($id));
    }
}
