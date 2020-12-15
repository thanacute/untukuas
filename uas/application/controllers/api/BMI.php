<?php

use Restserver\Libraries\REST_Controller;

defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
/** @noinspection PhpIncludeInspection */

//To Solve File REST_Controller not found
require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';
require APPPATH . 'models/classes/BMIcalculate.php';


class BMI extends CI_Controller {

    use REST_Controller {
        REST_Controller::__construct as private __resTraitConstruct;
    }


    protected $tinggi;
	protected $berat;

    function __construct()
    {
        parent::__construct();
        $this->__resTraitConstruct();

        $this->load->model('BMI_model', 'BMI');

    }


    public function index_get()
    {
        $id = $this->get('id');
        if ($id === null){
            $BMI = $this->BMI->getBMI();
        }
        else{
            $BMI = $this->BMI->getBMI($id);
        }
        
        if($BMI){
            $this->response([
                'status' => true,
                'data' => $BMI
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
                if ($this->BMI->deleteBMI($id) > 0){
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
                'id' => $this->post('id'),
                'tinggi' => $this->post('tinggi'),
                'berat' => $this->post('berat')
            ];
            

            if ($this->BMI->createBMI($data) > 0){
                $this->response([
                    'status' => true,
                    'message' => 'data added'
                ], 200);
            }
            else{
                $this->response([
                    'status' => false,
                    'message' => 'failed to add data'
                ], 400);
            }
        }

        public function index_put()
        {
            $id = $this->put('id');
            
            $data = [
                'tinggi' => $this->put('tinggi'),
                'berat' => $this->put('berat'),
                'nama' => $this->put('nama')
            ];
            
            if ($this->BMI->updateBMI($data, $id) > 0){
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
