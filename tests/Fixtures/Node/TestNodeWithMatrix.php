<?php

declare(strict_types=1);

namespace Cosray\Tests\Fixtures\Node;

use Cosray\Field\Text;
use Cosray\Node\Contract\Title;
use Cosray\Schema\Label;
use Cosray\Schema\Required;
use Cosray\Schema\Translate;

#[Label('Test Node With Matrix')]
class TestNodeWithMatrix implements Title
{
	#[Label('Titel'), Required, Translate]
	protected Text $title;

	#[Label('My Matrix Field'), Required]
	protected TestMatrix $matrix;

	public function title(): string
	{
		return strip_tags($this->title->value()->unwrap());
	}
}
