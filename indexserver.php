<?php
// Check for the path elements
// Turn off error reporting
error_reporting(0);
// Report runtime errors
error_reporting(E_ERROR | E_WARNING | E_PARSE);
// Report all errors
error_reporting(E_ALL);
// Same as error_reporting(E_ALL);
ini_set("error_reporting", E_ALL);
// Report all errors except E_NOTICE
error_reporting(E_ALL & ~E_NOTICE);
$method = $_SERVER['REQUEST_METHOD'];
//site.com/data -> /data
$request = explode('/', trim($_SERVER['PATH_INFO'],'/'));
// echo "request===".$request;
// echo "|||";
// echo "method===".$method;
// echo "|||";
 
// $input = json_decode(file_get_contents('php://input'),true);
// $input = file_get_contents('php://input');
// var_dump($input);die*();
$link = mysqli_connect('localhost', 'id8941235_admin', 'cacastie', 'id8941235_canteen');
// $link = mysqli_connect('localhost', 'root', '', 'posyandu');
mysqli_set_charset($link,'utf8');
 
$params = preg_replace('/[^a-z0-9_]+/i','',array_shift($request));
// echo "data===".$data;
// echo "|||";
$id = array_shift($request);
// echo "id===".$id;
// echo "|||";
if ($params == 'data') {
	switch ($method) {
		case 'GET':
	    {
		    if (empty($id))
		    {
			    $sql = "select * from makanan"; 
			    // echo "select * from makanan ";break;
		    }
		    else
		    {
		         $sql = "select * from makanan where id_makanan='$id'";
		         // echo "select * from makanan where id='$id'";break;
		    }
	    }
	}
 
	$result = mysqli_query($link,$sql);
 
	if (!$result) {
		http_response_code(404);
		die(mysqli_error());
	}
	if ($method == 'GET') {
		$hasil=array();
		while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
		{
			$hasil[]=$row;
		} 
		$resp = array('status' => true, 'message' => 'Data show success', 'data' => $hasil);
	} else {
		$resp = array('status' => false, 'message' => 'Access Denied');
	}
}elseif ($method == 'POST') {
	$data = $_POST;
    if ($params == "create") {
    	$nama_makanan=$data["nama_makanan"];
	    $harga=$data["harga"];
	    $stok=$data["stok"];
	    $querycek = "SELECT * FROM makanan WHERE nama_makanan like '$nama_makanan'";
		$result=mysqli_query($link,$querycek);
		if (mysqli_num_rows($result) == 0)
		{
			$query = "INSERT INTO makanan (
			nama_makanan,
			harga,stok)
			VALUES (				
			'$nama_makanan',
			'$harga','$stok')";
			
			mysqli_query($link,$query);
			$resp = array('status' => true, 'message' => "Makanan $nama_makanan telah ditambahkan");
		} else { 
			$resp = array('status' => false, 'message' => 'Nama makanan sudah terdaftar');
		}
    } elseif ($params == "update") {
	    $id_makanan=$data["id_makanan"];        
	    $nama_makanan=$data["nama_makanan"];
	    $harga=$data["harga"];
	    $stok=$data["stok"];
	    
	    $query = "UPDATE makanan 
	    	SET nama_makanan = '$nama_makanan',
			harga = '$harga',
			stok = '$stok'
			WHERE id_makanan ='$id_makanan'";
	    if (mysqli_query($link,$query)) {
			$resp = array('status' => true, 'message' => "Makanan $nama_makanan telah diperbarui");
	    } else {
	    	$resp = array('status' => false, 'message' => "Proses Pembaruan Gagal");
	    }
    } elseif ($params == "delete") {
    	$id_makanan=$data["id_makanan"];
	    $query = "DELETE FROM makanan WHERE id_makanan = $id_makanan";
	    if (mysqli_query($link,$query)) {
	    	
		    $resp = array('status' => true, 'message' => 'Data berhasil dihapus');
	    } else {
	    	$resp = array('status' => false, 'message' => 'Data gagal dihapus');
	    }
    }    
} else {
	$resp = array('status' => false, 'message' => 'data gagal');
}
echo json_encode($resp);
mysqli_close($link);
?>