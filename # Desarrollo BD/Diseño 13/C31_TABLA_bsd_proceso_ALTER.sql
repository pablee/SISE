ALTER TABLE `sise_legal`.`bsd_proceso` 
ADD COLUMN `usr_creacion` INT(3) UNSIGNED NULL COMMENT 'usuario de creaci�n del proceso' AFTER `ultimas_novedades`,
ADD COLUMN `usr_cooperacion` INT(3) UNSIGNED NULL COMMENT 'usuario de cooperaci�n del proceso' AFTER `usr_creacion`;
