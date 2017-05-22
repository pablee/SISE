USE `sise_legal`;
CREATE TABLE IF NOT EXISTS `bsd_vehiculo` 
(
	`cod_vehiculo` INT(11) UNSIGNED NOT NULL COMMENT 'Clave primaria',
	`vehiculo` VARCHAR(200) NOT NULL COMMENT 'Descripción referencial del vehiculo',
	-- `cod_marca` INT(11) UNSIGNED DEFAULT NULL COMMENT 'marca del vehiculo conformado', -- NO ES NECESARIO YA QUE POR MODELO SE PUEDE DEDUCIR
	`cod_modelo` INT(11) UNSIGNED DEFAULT NULL COMMENT 'modelo del vehiculo conformado',
	`observaciones` TEXT DEFAULT NULL COMMENT 'observaciones de texto libre de 65.635',
	`usr_ult_modif` INT(3) unsigned DEFAULT NULL COMMENT 'usuario de ultima modificacion',
	`fec_ult_modif` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'fecha de ultima modificacion',
	PRIMARY KEY (`cod_vehiculo`),
-- 	UNIQUE KEY (`vehiculo`),
-- 	KEY `cod_marca` (`cod_marca`),
-- 	CONSTRAINT `bsd_vehiculo_cod_marca_FK` FOREIGN KEY (`cod_marca`) REFERENCES `ref_vehiculo_marca`(`cod_marca`),
	KEY `cod_modelo` (`cod_modelo`),
	CONSTRAINT `bsd_vehiculo_cod_modelo_FK` FOREIGN KEY (`cod_modelo`) REFERENCES `ref_vehiculo_modelo`(`cod_modelo`),
	KEY `usr_ult_modif` (`usr_ult_modif`),
	CONSTRAINT `bsd_vehiculo_usr_ult_modif_FK` FOREIGN KEY (`usr_ult_modif`) REFERENCES `bsd_usuario`(`cod_usuario`)
) 
ENGINE=InnoDB 
DEFAULT CHARSET=latin1 
COLLATE=latin1_spanish_ci 
COMMENT='tabla de vehiculos disponibles a utilizar';