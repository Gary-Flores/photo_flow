
--  ******************** ******************** ******************** ******************** ******************** --
--                       T A B L E  - - - >   PF_PROFILE                                                     --
--  ******************** ******************** ******************** ******************** ******************** --

DROP TABLE pf_profile;
CREATE TABLE pf_profile (
	id_profile INT(8) AUTO_INCREMENT PRIMARY KEY,
	name VARCHAR(60) NOT NULL,
	alias VARCHAR(60) NOT NULL,
	description VARCHAR(255) NOT NULL,
	status SMALLINT(2) NOT NULL DEFAULT 1
);
ALTER TABLE pf_profile AUTO_INCREMENT = 1;
DELETE FROM pf_profile WHERE id_profile > 0;
INSERT INTO pf_profile (name, alias, description) VALUES ('Registro', '-','Usuario en proceso de registro sin perfil asignado');
INSERT INTO pf_profile (name, alias, description) VALUES ('Administrador', '-','Rol con todos los permisos para la supervición completa del sistema');
INSERT INTO pf_profile (name, alias, description) VALUES ('Cliente', '-', 'Persona que se interesa por el servicio fotografico');
INSERT INTO pf_profile (name, alias, description) VALUES ('Fotografo', '-', 'Fotografo de primer nivel');
INSERT INTO pf_profile (name, alias, description) VALUES ('Diseñador', '-', 'Encargado de la post-edición de los eventos');
INSERT INTO pf_profile (name, alias, description) VALUES ('Ventas', '-', 'Persona encargada de las ventas');
SELECT * FROM pf_profile;


--  ******************** ******************** ******************** ******************** ******************** --
--                       T A B L E  - - - >   PF_LOGIN_USER                                                  --
--  ******************** ******************** ******************** ******************** ******************** --

DROP TABLE pf_login_user;
CREATE TABLE pf_login_user (
    id_user INT(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    id_profile INT(8) NOT NULL DEFAULT 1,
    access VARCHAR(20) NOT NULL,
    password VARCHAR(250) NOT NULL,
    name VARCHAR(80) NOT NULL,
    default_lang VARCHAR(5) NOT NULL DEFAULT '_en',
    status SMALLINT(2) NOT NULL DEFAULT 1
);
ALTER TABLE pf_login_user ADD CONSTRAINT fk_login_user_id_profile FOREIGN KEY (id_profile) REFERENCES pf_profile (id_profile);
ALTER TABLE pf_login_user AUTO_INCREMENT = 1;
DELETE FROM pf_login_user WHERE id_user > 0;
INSERT INTO pf_login_user(access, password, name) VALUES('admin', 'admin', 'ADMINISTRADOR');
INSERT INTO pf_login_user(access, password, name) VALUES('cesar', 'flores', 'CESAR A FLORES');
INSERT INTO pf_login_user(access, password, name) VALUES('jazmin', 'perez', 'JAZMIN PEREZ');
INSERT INTO pf_login_user(access, password, name) VALUES('alex', 'flores', 'ALEJANDRO FLORES');
INSERT INTO pf_login_user(access, password, name) VALUES('roberto', 'canuto', 'ROBERTO CANUTO');
INSERT INTO pf_login_user(access, password, name) VALUES('ivan', 'rubio', 'IVAN RUBIO FLORES');
UPDATE pf_login_user SET default_lang = '_es' WHERE id_user = 5;
UPDATE pf_login_user SET id_profile = 2 WHERE id_user = 6;
SELECT * FROM pf_login_user;


--  ******************** ******************** ******************** ******************** ******************** --
--                       T A B L E  - - - >   PF_PHASE                                                       --
--  ******************** ******************** ******************** ******************** ******************** --

DROP TABLE pf_phase;
CREATE TABLE pf_phase (
	id_phase INT(8) AUTO_INCREMENT PRIMARY KEY,
	name VARCHAR(60) NOT NULL,
	description VARCHAR(255) NOT NULL,
	status SMALLINT(2) NOT NULL DEFAULT 1
);
ALTER TABLE pf_phase AUTO_INCREMENT = 1;
DELETE FROM pf_phase WHERE id_phase > 0;
-- Solicitudes
INSERT INTO pf_phase (name, description) VALUES ('Solicitud de Información x Página', 'Se genera una solicitud de información vía forma de contacto en la Página Web');
INSERT INTO pf_phase (name, description) VALUES ('Solicitud de Información x Blog', 'Se genera una solicitud de información vía forma de contacto en el Blog');
INSERT INTO pf_phase (name, description) VALUES ('Solicitud de Información x Teléfono', 'Se recibe la llamada de un cliente, se tomana sus datos y se registra');
-- Envío de Información paquete/cita
INSERT INTO pf_phase (name, description) VALUES ('Envío de Información al Cliente', 'Se envía la información solicitada al cliente mediante correo electrónico');
INSERT INTO pf_phase (name, description) VALUES ('Concretar Cita', 'Se concreta la cita cliente-proveedor');
-- Solicitud Complemento información/cita
INSERT INTO pf_phase (name, description) VALUES ('Solicitud de Información complementaria por el Cliente', 'El cliente solicita información complementaria para negociación del paquete');
INSERT INTO pf_phase (name, description) VALUES ('Solicitud de Cita por el Cliente', 'El cliente solicita una cita con el proveedor');
-- Envío de Contrato
INSERT INTO pf_phase (name, description) VALUES ('Envío de Contrato', 'Se envian los datos del contrato al cliente para revisión');
-- Contratos firmados
INSERT INTO pf_phase (name, description) VALUES ('Firma de Contrato', 'El cliente confirma el contrato e inicia el proceso de pago');
INSERT INTO pf_phase (name, description) VALUES ('Registro de Evento', 'Se realiza el registro del evento en el sistema');
INSERT INTO pf_phase (name, description) VALUES ('Registrar Abono', 'Se registra el depósito del cliente');
-- Envío de recordatorios
INSERT INTO pf_phase (name, description) VALUES ('Envío de Itinerario', 'Se envia el itinerario al cliente para la cobertura del evento');
INSERT INTO pf_phase (name, description) VALUES ('Envío de recordatorios', 'El sistema genera los recordatorios para el evento, tanto para cliente como para el proveedor');
-- Ejecución de evento
INSERT INTO pf_phase (name, description) VALUES ('Atender evento', 'Se atiende la cobertura del evento');
INSERT INTO pf_phase (name, description) VALUES ('Registro evento completado', 'Registro de evento completado');
-- Post Procesado del evento
INSERT INTO pf_phase (name, description) VALUES ('Selección y retoque de fotografías', 'Se realiza toda la parte de post-procesado: selección, retoque, diseño de books, etc...');
INSERT INTO pf_phase (name, description) VALUES ('Envío de galerias', 'Se envia la galería completa del evento al cliente');
INSERT INTO pf_phase (name, description) VALUES ('Confirmar Galerías Recibidas', 'El cliente confirma las galerías recibidas y en al caso de book su vobo para impresión');
INSERT INTO pf_phase (name, description) VALUES ('Impresión de entregables', 'Se mandan a imprimir los entregables');
INSERT INTO pf_phase (name, description) VALUES ('Entrega/Envío de impresiones, book, dvd, etc...', 'Se entrega o se envia el producto final al cliente');
INSERT INTO pf_phase (name, description) VALUES ('Cerrar contrato', 'Se entrega o se envia el producto final al cliente');
SELECT * FROM pf_phase;


--  ******************** ******************** ******************** ******************** ******************** --
--                       T A B L E  - - - >   PF_group_phase                                                  --
--  ******************** ******************** ******************** ******************** ******************** --

DROP TABLE pf_group_phase;
CREATE TABLE pf_group_phase (
	id_group_phase INT(8) AUTO_INCREMENT PRIMARY KEY,
	label VARCHAR(60) NOT NULL,
	level SMALLINT(2) NOT NULL DEFAULT 1,
	id_phase INT(8),
	id_group_parent INT(8),
	status SMALLINT(2) NOT NULL DEFAULT 1
);
CREATE INDEX idx_group_parent ON pf_group_phase(id_group_parent);
CREATE INDEX idx_group_phase ON pf_group_phase(id_phase);
ALTER TABLE pf_group_phase ADD CONSTRAINT fk_group_phase_id_phase FOREIGN KEY (id_phase) REFERENCES pf_phase (id_phase);
ALTER TABLE pf_group_phase AUTO_INCREMENT = 1;
DELETE FROM pf_group_phase WHERE id_group_phase > 0;
INSERT INTO pf_group_phase (id_group_phase, label, level, id_phase, id_group_parent) VALUES (1, 'Solicitudes', 1, null, null);
INSERT INTO pf_group_phase (id_group_phase, label, level, id_phase, id_group_parent) VALUES (2, '', 2, 1, 1);
INSERT INTO pf_group_phase (id_group_phase, label, level, id_phase, id_group_parent) VALUES (3, '', 2, 2, 1);
INSERT INTO pf_group_phase (id_group_phase, label, level, id_phase, id_group_parent) VALUES (4, '', 2, 3, 1);
INSERT INTO pf_group_phase (id_group_phase, label, level, id_phase, id_group_parent) VALUES (5, 'Envío de Información paquete/cita', 1, null, null);
INSERT INTO pf_group_phase (id_group_phase, label, level, id_phase, id_group_parent) VALUES (6, '', 2, 4, 5);
INSERT INTO pf_group_phase (id_group_phase, label, level, id_phase, id_group_parent) VALUES (7, '', 2, 5, 5);
INSERT INTO pf_group_phase (id_group_phase, label, level, id_phase, id_group_parent) VALUES (8, 'Solicitud Complemento información/cita', 1, null, null);
INSERT INTO pf_group_phase (id_group_phase, label, level, id_phase, id_group_parent) VALUES (9, '', 2, 6, 8);
INSERT INTO pf_group_phase (id_group_phase, label, level, id_phase, id_group_parent) VALUES (10, '', 2, 7, 8);
INSERT INTO pf_group_phase (id_group_phase, label, level, id_phase, id_group_parent) VALUES (11, 'Envío de Contrato', 1, null, null);
INSERT INTO pf_group_phase (id_group_phase, label, level, id_phase, id_group_parent) VALUES (12, '', 2, 8, 11);
INSERT INTO pf_group_phase (id_group_phase, label, level, id_phase, id_group_parent) VALUES (13, 'Contratos firmados', 1, null, null);
INSERT INTO pf_group_phase (id_group_phase, label, level, id_phase, id_group_parent) VALUES (14, '', 2, 9, 13);
INSERT INTO pf_group_phase (id_group_phase, label, level, id_phase, id_group_parent) VALUES (15, '', 2, 10, 13);
INSERT INTO pf_group_phase (id_group_phase, label, level, id_phase, id_group_parent) VALUES (16, '', 2, 11, 13);
INSERT INTO pf_group_phase (id_group_phase, label, level, id_phase, id_group_parent) VALUES (17, 'Envío de recordatorios', 1, null, null);
INSERT INTO pf_group_phase (id_group_phase, label, level, id_phase, id_group_parent) VALUES (18, '', 2, 12, 17);
INSERT INTO pf_group_phase (id_group_phase, label, level, id_phase, id_group_parent) VALUES (19, '', 2, 13, 17);
INSERT INTO pf_group_phase (id_group_phase, label, level, id_phase, id_group_parent) VALUES (20, 'Ejecución de evento', 1, null, null);
INSERT INTO pf_group_phase (id_group_phase, label, level, id_phase, id_group_parent) VALUES (21, '', 2, 14, 20);
INSERT INTO pf_group_phase (id_group_phase, label, level, id_phase, id_group_parent) VALUES (22, '', 2, 15, 20);
INSERT INTO pf_group_phase (id_group_phase, label, level, id_phase, id_group_parent) VALUES (23, 'Post Procesado del evento', 1, null, null);
INSERT INTO pf_group_phase (id_group_phase, label, level, id_phase, id_group_parent) VALUES (24, '', 2, 16, 23);
INSERT INTO pf_group_phase (id_group_phase, label, level, id_phase, id_group_parent) VALUES (25, '', 2, 17, 23);
INSERT INTO pf_group_phase (id_group_phase, label, level, id_phase, id_group_parent) VALUES (26, '', 2, 18, 23);
INSERT INTO pf_group_phase (id_group_phase, label, level, id_phase, id_group_parent) VALUES (27, '', 2, 19, 23);
INSERT INTO pf_group_phase (id_group_phase, label, level, id_phase, id_group_parent) VALUES (28, '', 2, 20, 23);
INSERT INTO pf_group_phase (id_group_phase, label, level, id_phase, id_group_parent) VALUES (29, '', 2, 21, 23);
SELECT * FROM pf_group_phase;
-- Query to build the menu
  SELECT * FROM (SELECT id_group_phase, label FROM pf_group_phase WHERE id_group_parent IS NULL AND level = 1 AND status = 1) T_1
  INNER JOIN (SELECT grp.id_group_parent, grp.id_group_phase, pha.id_phase, pha.name FROM pf_group_phase grp, pf_phase pha
    WHERE grp.id_group_parent IS NOT NULL AND grp.level = 2 AND grp.status = 1 AND pha.id_phase = grp.id_phase) T_2
  ON T_1.id_group_phase = T_2.id_group_parent ORDER BY T_1.id_group_phase, T_2.id_phase;


--  ******************** ******************** ******************** ******************** ******************** --
--                       T A B L E  - - - >   PF_PROFILE_MENU                                                --
--  ******************** ******************** ******************** ******************** ******************** --

DROP TABLE pf_profile_grants;
CREATE TABLE pf_profile_grants (
	id_profile_grant INT(8) AUTO_INCREMENT PRIMARY KEY,
	id_profile INT(8) NOT NULL,
	id_group_phase INT(8) NOT NULL
);
ALTER TABLE pf_profile_grants ADD CONSTRAINT fk_profile_id_profile FOREIGN KEY (id_profile) REFERENCES pf_profile (id_profile);
ALTER TABLE pf_profile_grants ADD CONSTRAINT fk_profile_id_group_phase FOREIGN KEY (id_group_phase) REFERENCES pf_group_phase (id_group_phase);
ALTER TABLE pf_profile_grants AUTO_INCREMENT = 1;
DELETE FROM pf_profile_grants WHERE id_profile_grant > 0;
INSERT INTO pf_profile_grants (id_profile, id_group_phase) VALUES (2, 1);
INSERT INTO pf_profile_grants (id_profile, id_group_phase) VALUES (2, 5);
INSERT INTO pf_profile_grants (id_profile, id_group_phase) VALUES (2, 8);
INSERT INTO pf_profile_grants (id_profile, id_group_phase) VALUES (2, 11);
INSERT INTO pf_profile_grants (id_profile, id_group_phase) VALUES (2, 13);
INSERT INTO pf_profile_grants (id_profile, id_group_phase) VALUES (2, 17);
INSERT INTO pf_profile_grants (id_profile, id_group_phase) VALUES (2, 20);
INSERT INTO pf_profile_grants (id_profile, id_group_phase) VALUES (2, 23);
INSERT INTO pf_profile_grants (id_profile, id_group_phase) VALUES (3, 5);
INSERT INTO pf_profile_grants (id_profile, id_group_phase) VALUES (3, 8);
INSERT INTO pf_profile_grants (id_profile, id_group_phase) VALUES (3, 17);
INSERT INTO pf_profile_grants (id_profile, id_group_phase) VALUES (3, 20);
INSERT INTO pf_profile_grants (id_profile, id_group_phase) VALUES (3, 23);
INSERT INTO pf_profile_grants (id_profile, id_group_phase) VALUES (5, 13);
INSERT INTO pf_profile_grants (id_profile, id_group_phase) VALUES (5, 17);
INSERT INTO pf_profile_grants (id_profile, id_group_phase) VALUES (5, 20);
INSERT INTO pf_profile_grants (id_profile, id_group_phase) VALUES (5, 23);
INSERT INTO pf_profile_grants (id_profile, id_group_phase) VALUES (6, 1);
INSERT INTO pf_profile_grants (id_profile, id_group_phase) VALUES (6, 5);
INSERT INTO pf_profile_grants (id_profile, id_group_phase) VALUES (6, 8);
INSERT INTO pf_profile_grants (id_profile, id_group_phase) VALUES (6, 11);
INSERT INTO pf_profile_grants (id_profile, id_group_phase) VALUES (6, 13);
INSERT INTO pf_profile_grants (id_profile, id_group_phase) VALUES (6, 17);
INSERT INTO pf_profile_grants (id_profile, id_group_phase) VALUES (6, 20);
INSERT INTO pf_profile_grants (id_profile, id_group_phase) VALUES (6, 23);
SELECT * FROM pf_profile_grants;
-- Query to build the user menu
SELECT PG_2.* FROM pf_profile_grants PG_1, 
  (SELECT * FROM (SELECT id_group_phase, label FROM pf_group_phase WHERE id_group_parent IS NULL AND level = 1 AND status = 1) T_1
  INNER JOIN (SELECT grp.id_group_parent, pha.id_phase, pha.name FROM pf_group_phase grp, pf_phase pha
    WHERE grp.id_group_parent IS NOT NULL AND grp.level = 2 AND grp.status = 1 AND pha.id_phase = grp.id_phase) T_2
  ON T_1.id_group_phase = T_2.id_group_parent) PG_2 WHERE PG_1.id_group_phase = PG_2.id_group_phase AND PG_1.id_profile = 5
ORDER BY PG_2.id_group_phase, PG_2.id_phase;

--  ******************** ******************** ******************** ******************** ******************** --
--                       T A B L E  - - - >   PF_FLOW                                                        --
--  ******************** ******************** ******************** ******************** ******************** --

DROP TABLE pf_flow;
CREATE TABLE pf_flow (
	id_flow INT(8) AUTO_INCREMENT PRIMARY KEY,
	name VARCHAR(60) NOT NULL,
	description VARCHAR(255) NOT NULL,
    code VARCHAR(5) NOT NULL,
	status SMALLINT(2) NOT NULL DEFAULT 1
);
ALTER TABLE pf_flow AUTO_INCREMENT = 1;
DELETE FROM pf_flow WHERE id_flow > 0;
INSERT INTO pf_flow (name, code, description) VALUES ('Flow para Bodas', 'WEDD', 'Flujo de actividades para boda');
INSERT INTO pf_flow (name, code, description) VALUES ('Flow para Sesiones', 'SESS', 'Flujo de actividades para sesiones');
INSERT INTO pf_flow (name, code, description) VALUES ('Flow para Retratos', 'RETR', 'Flujo de actividades para sesiones de retratos');
SELECT * FROM pf_flow;


--  ******************** ******************** ******************** ******************** ******************** --
--                       T A B L E  - - - >   PF_FLOW_PHASE                                                  --
--  ******************** ******************** ******************** ******************** ******************** --

DROP TABLE pf_flow_phase;
CREATE TABLE pf_flow_phase (
	id_flow INT(8) NOT NULL,
    id_group_phase INT(8) NOT NULL,
    sequence INT(4) NOT NULL,
	status SMALLINT(2) NOT NULL DEFAULT 1
);
ALTER TABLE pf_flow_phase ADD CONSTRAINT fk_flow_phase_id_flow FOREIGN KEY (id_flow) REFERENCES pf_flow (id_flow);
ALTER TABLE pf_flow_phase ADD CONSTRAINT fk_flow_phase_group_phase FOREIGN KEY (id_group_phase) REFERENCES pf_group_phase (id_group_phase);
DELETE FROM pf_flow_phase WHERE id_flow > 0;
INSERT INTO pf_flow_phase (id_flow, id_group_phase, sequence) VALUES (1,1,1);
INSERT INTO pf_flow_phase (id_flow, id_group_phase, sequence) VALUES (1,5,2);
INSERT INTO pf_flow_phase (id_flow, id_group_phase, sequence) VALUES (1,8,3);
INSERT INTO pf_flow_phase (id_flow, id_group_phase, sequence) VALUES (1,11,4);
INSERT INTO pf_flow_phase (id_flow, id_group_phase, sequence) VALUES (1,13,5);
INSERT INTO pf_flow_phase (id_flow, id_group_phase, sequence) VALUES (1,17,6);
INSERT INTO pf_flow_phase (id_flow, id_group_phase, sequence) VALUES (1,20,7);
INSERT INTO pf_flow_phase (id_flow, id_group_phase, sequence) VALUES (1,23,8);
INSERT INTO pf_flow_phase (id_flow, id_group_phase, sequence) VALUES (2,1,1);
INSERT INTO pf_flow_phase (id_flow, id_group_phase, sequence) VALUES (2,5,2);
INSERT INTO pf_flow_phase (id_flow, id_group_phase, sequence) VALUES (2,8,3);
INSERT INTO pf_flow_phase (id_flow, id_group_phase, sequence) VALUES (2,11,4);
INSERT INTO pf_flow_phase (id_flow, id_group_phase, sequence) VALUES (2,13,5);
INSERT INTO pf_flow_phase (id_flow, id_group_phase, sequence) VALUES (2,20,6);
INSERT INTO pf_flow_phase (id_flow, id_group_phase, sequence) VALUES (2,23,7);
SELECT * FROM pf_flow_phase;
SELECT * FROM pf_flow_phase WHERE id_flow = 1 ORDER BY sequence;



--  ******************** ******************** ******************** ******************** ******************** --
--                       T A B L E  - - - >   PF_INSTANCE                                                    --
--  ******************** ******************** ******************** ******************** ******************** --

DROP TABLE pf_instance;
CREATE TABLE pf_instance (
	id_instance VARCHAR(15) PRIMARY KEY,
	id_flow INT(8) NOT NULL,
    id_phase INT(8) NOT NULL,
    id_user INT(10),
	t_create TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    t_update TIMESTAMP,
    t_finish TIMESTAMP,
	status SMALLINT(2) NOT NULL DEFAULT 1
);
ALTER TABLE pf_instance ADD CONSTRAINT fk_instance_id_flow FOREIGN KEY (id_flow) REFERENCES pf_flow_phase (id_flow);
ALTER TABLE pf_instance ADD CONSTRAINT fk_instance_id_phase FOREIGN KEY (id_phase) REFERENCES pf_group_phase (id_phase);
ALTER TABLE pf_instance AUTO_INCREMENT = 1;
DELETE FROM pf_instance WHERE id_instance <> '';
INSERT INTO pf_instance (id_instance, id_flow, id_phase) VALUES ('WEDD-150616-001', 1, 1);
INSERT INTO pf_instance (id_instance, id_flow, id_phase) VALUES ('WEDD-150616-002', 1, 1);
INSERT INTO pf_instance (id_instance, id_flow, id_phase) VALUES ('WEDD-150616-003', 1, 2);
INSERT INTO pf_instance (id_instance, id_flow, id_phase) VALUES ('WEDD-150616-004', 1, 2);
INSERT INTO pf_instance (id_instance, id_flow, id_phase) VALUES ('WEDD-150616-005', 1, 2);
INSERT INTO pf_instance (id_instance, id_flow, id_phase) VALUES ('WEDD-150616-006', 1, 5);
INSERT INTO pf_instance (id_instance, id_flow, id_phase) VALUES ('WEDD-150616-007', 1, 5);
INSERT INTO pf_instance (id_instance, id_flow, id_phase) VALUES ('WEDD-150616-008', 1, 6);
INSERT INTO pf_instance (id_instance, id_flow, id_phase) VALUES ('WEDD-150616-009', 1, 7);
INSERT INTO pf_instance (id_instance, id_flow, id_phase) VALUES ('WEDD-150616-010', 1, 7);
INSERT INTO pf_instance (id_instance, id_flow, id_phase) VALUES ('SESS-150616-001', 2, 1);
INSERT INTO pf_instance (id_instance, id_flow, id_phase) VALUES ('SESS-150616-002', 2, 1);
INSERT INTO pf_instance (id_instance, id_flow, id_phase) VALUES ('WEDD-150618-001', 1, 1);
UPDATE pf_instance SET id_phase = 5 WHERE id_instance = 'WEDD-150625-001';
UPDATE pf_instance SET id_user = 6 WHERE id_instance IN ('WEDD-150625-001', 'WEDD-150624-002', 'WEDD-150623-001','SESS-150624-001');
SELECT * FROM pf_instance;
-- Query get id_instance
SELECT PRE.code, PFD.today, (LPAD(IFNULL(SUBSTR(MAX(INS.id_instance),-3), 0) + 1, 3, '0')) id_ins FROM
  (SELECT CAST(DATE_FORMAT(SYSDATE(), '%y%m%d') AS CHAR) AS today FROM DUAL) PFD,
  (SELECT id_flow, code FROM pf_flow WHERE id_flow = 1) PRE, pf_instance INS
WHERE PRE.id_flow = INS.id_flow AND INS.id_instance LIKE (CONCAT(PRE.code,'-',PFD.today,'%'));

SELECT CONCAT(PRE.code, '-', PFD.today, '-', (LPAD(IFNULL(SUBSTR(MAX(INS.id_instance),-3), 0) + 1, 3, '0'))) id_ins FROM
  (SELECT CAST(DATE_FORMAT(SYSDATE(), '%y%m%d') AS CHAR) AS today FROM DUAL) PFD,
  (SELECT id_flow, code FROM pf_flow WHERE id_flow = 1) PRE, pf_instance INS
WHERE PRE.id_flow = INS.id_flow AND INS.id_instance LIKE (CONCAT(PRE.code,'-',PFD.today,'%'));


--  ******************** ******************** ******************** ******************** ******************** --
--                       T A B L E  - - - >   PF_CUSTOMER                                                    --
--  ******************** ******************** ******************** ******************** ******************** --

DROP TABLE pf_customer;
CREATE TABLE pf_customer (
	id_instance VARCHAR(15) NOT NULL,
	first_name VARCHAR(60) NOT NULL,
    last_name VARCHAR(60),
    e_mail VARCHAR(60) NOT NULL,
    phone VARCHAR(25),
	status SMALLINT(2) NOT NULL DEFAULT 1
);
ALTER TABLE pf_customer ADD CONSTRAINT fk_customer_id_instance FOREIGN KEY (id_instance) REFERENCES pf_instance (id_instance);
DELETE FROM pf_customer WHERE id_instance <> '';
INSERT INTO pf_customer (id_instance, first_name, e_mail, phone) VALUES ('WEDD-150616-001', 'JUANA DE ARCO SOLEDAD', 'juana.de.arco@gmail.com', '+52 (722) - 1738670');
INSERT INTO pf_customer (id_instance, first_name, e_mail, phone) VALUES ('WEDD-150616-002', 'PETRA REYES DE LA PAZ', 'petra.reyes@gmail.com', '+52 (441) - 3878645');
SELECT * FROM pf_customer;

--  ******************** ******************** ******************** ******************** ******************** --
--                       T A B L E  - - - >   PF_EVENT                                                    --
--  ******************** ******************** ******************** ******************** ******************** --

DROP TABLE pf_event;
CREATE TABLE pf_event (
	id_instance VARCHAR(15) NOT NULL,
	e_date TIMESTAMP NOT NULL,
    e_location VARCHAR(250) NOT NULL,
    e_reception VARCHAR(250),
    n_guests INT(4)
);
ALTER TABLE pf_event ADD CONSTRAINT fk_event_id_instance FOREIGN KEY (id_instance) REFERENCES pf_instance (id_instance);
ALTER TABLE pf_event ADD CONSTRAINT fk_event_id_flow FOREIGN KEY (id_flow) REFERENCES pf_flow (id_flow);
DELETE FROM pf_event WHERE id_instance <> '';
INSERT INTO pf_event (id_instance, e_date, e_location, e_reception, n_guests) VALUES ('WEDD-150616-001', STR_TO_DATE('2015-08-05 16:00', '%Y-%m-%d %H:%i'), 'Riviera Maya, Hotel Palace', 'Riviera Maya, Hotel Palace', 25);
INSERT INTO pf_event (id_instance, e_date, e_location, e_reception, n_guests) VALUES ('WEDD-150616-001', STR_TO_DATE('2015-12-10 15:30', '%Y-%m-%d %H:%i'), 'Cancún, Hotel Dreams', 'Cancún, Hotel Dreams', 45);	
SELECT * FROM pf_event;


--  ******************** ******************** ******************** ******************** ******************** --
--                       T A B L E  - - - >   PF_EVENT                                                    --
--  ******************** ******************** ******************** ******************** ******************** --

DROP TABLE pf_email_config;
CREATE TABLE pf_email_config (
	id_flow INT(8) NOT NULL,
    id_phase INT(8) NOT NULL,
    m_from VARCHAR(60) NOT NULL,
    m_subject VARCHAR(250),
	message VARCHAR(4000),
    format VARCHAR(10) NOT NULL,
    attachment VARCHAR(250)
);
ALTER TABLE pf_email_config ADD CONSTRAINT fk_email_config_id_flow FOREIGN KEY (id_flow) REFERENCES pf_flow_phase (id_flow);
ALTER TABLE pf_email_config ADD CONSTRAINT fk_email_config_id_phase FOREIGN KEY (id_phase) REFERENCES pf_group_phase (id_phase);
DELETE FROM pf_email_config WHERE id_flow > 0;
INSERT INTO pf_email_config (id_flow, id_phase, m_from, m_subject, message, format, attachment) VALUES (1,1,'ivan@localhost.com', 'Cotización de paquetes de Fotografía para Boda', 
    'Buenas tardes <br> <p>Le envio los paquetes de boda!</p>', 'html','paquetes_boda.pdf; paquetes_bodas_foraneas.pdf');

SELECT * FROM pf_email_config;
SELECT * FROM pf_email_config  where id_flow=1;

--  ******************** ******************** ******************** ******************** ******************** --
--                       Q U E R Y     F O R     A P P  L I C A T I O N                                      --
--  ******************** ******************** ******************** ******************** ******************** --

SELECT ins.id_instance, ins.t_create, DATE_FORMAT(eve.e_date,'%b, %d %Y') e_date, eve.e_location, eve.e_reception, eve.n_guests,
  ltrim(concat(cus.first_name, ' ', cus.last_name)) c_name, cus.e_mail, cus.phone
FROM pf_event eve, pf_customer cus, pf_instance ins
WHERE ins.id_instance = eve.id_instance AND ins.id_instance = cus.id_instance AND ins.id_phase = 1
ORDER BY cus.first_name, eve.e_location;

SELECT *
FROM pf_event eve, pf_customer cus, pf_instance ins
WHERE ins.id_instance = eve.id_instance AND ins.id_instance = cus.id_instance AND ins.id_phase = 1 -- AND ins.id_user = 1
ORDER BY cus.first_name, eve.e_location;

SELECT ins.id_flow, ins.id_instance, ins.t_create, DATE_FORMAT(eve.e_date,"[FMT_DATE_EVENT]") e_date, eve.e_location,
        eve.e_reception, eve.n_guests, ltrim(concat(cus.first_name, " ", cus.last_name)) c_name, cus.e_mail, cus.phone
    FROM pf_event eve, pf_customer cus, pf_instance ins
    WHERE ins.id_instance = eve.id_instance AND ins.id_instance = cus.id_instance AND ins.id_phase = 1 
    ORDER BY cus.first_name, eve.e_location;
    
COMMIT;
