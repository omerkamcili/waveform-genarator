<?php

namespace WaveformGenerator\Parsers;

use WaveformGenerator\Channels\ChannelInterface;
use WaveformGenerator\Entity\Talk;

/**
 * Class FFMpegParser
 * @package WaveformGenerator\Parsers
 */
class FFMpegParser implements ParserInterface
{

	protected string $regexForLine = '~\[.*\]~';

	/**
	 * @param ChannelInterface $channel
	 * @return Talk[]
	 */
	public function parse(ChannelInterface $channel): array
	{
		$talks = [];
		$talk = new Talk(0.00);

		foreach ($channel->getLines() as $line) {

			$clearedLine = preg_replace($this->regexForLine, '', $line);
			$exploded = explode('|', $clearedLine);

			foreach ($exploded as $records) {

				$explodedRecords = explode(':', $records);

				if (trim($explodedRecords[0]) === 'silence_start') {

					$value = (float)trim($explodedRecords[1]);
					$talk->setEnd($value);

					if ($talk->getStart() < $talk->getEnd()) {
						array_push($talks, $talk);
					}

				} elseif (trim($explodedRecords[0]) === 'silence_end') {

					$talk = new Talk((float)trim($explodedRecords[1]));

				}
			}
		}

		$talk->setEnd($channel->getTotalTime());
		array_push($talks, $talk);

		return $talks;
	}
}
