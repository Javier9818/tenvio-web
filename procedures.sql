USE delivery;
-- SET GLOBAL event_scheduler = ON;
-- SHOW PROCESSLIST;
DROP EVENT IF EXISTS verifica_vigencia_contrato;
CREATE EVENT verifica_vigencia_contrato
ON SCHEDULE EVERY 1 SECOND STARTS NOW()
DO UPDATE CONTRATOS SET ESTADO = 'Vencido' WHERE estado = 'Vigente' and fecha_vencimiento < NOW();