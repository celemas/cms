<?php

declare(strict_types=1);

namespace Cosray\Tests\Fixtures\Node;

use Cosray\Field\Number;
use Cosray\Schema\Title;

#[Title('count')]
class NodeWithNumericTitleField
{
	public Number $count;
}
