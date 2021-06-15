<?php

class Mebel_model extends CI_Model
{
    public function getMebel ($id = null)
    {
        if( $id === null){  
            return $this->db->get('mebel')->result_array();
        } else {
            return $this->db->get_where('mebel',['id'=> $id])->result_array();
        }
    }

    public function deleteMebel($id)
    {
        $this->db->delete('mebel',['id' => $id]);
        return $this->db->affected_rows();
    }

    public function createMebel($data)
    {
        $this->db->insert('mebel', $data);
        return $this->db->affected_rows();
    }

    public function updateMebel($data, $id)
    {
        $this->db->update('mebel', $data, ['id' =>$id]);
        return $this->db->affected_rows();
    }
}