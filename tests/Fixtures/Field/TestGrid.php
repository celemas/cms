<?php

declare(strict_types=1);

namespace Cosray\Tests\Fixtures\Field;

use Cosray\Field\Grid;
use Cosray\Schema\Columns;
use Cosray\Schema\Label;
use Cosray\Schema\Translate;

#[Label('Test Grid')]
#[Columns(12, 4)]
#[Translate]
class TestGrid extends Grid {}
