SELECT
	up.path,
	up.locale
FROM
	/*:cms.prefix:*/url_paths up
WHERE
	up.node = :node
	AND up.inactive IS NULL;