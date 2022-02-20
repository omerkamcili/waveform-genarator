<?php

namespace WaveformGenerator\Converter;

use WaveformGenerator\Channels\ChannelInterface;
use WaveformGenerator\Entity\Talk;
use WaveformGenerator\Entity\TalkCollection;
use WaveformGenerator\Parsers\ParserInterface;
use WaveformGeneratorException;

/**
 * Class Converter
 * @package Converter
 */
class Converter
{

	/**
	 * @var ChannelInterface[]
	 */
	protected array $channels;

	/**
	 * @var array
	 */
	protected array $channelTalks;

	/**
	 * Converter constructor.
	 * @param ParserInterface $parser
	 * @param float $totalTime
	 */
	public function __construct(protected ParserInterface $parser, protected float $totalTime = 0.00)
	{
	}

	/**
	 * @param ChannelInterface $channel
	 * @return void
	 */
	public function addChannel(ChannelInterface $channel): void
	{
		$this->channels[$channel->getChannelName()] = $channel;
	}

	/**
	 * @param string $channelName
	 * @return ChannelInterface
	 */
	public function getChannel(string $channelName): ChannelInterface
	{
		return $this->channels[$channelName];
	}

	/**
	 * @return TalkCollection[]
	 */
	public function getTalkCollections(): array
	{
		$collections = [];
		foreach ($this->channels as $channel) {
			$talksFromChannel = $this->getChannelTalks($channel->getChannelName());
			$collection = new TalkCollection($channel->getChannelName(), $talksFromChannel);
			array_push($collections, $collection);
		}

		return $collections;
	}

	/**
	 * @param string $channelName
	 * @return float
	 */
	public function getLongestMonologueFromChannel(string $channelName): float
	{
		// TODO: Implement getLongestMonologueFromChannel
	}

	/**
	 * @param string $channelName
	 * @return float
	 * @throws WaveformGeneratorException
	 */
	public function getChannelTalkPercentage(string $channelName): float
	{
		if ($this->getTotalTime() === 0.00) {
			throw new WaveformGeneratorException('Need to define total meet time for talk percentage');
		}

		// TODO: Implement getChannelTalkPercentage

	}

	/**
	 * @param string $channelName
	 * @return Talk[]
	 */
	public function getChannelTalks(string $channelName): array
	{
		if (!isset($this->channelTalks[$channelName])) {
			$channel = $this->getChannel($channelName);
			$this->channelTalks[$channelName] = $this->parser->parse($channel);
		}

		return $this->channelTalks[$channelName];
	}

	/**
	 * @return float
	 */
	public function getTotalTime(): float
	{
		return $this->totalTime;
	}

	/**
	 * @param string $channelName
	 * @return float
	 */
	public function getTotalTalksTimeFromChannel(string $channelName): float
	{
		// TODO: Implement getTotalTalksTimeFromChannel
	}

}
