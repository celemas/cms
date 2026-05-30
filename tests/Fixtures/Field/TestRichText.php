<?php

declare(strict_types=1);

namespace Cosray\Tests\Fixtures\Field;

use Cosray\Field\RichText;
use Cosray\Schema\Label;
use Cosray\Schema\Translate;

#[Label('Test RichText')]
#[Translate]
class TestRichText extends RichText {}
