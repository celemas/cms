<?php

declare(strict_types=1);

namespace Cosray\Tests\Fixtures\Node;

use Cosray\Schema\Title;

class NodeWithInvalidPropertyTitleAttribute
{
	#[Title]
	protected string $heading;
}
