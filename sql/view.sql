CREATE OR REPLACE VIEW v_l_exercice AS
SELECT
    e.id,
    e.no_account,
    e.id_exercice_year,
    e.label,
    ey.label AS exercice_year,
    e.debit,
    e.credit,
    e.date
FROM
    exercice  AS e
JOIN
    exercice_year AS ey ON e.id_exercice_year = ey.id;

/* ========================================== */
/* ========================================== */
/* ========================================== */

CREATE OR REPLACE VIEW v_l_section AS
SELECT
    s.id,
    s.label,
    s.no_account,
    s.id_unit,
    u.label AS unit,
    s.id_nature,
    n.label AS nature,
    s.id_incorporation,
    i.label AS incorporation
FROM
    section s
LEFT JOIN
    unit u ON s.id_unit = u.id
LEFT JOIN
    nature n ON s.id_nature = n.id
LEFT JOIN
    incorporation i ON s.id_incorporation = i.id;

/* ========================================== */
/* ========================================== */
/* ========================================== */

CREATE OR REPLACE VIEW v_l_expense AS
SELECT
    e.id,
    e.id_section,
    e.quantity,
    e.price,
    e.date,
    s.label,
    s.no_account,
    s.id_unit,
    s.unit,
    s.id_nature,
    s.nature,
    s.id_incorporation,
    s.incorporation
FROM
    expense e
JOIN
    v_l_section s ON e.id_section = s.id;

/* ========================================== */
/* ========================================== */
/* ========================================== */

CREATE OR REPLACE VIEW v_l_product AS
SELECT
    p.id,
    p.label,
    p.quantity,
    p.id_unit,
    u.label AS unit
FROM
    product p
LEFT JOIN
    unit u ON p.id_unit = u.id;

/* ========================================== */
/* ========================================== */
/* ========================================== */

CREATE OR REPLACE VIEW v_cost_center_detail AS
SELECT
    ec.id,
    ec.id_expense,
    e.id_section,
    e.quantity,
    e.price AS price_total,
    e.price * COALESCE(ec.percentage, 0) AS price_center,
    e.date,
    c.id AS id_center,
    c.label AS center,
    c.id_center_type,
    ec.percentage
FROM
    expense e
CROSS JOIN
    center c
LEFT JOIN
    expense_center ec ON ec.id_expense = e.id AND ec.id_center = c.id;

/* ========================================== */
/* ========================================== */
/* ========================================== */

CREATE OR REPLACE VIEW v_l_cost_center_detail AS
SELECT
    ccd.id,
    ccd.id_expense,
    ccd.id_section,
    s.label,
    s.id_unit,
    s.unit,
    s.id_nature,
    s.nature,
    s.id_incorporation,
    s.incorporation,
    ccd.quantity,
    ccd.price_total,
    ccd.price_center,
    ccd.date,
    ccd.id_center,
    ccd.center,
    ccd.id_center_type,
    ccd.percentage
FROM
    v_cost_center_detail ccd
JOIN
    v_l_section s ON ccd.id_section = s.id;

/* ========================================== */
/* ========================================== */
/* ========================================== */

CREATE OR REPLACE VIEW v_cost_center AS
SELECT
    ccd.id_center,
    ccd.id_center_type,
    s.id_nature,
    SUM(price_center) AS price
FROM
    v_cost_center_detail ccd
JOIN
    section s ON ccd.id_section = s.id
GROUP BY
    s.id_nature,
    ccd.id_center,
    ccd.id_center_type
UNION ALL
SELECT
    NULL,
    NULL,
    s.id_nature,
    SUM(price_center)
FROM
    v_cost_center_detail ccd
JOIN
    section s ON ccd.id_section = s.id
GROUP BY
    s.id_nature;

/* ========================================== */
/* ========================================== */
/* ========================================== */

CREATE OR REPLACE VIEW v_cost_center_active AS
SELECT
    id_center,
    id_center_type,
    SUM(price) AS price
FROM
    v_cost_center
WHERE
    id_center_type = 2
GROUP BY
    id_center,
    id_center_type;

/* ========================================== */
/* ========================================== */
/* ========================================== */


CREATE OR REPLACE VIEW v_cost_center_structure AS
SELECT
    id_center,
    id_center_type,
    SUM(price) AS price
FROM
    v_cost_center
WHERE
    id_center_type = 1
GROUP BY
    id_center,
    id_center_type;

/* ========================================== */
/* ========================================== */
/* ========================================== */

CREATE OR REPLACE VIEW v_cost_center_active_shared AS
SELECT
    cca.id_center,
    cca.price,
    cca.price / pt.price_total AS key,
    ccs.id_center AS id_center_shared,
    ccs.price * cca.price / pt.price_total AS price_shared
FROM
    v_cost_center_active AS cca
CROSS JOIN
    v_cost_center_structure AS ccs
CROSS JOIN (
    SELECT SUM(price) AS price_total FROM v_cost_center_active
) AS pt;

/* ========================================== */
/* ========================================== */
/* ========================================== */

CREATE OR REPLACE VIEW v_l_cost_center_active_shared AS
SELECT
    c1.id,
    c1.label,
    ccas.price,
    ccas.key,
    ccas.id_center_shared AS id_shared,
    c2.label AS label_shared,
    ccas.price_shared
FROM
    v_cost_center_active_shared ccas
JOIN
    center c1 ON ccas.id_center = c1.id
JOIN
    center c2 ON ccas.id_center_shared = c2.id;

/* ========================================== */
/* ========================================== */
/* ========================================== */

CREATE OR REPLACE VIEW v_expense_cost_unit AS
SELECT
    id,
    id_section,
    quantity,
    price AS price_total,
    price / quantity AS price_unit,
    date
FROM
    expense;

/* ========================================== */
/* ========================================== */
/* ========================================== */

CREATE OR REPLACE VIEW v_l_expense_cost_unit AS
SELECT
    ecu.id,
    ecu.id_section,
    s.label,
    s.id_unit,
    s.unit AS unit,
    s.id_nature,
    s.label AS nature,
    s.id_incorporation,
    s.label AS incorporation,
    ecu.quantity,
    ecu.price_total,
    ecu.price_unit,
    ecu.date
FROM
    v_expense_cost_unit ecu
JOIN
    v_l_section s ON ecu.id_section = s.id;

/* ========================================== */
/* ========================================== */
/* ========================================== */

CREATE OR REPLACE VIEW v_product_cost_unit AS
SELECT
    p.id,
    p.label,
    p.quantity,
    p.id_unit,
    p.unit,
    SUM(price) AS price_total,
    SUM(price) / p.quantity AS price_unit
FROM
    v_cost_center cc
CROSS JOIN
    v_l_product p
WHERE
    cc.id_center IS NULL
GROUP BY
    p.id,
    p.label,
    p.quantity,
    p.id_unit,
    p.unit;

/* ========================================== */
/* ========================================== */
/* ========================================== */

CREATE OR REPLACE VIEW v_product_selling_price AS
SELECT 
    vpc.*,
    vpc.price_unit * 1.2 AS selling_price
FROM 
    v_product_cost_unit vpc;