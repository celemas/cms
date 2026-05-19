SELECT
	path,
	locale,
	creator,
	editor,
	created,
	inactive
FROM
	/*:cms.prefix:*/url_paths
WHERE
	node = :node
	AND inactive IS NULL;