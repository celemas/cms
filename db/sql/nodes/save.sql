INSERT INTO /*:cms.prefix:*/nodes (
	uid,
	parent,
	type,
	published,
	locked,
	hidden,
	editor,
	creator,
	content
)
SELECT
	:uid,
	:parent,
	type,
	:published,
	:locked,
	:hidden,
	:editor,
	:editor,
	:content
FROM
	/*:cms.prefix:*/types t
WHERE
	t.handle = :type

ON CONFLICT (uid) DO

UPDATE SET
	parent = :parent,
	published = :published,
	locked = :locked,
	hidden = :hidden,
	editor = :editor,
	content = :content
WHERE
	/*:cms.prefix:*/nodes.uid = :uid

RETURNING node;
