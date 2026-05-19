DELETE FROM /*:cms.prefix:*/url_paths
WHERE
	path = :path
	AND inactive IS NOT NULL;