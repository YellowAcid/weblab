<?php
session_start();
require_once 'php\operationWithDataBase.php';
$record_per_page = 10;
$page = '';
$output = '';
if(isset($_POST["page"]))
{
    $page = $_POST["page"];
}
else
{
    $page = 1;
}
$start_from = ($page - 1)*$record_per_page;
$advertisements = getAdvertisements($start_from, $record_per_page);

foreach ($advertisements as $adv){
    $output .= '<div class="card">
                      <div class="card-header text-center">
                        <a href="pages/userpagereport.php?id='.$adv['id'].'" class="stretched-link h4">'.$adv['advertisement_title'].'</a>
                      </div>
                      <div class="card-body text-center">
                        <h6 class="card-title">'.$adv['price'].'</h6>
                        <img src="../'.$adv['path_photo'].'" width="255" height="255"><br/>
                      </div>
                    </div>';
}

$output .= '<br /><div align="center">';
$total_records = getCountAdvertisements();
$total_pages = ceil((int)$total_records[0]["count(*)"]/$record_per_page);
for($i=1; $i<=$total_pages; $i++)
{
    $output .= "<span class='pagination_link' style='cursor:pointer; padding:6px; border:1px solid #ccc;' id='".$i."'>".$i."</span>";
}
$output .= '</div><br /><br />';
echo $output;