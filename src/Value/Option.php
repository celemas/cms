<?php

declare(strict_types=1);

namespace Cosray\Value;

use function Cosray\escape;

class Option extends Value
{
	public function __toString(): string
	{
		return escape($this->unwrap());
	}

	public function unwrap(): string
	{
		return $this->data['value'];
	}

	public function json(): array
	{
		return $this->data;
	}

	public function isset(): bool
	{
		return isset($this->data['value']);
	}
}
