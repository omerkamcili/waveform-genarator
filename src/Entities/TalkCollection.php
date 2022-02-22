<?php

namespace WaveformGenerator\Entity;

use JsonSerializable;

/**
 * Class TalkCollection
 * @package Converter
 */
class TalkCollection implements JsonSerializable
{
	/**
	 * @var float
	 */
	protected float $longestMonologue;

	/**
	 * @var float
	 */
	protected float $talkPercentage;

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
	 * @return Talk[]
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
		return $this->talkPercentage;
	}

	/**
	 * @param float $talkPercentage
	 */
	public function setTalkPercentage(float $talkPercentage): void
	{
		$this->talkPercentage = $talkPercentage;
	}

	/**
	 * @return array
	 */
	public function jsonSerialize(): array
	{
		return get_object_vars($this);
	}
}
