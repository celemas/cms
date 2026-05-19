UPDATE /*:cms.prefix:*/url_paths
SET
	inactive = now(),
	editor = :editor
WHERE
	path = :path
	AND locale = :locale;
