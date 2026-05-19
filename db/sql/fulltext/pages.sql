SELECT
	n.content,
	t.handle
FROM
	/*:cms.prefix:*/nodes n
JOIN /*:cms.prefix:*/types t
	ON t.type = n.type
WHERE
	n.deleted IS NULL
	AND n.published = true;