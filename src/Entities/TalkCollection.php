<?php

namespace WaveformGenerator\Entity;

/**
 * Class TalkCollection
 * @package Converter
 */
class TalkCollection
{

	/**
	 * TalkCollection constructor.
	 * @param string $channelName
	 * @param array $talks
	 */
	public function __construct(protected string $channelName, protected array $talks = [])
	{
	}

	/**
	 * @return mixed
	 */
	public function getChannelName(): string
	{
		return $this->channelName;
	}

	/**
	 * @param string $channelName
	 */
	public function setChannelName(string $channelName): void
	{
		$this->channelName = $channelName;
	}

	/**
	 * @return array
	 */
	public function getTalks(): array
	{
		return $this->talks;
	}

	/**
	 * @param array $talks
	 */
	public function setTalks(array $talks): void
	{
		$this->talks = $talks;
	}
}
