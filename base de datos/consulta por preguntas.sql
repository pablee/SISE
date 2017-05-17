
SELECT ref_detalle_tipo.detalle_tipo, ref_detalle_tipo.cod_tipo_dato, ref_tipo_dato.tipo_dato 
FROM `rel_pers_cond_proc_tipo_deta_tipo`, `ref_detalle_tipo`, ref_tipo_dato 
WHERE ref_detalle_tipo.cod_detalle_tipo = rel_pers_cond_proc_tipo_deta_tipo.cod_detalle_tipo 
AND ref_tipo_dato.cod_tipo_dato = ref_detalle_tipo.cod_tipo_dato 
AND `cod_proceso_tipo` =3 
AND (`cod_persona_condicion` = 2 or `cod_persona_condicion` = 3);


