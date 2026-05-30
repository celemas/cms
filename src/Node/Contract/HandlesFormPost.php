<?php

declare(strict_types=1);

namespace Cosray\Node\Contract;

use Celemas\Core\Response;

interface HandlesFormPost
{
	public function formPost(?array $body): Response;
}
