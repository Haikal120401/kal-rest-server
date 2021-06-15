<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Mebel extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Mebel_model','mebel');

    }

    public function index_get ()
    {
        $id = $this->get('id');
        if($id===null){
            $mebel = $this->mebel->getMebel();
        }else{
            $mebel = $this->mebel->getMebel($id);
        }
        
        if ($mebel) {
            $this->set_response([
                'status' => true,
                'data' => $mebel
            ], REST_Controller::HTTP_OK);
        } else {
            $this->set_response([
                'status' => false,
                'message' => 'id not found'
            ], REST_Controller::HTTP_NOT_FOUND);
        }

    }

    public function index_delete()
    {
        $id = $this->delete('id');

        if ($id === null) {
            $this->set_response([
                'status' => false,
                'message' => 'masukkan terlebih dahulu id'
            ], REST_Controller::HTTP_BAD_REQUEST);
        } else {
            if ($this->mebel->deleteMebel($id) > 0) {
                $this->set_response([
                    'status' => true,
                    'id' => $id,
                    'message' => 'data terhapus'
                ], REST_Controller::HTTP_OK);
            } else {
                $this->set_response([
                    'status' => false,
                    'message' => 'id tidak ditemukan'
                ], REST_Controller::HTTP_BAD_REQUEST);
            }
        }
    }


    public function index_post()
    {
        $data = [
            'nama' => $this->post('nama'),
            'bahan' => $this->post('bahan'),
            'merk' => $this->post('merk'),
            'harga' => $this->post('harga')
        ];

        // masukkan ke db
        if ( $this->mebel->createMebel($data) > 0 ) {
            $this->set_response([
                'status' => true,
                'message' => 'data baru telah ditambahkan'
            ], REST_Controller::HTTP_CREATED);
        } else {
            $this->set_response([
                'status' => false,
                'message' => 'Gagal menambahkan data'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }


    public function index_put()
    {
        $id = $this->put('id');
        $data = [
            'nama' => $this->put('nama'),
            'bahan' => $this->put('bahan'),
            'merk' => $this->put('merk'),
            'harga' => $this->put('harga')
        ];

        if ( $this->mebel->updateMebel($data, $id) > 0 ) {
            $this->set_response([
                'status' => true,
                'message' => 'data berhasil di ubah'
            ], REST_Controller::HTTP_OK);
        } else {
            $this->set_response([
                'status' => false,
                'message' => 'failed to update data!'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }

}