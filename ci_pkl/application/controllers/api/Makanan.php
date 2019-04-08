<?php

defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
/** @noinspection PhpIncludeInspection */
require APPPATH . '/libraries/REST_Controller.php';

/**
 * This is an example of a few basic user interaction methods you could use
 * all done with a hardcoded array
 *
 * @package         CodeIgniter
 * @subpackage      Rest Server
 * @category        Controller
 * @author          Phil Sturgeon, Chris Kacerguis
 * @license         MIT
 * @link            https://github.com/chriskacerguis/codeigniter-restserver
 */
class Makanan extends \Restserver\Libraries\REST_Controller {


    function __construct()
    {
        // Construct the parent class
        parent::__construct();

        // Configure limits on our controller methods
        // Ensure you have created the 'limits' table and enabled 'limits' within application/config/rest.php
        $this->methods['users_get']['limit'] = 500; // 500 requests per hour per user/key
        $this->methods['users_post']['limit'] = 100; // 100 requests per hour per user/key
        $this->methods['users_delete']['limit'] = 50; // 50 requests per hour per user/key
        $this->load->model('crud');
    }

    public function index_get()
    {
        $id_makanan = $this->get('id_makanan');

        // If the id parameter doesn't exist return all the users

        if ($id_makanan === NULL)
        {
            // Check if the users data store contains users (in case the database result returns NULL)
            $data = $this->crud->get('makanan');

            if (!empty($data))
            {
                // Set the response and exit
                $this->response($data, \Restserver\Libraries\REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
            }
            else
            {
                // Set the response and exit
                $this->response([
                    'status' => FALSE,
                    'message' => 'No users were found'
                ], \Restserver\Libraries\REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
            }
        }

        // Find and return a single record for a particular user.
        else {
            $id_makanan = (int) $id_makanan;

            // Validate the id.
            if ($id_makanan <= 0)
            {
                // Invalid id, set the response and exit.
                $this->response(NULL, \Restserver\Libraries\REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
            } else {
                $data = $this->crud->get('makanan', array('id_makanan' => $id_makanan));
            }

            // Get the user from the array, using the id as key for retrieval.
            // Usually a model is to be used for this.

            if (!empty($data))
            {
                $this->set_response($data, \Restserver\Libraries\REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
            }
            else
            {
                $this->set_response([
                    'status' => FALSE,
                    'message' => 'Data of the Cacastie could not be found'
                ], \Restserver\Libraries\REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
            }
        }
    }

    public function add_post()
    {
        $data = [
            'nama_makanan' => $this->post('nama_makanan'),
            'harga' => $this->post('harga'),
            'id_penjual' => $this->post('id_penjual')
        ];

        $insert = $this->crud->insert('makanan', $data);

        if ($insert) {
            $this->set_response(['message' => 'Data berhasil ditambahkan'], \Restserver\Libraries\REST_Controller::HTTP_CREATED); // CREATED (201) being the HTTP response code
        } else {
            $this->response(['message' => 'Data gagal ditambahkan'], \Restserver\Libraries\REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
        }
    }

    public function delete_get()
    {
        $id_makanan = (int) $this->get('id_makanan');
        $data = $this->crud->delete('makanan', ['id_makanan' => $id_makanan]);

        if ($data) {
            $message = [
                'id_makanan' => $id_makanan,
                'message' => 'Deleted the resource'
            ];

            $this->set_response($message, \Restserver\Libraries\REST_Controller::HTTP_OK);
        } else {
            $this->response(['message' => 'Data gagal dihapus'], \Restserver\Libraries\REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
        }
        
    }

    public function edit_post()
    {
        $id_makanan     = $this->post('id_makanan');
        $nama_makanan   = $this->post('nama_makanan');
        $harga = $this->post('harga');
        $id_penjual = $this->post('id_penjual');
        $cek    = $this->crud->update('makanan', ['nama_makanan' => $nama_makanan, 'harga' => $harga, 'id_penjual' => $id_penjual], ['id_makanan' => $id_makanan]);

        if ($cek) {
            $this->set_response(['status' => TRUE, 'message' => 'Data makanan berhasil diupdate'], \Restserver\Libraries\REST_Controller::HTTP_CREATED); 
        } else {
            $this->set_response([
                    'status' => FALSE,
                    'message' => 'Data makanan tidak ditemukan'
                ], \Restserver\Libraries\REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        }

    }
}
