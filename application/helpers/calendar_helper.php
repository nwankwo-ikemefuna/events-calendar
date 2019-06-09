<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/* ===== Documentation ===== 
Name: calendar_helper
Role: Helper
Description: custom calendar helper
Contributors: [Nwankwo Ikemefuna]
Date Created: 16th April, 2019
Date Modified: 1st June, 2019
*/


/**
* custom calendar template
* @return string
*/
function custom_calendar_template() {
    return 
    '{table_open}<table class="cal_table" cellpadding="1" cellspacing="2">{/table_open}

        //heading row
        {heading_row_start}<tr>{/heading_row_start}

            //previous month link
            {heading_previous_cell}
                <th class="prev_sign"><a href="{previous_url}">&laquo;</a></th>
            {/heading_previous_cell}
            
            //title i.e. Month & Year
            {heading_title_cell}
                <th colspan="{colspan}">{heading}</th>
            {/heading_title_cell}
            
            //next month link
            {heading_next_cell}
                <th class="next_sign"><a href="{next_url}">&raquo;</a></th>
            {/heading_next_cell}

        {heading_row_end}</tr>{/heading_row_end}

        //Deciding where week row starts
        {week_row_start}<tr class="week_name">{/week_row_start}
            //Deciding week day cell and week days
            {week_day_cell}<td>{week_day}</td>{/week_day_cell}
            //week row end
        {week_row_end}</tr>{/week_row_end}

        //days
        {cal_row_start}<tr>{/cal_row_start}
            {cal_cell_start}<td>{/cal_cell_start}

                //cell with content
                {cal_cell_content}
                    {content}
                {/cal_cell_content}
                
                //cell with content current day
                {cal_cell_content_today}
                    {content}
                {/cal_cell_content_today}

                //cell without content
                {cal_cell_no_content}
                    {day}
                {/cal_cell_no_content}
                
                //cell without content current day
                {cal_cell_no_content_today}
                    <div class="today">
                        {day}
                    </div>
                {/cal_cell_no_content_today}

                //blank cell i.e. cells in a month without day in it
                {cal_cell_blank}
                    &nbsp;
                {/cal_cell_blank}

            {cal_cell_end}</td>{/cal_cell_end}
            
        {cal_row_end}</tr>{/cal_row_end}

    {table_close}</table>{/table_close}';
}


/**
* parse events data to be rendered in calendar box
* @param year: the year
* @param month: the month
* @param modal_trigger: the class name that triggers the modal to display event details
* @return array
*/
function calendar_date_items($month, $year, $modal_trigger = '') {
    $CI =& get_instance(); //get instance of CI super object
    //load calendar events
    //create an array to hold the events
    $data = array();
    $events_arr =  $CI->events_model->get_events(); 
    foreach ($events_arr as $single_event_arr) {

        //cast into object (I just prefer objects)
        $event = (Object) $single_event_arr; 

        //VERY IMPORTANT! 
        //Check if day is less than 10 and remove the leading 0 if true. This is because CI calendar library renders days from 1 to 9 as 1 digit, while the days are saved as 2 digits in db.
        $day = ($event->day < 10) ? substr($event->day, 1) : $event->day; //strip off the 1st xter i.e. 0
        $date = $event->year .'/'. $event->month .'/'. $event->day;
        $date = x_date_full($date);
        $date_int = get_date_int($event->year, $event->month, $event->day);
        //check that date is on current month and year (this is necessary to avoid duplicating same event date on all the months)
        if ($month == $event->month && $year == $event->year) {
            //day = 'link to event on this day'
            $data[$day] = '<div class="content '.$modal_trigger.'" data-date="'.$date.'" data-date_int="'.$date_int.'">';
            $data[$day] .= $day;
            $data[$day] .= '</div>';
        } 
    }
    return $data;
}


/**
* concatenate event year, month and day to form an integer
* @param year: the year
* @param month: the month
* @param day: the day
* @return int
*/
function get_date_int($year, $month, $day) {
    return $date_int = $year.$month.$day;
}


/**
* format date in the form eg 23rd August, 2018
* @param date: the date string
* @param with_ago: whether to show time in ago in parenthesis after the formatted date.
* @return string
*/
function x_date_full($date, $with_ago = false) { 
    if ($date == NULL) return NULL;
    $x_date = date("jS F, Y", strtotime($date));
    if ( ! $with_ago) {
        $x_date = $x_date;
    } else {
        $x_date = $x_date . ' (' . time_ago($date) . ')';
    }
    return $x_date;
}






