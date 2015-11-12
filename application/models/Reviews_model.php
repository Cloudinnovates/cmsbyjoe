<?php if (!defined('BASEPATH')) exit('No direct script access allowed.');

class Reviews_model extends CI_Model {

		function __construct()
		{
				parent::__construct();
		}
		
		function get_public_reviews()
		{
				$reviews = FALSE;

				$this->db->order_by('sort_order', 'asc');
				$query = $this->db->get('reviews');
				
				if ($query->num_rows() > 0)
				{
						$reviews = $query;
				}
				
				return $reviews;
		}
		
		function get_all_reviews()
		{
				$this->db->order_by('sort_order', 'asc');
				return $this->db->get('reviews');
		}
		
		function update_sort_order($id, $order)
		{
				$data = array(
						'sort_order' => $order
				);
				$this->db->where('id', $id);
				$this->db->update('reviews', $data);
				return $this->db->affected_rows();
		}
		
}


/* End of file reviews_model.php */
/* Location: ./application/models/reviews_model.php */