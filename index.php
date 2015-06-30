<!DOCTYPE html>
<html>
<!--<meta http-equiv="refresh" content="3">-->
<head>
	<title>Table</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	 <script language="javascript" type="text/javascript" src="jquery.js"></script>
    <script language="javascript" type="text/javascript" src="jquery.flot.js"></script>
	<script language="javascript" type="text/javascript" src="jquery.flot.selection.js"></script>
</head>
<body>
<div class="navbar">
	<a !href="index.html" class="current">Monitoring Suhu dan Kelembaban udara pada ruang Data Center</a>
	<!a href="index1.html"><!/a>
	<!a href="index2.html"><!/a>
	<!a href="index3.html"><!/a>
	<!a href="index4.html"><!/a>
</div>
<div class="container">
	<h1>Table</h1>
	<table class="zebra-table">
		<thead>
			<tr>
				<th>Nomer</th>
				<th>Waktu</th>
				<th>Suhu</th>
				<th>Kelembaban</th>
			</tr>
		</thead>
		<tbody>
			<?php

mysql_connect('localhost','root','');
mysql_select_db('ta');
$i=0;
$query=mysql_query("SELECT * FROM `sensor` ORDER BY waktu DESC, `sensor`.`id` DESC ");
while($row=mysql_fetch_array($query))
{
	$i++;

	echo '	<tr>
				<td>'.$i.'</td>
				<td>'.$row[3].'</td>
				<td>'.$row[1].'</td>
				<td>'.$row[2].'</td>
			</tr>';
}

?>

			
		</tbody>
	</table>
	<br/>
	<div style="width:47%; float:left; height:300px;">
	<div id="placeholder-suhu"  style="width:100%; height:300px;"></div>
	</div>
	
	<div style="width:47%; float:right; height:300px;">
	<div id="placeholder-kelembaban"  style="width:100%; height:300px;"></div>
	</div>
</div>
<div class="back">
 
  

<script type="text/javascript">
$(function () {
  var data = [
  <?php 
  
$query=mysql_query("SELECT * FROM `sensor` ORDER BY waktu DESC");
while($row=mysql_fetch_array($query))
{
        ?>[<?php $tanggal=explode(" ",$row[3]); echo str_replace("-","",$tanggal[0]);?>,<?php echo $row[1];?>],<?php 
}
		?>
    ];

    var dataDetail = [
            {
                label:"Suhu",
                data:data, 
                color:"#FF7575"
            }
        ];
 	
	    var masterOptions =  {            
             series: {
                lines: { show: true, lineWidth: 3 },
                shadowSize: 0
            },
            grid: {  
                hoverable: true,               
                backgroundColor: { colors: ["#96CBFF", "#75BAFF"] }
            },
            yaxis:{
                color:"#8400FF"
            },
            xaxis:{
                mode:"time",
                color:"#8400FF"
            },
            selection:{
                mode: "x"
            }
    };
    
    $.plot($("#placeholder-suhu"),  dataDetail, masterOptions);
	
	  $("#placeholder-suhu").bind("plotselected", function (event, ranges) {        
        plotDetail = $.plot($("#placeholder-suhu"), dataDetail,
                      $.extend(true, {}, masterOptions, {
                          xaxis: { min: ranges.xaxis.from, max: ranges.xaxis.to }
                      }));
         
        plotMaster.setSelection(ranges, true);
    });
	
	
});










$(function () {
  var data = [
  <?php 
  
$query=mysql_query("SELECT * FROM `sensor` ORDER BY waktu DESC");
while($row=mysql_fetch_array($query))
{
        ?>[<?php $tanggal=explode(" ",$row[2]); echo str_replace("-","",$tanggal[0]);?>,<?php echo $row[1];?>],<?php 
}
		?>
    ];

    var dataDetail = [
            {
                label:"Kelembaban",
                data:data, 
                color:"#FF7575"
            }
        ];
 	
	    var masterOptions =  {            
             series: {
                lines: { show: true, lineWidth: 3 },
                shadowSize: 0
            },
            grid: {  
                hoverable: true,               
                backgroundColor: { colors: ["#96CBFF", "#75BAFF"] }
            },
            yaxis:{
                color:"#8400FF"
            },
            xaxis:{
                mode:"time",
                color:"#8400FF"
            },
            selection:{
                mode: "x"
            }
    };
    
    $.plot($("#placeholder-kelembaban"),  dataDetail, masterOptions);
	
	  $("#placeholder-kelembaban").bind("plotselected", function (event, ranges) {        
        plotDetail = $.plot($("#placeholder-kelembaban"), dataDetail,
                      $.extend(true, {}, masterOptions, {
                          xaxis: { min: ranges.xaxis.from, max: ranges.xaxis.to }
                      }));
         
        plotMaster.setSelection(ranges, true);
    });
	
	
});
</script>
</body>
</html>