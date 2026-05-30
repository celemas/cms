<?php

declare(strict_types=1);

namespace Cosray\Field\Capability;

trait IsDescribable
{
	protected ?string $description = null;

	public function description(string $description): static
	{
		$this->description = $description;

		return $this;
	}

	public function getDescription(): ?string
	{
		return $this->description;
	}
}
