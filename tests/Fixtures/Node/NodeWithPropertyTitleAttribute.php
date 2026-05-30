<?php

declare(strict_types=1);

namespace Cosray\Tests\Fixtures\Node;

use Cosray\Field\Text;
use Cosray\Schema\Title;

class NodeWithPropertyTitleAttribute
{
	#[Title]
	protected Text $heading;

	protected Text $body;
}
