<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class menu_m extends CI_Model {

	protected $table = 'menu';
	protected $primary_key = 'menu_id';

	public function get_menu_items($menu_set_id = null)
	{
		$items = $this->get_top_items($menu_set_id);
		if($items !== null){
			foreach ($items as $key => $item) {
				$item->submenu = $this->iterate_submenu_items($item);		
			}
		} else {
			$items = null;			
		}

		return $items;
	}

	public function get_admin_menu_items()
	{
		return $this->get_menu_items(1);
	}

	public function get_max_depth($menu_set_id = null)
	{
		$this->db->where($this->table.'.deleted_at is null');
		$sub_levels = $this->db
			->where('menu_set_id',$menu_set_id)
			->select_max('menu_level')
			->get($this->table);
		if($sub_levels = $sub_levels->row()){
			$sub_levels = !empty($sub_levels->menu_level) ? $sub_levels->menu_level : 0; 
		} else {
			$sub_levels = 0;
		}

		return $sub_levels;
	}

	public function get_top_items($menu_set_id)
	{
		$menu_items = $this->db
			->where($this->table.'.deleted_at is null')
			->where('menu_set_id',$menu_set_id)
			->where('parent_menu_id',0)
			->order_by('order_num',"asc")
			->get($this->table);

		if($menu_items->num_rows() > 0){
			$menu_items = $menu_items->result();
		} else {
			$menu_items = null;
		}

		return $menu_items;
	}

	public function get_submenu_items($parent_menu)
	{
		$sub_items = $this->db
			->where($this->table.'.deleted_at is null')
			->where('parent_menu_id',$parent_menu->menu_id)
			->order_by('order_num',"asc")
			->get($this->table);
		if($sub_items->num_rows() > 0 ){
			$sub_items = $sub_items->result();
		} else {
			$sub_items = null;
		}

		return $sub_items;
	}

	public function iterate_submenu_items($menu)
	{
		$submenu = $this->get_submenu_items($menu);
		if($submenu !== null){
			foreach($submenu as $key => $sub)
			$sub->submenu = $this->iterate_submenu_items($sub);	
		}

		return $submenu;
	}

}