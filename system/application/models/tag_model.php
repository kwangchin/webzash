<?php

class Tag_model extends Model {

	function Tag_model()
	{
		parent::Model();
	}

	function get_all_tags($allow_none = TRUE)
	{
		$options = array();
		if ($allow_none)
			$options[0] = "(None)";
		$tag_q = $this->db->query('SELECT * FROM tags ORDER BY title ASC');
		foreach ($tag_q->result() as $row)
		{
			$options[$row->id] = $row->title;
		}
		return $options;
	}

	function show_voucher_tag($tag_id)
	{
		if ($tag_id < 1)
			return "";
		$tag_q = $this->db->query("SELECT * FROM tags WHERE id = ?", array($tag_id));
		if ($tag = $tag_q->row())
		{
			return "<span class=\"tags\" style=\"color:#" . $tag->color . "; background-color:#" . $tag->background . "\">" . $tag->title . "</span>";
		}
		return "";
	}

	function show_voucher_tag_link($tag_id)
	{
		if ($tag_id < 1)
			return "";
		$tag_q = $this->db->query("SELECT * FROM tags WHERE id = ?", array($tag_id));
		if ($tag = $tag_q->row())
		{
			return "<span class=\"tags\" style=\"color:#" . $tag->color . "; background-color:#" . $tag->background . "\">" . anchor("voucher/show/tag/" . $tag->id , $tag->title, array('style' => 'text-decoration:none;color:#' . $tag->color . ';')) . "</span>";
		}
		return "";
	}
	
	function tag_name($tag_id)
	{
		if ($tag_id < 1)
			return "";
		$tag_q = $this->db->query("SELECT * FROM tags WHERE id = ?", array($tag_id));
		if ($tag = $tag_q->row())
		{
			return $tag->title;
		}
		return "";
	}
}
