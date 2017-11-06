USE sise_legal;
CREATE TABLE IF NOT EXISTS `bsd_proceso` 
(
	`cod_proceso` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Clave primaria',
	`proceso` VARCHAR(100) DEFAULT NULL COMMENT 'descripcion opcional del proceso',
	`cod_proceso_tipo` INT(3) UNSIGNED DEFAULT NULL COMMENT 'tipo de proceso usado para saber que documentos de la documentacion pedir',
	`usr_creacion` int(3) UNSIGNED DEFAULT NULL COMMENT 'usuario de creación del proceso',
	`usr_cooperacion` int(3) UNSIGNED DEFAULT NULL COMMENT 'usuario de cooperación del proceso',
	`observaciones` TEXT DEFAULT NULL COMMENT 'observaciones de texto libre de 65.635',
	`ultimas_novedades` TEXT DEFAULT NULL COMMENT 'últimas novedades de texto libre de 65.635',
	`usr_ult_modif` int(3) UNSIGNED DEFAULT NULL COMMENT 'usuario de ultima modificacion',
	`fec_ult_modif` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'fecha de ultima modificacion',
	PRIMARY KEY (`cod_proceso`),
	KEY `cod_proceso_tipo` (`cod_proceso_tipo`),
	CONSTRAINT `bsd_proceso_cod_proceso_tipo_FK` FOREIGN KEY (`cod_proceso_tipo`) REFERENCES `ref_proceso_tipo`(`cod_proceso_tipo`),
	KEY `usr_ult_modif_KEY` (`usr_ult_modif`),
	CONSTRAINT `bsd_proceso_usr_ult_modif_FK` FOREIGN KEY (`usr_ult_modif`) REFERENCES `bsd_usuario`(`cod_usuario`),
	KEY `usr_creacion_KEY` (`usr_creacion`),
	CONSTRAINT `bsd_proceso_usr_creacion_FK` FOREIGN KEY (`usr_creacion`) REFERENCES `bsd_usuario`(`cod_usuario`),
	KEY `usr_cooperacion_KEY` (`usr_cooperacion`),
	CONSTRAINT `bsd_proceso_usr_cooperacion_FK` FOREIGN KEY (`usr_cooperacion`) REFERENCES `bsd_usuario`(`cod_usuario`)
) 
ENGINE=InnoDB 
-- DEFAULT CHARSET=latin1 
-- COLLATE=latin1_spanish_ci 
COMMENT='tabla de procesos';
