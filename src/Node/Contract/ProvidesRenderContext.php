<?php

declare(strict_types=1);

namespace Cosray\Node\Contract;

interface ProvidesRenderContext
{
	public function renderContext(): array;
}
