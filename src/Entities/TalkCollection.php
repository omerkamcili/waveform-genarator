<?php

namespace WaveformGenerator\Entity;

/**
 * Class TalkCollection
 * @package Converter
 */
class TalkCollection
{
	/**
	 * @var float
	 */
	protected float $longestMonologue;

	/**
	 * @var float
	 */
	protected float $talk_percentage;

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


	/**
	 * @return float
	 */
	public function getLongestMonologue(): float
	{
		return $this->longestMonologue;
	}

	/**
	 * @param float $longestMonologue
	 */
	public function setLongestMonologue(float $longestMonologue): void
	{
		$this->longestMonologue = $longestMonologue;
	}

	/**
	 * @return float
	 */
	public function getTalkPercentage(): float
	{
		return $this->talk_percentage;
	}

	/**
	 * @param float $talk_percentage
	 */
	public function setTalkPercentage(float $talk_percentage): void
	{
		$this->talk_percentage = $talk_percentage;
	}
}
