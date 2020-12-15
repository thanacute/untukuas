<?php

use Restserver\Libraries\REST_Controller;

defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
/** @noinspection PhpIncludeInspection */

//To Solve File REST_Controller not found
require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';


class Mahasiswa extends CI_Controller {

    use REST_Controller {
        REST_Controller::__construct as private __resTraitConstruct;
    }

    function __construct()
    {
        parent::__construct();
        $this->__resTraitConstruct();

        $this->load->model('Mahasiswa_model', 'mahasiswa');
    }

    public function index_get()
    {
        $id = $this->get('id');
        if ($id === null){
            $mahasiswa = $this->mahasiswa->getMahasiswa();
        }
        else{
            $mahasiswa = $this->mahasiswa->getMahasiswa($id);
        }
        
        if($mahasiswa){
            $this->response([
                'status' => true,
                'data' => $mahasiswa
            ], 200);
        }
        else{
            $this->response([
                'status' => false,
                'data' => 'id not found'
            ], 404);
        }
        }

        public function index_delete()
        {
            $id = $this->delete('id');

            if ($id === null){
                $this->response([
                    'status' => false,
                    'data' => 'no id'
                ], 400);
            }
            else{
                if ($this->mahasiswa->deleteMahasiswa($id) > 0){
                    $this->response([
                        'status' => true,
                        'data' => $id,
                        'message' => 'deleted'
                    ], 204);
                }
                else{
                    $this->response([
                        'status' => false,
                        'data' => 'no id detected'
                    ], 400);
                }
            }
        }


        public function index_post()
        {
            $data = [
                'nrp' => $this->post('nrp'),
                'nama' => $this->post('nama'),
                'email' => $this->post('email'),
                'jurusan' => $this->post('jurusan')
            ];

            if ($this->mahasiswa->createMahasiswa($data) > 0){
                $this->response([
                    'status' => true,
                    'message' => 'added'
                ], 200);
            }
            else{
                $this->response([
                    'status' => false,
                    'message' => 'failed'
                ], 400);
            }
        }


        public function index_put()
        {
            $id = $this->put('id');
            $data = [
                'nrp' => $this->put('nrp'),
                'nama' => $this->put('nama'),
                'email' => $this->put('email'),
                'jurusan' => $this->put('jurusan')
            ];
            if ($this->mahasiswa->updateMahasiswa($data, $id) > 0){
                $this->response([
                    'status' => true,
                    'message' => 'updated'
                ], 200);
            }
            else{
                $this->response([
                    'status' => false,
                    'message' => 'failed'
                ], 400);
            }
        }
    }
