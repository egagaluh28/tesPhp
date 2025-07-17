select concat(a.kdkotama,a.kdsatkr) as display, a.kdsatkr, a.nmsatkr, 'PAGU' as KETERANGAN, b1.pagu51, b2.pagu52, b3.pagu53, c.hibah  from t_satkr a 
left join (select kdsatker, kdjenbel, sum(pagurevisi) as pagu51 from dipa where kdjenbel='51' and thang='2019' group by kdkotama,kdsatker) as b1 on a.kdsatkr=b1.kdsatker
left join (select kdsatker, kdjenbel, sum(pagurevisi) as pagu52 from dipa where kdjenbel='52' and thang='2019' group by kdkotama,kdsatker) as b2 on a.kdsatkr=b2.kdsatker
left join (select kdsatker, kdjenbel, sum(pagurevisi) as pagu53 from dipa where kdjenbel='53' and thang='2019' group by kdkotama,kdsatker) as b3 on a.kdsatkr=b3.kdsatker
left join (select kdsatker, sum(pagurevisi) as hibah from hibah where thang='2019' group by kdkotama,kdsatker) as c on a.kdsatkr=c.kdsatker
union
select concat(a.kdkotama,a.kdsatkr,1) as display, '' as kdsatkr, '' as nmsatkr, 'REALISASI' as KETERANGAN, b1.reals51, b2.reals52, b3.reals53, c.hibah from t_satkr a 
left join (select a.kdsatker, b.kdjenbel, sum(a.realisasi) as reals51 from realisasix a left join dipa b on a.id_pagu=b.id_pagu where b.kdjenbel='51' and b.thang='2019' group by a.kdkotama,a.kdsatker) as b1 on a.kdsatkr=b1.kdsatker
left join (select a.kdsatker, b.kdjenbel, sum(a.realisasi) as reals52 from realisasix a left join dipa b on a.id_pagu=b.id_pagu where b.kdjenbel='52' and b.thang='2019' group by a.kdkotama,a.kdsatker) as b2 on a.kdsatkr=b2.kdsatker
left join (select a.kdsatker, b.kdjenbel, sum(a.realisasi) as reals53 from realisasix a left join dipa b on a.id_pagu=b.id_pagu where b.kdjenbel='53' and b.thang='2019' group by a.kdkotama,a.kdsatker) as b3 on a.kdsatkr=b3.kdsatker
left join (select a.kdsatker, b.kdjenbel, sum(a.realisasi) as hibah from realisasi_hibah  a left join hibah b on a.id_pagu=b.id_pagu where b.thang='2019' group by a.kdkotama,a.kdsatker) as c on a.kdsatkr=c.kdsatker
union
select concat(kdkotama,kdsatkr,12) as display,'' as kdsatkr, '' as nmsatkr, '' as KETERANGAN, '' as reals51, '' as reals52, '' as reals53, '' as hibah from t_satkr 
union
select concat(kdkotama,kdsatkr,13) as display,'' as kdsatkr, '' as nmsatkr, '' as KETERANGAN, '' as reals51, '' as reals52, '' as reals53, '' as hibah from t_satkr 
order by display
 
 
select a.thang, 'PAGU' as KETERANGAN, b1.pagu51, b2.pagu52, b3.pagu53, c.hibah  from dipa a 
left join (select thang, kdjenbel, sum(pagurevisi) as pagu51 from dipa where kdjenbel='51' and thang='2019' group by thang) as b1 on a.thang=b1.thang
left join (select thang, kdjenbel, sum(pagurevisi) as pagu52 from dipa where kdjenbel='52' and thang='2019' group by thang) as b2 on a.thang=b2.thang
left join (select thang, kdjenbel, sum(pagurevisi) as pagu53 from dipa where kdjenbel='53' and thang='2019' group by thang) as b3 on a.thang=b3.thang
left join (select thang, sum(pagurevisi) as hibah from hibah where thang='2019' group by thang) as c on a.thang=c.thang where a.thang='2019'
group by a.thang


select a.thang, 'PAGU' as KETERANGAN, b1.reals51, b2.reals52, b3.reals53, c.hibah  from dipa a 
left join (select a.thang, b.kdjenbel, sum(a.realisasi) as reals51 from realisasix a left join dipa b on a.id_pagu=b.id_pagu where b.kdjenbel='51' and b.thang='2019' group by a.thang) as b1 on a.thang=b1.thang
left join (select a.thang, b.kdjenbel, sum(a.realisasi) as reals52 from realisasix a left join dipa b on a.id_pagu=b.id_pagu where b.kdjenbel='52' and b.thang='2019' group by a.thang) as b2 on a.thang=b2.thang
left join (select a.thang, b.kdjenbel, sum(a.realisasi) as reals53 from realisasix a left join dipa b on a.id_pagu=b.id_pagu where b.kdjenbel='53' and b.thang='2019' group by a.thang) as b3 on a.thang=b3.thang
left join (select a.thang, b.kdjenbel, sum(a.realisasi) as hibah from realisasi_hibah  a left join hibah b on a.id_pagu=b.id_pagu where b.thang='2019' group by a.thang) as c on a.thang=c.thang
where a.thang='2019'
group by a.thang



