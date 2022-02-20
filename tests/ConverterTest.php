<?php

use PHPUnit\Framework\TestCase;
use WaveformGenerator\Channels\ChannelInterface;
use WaveformGenerator\Entity\Talk;
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
}
