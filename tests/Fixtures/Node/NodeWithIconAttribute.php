<?php

declare(strict_types=1);

namespace Cosray\Tests\Fixtures\Node;

use Cosray\Schema\Icon;
use Cosray\Schema\Label;

#[Label('Node with icon')]
#[Icon('bi:check', color: '#ff0000', class: 'cms-node-icon', style: 'height: 1rem')]
class NodeWithIconAttribute {}
