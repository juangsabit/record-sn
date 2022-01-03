<?php 
require_once '../koneksi.php';

if($_GET['action'] == "table_data"){


		$columns = array( 
	                            0 =>'id', 
	                            1 =>'label_paco', 
	                            2 =>'serial_number',
	                            3=> 'source',
	                            4=> 'created_at',
	                        );

		$querycount = $mysqli->query("SELECT count(id) as jumlah FROM fct");
		$datacount = $querycount->fetch_array();
	
  
        $totalData = $datacount['jumlah'];
            
        $totalFiltered = $totalData; 

        $limit = $_POST['length'];
        $start = $_POST['start'];
        $order = $columns[$_POST['order']['0']['column']];
        $dir = $_POST['order']['0']['dir'];
            
        if(empty($_POST['search']['value']))
        {            
        	$query = $mysqli->query("SELECT fct.id, paco.label as label_paco, serial_number, source, fct.created_at FROM fct LEFT JOIN PACO ON paco.id = fct.paco_id order by fct.created_at DESC LIMIT $limit OFFSET $start");
        }
        else {
            $search = $_POST['search']['value']; 
            if($search == "Not Registered") {
                $query = $mysqli->query("SELECT fct.id, paco.label as label_paco, serial_number, source, fct.created_at FROM fct LEFT JOIN PACO ON paco.id = fct.paco_id WHERE paco.label IS NULL");
                
                $querycount = $mysqli->query("SELECT count(fct.id) as jumlah FROM fct LEFT JOIN PACO ON paco.id = fct.paco_id WHERE  paco.label IS NULL");
                $datacount = $querycount->fetch_array();
                $totalFiltered = $datacount['jumlah'];
            } else {
                $query = $mysqli->query("SELECT fct.id, paco.label as label_paco, serial_number, source, fct.created_at FROM fct LEFT JOIN PACO ON paco.id = fct.paco_id WHERE paco.label LIKE '%$search%' or serial_number LIKE '%$search%' or source LIKE '%$search%' or fct.created_at LIKE '%$search%' order by $order $dir LIMIT $limit OFFSET $start");

                $querycount = $mysqli->query("SELECT count(fct.id) as jumlah FROM fct LEFT JOIN PACO ON paco.id = fct.paco_id WHERE  paco.label LIKE '%$search%' or serial_number LIKE '%$search%' or source LIKE '%$search%' or fct.created_at LIKE '%$search%'");
                $datacount = $querycount->fetch_array();
                $totalFiltered = $datacount['jumlah'];
            }
        }

        $data = array();
        if(!empty($query))
        {
            $no = $start + 1;
            while ($r = $query->fetch_array())
            {
                $nestedData['no'] = $no;
                if($r['label_paco'] == NULL) {
                    $nestedData['label_paco'] = 'Not Registered';
                } else {
                    $nestedData['label_paco'] = $r['label_paco'];
                }
                $nestedData['serial_number'] = $r['serial_number'];
                $nestedData['source'] = $r['source'];
                $nestedData['created_at'] = $r['created_at'];
                $data[] = $nestedData;
                $no++;
            }
        }
          
        $json_data = array(
                    "draw"            => intval($_POST['draw']),  
                    "recordsTotal"    => intval($totalData),  
                    "recordsFiltered" => intval($totalFiltered), 
                    "data"            => $data   
                    );
            
        echo json_encode($json_data); 

}