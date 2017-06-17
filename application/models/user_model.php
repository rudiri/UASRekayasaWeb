<?php
class User_model extends CI_Model{

    function simpan_user()
    {
        $simpan_data=array(
            'nama_lengkap'  => $this->input->post('nama_lengkap'),
            'username'      => $this->input->post('username'),
            'password'      => md5($this->input->post('password')),
            'email'         => $this->input->post('email'),
            'alamat'        => $this->input->post('alamat')
       );
        $simpan = $this->db->insert('user', $simpan_data);
        return $simpan;
    }
 
    function get_user_all()
    {
        $query=$this->db->query("SELECT * FROM user ORDER BY id_user DESC");
        return $query->result();
    }

    function delete_user($id_user)
    {
        $query=$this->db->query("DELETE FROM user WHERE id_user='$id_user'");
    }
 
    function edit_user($id_user)
    {
        $q="SELECT * FROM  user WHERE id_user='$id_user'";
        $query=$this->db->query($q);
        return $query->row();
    }
 
    function simpan_edit_user($id_user, $nama_lengkap, $username, $password, $email, $alamat)
    {
        $data = array(
            'id_user'        => $id_user,
            'nama_lengkap'   => $nama_lengkap,
            'username'       => $username,
            'password'       => $password,
            'email'          => $email,     
            'alamat'         => $alamat
        );
        $this->db->where('id_user', $id_user);
        $this->db->update('user', $data);    
    }

    function validate()
        { 
            $this->db->where('username', $this->input->post('username'));
            $this->db->where('password', m23($this->input->post('password')));
            $query = $this->db->get('user');
 
            if($query->num_rows == 1)
            {
                return TRUE;
            }
    }
}