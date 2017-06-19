/*INSERTAR PERSONAS*/
INSERT INTO `sise_legal`.`bsd_persona` (`nombres`, `apellidos`, `cod_tipo_dni`, `dni`, `cuil`, `fec_nacimiento`, `sexo`, `cod_nacionalidad`, `cod_estado_civil`, `telefono`, `codigo_postal`, `profesion`, `cod_categoria`, `usr_ult_modif`) 
-- ERROR de valores DNI, CUIL, telefono, 
-- VALUES ('Maria Beatriz', 'Rodriguez', '4', '20.477.810', '20-20.477.810-3', '1900-01-01', 'f', '2', '2', '2222-2222', '1234', '-', '1', '1');
VALUES ('Maria Beatriz', 'Rodriguez', '4', '20477810', '20204778103', '1900-01-01', 'f', '2', '2', '22222222', '1234', '-', '1', '1');

INSERT INTO `sise_legal`.`bsd_persona` (`nombres`, `apellidos`, `cod_tipo_dni`, `dni`, `cuil`, `fec_nacimiento`, `sexo`, `cod_nacionalidad`, `cod_estado_civil`, `telefono`, `codigo_postal`, `profesion`, `cod_categoria`, `usr_ult_modif`) 
-- ERROR de valores DNI, CUIL, telefono, 
-- VALUES ('Joaquin Ramon', 'Solanes', '4', '11.111.111', '20-11.111.111-3', '1900-01-01', 'm', '2', '2', '2222-2222', '4321', '-', '1', '1');
VALUES ('Joaquin Ramon', 'Solanes', '4', '11111111', '20111111113', '1900-01-01', 'm', '2', '2', '22222222', '4321', '-', '1', '1');


/*INSERTAR PROCESOS*/
INSERT INTO `sise_legal`.`bsd_proceso` (`proceso`, `cod_proceso_tipo`, `observaciones`, `usr_ult_modif`) 
VALUES ('Rodriguez VS. Solanes', '2', 'Ejemplo del cliente', '1');


/*INSERTAR RELACIÓN ENTRE PERSONA Y PROCESO, PARA DEFINIR SU CONDICION*/
INSERT INTO `sise_legal`.`rel_pers_cond_proc`(`cod_proceso`,`cod_persona`,`cod_persona_condicion`,`orden`,`observaciones`,`usr_ult_modif`)
VALUES((SELECT cod_proceso_tipo FROM sise_legal.bsd_proceso WHERE proceso like 'Rodriguez VS. Solanes'),(SELECT cod_persona FROM bsd_persona WHERE apellidos LIKE 'Rodriguez' AND nombres LIKE 'Maria Beatriz'),2,1,'Observaciones Internas',1);

INSERT INTO `sise_legal`.`rel_pers_cond_proc`(`cod_proceso`,`cod_persona`,`cod_persona_condicion`,`orden`,`observaciones`,`usr_ult_modif`)
VALUES((SELECT cod_proceso_tipo FROM sise_legal.bsd_proceso WHERE proceso like 'Rodriguez VS. Solanes'),(SELECT cod_persona FROM bsd_persona WHERE apellidos LIKE 'Solanes' AND nombres LIKE 'Joaquin Ramon'),3,2,'Observaciones Internas',1);


/*SE INSERTA EL DETALLE PARA CADA PERSONA EN EL PROCESO SEGUN SU CONDICION*/
INSERT INTO `sise_legal`.`bsd_detalle`(`cod_persona`,`cod_proceso`,`cod_detalle_tipo`,`valor`,`observaciones`)
SELECT 	(	SELECT cod_persona 
			FROM bsd_persona 
			WHERE apellidos LIKE 'Rodriguez' AND nombres LIKE 'Maria Beatriz') AS COD_PER
		, (	SELECT cod_proceso 
			FROM bsd_proceso 
			WHERE proceso like 'Rodriguez VS. Solanes') AS COD_PRO
        , REL.COD_DETALLE_TIPO
		, 'VALOR'
        , DET.DETALLE_TIPO
FROM 	  rel_pers_cond_proc_tipo_deta_tipo AS REL
		, ref_detalle_tipo AS DET
        , ref_proceso_tipo AS PRO
WHERE REL.COD_PROCESO_TIPO = PRO.COD_PROCESO_TIPO
  AND REL.COD_DETALLE_TIPO = DET.COD_DETALLE_TIPO
  AND REL.COD_PROCESO_TIPO = (	SELECT cod_proceso_tipo 
								FROM bsd_proceso 
                                WHERE proceso like 'Rodriguez VS. Solanes')
  AND REL.COD_PERSONA_CONDICION = (	SELECT cod_persona_condicion FROM rel_pers_cond_proc 
									WHERE cod_persona = (	SELECT cod_persona 
															FROM bsd_persona 
															WHERE apellidos LIKE 'Rodriguez' AND nombres LIKE 'Maria Beatriz')
									  AND cod_proceso = (	SELECT cod_proceso_tipo 
															FROM bsd_proceso 
															WHERE proceso like 'Rodriguez VS. Solanes'))
;
INSERT INTO `sise_legal`.`bsd_detalle`(`cod_persona`,`cod_proceso`,`cod_detalle_tipo`,`valor`,`observaciones`)
SELECT 	(	SELECT cod_persona 
			FROM bsd_persona 
			WHERE apellidos LIKE 'Solanes' AND nombres LIKE 'Joaquin Ramon') AS COD_PER
		, (	SELECT cod_proceso 
			FROM bsd_proceso 
			WHERE proceso like 'Rodriguez VS. Solanes') AS COD_PRO
        , REL.COD_DETALLE_TIPO
		, 'VALOR'
        , DET.DETALLE_TIPO
FROM 	  rel_pers_cond_proc_tipo_deta_tipo AS REL
		, ref_detalle_tipo AS DET
        , ref_proceso_tipo AS PRO
WHERE REL.COD_PROCESO_TIPO = PRO.COD_PROCESO_TIPO
  AND REL.COD_DETALLE_TIPO = DET.COD_DETALLE_TIPO
  AND REL.COD_PROCESO_TIPO = (	SELECT cod_proceso_tipo 
								FROM bsd_proceso 
                                WHERE proceso like 'Rodriguez VS. Solanes')
  AND REL.COD_PERSONA_CONDICION = (	SELECT cod_persona_condicion FROM rel_pers_cond_proc 
									WHERE cod_persona = (	SELECT cod_persona 
															FROM bsd_persona 
															WHERE apellidos LIKE 'Solanes' AND nombres LIKE 'Joaquin Ramon')
									  AND cod_proceso = (	SELECT cod_proceso_tipo 
															FROM bsd_proceso 
															WHERE proceso like 'Rodriguez VS. Solanes'))
;