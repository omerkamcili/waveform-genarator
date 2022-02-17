<?php

use PHPUnit\Framework\TestCase;
use WaveformGenerator\Entity\Talk;
use WaveformGenerator\Entity\TalkCollection;

/**
 * Class EntitiesTest
 */
class EntitiesTest extends TestCase
{

	public function testTalksCollectionProperties()
	{
		$talk1 = new Talk(1.345, 2.554);
		$talk2 = new Talk(6.776, 10.554);
		$talk3 = new Talk(17.667, 40);
		$talksCollection = new TalkCollection('test_channel', [$talk1, $talk2, $talk3]);

		$this->assertEquals([$talk1, $talk2, $talk3], $talksCollection->getTalks());
		$this->assertEquals('test_channel', $talksCollection->getChannelName());
	}

	public function testTalksJsonable()
	{
		$talk1 = new Talk(1.345, 2.554);
		$talk2 = new Talk(6.776, 10.554);
		$talk3 = new Talk(17.667, 40);
		$talksCollection = new TalkCollection('test_channel', [$talk1, $talk2, $talk3]);

		$expected = '{"channelName":"test_channel","talks":[{"start":1.345,"end":2.554},{"start":6.776,"end":10.554},{"start":17.667,"end":40}]}';
		$this->assertEquals($expected, json_encode($talksCollection));
	}

	public function testTalkProperties()
	{
		// TODO: Implement test
	}
}
