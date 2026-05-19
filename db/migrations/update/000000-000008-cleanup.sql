DROP TRIGGER IF EXISTS nodes_trigger_01_delete ON cms.nodes;
DROP FUNCTION IF EXISTS cms.check_if_deletable();

ALTER TABLE cms.users DROP CONSTRAINT IF EXISTS ck_users_username_or_email;
ALTER TABLE cms.users ADD CONSTRAINT ck_users_username_or_email CHECK (
	deleted IS NOT NULL OR username IS NOT NULL OR email IS NOT NULL
);

ALTER TABLE cms.users DROP CONSTRAINT IF EXISTS ck_users_email;
ALTER TABLE cms.users ADD CONSTRAINT ck_users_email CHECK (
	email IS NULL OR (
		char_length(email) <= 254
		AND email !~ '[[:space:]]'
		AND email NOT LIKE '%..%'
		AND email NOT LIKE '%.@%'
		AND email NOT LIKE '%@.%'
		AND email ~ '^[^@]+@[^@]+[.][^@]+$'
	)
);

ALTER TABLE cms.nodes DROP CONSTRAINT IF EXISTS ck_nodes_uid;
ALTER TABLE cms.nodes ADD CONSTRAINT ck_nodes_uid CHECK (
	uid ~ '^(?!.*[.][.])[A-Za-z0-9](?:[A-Za-z0-9._-]{0,62}[A-Za-z0-9])?$'
);

ALTER TABLE cms.nodes ADD COLUMN version integer NOT NULL DEFAULT 1;
ALTER TABLE cms.nodes ADD CONSTRAINT ck_nodes_version CHECK (version > 0);

ALTER TABLE audit.nodes ADD COLUMN version integer;
UPDATE audit.nodes SET version = 1;
ALTER TABLE audit.nodes ALTER COLUMN version SET NOT NULL;

CREATE OR REPLACE FUNCTION cms.process_nodes_audit()
	RETURNS TRIGGER AS $$
BEGIN
	INSERT INTO audit.nodes (
		node, parent, version, changed, published, hidden, locked,
		type, editor, deleted, content
	) VALUES (
		OLD.node, OLD.parent, OLD.version, OLD.changed, OLD.published, OLD.hidden, OLD.locked,
		OLD.type, OLD.editor, OLD.deleted, OLD.content
	);

	RETURN OLD;
EXCEPTION WHEN unique_violation THEN
	RAISE WARNING 'Duplicate nodes audit row skipped. node: %, changed: %', OLD.node, OLD.changed;
	RETURN NULL;
END;
$$ LANGUAGE plpgsql;

DROP INDEX IF EXISTS cms.ix_nodes_content;
CREATE INDEX ix_nodes_type ON cms.nodes USING btree (type);
CREATE INDEX ix_nodes_content ON cms.nodes USING GIN (content);
