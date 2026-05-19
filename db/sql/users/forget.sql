DELETE FROM /*:cms.prefix:*/login_sessions
WHERE hash = :hash;