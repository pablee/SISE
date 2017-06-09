USE sise_legal;
CREATE TABLE IF NOT EXISTS `ref_nacionalidad` 
(
	`cod_nacionalidad` INT(3) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Clave primaria',
	`nacionalidad` VARCHAR(100) NOT NULL COMMENT 'Descripción de referencia',
	`observaciones` TEXT DEFAULT NULL COMMENT 'observaciones de texto libre de 65.635',
	`usr_ult_modif` INT(3) UNSIGNED DEFAULT NULL COMMENT 'usuario de ultima modificacion',
	`fec_ult_modif` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'fecha de ultima modificacion',
	PRIMARY KEY (`cod_nacionalidad`),
	UNIQUE KEY `nacionalidad` (`nacionalidad`),
	KEY `usr_ult_modif` (`usr_ult_modif`), 
	CONSTRAINT `ref_nacionalidad_usr_ult_modif_FK` FOREIGN KEY (`usr_ult_modif`) REFERENCES `bsd_usuario`(`cod_usuario`)
) 
ENGINE = InnoDB
-- DEFAULT CHARACTER SET = latin1
-- COLLATE = latin1_spanish_ci
COMMENT='Tabla auxiliar de nacionalidades';