<?php
if ( ! defined('ABSPATH')) exit;  // if direct access

remove_action('qa_question_submitted', 'qa_question_submitted_notification', 50, 2);

add_action('qa_question_submitted', 'qa_question_submitted_notification_custom', 50, 2);

function qa_question_submitted_notification_custom($question_ID, $post_data)
{

    $q_category = get_the_terms($question_ID, 'question_cat');

    $term_list = wp_get_post_terms($question_ID, 'question_cat', array('fields' => 'all'));


    if (isset($term_list[0]->slug) && $term_list[0]->slug === 'slug_one') { // 'slug_one' category slug
        $subscriber_id = 13; // modaretor user ID

    } else if(
        isset($term_list[0]->slug) && $term_list[0]->slug === 'slug_two') { // 'slug_two' category slug
        $subscriber_id = 14; // modaretor user ID
    }
    else{
        $admin_email = get_option('admin_email');
        $admin = get_user_by('email', $admin_email);
        $subscriber_id = $admin->ID;

    }



    $admin_email = get_option('admin_email');
    $admin = get_user_by('email', $admin_email);
    $user_id = get_current_user_id();

    $notification_data = array();


    $notification_data['user_id'] = $user_id;
    $notification_data['q_id'] = $question_ID;
    $notification_data['a_id'] = '';
    $notification_data['c_id'] = '';
    $notification_data['subscriber_id'] = $subscriber_id;
    $notification_data['action'] = 'new_question';

    do_action('qa_action_notification_save', $notification_data);
}