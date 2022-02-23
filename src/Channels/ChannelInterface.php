<?php

namespace WaveformGenerator\Channels;

/**
 * Interface ChannelInterface
 */
interface ChannelInterface
{
	/**
	 * @return array
	 */
	public function getLines(): array;

	/**
	 * @return string
	 */
	public function getChannelName(): string;
}
