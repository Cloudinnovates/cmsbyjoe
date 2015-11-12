<?php if (!defined('BASEPATH')) exit('No direct script access allowed.');

class Pages_model extends CI_Model {

		function __construct()
		{
				parent::__construct();
		}
		
		function get_all_pages()
		{
				$this->db->order_by('sort_order', 'asc');
				return $this->db->get('pages');		
		}
		
		function get_all_published_pages()
		{
				$this->db->where('status', 1);
				$this->db->order_by('sort_order', 'asc');
				return $this->db->get('pages');
		}
		
		function get_menu_items()
		{
				$this->db->order_by('id', 'asc');
				$query = $this->db->get('menu');
				$menu = array();
				foreach ($query->result() as $item)
				{
						$menu[] = $item->name;
				}
				return $menu;
		}
		
		function get_latest_pages($status, $count)
		{
				$this->db->where('status', $status);
				$this->db->limit($count);
				$this->db->order_by('datestamp', 'desc');
				$this->db->limit($count);
				return $this->db->get('pages');
		}
		
		function update_sort_order($id, $order)
		{
				$data = array(
						'sort_order' => $order
				);
				$this->db->where('id', $id);
				$this->db->update('pages', $data);
				return $this->db->affected_rows();
		}
		
		function get_page_by_id($id)
		{
				$this->db->where('id', $id);
				return $this->db->get('pages');
		}
		
		function get_homepage_text()
		{
				$this->db->where('title', 'homepage');
				return $this->db->get('pages');
		}
		
		function get_pages_for_nav()
		{
				$this->db->select('title');
				$this->db->select('slug');
				$this->db->where('status', 1);
				$this->db->order_by('sort_order', 'asc');
				return $this->db->get('pages');
		}
		
		function get_page_by_slug($slug)
		{
				$this->db->where('slug', $slug);
				return $this->db->get('pages');
		}
		
		function get_child_pages($slug)
		{
				$this->db->select('id');
				$this->db->where('slug', $slug);
				$parent_page = $this->db->get('pages')->row()->id;
				
				$this->db->where('parent_page', $parent_page);
				$this->db->where('status', 1);
				$this->db->order_by('sort_order', 'asc');
				return $this->db->get('pages');
		}
		
		/* this is a newer function that ties to the admin_nav thing I'm working on */
		function get_section_pages($section)
		{
				$this->db->where('menu_section', $section);
				$this->db->where('status', 1);
				return $this->db->get('pages');
		}
		
		function get_related_pages($slug)
		{
				$this->db->select('parent_page');
				$this->db->where('slug', $slug);
				$parent_page = $this->db->get('pages')->row()->parent_page;
				if ($parent_page > 0)
				{
						$this->db->where('parent_page', $parent_page);
						$this->db->where('status', 1);
						$this->db->order_by('sort_order', 'asc');
						return $this->db->get('pages');
				}
				else
				{
						return FALSE;
				}
		}
		
		function get_parent_pages()
		{
				$this->db->where('parent_page', 0);
				return $this->db->get('pages');
		}
		
		function delete_page($id)
		{
				$this->db->where('id', $id);
				$this->db->delete('pages');
				return $this->db->affected_rows();
		}
		
		function insert_page($data)
		{
				$this->db->insert('pages', $data);
				return $this->db->insert_id();
		}
		
		function update_page($id, $data)
		{
				$this->db->where('id', $id);
				$this->db->update('pages', $data);
				return $this->db->affected_rows();
		}
		
		function get_navigation_pages()
		{
				$nav_sections = array();
				$this->db->where('menu_section >', '');
				$this->db->select('menu_section');
				$this->db->distinct();
				$cats_query = $this->db->get('pages');
				
				foreach ($cats_query->result() as $cat)
				{
						$nav_sections[$cat->menu_section] = array();
						
						$this->db->where('menu_section', $cat->menu_section);
						$this->db->order_by('sort_order', 'asc');
						$pages = $this->db->get('pages');
						
						foreach ($pages->result() as $page)
						{
								$nav_sections[$cat->menu_section][$page->menu_label] = $page->slug;
						}					
				}
				return $nav_sections;
				
				//print_r($nav_sections);
		}
		
		function get_all_slides()
		{
				$this->db->order_by('sort_order', 'asc');
				return $this->db->get('slides');
		}
		
		function get_homepage_slides()
		{
				$this->db->order_by('sort_order', 'asc');
				return $this->db->get('slides');
		}
		
		function insert_slide($record)
		{
				$this->db->insert('slides', $record);
				return $this->db->insert_id();
		}
		
		function update_slide($id, $record)
		{
				$this->db->where('id', $id);
				$this->db->update('slides', $record);
				return $this->db->affected_rows();
		}
		
		function delete_slide($id)
		{
				$this->db->where('id', $id);
				$this->db->delete('slides');
				return $this->db->affected_rows();
		}
		
		function get_slide_by_id($id)
		{
				$this->db->where('id', $id);
				return $this->db->get('slides');
		}
		
		function update_slide_sort_order($id, $order)
		{
				$data = array(
						'sort_order' => $order
				);
				$this->db->where('id', $id);
				$this->db->update('slides', $data);
				return $this->db->affected_rows();
		}
		
}

/* End of file pages_model.php */
/* Location: ./application/models/pages_model.php */