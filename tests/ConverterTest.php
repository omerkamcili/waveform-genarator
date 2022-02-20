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
			new Talk()
		]);

		$channel = $this->createMock(ChannelInterface::class);
		$channel->method('getChannelName')->willReturn('test_channel');

		$converter = new Converter($parser);
		$converter->addChannel($channel);

		$talksCollections = $converter->getTalkCollections();
		$talksFromCollection = $talksCollections[0]->getTalks();
		$this->assertInstanceOf(TalkCollection::class, $talksCollections[0]);
		$this->assertInstanceOf(Talk::class, $talksFromCollection[0]);
		$this->assertInstanceOf(Talk::class, $talksFromCollection[1]);
		$this->assertEquals(1.2, $talksFromCollection[0]->getStart());
		$this->assertEquals(2.3, $talksFromCollection[0]->getEnd());

	}

	public function testGetLongestMonologueFromChannel()
	{
		// TODO: Implement testGetLongestMonologueFromChannel
	}

	public function testGetChannelTalkPercentage()
	{
		// TODO: Implement testGetLongestMonologueFromChannel
	}

	public function testGetTotalTime()
	{
		// TODO: Implement testGetTotalTime
	}

	public function testGetTotalTalksTimeFromChannel()
	{
		// TODO: Implement testGetTotalTalksTimeFromChannel
	}
}
