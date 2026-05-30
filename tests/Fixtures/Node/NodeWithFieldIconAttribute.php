<?php

declare(strict_types=1);

namespace Cosray\Tests\Fixtures\Node;

use Cosray\Field\Text;
use Cosray\Schema\Icon;

class NodeWithFieldIconAttribute
{
	#[Icon('bi:type', ['color' => '#00ff00', 'class' => 'cms-field-icon', 'style' => 'width: 1rem'])]
	protected Text $title;
}
