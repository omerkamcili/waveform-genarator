<?php

namespace WaveformGenerator\Converter;

use WaveformGenerator\Channels\ChannelInterface;
use WaveformGenerator\Entity\Talk;
use WaveformGenerator\Entity\TalkCollection;
use WaveformGenerator\Parsers\ParserInterface;

/**
 * Class Converter
 * @package Converter
 */
class Converter
{
	/**
	 * Converter constructor.
	 * @param ParserInterface $parser
	 */
	public function __construct(protected ParserInterface $parser)
	{
	}

	/**
	 * @var array
	 */
	protected array $channels;

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
			$talksFromChannel = $this->getChannelTalks($channel);
			$collection = new TalkCollection($channel, $talksFromChannel);
			array_push($collections, $collection);
		}

		return $collections;
	}

	/**
	 * @param string $channel
	 * @return float
	 */
	public function getLongestMonologueFromChannel(string $channel): float
	{

	}

	public function getChannelTalkPercentage(string $channel): float
	{

	}

	/**
	 * @param string $channelName
	 * @return Talk[]
	 */
	public function getChannelTalks(string $channelName): array
	{
		$channel = $this->getChannel($channelName);
		return $this->parser->parse($channel);
	}

}
