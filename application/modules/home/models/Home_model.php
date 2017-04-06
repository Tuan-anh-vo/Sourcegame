<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Home_model extends MY_Model {

    public function getVideo(){

        $this->db->select('content');

        $this->db->where('id',4);

        $this->db->limit(1);

        return $this->db->get('admin_nqt_settings')->row();

    }

}

?>