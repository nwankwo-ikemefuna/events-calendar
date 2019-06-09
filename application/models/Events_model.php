<?php
defined('BASEPATH') or exit('Direct access to script not allowed');


/* ===== Documentation ===== 
Name: Publication_management_model
Description: Handles the DB processes of events
Controller: Events_calendar
Contributors: [Nwankwo Ikemefuna]
Date Created: 17 April, 2018
Date Modified: 1st June, 2019
*/

class Events_model extends CI_Model {
	public function __construct() {
		parent::__construct();
	}
	
	

	/**
	* This method creates default events using some days in the current month and year.
	* @return array
	*/
	public function default_events() { 
		$current_year = date('Y'); //full 4-digit year value (eg 2018)
		$current_month = date('m'); //2-digit month value (eg. 08 for August)
		$events_arr = array(
			array(
				'year'			=> $current_year,
				'month'			=> $current_month,
				'day'			=> '03',
				'time'			=> '10:15 AM',
				'venue'			=> 'Muson Centre, Lagos',
				'title' 		=> 'PHP Developers Summit',
				'description' 	=> 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.'
			),
			array(
				'year'			=> $current_year,
				'month'			=> $current_month,
				'day'			=> '03',
				'time'			=> '12:45 AM',
				'venue'			=> 'Muson Centre, Lagos',
				'title' 		=> 'Question & Answer Session',
				'description' 	=> 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.'
			),
			array(
				'year'			=> $current_year,
				'month'			=> $current_month,
				'day'			=> '12',
				'time'			=> '08:30 AM',
				'venue'			=> 'Palm Bay, Abuja',
				'title' 		=> 'Developers Get Together',
				'description' 	=> 'sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'
			),
			array(
				'year'			=> $current_year,
				'month'			=> $current_month,
				'day'			=> '12',
				'time'			=> '01:00 PM',
				'venue'			=> 'Palm Bay, Abuja',
				'title' 		=> 'Developers Get Together 2',
				'description' 	=> 'Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.'
			),
			array(
				'year'			=> $current_year,
				'month'			=> $current_month,
				'day'			=> '12',
				'time'			=> '04:00 PM',
				'venue'			=> 'Palm Bay, Abuja',
				'title' 		=> 'Pool Party',
				'description' 	=> 'Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.'
			),
			array(
				'year'			=> $current_year,
				'month'			=> $current_month,
				'day'			=> '17',
				'time'			=> '06:00 PM',
				'venue'			=> 'Gates Lounge, New York',
				'title' 		=> 'Dinner Night',
				'description' 	=> 'Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.'
			),
			array(
				'year'			=> $current_year,
				'month'			=> $current_month,
				'day'			=> '28',
				'time'			=> '11:00 AM',
				'venue'			=> 'Torvalds Auditorium, LA',
				'title' 		=> 'PHP Hackathon',
				'description' 	=> 'Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.'
			)
		);
		return $events_arr;
	}


	/**
	* This method creates a new event and adds it to the events session data
	* Not used yet...
	* @return array
	*/
	public function create_new_event() { 
		$date = $this->input->post('date', TRUE); 	
		$time = $this->input->post('time', TRUE); 	
		$title = ucwords($this->input->post('title', TRUE)); 	
		$description = nl2br(ucfirst($this->input->post('description', TRUE))); 
		//explode date to get year, month and day as separate values
		$x_date = explode('/', $date);
		$year = $x_date[0]; //year is array index 0 
		$month = $x_date[1]; //month is array index 1
		$day = $x_date[2]; //day is array index 2
		
		//new data
		$data_arr = array(
			array(
				'year' => $year, 
				'month' => $month, 
				'day' => $day, 
				'time' => $time, 
				'title' => $title,
				'description' => $description
			)
		);
		return $data_arr;
	}


	/**
	* This method returns all the events (default only for now)
	* @return array
	*/
	public function get_events() { 
		return $this->default_events();
	}


	/**
	* This method returns all the events created for a single day
	* @param event_date_int: the event date in the format yyyymmdd
	* @return array
	*/
	public function get_events_by_date($event_date_int) { 
		$events_arr = $this->get_events();
		$data_arr = array();
		foreach ($events_arr as $single_event_arr) {
			//cast into object (I just prefer objects)
        	$event = (Object) $single_event_arr; 
        	$date_int = get_date_int($event->year, $event->month, $event->day);
        	//compare date int
        	if ($event_date_int === $date_int) {
        		//push single event to array
        		array_push($data_arr, $single_event_arr);
        	}
		}
		return $data_arr;
	}
	
}