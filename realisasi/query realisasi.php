<?
SELECT '' as id_pagu, a.thang, a.kdprogram as kode, a.kdprogram as display,  b.nmprogram as uraian, sum(a.pagu) as pagu, sum(a.revisi) as revisi, c.blnlalu, d.blnini
FROM dipa a 
left join t_program b on a.kdfungsi=b.kdfungsi and a.kdsfungsi=b.kdsfungsi and a.kdprogram=b.kdprogram
left join (select id_pagu, sum(realisasi) as blnlalu from realisasi where kdbulan<'$_GET[kdbulan]' group by id_pagu) as c on a.id_pagu=c.id_pagu
left join (select id_pagu, sum(realisasi) as blnini from realisasi where kdbulan='$_GET[kdbulan]' group by id_pagu) as d on a.id_pagu=d.id_pagu
where  a.kdkotama='$_SESSION[kdkotama]' and a.kdsatker='$_SESSION[kdsatker]' and a.thang='$_SESSION[thang]' 
group by a.kdfungsi, a.kdsfungsi, a.kdprogram

union (SELECT '' as id_pagu, a.thang, a.kdgiat as kode, concat(a.kdprogram,a.kdgiat) as display, b.nmgiat as uraian, sum(a.pagu) as pagu, sum(a.revisi) as revisi, c.blnlalu, d.blnini 
FROM dipa a 
left join t_giat b on a.kdfungsi=b.kdfungsi and a.kdsfungsi=b.kdsfungsi and a.kdprogram=b.kdprogram and a.kdgiat=b.kdgiat
left join (select id_pagu, sum(realisasi) as blnlalu from realisasi where kdbulan<'$_GET[kdbulan]' group by id_pagu) as c on a.id_pagu=c.id_pagu
left join (select id_pagu, sum(realisasi) as blnini from realisasi where kdbulan='$_GET[kdbulan]' group by id_pagu) as d on a.id_pagu=d.id_pagu
where  a.kdkotama='$_SESSION[kdkotama]' and a.kdsatker='$_SESSION[kdsatker]' and a.thang='$_SESSION[thang]' 
group by a.kdfungsi, a.kdsfungsi, a.kdprogram, a.kdgiat)

union (SELECT '' as id_pagu, a.thang, a.kdoutput as kode, concat(a.kdprogram,a.kdgiat,a.kdoutput) as display,  b.nmoutput as uraian,  
sum(a.pagu) as pagu, sum(a.revisi) as revisi, c.blnlalu, d.blnini 
FROM dipa a 
left join t_output b on a.kdfungsi=b.kdfungsi and a.kdsfungsi=b.kdsfungsi and a.kdprogram=b.kdprogram and a.kdgiat=b.kdgiat and a.kdoutput=b.kdoutput
left join (select id_pagu, sum(realisasi) as blnlalu from realisasi where kdbulan<'$_GET[kdbulan]' group by id_pagu) as c on a.id_pagu=c.id_pagu
left join (select id_pagu, sum(realisasi) as blnini from realisasi where kdbulan='$_GET[kdbulan]' group by id_pagu) as d on a.id_pagu=d.id_pagu
where  a.kdkotama='$_SESSION[kdkotama]' and a.kdsatker='$_SESSION[kdsatker]' and a.thang='$_SESSION[thang]' 
group by a.kdfungsi, a.kdsfungsi, a.kdprogram, a.kdgiat,a.kdoutput)

union (SELECT '' as id_pagu, a.thang, a.kdakun as kode, concat(a.kdprogram,a.kdgiat,a.kdoutput,a.kdakun) as display, b.nmakun as uraian,  
sum(a.pagu) as pagu, sum(a.revisi) as revisi, c.blnlalu, d.blnini 
FROM dipa a left join t_akun b on a.kdakun=b.kdakun
left join (select id_pagu, sum(realisasi) as blnlalu from realisasi where kdbulan<'$_GET[kdbulan]' group by id_pagu) as c on a.id_pagu=c.id_pagu
left join (select id_pagu, sum(realisasi) as blnini from realisasi where kdbulan='$_GET[kdbulan]' group by id_pagu) as d on a.id_pagu=d.id_pagu
where  a.kdkotama='$_SESSION[kdkotama]' and a.kdsatker='$_SESSION[kdsatker]' and a.thang='$_SESSION[thang]'
group by a.kdfungsi, a.kdsfungsi, a.kdprogram, a.kdgiat,a.kdoutput,a.kdakun)

union (SELECT '' as id_pagu, a.thang, '' as kode, concat(a.kdprogram,a.kdgiat,a.kdoutput,a.kdakun, a.kdsakun) as display, b.nmsakun as uraian,  sum(a.pagu) as pagu, sum(a.revisi) as revisi, c.blnlalu, d.blnini 
FROM dipa a left join t_sakun b on a.kdgiat=b.kdgiat and a.kdoutput=b.kdoutput and a.kdakun=b.kdakun and a.kdsakun=b.kdsakun
left join (select id_pagu, sum(realisasi) as blnlalu from realisasi where kdbulan<'$_GET[kdbulan]' group by id_pagu) as c on a.id_pagu=c.id_pagu
left join (select id_pagu, sum(realisasi) as blnini from realisasi where kdbulan='$_GET[kdbulan]' group by id_pagu) as d on a.id_pagu=d.id_pagu
where  a.kdkotama='$_SESSION[kdkotama]' and a.kdsatker='$_SESSION[kdsatker]' and a.thang='$_SESSION[thang]' 
group by a.kdfungsi, a.kdsfungsi, a.kdprogram, a.kdgiat,a.kdoutput,a.kdakun,a.kdsakun)

union (SELECT a.id_pagu, a.thang, '' as kode, concat(a.kdprogram,a.kdgiat,a.kdoutput,a.kdakun, a.kdsakun,a.urutitem) as display, concat('-',' ', nmitem) as 
uraian, sum(a.pagu) as pagu, sum(a.revisi) as revisi, c.blnlalu, d.blnini  FROM dipa a 
left join (select id_pagu, sum(realisasi) as blnlalu from realisasi where kdbulan<'$_GET[kdbulan]' group by id_pagu) as c on a.id_pagu=c.id_pagu
left join (select id_pagu, realisasi as blnini from realisasi where kdbulan='$_GET[kdbulan]' ) as d on a.id_pagu=d.id_pagu
where  kdkotama='$_SESSION[kdkotama]' and kdsatker='$_SESSION[kdsatker]' and thang='$_SESSION[thang]' group by id_pagu order by a.noitem, a.id_pagu)

order by display


?>

SELECT '' as id_pagu, a.thang, a.kdprogram as kode, a.kdprogram as display,  b.nmprogram as uraian, sum(a.pagu) as pagu, sum(a.revisi) as revisi, c.blnlalu, d.blnini
FROM dipa a 
left join t_program b on a.kdfungsi=b.kdfungsi and a.kdsfungsi=b.kdsfungsi and a.kdprogram=b.kdprogram
left join (select id_pagu, sum(realisasi) as blnlalu from realisasi where kdbulan<'04' group by id_pagu) as c on a.id_pagu=c.id_pagu
left join (select id_pagu, sum(realisasi) as blnini from realisasi where kdbulan='04' group by id_pagu) as d on a.id_pagu=d.id_pagu
where  a.kdkotama='05' and a.kdsatker='08' and a.thang='2016' 
group by a.kdfungsi, a.kdsfungsi, a.kdprogram

union (SELECT '' as id_pagu, a.thang, a.kdgiat as kode, concat(a.kdprogram,a.kdgiat) as display, b.nmgiat as uraian, sum(a.pagu) as pagu, sum(a.revisi) as revisi, c.blnlalu, d.blnini 
FROM dipa a 
left join t_giat b on a.kdfungsi=b.kdfungsi and a.kdsfungsi=b.kdsfungsi and a.kdprogram=b.kdprogram and a.kdgiat=b.kdgiat
left join (select id_pagu, sum(realisasi) as blnlalu from realisasi where kdbulan<'04' group by id_pagu) as c on a.id_pagu=c.id_pagu
left join (select id_pagu, sum(realisasi) as blnini from realisasi where kdbulan='04' group by id_pagu) as d on a.id_pagu=d.id_pagu
where  a.kdkotama='05' and a.kdsatker='08' and a.thang='2016' 
group by a.kdfungsi, a.kdsfungsi, a.kdprogram, a.kdgiat)

union (SELECT '' as id_pagu, a.thang, a.kdoutput as kode, concat(a.kdprogram,a.kdgiat,a.kdoutput) as display,  b.nmoutput as uraian,  
sum(a.pagu) as pagu, sum(a.revisi) as revisi, c.blnlalu, d.blnini 
FROM dipa a 
left join t_output b on a.kdfungsi=b.kdfungsi and a.kdsfungsi=b.kdsfungsi and a.kdprogram=b.kdprogram and a.kdgiat=b.kdgiat and a.kdoutput=b.kdoutput
left join (select id_pagu, sum(realisasi) as blnlalu from realisasi where kdbulan<'04' group by id_pagu) as c on a.id_pagu=c.id_pagu
left join (select id_pagu, sum(realisasi) as blnini from realisasi where kdbulan='04' group by id_pagu) as d on a.id_pagu=d.id_pagu
where  a.kdkotama='05' and a.kdsatker='08' and a.thang='2016' 
group by a.kdfungsi, a.kdsfungsi, a.kdprogram, a.kdgiat,a.kdoutput)

union (SELECT '' as id_pagu, a.thang, a.kdakun as kode, concat(a.kdprogram,a.kdgiat,a.kdoutput,a.kdakun) as display, b.nmakun as uraian,  
sum(a.pagu) as pagu, sum(a.revisi) as revisi, c.blnlalu, d.blnini 
FROM dipa a left join t_akun b on a.kdakun=b.kdakun
left join (select id_pagu, sum(realisasi) as blnlalu from realisasi where kdbulan<'04' group by id_pagu) as c on a.id_pagu=c.id_pagu
left join (select id_pagu, sum(realisasi) as blnini from realisasi where kdbulan='04' group by id_pagu) as d on a.id_pagu=d.id_pagu
where  a.kdkotama='05' and a.kdsatker='08' and a.thang='2016'
group by a.kdfungsi, a.kdsfungsi, a.kdprogram, a.kdgiat,a.kdoutput,a.kdakun)

union (SELECT '' as id_pagu, a.thang, '' as kode, concat(a.kdprogram,a.kdgiat,a.kdoutput,a.kdakun, a.kdsakun) as display, b.nmsakun as uraian,  sum(a.pagu) as pagu, sum(a.revisi) as revisi, c.blnlalu, d.blnini 
FROM dipa a left join t_sakun b on a.kdgiat=b.kdgiat and a.kdoutput=b.kdoutput and a.kdakun=b.kdakun and a.kdsakun=b.kdsakun
left join (select id_pagu, sum(realisasi) as blnlalu from realisasi where kdbulan<'04' group by id_pagu) as c on a.id_pagu=c.id_pagu
left join (select id_pagu, sum(realisasi) as blnini from realisasi where kdbulan='04' group by id_pagu) as d on a.id_pagu=d.id_pagu
where  a.kdkotama='05' and a.kdsatker='08' and a.thang='2016' 
group by a.kdfungsi, a.kdsfungsi, a.kdprogram, a.kdgiat,a.kdoutput,a.kdakun,a.kdsakun)


union (SELECT a.id_pagu, a.thang, '' as kode, concat(a.kdprogram,a.kdgiat,a.kdoutput,a.kdakun, a.kdsakun,a.urutitem) as display, concat('-',' ', nmitem) as 
uraian, sum(a.pagu) as pagu, sum(a.revisi) as revisi, c.blnlalu, d.blnini  FROM dipa a 
left join (select id_pagu, sum(realisasi) as blnlalu from realisasi where kdbulan<'04' group by id_pagu) as c on a.id_pagu=c.id_pagu
left join (select id_pagu, realisasi as blnini from realisasi where kdbulan='04' ) as d on a.id_pagu=d.id_pagu
where  kdkotama='05' and kdsatker='08' and thang='2016' group by id_pagu order by a.noitem, a.id_pagu)

order by display