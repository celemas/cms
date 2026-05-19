SELECT
	type,
	handle
FROM
	/*:cms.prefix:*/types
WHERE
	handle = :handle;
