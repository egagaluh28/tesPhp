

<input id="Option1" name="b01" type="checkbox" value="x" 
<? if($row['b01']=='x') {print "checked=checked";}?> >
<label class="checkbox" for="Option1"></label><br>


<input type="checkbox" name="checkbox[]" />item1<input type="text" name="nilai[]" />
<br />
<input type="checkbox" name="checkbox[]" />item2<input type="text" name="nilai[]" />
<br />
<input type="checkbox" name="checkbox[]" />item3<input type="text" name="nilai[]" />
<?php 

foreach( $_POST["checkbox"] as $temp ) {

if(isset($temp)) { mysql_query = ("insert into coba(nilai) values ('$nilai[$i]')"); }

$i++;
}
?>