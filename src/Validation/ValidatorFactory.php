<?php

declare(strict_types=1);

namespace Celemas\Cms\Validation;

use Celemas\Cms\Field\Field;
use Celemas\Cms\Field\FieldHydrator;
use Celemas\Cms\Locales;
use Celemas\Cms\Node\Factory;
use Celemas\Sire\Shape;

class ValidatorFactory
{
	protected readonly Shape $shape;

	public function __construct(
		protected readonly object $node,
		protected readonly Locales $locales,
		private readonly FieldHydrator $hydrator = new FieldHydrator(),
	) {
		$this->shape = Shapes::create();
		Shapes::add($this->shape, 'uid', 'text', 'required', 'maxlen:64');
		Shapes::add($this->shape, 'parent', 'text', 'maxlen:64');
		Shapes::add($this->shape, 'published', 'bool', 'required');
		Shapes::add($this->shape, 'locked', 'bool')->empty('missing', 'null')->default(false);
		Shapes::add($this->shape, 'hidden', 'bool')->empty('missing', 'null')->default(false);
	}

	public function create(): Shape
	{
		$contentShape = Shapes::create();

		foreach (Factory::fieldNamesFor($this->node) as $fieldName) {
			$this->add($contentShape, $fieldName, $this->hydrator->getField($this->node, $fieldName));
		}

		Shapes::add($this->shape, 'content', $contentShape);

		return $this->shape;
	}

	protected function add(Shape $shape, string $fieldName, Field $field): void
	{
		Shapes::add($shape, $fieldName, $field->shape())->label($field->getLabel());
	}
}
