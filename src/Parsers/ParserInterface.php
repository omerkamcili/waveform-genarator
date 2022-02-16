<?php

namespace WaveformGenerator\Parsers;

use WaveformGenerator\Channels\ChannelInterface;
use WaveformGenerator\Entity\Talk;

/**
 * Interface ParserInterface
 */
interface ParserInterface
{
	/**
	 * @return Talk[]
	 */
	public function parse(ChannelInterface $channel): array;
}
