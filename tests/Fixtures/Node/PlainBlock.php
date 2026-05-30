<?php

declare(strict_types=1);

namespace Cosray\Tests\Fixtures\Node;

use Cosray\Field\Text;
use Cosray\Schema\Deletable;
use Cosray\Schema\Label;

#[Label('Plain Block')]
#[Deletable(false)]
class PlainBlock
{
	#[Label('Content')]
	protected Text $content;
}
