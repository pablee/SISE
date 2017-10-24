ALTER TABLE `sise_legal`.`bsd_proceso` 
ADD COLUMN `usr_creacion` INT(3) UNSIGNED NULL COMMENT 'usuario de creación del proceso' AFTER `ultimas_novedades`,
ADD COLUMN `usr_cooperacion` INT(3) UNSIGNED NULL COMMENT 'usuario de cooperación del proceso' AFTER `usr_creacion`;
