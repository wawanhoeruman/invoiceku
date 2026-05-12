<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function log_activity($activity, $description = '')
{
    $CI =& get_instance();

    if (!$CI->db) {
        $CI->load->database();
    }

    $user_id = $CI->session->userdata('user_id');

    $data = [
        'user_id'    => $user_id,
        'activity'   => $activity,
        'description'=> $description,
        'ip_address' => $CI->input->ip_address(),
        'user_agent' => $CI->input->user_agent(),
        'created_at' => date('Y-m-d H:i:s')
    ];

    $CI->db->insert('logs', $data);
}