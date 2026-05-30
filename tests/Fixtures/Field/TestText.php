<?php

declare(strict_types=1);

namespace Cosray\Tests\Fixtures\Field;

use Cosray\Field\Text;
use Cosray\Schema\Label;
use Cosray\Schema\Translate;

#[Label('Test Text')]
#[Translate]
class TestText extends Text {}
