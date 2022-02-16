<?php

namespace Channels;

use Exception;

/**
 * Class FileChannel
 * @package Channels
 */
class FileChannel implements ChannelInterface
{
	/**
	 * @var array
	 */
	protected array $lines;

	/**
	 * FileChannel constructor.
	 * @param string $channelName
	 * @param string $filePath
	 * @throws Exception
	 */
	public function __construct(protected string $channelName, protected string $filePath)
	{
		if (!is_file($this->filePath)) {
			throw new Exception(sprintf('The channel file doesn\'t exist %s', $$this->filePath));
		}
	}

	/**
	 * @return array
	 */
	public function getLines(): array
	{
		$lines = [];
		if ($file = fopen($this->filePath, "r")) {
			while (!feof($file)) {
				$line = str_replace(["\r", "\n"], '', fgets($file));
				if (strlen($line)) {
					array_push($lines, $line);
				}
			}
			fclose($file);
		}
		return $lines;
	}

	/**
	 * @return string
	 */
	public function getChannelName(): string
	{
		return $this->channelName;
	}
}
