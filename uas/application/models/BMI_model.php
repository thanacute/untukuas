<?php

class BMI_model extends CI_Model
{
    public function getBMI($id = null){

        if ($id === null ){
            return $this->db->get('test')->result_array();
        } 
        else{
            return $this->db->get_where('test', ['id' => $id])->result_array();
        }
    }

    public function deleteBMI($id){
        $this->db->delete('test', ['id' => $id]);
        return $this->db->affected_rows();
    }

    public function createBMI($data){
        $this->db->insert('test', $data);
        return $this->db->affected_rows();
    }

    public function updateBMI ($data, $id){
        $this->db->update('test', $data, ['id' => $id]);
        return $this->db->affected_rows();
    }
   
}