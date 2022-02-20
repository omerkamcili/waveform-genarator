<?php

use WaveformGenerator\Channels\FileChannel;
use PHPUnit\Framework\TestCase;

/**
 * Class FileChannelTests
 */
class FileChannelTests extends TestCase
{
	public function testGetLines()
	{
		$expectedLines = [
			'[silencedetect @ 0x7fbfbbc076a0] silence_start: 3.504',
			'[silencedetect @ 0x7fbfbbc076a0] silence_end: 6.656 | silence_duration: 3.152',
			'[silencedetect @ 0x7fbfbbc076a0] silence_start: 14',
			'[silencedetect @ 0x7fbfbbc076a0] silence_end: 19.712 | silence_duration: 5.712'
		];
		$testChannel = new FileChannel('test_user', 'resources/ffmpeg-exported.txt', 100.00);
		$actualLines = $testChannel->getLines();
		$this->assertIsArray($testChannel->getLines());
		$this->assertEquals($expectedLines, $actualLines);
	}

	public function testGetChannelName()
	{
		$testChannel = new FileChannel('test_channel_name', 'resources/ffmpeg-exported.txt', 100.00);
		$this->assertEquals('test_channel_name', $testChannel->getChannelName());
	}

	public function testGetTotalTime()
	{
		$testChannel = new FileChannel('test_channel_name', 'resources/ffmpeg-exported.txt', 100.00);
		$this->assertEquals(100.00, $testChannel->getTotalTime());
	}

}
