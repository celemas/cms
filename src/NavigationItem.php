<?php

declare(strict_types=1);

namespace Cosray;

interface NavigationItem
{
	public NavMeta $meta { get; }

	public function slug(): ?string;

	/** @return list<NavigationItem> */
	public function children(): array;
}
