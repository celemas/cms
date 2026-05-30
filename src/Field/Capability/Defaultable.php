<?php

declare(strict_types=1);

namespace Cosray\Field\Capability;

interface Defaultable
{
	public function default(mixed $default): static;
}
