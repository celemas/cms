<?php

declare(strict_types=1);

namespace Cosray\Field\Capability;

interface Requirable
{
	public function required(): static;

	public function isRequired(): bool;
}
