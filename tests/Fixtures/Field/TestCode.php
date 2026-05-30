<?php

declare(strict_types=1);

namespace Cosray\Tests\Fixtures\Field;

use Cosray\Field\Code;
use Cosray\Schema\Label;
use Cosray\Schema\Syntax;
use Cosray\Schema\Translate;

#[Label('Test Code')]
#[Translate]
#[Syntax('php', 'javascript')]
class TestCode extends Code {}
