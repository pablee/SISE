SELECT 	CONCAT( "INSERT INTO `sise_legal`.`rel_proc_tipo_deta_tipo` (`cod_proceso_tipo`, `cod_detalle_tipo`, `orden`, `observaciones`, `usr_ult_modif`, `fec_ult_modif`) VALUES "
		,"("
        , "'",B.COD_PROCESO_TIPO,"', "
		, "'", A.COD_DETALLE_TIPO, "', "
		, "'", A.COD_DETALLE_TIPO, "0', "
        , "'", B.PROCESO_TIPO, " - ", A.DETALLE_TIPO, "', "
        , "'", "1", "', " /*Admin*/
        , "SYSDATE()"
        , ");")
FROM 	ref_detalle_tipo AS A
		, ref_proceso_tipo AS B
WHERE A.COD_DETALLE_TIPO > 1
  AND B.COD_PROCESO_TIPO > 1
ORDER BY 	B.COD_PROCESO_TIPO
			, A.COD_DETALLE_TIPO
