<?php

declare(strict_types=1);

namespace Cosray\Controller\Panel;

use Celemas\Core\Exception\HttpNotFound;
use Celemas\Core\Request;
use Celemas\Wire\Creator;
use Cosray\Collection as CmsCollection;
use Cosray\Exception\RuntimeException;
use Cosray\Navigation;

final class Collection extends Panel
{
	public function collection(string $collection): array
	{
		$creator = new Creator($this->container);
		$navigation = $this->navigation();

		try {
			$ref = $navigation->ref($collection);
		} catch (RuntimeException $e) {
			throw new HttpNotFound($this->request, previous: $e);
		}

		$obj = $creator->create(
			$ref::class,
			predefinedTypes: [Request::class => $this->request],
		);
		assert($obj instanceof CmsCollection, 'The collection route must resolve a collection');
		$listing = $obj->list();

		return $this->context([
			'name' => $ref->meta->label,
			'slug' => $collection,
			'header' => $obj->header(),
			'nodes' => $listing['nodes'],
		]);
	}

	private function navigation(): Navigation
	{
		$navigation = $this->container->get(Navigation::class);
		assert($navigation instanceof Navigation, 'The navigation service must be available');

		return $navigation;
	}
}
