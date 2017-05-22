SELECT 	CONCAT("INSERT INTO `sise_legal`.`rel_pers_cond_proc_tipo_deta_tipo` (`cod_persona_condicion`, `cod_proceso_tipo`, `cod_detalle_tipo`, `orden`, `observaciones`, `usr_ult_modif`, `fec_ult_modif`) VALUES "
		, "("
        , "'", C.COD_PERSONA_CONDICION, "', "
		, "'", B.COD_PROCESO_TIPO, "', "
		, "'", A.COD_DETALLE_TIPO, "', "
		, "'", A.COD_DETALLE_TIPO, "0', "
        , "'", B.PROCESO_TIPO, " - ", C.PERSONA_CONDICION, " - ", A.DETALLE_TIPO, "', "
        , "'", "1", "', " /*ADMIN*/
        , "SYSDATE()"
        , ");")
FROM 	ref_detalle_tipo AS A
		, ref_proceso_tipo AS B
        , ref_persona_condicion AS C
WHERE A.COD_DETALLE_TIPO > 1
  AND B.COD_PROCESO_TIPO > 1
  AND C.COD_PERSONA_CONDICION > 1
ORDER BY 	B.COD_PROCESO_TIPO
			,C.COD_PERSONA_CONDICION
            , A.COD_DETALLE_TIPO
            
