<?php 
require_once '../koneksi.php';
$querycount = $mysqli->query("SELECT LEFT(created_at,10) as date, count(LEft(created_at,10))  as jumlah from fct GROUP BY LEFT(created_at,10)");
$data = $querycount->fetch_all();
foreach($data as $row)
{
    $dataNew[] = [
        intval((strtotime($row[0])+90000)."000"),
        intval($row[1])
    ];
}
echo json_encode($dataNew);
?>