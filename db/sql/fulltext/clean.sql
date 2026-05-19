DELETE FROM /*:cms.prefix:*/full_text ft
WHERE
	ft.node NOT IN (
		SELECT
			n.node
		FROM
			/*:cms.prefix:*/nodes n
		WHERE
			n.deleted IS NULL
			AND n.published = true
	);