<?php

use PHPUnit\Framework\TestCase;
use WaveformGenerator\Channels\ChannelInterface;
use WaveformGenerator\Entity\Talk;
use WaveformGenerator\Parsers\FFMpegParser;

/**
 * Class FFMpegParserTest
 */
class FFMpegParserTest extends TestCase
{
	public function testFFMpegParser()
	{
		$channel = $this->createMock(ChannelInterface::class);
		$channel->method('getLines')->willReturn([
			'[silencedetect @ 0x7fbfbbc076a0] silence_start: 3.504',
			'[silencedetect @ 0x7fbfbbc076a0] silence_end: 6.656 | silence_duration: 3.152',
			'[silencedetect @ 0x7fbfbbc076a0] silence_start: 14',
			'[silencedetect @ 0x7fbfbbc076a0] silence_end: 19.712 | silence_duration: 5.712'
		]);

		$parser = new FFMpegParser();
		$parameters = [
			'totalTime' => 25.424
		];
		$talks = $parser->parse($channel, $parameters);

		$this->assertInstanceOf(Talk::class, $talks[0]);
		$this->assertInstanceOf(Talk::class, $talks[1]);
		$this->assertInstanceOf(Talk::class, $talks[2]);

		$this->assertEquals(0, $talks[0]->getStart());
		$this->assertEquals(3.504, $talks[0]->getEnd());

		$this->assertEquals(6.656, $talks[1]->getStart());
		$this->assertEquals(14, $talks[1]->getEnd());

		$this->assertEquals(19.712, $talks[2]->getStart());
		$this->assertEquals(25.424, $talks[2]->getEnd());
	}
}
