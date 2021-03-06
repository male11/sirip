<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class M_intensitas extends CI_Model
{

    public $table = 'mstr_intensitas';
    public $id = 'ID_INTENSITAS';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json() {
        $this->datatables->select('ID_INTENSITAS,DESCP_INTENSITAS,POINT_INTENSITAS');
        $this->datatables->from('mstr_intensitas');
        //add this line for join
        //$this->datatables->join('table2', 'mstr_intensitas.field = table2.field');
        $this->datatables->add_column('action', anchor(site_url('admin/intensitas/update/$1'),'<i class="fa fa-edit fa-lg" title="Edit" style="color:orange;">
         </i>')."&nbsp;&nbsp;&nbsp;&nbsp"
        .anchor(site_url('admin/intensitas/delete/$1'),'<i class="fa fa-trash fa-lg" title="Hapus" style="color:red;">
         </i>','onclick="javasciprt: return confirm(\'Hapus Data ini ?\')"'), 'ID_INTENSITAS');
        return $this->datatables->generate();
    }

    // get all
    function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }

    // get total rows
    function total_rows($q = NULL) {
        $this->db->like('ID_INTENSITAS', $q);
	$this->db->or_like('DESCP_INTENSITAS', $q);
	$this->db->or_like('POINT_INTENSITAS', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('ID_INTENSITAS', $q);
	$this->db->or_like('DESCP_INTENSITAS', $q);
	$this->db->or_like('POINT_INTENSITAS', $q);
	$this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    // insert data
    function insert($data)
    {
        $this->db->insert($this->table, $data);
    }

    // update data
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }

}

/* End of file M_intensitas.php */
/* Location: ./application/models/M_intensitas.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-04-27 21:56:58 */
/* http://harviacode.com */
