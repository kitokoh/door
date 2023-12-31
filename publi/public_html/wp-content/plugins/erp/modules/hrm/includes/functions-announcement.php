<?php

/**
 * Assign / Send announcements to the employee(s)
 *
 * @param int    $post_id
 * @param string $type
 * @param array  $employees
 *
 * @return void
 */
function erp_hr_assign_announcements_to_employees( $post_id, $type, $selected = [] ) {
    $post      = get_post( $post_id );
    $post_type = $post->post_status;

    $data      = [];

    if ( $type == 'by_department' ) {
        update_post_meta( $post_id, '_announcement_department', $selected );

        foreach ( $selected as $department ) {
            $data[] = erp_hr_get_employees( [
                 'no_object'  => true,
                 'department' => $department,
                 'number'     => '-1',
            ] );
        }

        $selected = format_data_as_employee( $data );
    }

    if ( $type == 'by_designation' ) {
        update_post_meta( $post_id, '_announcement_designation', $selected );

        foreach ( $selected as $designation ) {
            $data[] = erp_hr_get_employees( [
                 'no_object'   => true,
                 'designation' => $designation,
                 'number'      => '-1',
            ] );
        }

        $selected = format_data_as_employee( $data );
    }

    update_post_meta( $post_id, '_announcement_type', $type );
    update_post_meta( $post_id, '_announcement_selected_user', $selected );

    if ( $type == 'all_employee' ) {
        $empls = erp_hr_get_employees( [ 'no_object' => true, 'number' => '-1' ] );

        if ( $empls ) {
            foreach ( $empls as $user ) {
                $selected[] = (int) $user->user_id;
            }
        }
    }

    do_action( 'hr_annoucement_save', $post_id, $selected );

    $announces_object = \WeDevs\ERP\HRM\Models\Announcement::where( 'post_id', $post_id )->whereIn( 'user_id', $selected );

    $announcements      = $announces_object->get();
    $existing_employees = array_pluck( $announcements->toArray(), 'user_id' );

    $new_employees = array_diff( $selected, $existing_employees );

    $data = [];

    foreach ( $new_employees as $item ) {
        $data[] = [
            'user_id'      => $item,
            'post_id'      => $post_id,
            'status'       => 'unread',
            'email_status' => ( $post_type == 'publish' ) ? 'sent' : 'not_sent',
        ];
    }

    \WeDevs\ERP\HRM\Models\Announcement::insert( $data );

    // Send email only when the announcement is published & send to not recieved yet employees
    if ( $post_type == 'publish' ) {
        $not_recieved_employees = array_pluck( $announcements->where( 'email_status', 'not_sent' )->toArray(), 'user_id' );
        $recipients             = array_unique( array_merge( $new_employees, $not_recieved_employees ) );
        $employee_chunks        = array_chunk( $recipients, 100 );

        $announces_object->update( ['email_status' => 'sent'] );

        $count = 0;

        foreach ( $employee_chunks as $employee_chunk ) {
            wp_schedule_single_event( time() + ( 300 * $count ), 'erp_hr_schedule_announcement_email', [ $employee_chunk, $post_id ] );

            $count ++;
        }
    }

    do_action( 'hr_announcement_insert_assignment', $selected, $post_id );
}

/**
 * Process ids and return a flat array of unique user id
 *
 * @param array $data [description]
 *
 * @return array unique user id
 */
function format_data_as_employee( $data ) {
    $temp_users = [];

    foreach ( $data as $employee ) {
        foreach ( $employee as $employee_data ) {
            $temp_users[] = $employee_data->user_id;
        }
    }

    return array_unique( $temp_users );
}

/**
 * Send Announcement Email
 *
 * @param array $employee_ids
 * @param int   $post_id
 *
 * @return void
 */
function erp_hr_send_announcement_email( $employee_ids, $post_id ) {
    $announcement_email = new \WeDevs\ERP\HRM\Emails\HRAnnouncementEmail();

    $announcement_email->trigger( $employee_ids, $post_id );
}

/**
 * Get all the announcements having a status and in a date range
 *
 * @since 1.10.0
 *
 * @param array query arguments
 *
 * @return array list of announcements
 */
function erp_hr_get_announcements( $args = [] ) {
    $defaults = [
        'numberposts'     => 20,
        'offset'          => 0,
        'orderby'         => 'post_date',
        'order'           => 'DESC',
        'post_type'       => 'erp_hr_announcement',
    ];

    $args = wp_parse_args( $args, $defaults );

    $announcements = get_posts( $args );

    return $announcements;
}

/**
 * Get the count of the announcements having a status and in a date range
 *
 * @since 1.10.0
 *
 * @param array query arguments
 *
 * @return int count of announcements
 */
function erp_hr_get_announcements_count( $args = [] ) {
    $defaults = [
        'numberposts'     => -1,
        'offset'          => 0,
        'post_type'       => 'erp_hr_announcement',
    ];

    if ( ! empty( $args['numberposts'] ) ) {
        unset( $args['numberposts'] );
    }

    if ( ! empty( $args['offset'] ) ) {
        unset( $args['offset'] );
    }

    $args = wp_parse_args( $args, $defaults );

    $announcements_count = count( get_posts( $args ) );

    return $announcements_count;
}

/**
 * Trash/Delete announcements
 *
 * @since 1.10.0
 *
 * @param array $announcement_ids
 * @param bool $delete
 *
 * @return int Returns number of announcements in $announcement_ids not deleted/trashed
 *             successfully
 */
function erp_hr_trash_announcements( $announcement_ids, $delete = false ) {
    return array_reduce( $announcement_ids, function( $fail_count, $id ) use ( $delete ) {
        if ( $delete ) {
            return $fail_count + ( empty( wp_delete_post( $id ) ) ? 1 : 0 );
        } else {
            return $fail_count + ( empty( wp_trash_post( $id ) ) ? 1 : 0 );
        }
    }, 0 );
}

/**
 * Get the count of the announcements by their status
 *
 * @since 1.10.0
 *
 * @return array count of announcement statuses
 */
function erp_hr_get_announcements_status_counts() {
    $count    = wp_count_posts( 'erp_hr_announcement' );
    $counts   = [];
    $statuses = [ 'publish', 'draft', 'trash' ];

    foreach ( $statuses as $status ) {
        $counts[ $status ] = $count->{$status};
    }

    return $counts;
}

/**
 * Restore announcements from trash
 *
 * @since 1.10.0
 *
 * @param array $announcement_ids
 *
 * @return int Returns number of announcements in $announcement_ids not restored
 *             successfully.
 */
function erp_hr_restore_announcements( $announcement_ids ) {
    return array_reduce( $announcement_ids, function( $fail_count, $id ) {
        return $fail_count + ( empty( wp_untrash_post( $id ) ) ? 1 : 0 );
    }, 0 );
}
