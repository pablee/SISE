USE sise_legal;
CREATE TABLE IF NOT EXISTS `ref_detalle_tipo` 
(
	`cod_detalle_tipo` INT(3) UNSIGNED AUTO_INCREMENT COMMENT 'Clave primaria',
	`detalle_tipo` VARCHAR(100) NOT NULL COMMENT 'descripción de referencia',
	`descripcion` VARCHAR(1000) NULL COMMENT 'descripción completa del detalle',
	`cod_tipo_dato` INT(3) UNSIGNED NOT NULL COMMENT 'Clave Foranea',
	`observaciones` TEXT DEFAULT NULL COMMENT 'observaciones de texto libre de 65.635',
	`usr_ult_modif` INT(3) UNSIGNED NULL DEFAULT NULL COMMENT 'codigo del usuario de ultima modificacion',
	`fec_ult_modif` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'fecha de ultima modificacion',
	PRIMARY KEY (`cod_detalle_tipo`),
	UNIQUE KEY `detalle_tipo` (`detalle_tipo`),
    KEY `cod_tipo_dato` (`cod_tipo_dato`),
	CONSTRAINT `ref_detalle_tipo_cod_tipo_dato_FK` FOREIGN KEY (`cod_tipo_dato`) REFERENCES `ref_tipo_dato`(`cod_tipo_dato`),
    KEY `usr_ult_modif` (`usr_ult_modif`),
	CONSTRAINT `ref_detalle_tipo_usr_ult_modif_FK` FOREIGN KEY (`usr_ult_modif`) REFERENCES `bsd_usuario`(`cod_usuario`)
)
ENGINE = InnoDB
-- DEFAULT CHARACTER SET = latin1
-- COLLATE = latin1_spanish_ci
COMMENT = 'Tabla auxiliar de referencia para tipos de detalle a registrar';