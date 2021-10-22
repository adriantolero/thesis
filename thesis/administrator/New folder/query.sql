
PAYMENT

SELECT rev.ch_sname, rev.ch_fname, rev.ch_mi, pay.i_or_num, pay.f_amount_paid, pay.d_datepaid
FROM reviewer rev
INNER JOIN reservation res 
ON rev.i_rev_id=res.i_rev_id
INNER JOIN payment pay 
ON res.i_rev_id=pay.i_rev_id
WHERE pay.i_rev_id=87


DISPLAY Number of hours 
SELECT fr.str_agency,fr.str_agency_add,fr.str_title,fr.str_nature,fr.dt_start,fr.dt_end, (SELECT SUM(hour(timediff(t_end,t_start))) FROM timelog WHERE timelog.i_fr_id=tl.i_fr_id) AS hours

FROM function_reservation fr
INNER JOIN timelog tl
ON fr.i_fr_id=tl.i_fr_id
GROUP BY fr.i_fr_id