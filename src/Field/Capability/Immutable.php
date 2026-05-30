<?php

declare(strict_types=1);

namespace Cosray\Field\Capability;

interface Immutable
{
	public function immutable(bool $immutable = true): static;
}
