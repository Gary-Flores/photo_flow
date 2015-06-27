<?php
/* 
 * All queries in this file.
 */
// Login
$pf_sel_user_access = "SELECT id_user, id_profile, access, password, name, status, default_lang FROM pf_login_user WHERE access = '%s'";
$pf_sel_menu_profile = "SELECT PG_2.* FROM pf_profile_grants PG_1, 
    (SELECT * FROM (SELECT id_group_phase, label FROM pf_group_phase WHERE id_group_parent IS NULL AND level = 1 AND status = 1) T_1
      INNER JOIN (SELECT grp.id_group_parent, pha.id_phase, pha.name FROM pf_group_phase grp, pf_phase pha
      WHERE grp.id_group_parent IS NOT NULL AND grp.level = 2 AND grp.status = 1 AND pha.id_phase = grp.id_phase) T_2
      ON T_1.id_group_phase = T_2.id_group_parent) PG_2 WHERE PG_1.id_group_phase = PG_2.id_group_phase AND PG_1.id_profile = %s
    ORDER BY PG_2.id_group_phase, PG_2.id_phase";
// Inbox
$pf_sel_c_instance_total = "SELECT COUNT(*) AS total FROM pf_instance WHERE id_phase = %d AND status = 1";
$pf_sel_c_instance_user = "SELECT COUNT(*) AS total FROM pf_instance WHERE id_phase = %d AND id_user = %s AND status = 1";
// Create a New Instance
$pf_sel_1step_flow = "SELECT MIN(sequence) step FROM pf_flow_phase WHERE id_flow = %d AND status = 1";
$pf_sel_id_instance = "SELECT CONCAT(PRE.code, '-', PFD.today, '-', (LPAD(IFNULL(SUBSTR(MAX(INS.id_instance),-3), 0) + 1, 3, '0'))) id_ins
    FROM (SELECT CAST(DATE_FORMAT(SYSDATE(), '%y%m%d') AS CHAR) AS today FROM DUAL) PFD,
        (SELECT id_flow, code FROM pf_flow WHERE id_flow = [ID_FLOW]) PRE, pf_instance INS
    WHERE PRE.id_flow = INS.id_flow AND INS.id_instance LIKE (CONCAT(PRE.code,'-',PFD.today,'%'))";
$pf_ins_instance = "INSERT INTO pf_instance (id_instance, id_flow, id_phase) VALUES ('%s', %d, %d)";
$pf_ins_customer = "INSERT INTO pf_customer (id_instance, first_name, last_name, e_mail, phone) VALUES ('%s', '%s', '%s', '%s', '%s')";
$pf_ins_event = "INSERT INTO pf_event (id_instance, e_date, e_location, e_reception, n_guests)
        VALUES(\"%s\", STR_TO_DATE(\"%s\", \"[FMT_DATE_HOUR]\"), \"%s\", \"%s\", %d)";
// Detail Instance Work
$pf_sel_phases_id =  "SELECT ins.id_flow, ins.id_phase, ins.id_instance, ins.t_create, DATE_FORMAT(eve.e_date,\"[FMT_DATE_EVENT]\") e_date, eve.e_location,
        eve.e_reception, eve.n_guests, ltrim(concat(cus.first_name, \" \", cus.last_name)) c_name, cus.e_mail, cus.phone
    FROM pf_event eve, pf_customer cus, pf_instance ins
    WHERE ins.id_instance = eve.id_instance AND ins.id_instance = cus.id_instance AND ins.id_phase = %d
    ORDER BY cus.first_name, eve.e_location";
$pf_sel_phases_id_user =  "SELECT ins.id_flow, ins.id_phase, ins.id_instance, ins.t_create, DATE_FORMAT(eve.e_date,\"[FMT_DATE_EVENT]\") e_date, eve.e_location,
        eve.e_reception, eve.n_guests, ltrim(concat(cus.first_name, \" \", cus.last_name)) c_name, cus.e_mail, cus.phone
    FROM pf_event eve, pf_customer cus, pf_instance ins
    WHERE ins.id_instance = eve.id_instance AND ins.id_instance = cus.id_instance AND ins.id_phase = %d AND ins.id_user = %d
    ORDER BY cus.first_name, eve.e_location";
$pf_sel_mail_phase =  "SELECT id_flow, id_phase, m_from, m_subject, message, format, attachment FROM pf_email_config WHERE id_flow = %d AND id_phase = %d";
$pf_sel_ins_info =  "SELECT eve.id_instance, ltrim(concat(cus.first_name, ' ', cus.last_name)) name, cus.e_mail, cus.phone, cus.status, eve.e_date,
    eve.e_location, eve.e_reception, eve.n_guests FROM pf_customer cus, pf_event eve WHERE cus.id_instance = eve.id_instance AND cus.id_instance = '%s'";
//Catalogs
$pf_sel_list_flow = "SELECT id_flow, name FROM pf_flow WHERE status = 1";
// Ungrouped
$pf_sel_list_phases = "SELECT id_phase, name, description FROM pf_phase WHERE status = 1";