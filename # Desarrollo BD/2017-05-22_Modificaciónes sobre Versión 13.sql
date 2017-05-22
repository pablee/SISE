ALTER TABLE `sise_legal`.`bsd_detalle` 
DROP FOREIGN KEY `bsd_detalle_cod_detalle_tipo_FK`;
ALTER TABLE `sise_legal`.`bsd_detalle` 
CHANGE COLUMN `cod_detalle` `cod_detalle` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Clave primaria' ,
CHANGE COLUMN `cod_detalle_tipo` `cod_detalle_tipo` INT(3) UNSIGNED NOT NULL COMMENT 'Clave foranea' ;
ALTER TABLE `sise_legal`.`bsd_detalle` 
ADD CONSTRAINT `bsd_detalle_cod_detalle_tipo_FK`
  FOREIGN KEY (`cod_detalle_tipo`)
  REFERENCES `sise_legal`.`ref_detalle_tipo` (`cod_detalle_tipo`);

  ALTER TABLE `sise_legal`.`bsd_proceso` 
DROP COLUMN `cantidad_acompaniantes`;
