ALTER TABLE `contribution` ADD `stamp` INT NOT NULL COMMENT 'ETAG, Versionierung' ;
ALTER TABLE `entry` ADD `stamp` INT NOT NULL COMMENT 'ETAG, Versionierung' ;
ALTER TABLE `event` ADD `stamp` INT NOT NULL COMMENT 'ETAG, Versionierung' ;
ALTER TABLE `user` ADD `stamp` INT NOT NULL COMMENT 'ETAG, Versionierung' ;