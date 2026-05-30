<?php

declare(strict_types=1);

namespace Cosray\Field\Capability;

interface Limitable
{
	public function limit(int $max, int $min = 0): static;

	public function getLimitMin(): int;

	public function getLimitMax(): int;
}
