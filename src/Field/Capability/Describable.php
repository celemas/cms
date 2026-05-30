<?php

declare(strict_types=1);

namespace Cosray\Field\Capability;

interface Describable
{
	public function description(string $description): static;

	public function getDescription(): ?string;
}
