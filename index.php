<html>
<title>Linux GPU Public Survey</title>
<head>
 <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
<p>This website shows the number of GPU/video cards used by Linux community who participate on the survey for GPU's. This will provide insights about the GPU support for Linux</p>

<p><strong>Privacy Policy:</strong>&nbsp;This website does not collect any personal information. Only the GPU vendor id and device id; and MD5 hash of machine-id to prevent duplicate entry and provide more accurate survey result</p>
<br>
<br>
<p><h2 style="text-align: center;">GPU statistics</h2></p>

<div style='padding: 10px 20px 0px; border-top: dotted 1px #CCC; text-align: center;'></div>

<?php

//https://www.allphptricks.com/create-simple-pagination-using-php-and-mysqli/

include 'db.php';

if (isset($_GET['page_no']) && $_GET['page_no']!="") {
    
    if (is_numeric($_GET['page_no'])){
     $page_no = $_GET['page_no'];
    }
    else {
     $page_no = 1;
    }

    
} else {
        $page_no = 1;
    }

$total_records_per_page = 100;
$offset = ($page_no-1) * $total_records_per_page;
$previous_page = $page_no - 1;
$next_page = $page_no + 1;
$adjacents = "2";

$result_count = mysqli_query(
$con,
"select COUNT(*) As total_records,vendor,device,manufacturer,value_ from tbl_gpu_log group by vendor,device,manufacturer"
);
$total_records = mysqli_fetch_array($result_count);
$total_records = $total_records['total_records'];
$total_no_of_pages = ceil($total_records / $total_records_per_page);
$second_last = $total_no_of_pages - 1; // total pages minus 1

?>



<?php
$result = mysqli_query(
    $con,
    "select vendor,device,manufacturer,sum(value_) as total_ from tbl_gpu_log group by vendor,device,manufacturer limit $offset, $total_records_per_page"
    );

$rowcount=mysqli_num_rows($result);

if($rowcount>0){

echo "<table class=\"table table-striped table-bordered\">
<thead>
<tr>
<th style='text-align:center;'>Vendor ID</th>
<th style='text-align:center;'>Device ID</th>
<th style='text-align:center;'>Vendor</th>
<th style='text-align:center;'>Count</th>
<th style='text-align:center;'>&nbsp;</th>
</tr>
</thead>
<tbody>
";

while($row = mysqli_fetch_array($result)){
    echo "<tr>
 <td>". strtoupper($row['vendor']) ."</td>
 <td>". strtoupper($row['device']) ."</td>
 <td>". strtoupper($row['manufacturer']) ."</td>
 <td style=\"text-align: right;\">".$row['total_']."</td>
 <td><a href=\"https://devicehunt.com/view/type/pci/vendor/". strtoupper($row['vendor']) . "/device/" . strtoupper($row['device']) . "\"  target=\"_blank\">More Info (Devicehunt)</a></td>
 </tr>";
}

mysqli_close($con);

echo "</tbody>
</table>";

}
else {
 echo "<p style=\"text-align: center;\">No records yet</p>";
}

?>


<div style='padding: 10px 20px 0px; border-top: dotted 1px #CCC; text-align: center;'>
<strong>Page <?php echo $page_no." of ".$total_no_of_pages; ?></strong>
</div>

<div style="text-align: center;">

<ul class="pagination">

<?php
if ($total_no_of_pages <= 10){   
 for ($counter = 1; $counter <= $total_no_of_pages; $counter++){
 if ($counter == $page_no) {
 echo "<li class='active'><a>$counter</a></li>"; 
         }else{
        echo "<li><a href='?page_no=$counter'>$counter</a></li>";
                }
        }
}
elseif ($total_no_of_pages > 10){

    if($page_no <= 4) { 
    for ($counter = 1; $counter < 8; $counter++){ 
    if ($counter == $page_no) {
        echo "<li class='active'><a>$counter</a></li>"; 
    }else{
            echo "<li><a href='?page_no=$counter'>$counter</a></li>";
                    }
    }
    echo "<li><a>...</a></li>";
    echo "<li><a href='?page_no=$second_last'>$second_last</a></li>";
    echo "<li><a href='?page_no=$total_no_of_pages'>$total_no_of_pages</a></li>";
    }

    elseif($page_no > 4 && $page_no < $total_no_of_pages - 4) { 
    echo "<li><a href='?page_no=1'>1</a></li>";
    echo "<li><a href='?page_no=2'>2</a></li>";
    echo "<li><a>...</a></li>";
    for (
        $counter = $page_no - $adjacents;
        $counter <= $page_no + $adjacents;
        $counter++
        ) { 
        if ($counter == $page_no) {
    echo "<li class='active'><a>$counter</a></li>"; 
    }else{
            echo "<li><a href='?page_no=$counter'>$counter</a></li>";
            }                  
        }
    echo "<li><a>...</a></li>";
    echo "<li><a href='?page_no=$second_last'>$second_last</a></li>";
    echo "<li><a href='?page_no=$total_no_of_pages'>$total_no_of_pages</a></li>";
    }

    else {
    echo "<li><a href='?page_no=1'>1</a></li>";
    echo "<li><a href='?page_no=2'>2</a></li>";
    echo "<li><a>...</a></li>";
    for (
        $counter = $total_no_of_pages - 6;
        $counter <= $total_no_of_pages;
        $counter++
        ) {
        if ($counter == $page_no) {
    echo "<li class='active'><a>$counter</a></li>"; 
    }else{
            echo "<li><a href='?page_no=$counter'>$counter</a></li>";
    }                   
        }
    }

}

?>

</ul>

</div>

</body>
</html>
