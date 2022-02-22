<?php

use PHPUnit\Framework\TestCase;
use WaveformGenerator\Channels\ChannelInterface;
use WaveformGenerator\Entity\Talk;
use WaveformGenerator\Entity\TalkCollection;
use WaveformGenerator\Parsers\ParserInterface;
use WaveformGenerator\Converter\Converter;

/**
 * Class ConverterTest
 */
class ConverterTest extends TestCase
{

	public function testConverterAddAndGetChannel()
	{
		$parser = $this->createMock(ParserInterface::class);
		$converter = new Converter($parser);

		$channel = $this->createMock(ChannelInterface::class);
		$channel->method('getChannelName')->willReturn('test_channel');
		$converter->addChannel($channel);

		$this->assertEquals($channel, $converter->getChannel('test_channel'));
	}

	public function testConverterGetChannelTalks()
	{
		$parser = $this->createMock(ParserInterface::class);
		$parser->method('parse')->willReturn([
			new Talk(),
			new Talk()
		]);

		$channel = $this->createMock(ChannelInterface::class);
		$channel->method('getChannelName')->willReturn('test_channel');

		$converter = new Converter($parser);
		$converter->addChannel($channel);

		$talks = $converter->getChannelTalks('test_channel');
		$this->assertInstanceOf(Talk::class, $talks[0]);
		$this->assertInstanceOf(Talk::class, $talks[1]);
	}

	public function testGetTalkCollections()
	{
		$parser = $this->createMock(ParserInterface::class);
		$parser->method('parse')->willReturn([
			new Talk(1.2, 2.3),
			new Talk(5, 10)
		]);

		$channel = $this->createMock(ChannelInterface::class);
		$channel->method('getChannelName')->willReturn('test_channel');

		$converter = new Converter($parser, 20);
		$converter->addChannel($channel);

		$talksCollections = $converter->getTalkCollections();
		$talksFromCollection = $talksCollections[0]->getTalks();
		$this->assertInstanceOf(TalkCollection::class, $talksCollections[0]);
		$this->assertInstanceOf(Talk::class, $talksFromCollection[0]);
		$this->assertInstanceOf(Talk::class, $talksFromCollection[1]);
		$this->assertEquals(1.2, $talksFromCollection[0]->getStart());
		$this->assertEquals(2.3, $talksFromCollection[0]->getEnd());
		$this->assertEquals(5.0, $talksCollections[0]->getLongestMonologue());
		$this->assertEquals(30.5, $talksCollections[0]->getTalkPercentage());

	}

	public function testGetLongestMonologueFromChannel()
	{
		$parser = $this->createMock(ParserInterface::class);
		$parser->method('parse')->willReturn([
			new Talk(1.2, 2.3),
			new Talk(30.2, 50.4),
			new Talk(55, 80.5),
			new Talk(90, 90.3)
		]);

		$channel = $this->createMock(ChannelInterface::class);
		$channel->method('getChannelName')->willReturn('test_channel');

		$converter = new Converter($parser);
		$converter->addChannel($channel);

		$totalTalksTime = $converter->getLongestMonologueFromChannel('test_channel');
		$this->assertEquals(25.5, $totalTalksTime);
	}

	public function testGetChannelTalkPercentage()
	{
		$parser = $this->createMock(ParserInterface::class);
		$parser->method('parse')->willReturn([
			new Talk(10, 20.00)
		]);

		$channel = $this->createMock(ChannelInterface::class);
		$channel->method('getChannelName')->willReturn('test_channel');

		$converter = new Converter($parser, 40);
		$converter->addChannel($channel);

		$channelTalkPercentage = $converter->getChannelTalkPercentage('test_channel');
		$this->assertEquals(25.0, $channelTalkPercentage);
	}

	public function testGetTotalTime()
	{
		$parser = $this->createMock(ParserInterface::class);
		$channel = $this->createMock(ChannelInterface::class);
		$channel->method('getChannelName')->willReturn('test_channel');

		$converter = new Converter($parser, 30.4);
		$this->assertEquals(30.4, $converter->getTotalTime());
	}

	public function testGetTotalTalksTimeFromChannel()
	{
		$parser = $this->createMock(ParserInterface::class);
		$parser->method('parse')->willReturn([
			new Talk(1.2, 2.3),
			new Talk(10.4, 20.5)
		]);

		$channel = $this->createMock(ChannelInterface::class);
		$channel->method('getChannelName')->willReturn('test_channel');

		$converter = new Converter($parser);
		$converter->addChannel($channel);

		$totalTalksTime = $converter->getTotalTalksTimeFromChannel('test_channel');
		$this->assertEquals(11.2, $totalTalksTime);
	}
}
