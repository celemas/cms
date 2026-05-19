UPDATE
	/*:cms.prefix:*/nodes
SET
	deleted = now()
WHERE
	uid = :uid;

UPDATE
	/*:cms.prefix:*/url_paths
SET
	inactive = now(),
	editor = :editor
WHERE node IN (
	SELECT n.node FROM /*:cms.prefix:*/nodes n WHERE n.uid = :uid
);