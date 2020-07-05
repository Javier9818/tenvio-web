USE delivery;
-- SET GLOBAL event_scheduler = ON;
-- SHOW PROCESSLIST;
DROP EVENT IF EXISTS verifica_vigencia_contrato;
CREATE EVENT verifica_vigencia_contrato
ON SCHEDULE EVERY 1 HOUR STARTS NOW()
DO UPDATE CONTRATOS SET ESTADO = 'VENCIDO' WHERE estado = 'VIGENTE' and fecha_vencimiento < NOW();

-- los contratos acaban en un día en específico
