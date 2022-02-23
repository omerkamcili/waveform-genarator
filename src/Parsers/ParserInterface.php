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
	 * @param ChannelInterface $channel
	 * @param array $parameters
	 * @return Talk[]
	 */
	public function parse(ChannelInterface $channel, array $parameters): array;
}
