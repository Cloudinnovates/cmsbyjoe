<?php if (!defined('BASEPATH')) exit('No direct script access allowed.');

class Posts_model extends CI_Model {

		function __construct()
		{
				parent::__construct();
		}
		
		function get_posts($limit = FALSE, $category = 'news')
		{
				$this->db->order_by('datestamp', 'desc');
				$this->db->order_by('id', 'desc');
				return $this->db->get('posts', $limit);
		}
		
		function get_featured_post($limit)
		{
				// featured post
				$this->db->where('featured', 1);
				$this->db->order_by('datestamp', 'desc');
				return $this->db->get('posts', $limit);
		}
		
		function get_blog_categories()
		{
				$this->db->order_by('name', 'asc');
				return $this->db->get('categories');
		}
		
		function get_all_posts($category = FALSE)
		{
				$this->db->order_by('datestamp', 'desc');
				return $this->db->get('posts');
		}
		
		function get_published_posts($category = FALSE)
		{
				if($category)
				{
						$this->db->where('category', $category);
				}
				$this->db->where('published', 1);
				$this->db->order_by('datestamp', 'desc');
				return $this->db->get('posts');
		}
		
		function get_recent_posts($limit, $category = FALSE)
		{
				if ($category)
				{
						$this->db->where('category', $category);
				}
				$this->db->where('published', 1);
				$this->db->order_by('datestamp', 'desc');
				$this->db->order_by('id', 'desc');
				return $this->db->get('posts', $limit);
		}
		
		function get_recent_posts_and_comments($limit = FALSE, $category = 'news')
		{
				if ( ! $limit)
				{
						$limit = 2;
				}
				
				$this->db->select('posts.*');
				$this->db->select('(SELECT COUNT(*) FROM comments WHERE comments.article_id = posts.id) AS comments', FALSE); 
				//(SELECT count(*)  FROM (`users`))  AS userCount FROM (`users`)  WHERE `users`.`status` =  'active'
				$this->db->where('published', 1);
				if ($category)
				{
						$this->db->where('category', $category);
				}
				$this->db->order_by('datestamp', 'desc');
				$this->db->order_by('id', 'desc');
				return $this->db->get('posts', $limit);
		}
		
		function get_posts_and_comments($limit = FALSE, $category = 'news')
		{		
				$this->db->select('posts.*');
				$this->db->select('(SELECT COUNT(*) FROM comments WHERE comments.article_id = posts.id) AS comments', FALSE); 
				//(SELECT count(*)  FROM (`users`))  AS userCount FROM (`users`)  WHERE `users`.`status` =  'active'
				$this->db->where('published', 1);
				if ($category)
				{
						$this->db->where('category', $category);
				}
				$this->db->order_by('datestamp', 'desc');
				$this->db->order_by('id', 'desc');
				return $this->db->get('posts', $limit);
		}
		
		function get_news_box_headlines($limit = FALSE, $category = 'news')
		{
				$this->db->select('posts.*');
				//$this->db->select('(SELECT COUNT(*) FROM comments WHERE comments.article_id = articles.id) AS comments', FALSE); 
				//(SELECT count(*)  FROM (`users`))  AS userCount FROM (`users`)  WHERE `users`.`status` =  'active'
				$this->db->where('published', 1);
				if ($category)
				{
						$this->db->where('category', $category);
				}
				$this->db->order_by('datestamp', 'desc');
				$this->db->order_by('id', 'desc');
				return $this->db->get('posts', $limit);
		}

		
		function get_feed_posts()
		{
				$this->db->where('published', 1);
				$this->db->order_by('datestamp', 'desc');
				return $this->db->get('posts');
		}
		
		function get_latest_posts($status, $count, $category = FALSE)
		{
				if ($category)
				{
						$this->db->where('category', $category);
				}
				$this->db->where('published', $status);
				$this->db->order_by('datestamp', 'desc');
				$this->db->limit($count);
				return $this->db->get('posts');
		}	
		
		function insert_post($data)
		{
				$this->db->insert('posts', $data);
				return $this->db->insert_id();
		}
		
		function update_post($id, $data)
		{
				$this->db->where('id', $id);
				$this->db->update('posts', $data);
		}
		
		function get_post_by_id($id)
		{
				$this->db->where('id', $id);
				$query = $this->db->get('posts');
				return ($query->num_rows() > 0) ? $query : FALSE;				
		}
		
		function get_post_by_slug($slug)
		{
				$this->db->where('slug', $slug);
				return $this->db->get('posts');
		}			
		
		// sitebyjoe.com/posts/2010/02/12/slug-goes-here
		function get_post_by_date_slug($year, $month, $day, $slug)
		{
				$this->db->where('date(datestamp)', "$year/$month/$day");
				$this->db->where('slug', $slug);
				return $this->db->get('posts');
		}		
		
		function get_all_comments()
		{
				$this->db->order_by('id', 'desc');
				return $this->db->get('comments');
		}
		
		function get_post_comments($id)
		{
				$this->db->where('article_id', $id);
				$this->db->order_by('timestamp', 'asc');
				return $this->db->get('comments');
		}
		
		function add_comment($record)
		{
				$this->db->insert('comments', $record);
				return $this->db->insert_id();
		}
		
		function edit_comment($id, $record)
		{
				$this->db->where('id', $id);
				$this->db->update('comments');
		}
		
		function delete_comment($id)
		{
				$this->db->where('id', $id);
				return $this->db->delete('comments');
		}
		
}


/* End of file posts_model.php */
/* Location: ./application/models/posts_model.php */