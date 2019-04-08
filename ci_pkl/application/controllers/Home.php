<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	public function index()
	{
		$c = curl_init();
		curl_setopt($c, CURLOPT_URL, "https://turreted-worries.000webhostapp.com/ci_pkl/api/makanan");
		curl_setopt($c, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($c, CURLOPT_FOLLOWLOCATION, TRUE);
		curl_setopt($c, CURLOPT_HEADER, FALSE);
		curl_setopt($c, CURLOPT_CUSTOMREQUEST, "GET");

		$data = curl_exec($c);

		$data = array(
			'data' => json_decode($data),
			'page' => 'data'
		);

		$this->load->view('master',$data);
	}

	public function add()
	{
		$submit	= $this->input->post('submit');
		$nama_makanan	= $this->input->post('nama_makanan');
		$harga = $this->input->post('harga');
		$id_penjual = $this->input->post('id_penjual');

		if ($submit) {
			$param = [
				
				'nama_makanan' 		=> $nama_makanan,
				'harga'	=> $harga,
				'id_penjual'=> $id_penjual
			];

			$c = curl_init();
			curl_setopt($c, CURLOPT_URL, "https://turreted-worries.000webhostapp.com/ci_pkl/api/makanan/add");
			curl_setopt($c, CURLOPT_RETURNTRANSFER, TRUE);
			curl_setopt($c, CURLOPT_FOLLOWLOCATION, TRUE);
			curl_setopt($c, CURLOPT_HEADER, FALSE);
			curl_setopt($c, CURLOPT_CUSTOMREQUEST, "POST");
			curl_setopt($c, CURLOPT_POST, TRUE);
			curl_setopt($c, CURLOPT_POSTFIELDS, http_build_query($param));

			$data = curl_exec($c);

 			header('location:'.base_url());
		}

		$this->load->view('master',['page' => 'add']);
	}

	public function edit()
	{
		$id_makanan 	= $this->uri->segment(3);
		$submit	= $this->input->post('submit');

		if ($submit) {
			$nama_makanan	= $this->input->post('nama_makanan');
			$harga = $this->input->post('harga');
			$id_penjual = $this->input->post('id_penjual');
			$id_makanan 	= $this->input->post('id_makanan');

			$param = [
				'id_makanan'		=> $id_makanan,
				'nama_makanan' 		=> $nama_makanan,
				'harga'	=> $harga,
				'id_penjual ' => $id_penjual
			];

			$c = curl_init();
			curl_setopt($c, CURLOPT_URL, "https://turreted-worries.000webhostapp.com/ci_pkl/api/makanan/edit");
			curl_setopt($c, CURLOPT_RETURNTRANSFER, TRUE);
			curl_setopt($c, CURLOPT_FOLLOWLOCATION, TRUE);
			curl_setopt($c, CURLOPT_HEADER, FALSE);
			curl_setopt($c, CURLOPT_CUSTOMREQUEST, "POST");
			curl_setopt($c, CURLOPT_POST, TRUE);
			curl_setopt($c, CURLOPT_POSTFIELDS, http_build_query($param));

			$data = curl_exec($c);

			print_r(json_decode($data));

			header('location:'.base_url());
		}

		$c = curl_init();
		curl_setopt($c, CURLOPT_URL, "https://turreted-worries.000webhostapp.com/ci_pkl/api/makanan?id_makanan=$id_makanan");
		curl_setopt($c, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($c, CURLOPT_FOLLOWLOCATION, TRUE);
		curl_setopt($c, CURLOPT_HEADER, FALSE);
		curl_setopt($c, CURLOPT_CUSTOMREQUEST, "GET");

		$data = curl_exec($c);

		$data = array(
			'data' => json_decode($data),
			'page' => 'update'
		);

		$this->load->view('master', $data);
	}

	public function delete()
	{
		$id_makanan = $this->uri->segment(3);

		$c = curl_init();
		curl_setopt($c, CURLOPT_URL, "https://turreted-worries.000webhostapp.com/ci_pkl/api/makanan/delete?id_makanan=$id_makanan");
		curl_setopt($c, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($c, CURLOPT_FOLLOWLOCATION, TRUE);
		curl_setopt($c, CURLOPT_HEADER, FALSE);
		curl_setopt($c, CURLOPT_CUSTOMREQUEST, "GET");

		$data = curl_exec($c);

		header('location:'.base_url());
	}
}
