<?php

namespace WaveformGenerator\Entity;

use JsonSerializable;

/**
 * Class Talk
 * @package Converter
 */
class Talk implements JsonSerializable
{
	/**
	 * Talk constructor.
	 * @param float $start
	 * @param float $end
	 */
	public function __construct(protected float $start, protected float $end)
	{
	}

	/**
	 * @return float
	 */
	public function getStart(): float
	{
		return $this->start;
	}

	/**
	 * @param float $start
	 */
	public function setStart(float $start): void
	{
		$this->start = $start;
	}

	/**
	 * @return float
	 */
	public function getEnd(): float
	{
		return $this->end;
	}

	/**
	 * @param float $end
	 */
	public function setEnd(float $end): void
	{
		$this->end = $end;
	}

	/**
	 * @return array
	 */
	public function jsonSerialize(): array
	{
		return get_object_vars($this);
	}
}
