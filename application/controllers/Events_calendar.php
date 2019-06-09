<?php
defined('BASEPATH') or die('Direct access not allowed');


/* ===== Documentation ===== 
Name: Event_calendar
Description: This class holds objects that allows users to view and manage calendar events
Model: Events_model
Contributors: [Nwankwo Ikemefuna]
Date Created: 17th April, 2018
Date Modified: 1st June, 2019
*/


class Events_calendar extends Core_controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('events_model');
	}


	/**
	* Index page
	*/
	public function index() {
		$page_title = 'Events Calendar';
		$this->site_header($page_title);
		$data['calendar'] = $this->events();
		$this->load->view('events_calendar', $data);
		$this->site_footer();
	}
	
	
	/**
	* create events calendar using CI calendaring class 
	* @return string
	*/
	public function events() {
		// Create template of preferences
		$prefs['template'] = custom_calendar_template(); //the custom calendar template
		$prefs['show_next_prev'] = true; //show next and previous links
		$prefs['next_prev_url'] = base_url($this->c_controller.'/index'); //url for calendar pagination
		$prefs['month_type'] = 'long'; //full month name
		$prefs['day_type'] = 'short'; //3-letter day type
		$prefs['start_day'] = 'sunday'; //start calendar on sunday
		$prefs['show_other_days'] = FALSE; //Do not display days of other months that share the first or last week of the calendar month.
		
		//load calendar library with preferences
		$this->load->library('calendar', $prefs);
		
		if ($this->uri->segment(4)) { 
			$year = $this->uri->segment(3); //year URI segment
			$month = $this->uri->segment(4); //month URI segment
		} else { //first page, load current year and date
			$year = date("Y", time()); //full year eg 2018
			$month = date("m", time()); //numeric month eg 04 for April
		}
		$modal_trigger = 'tm_calendar_events';
		$items = calendar_date_items($month, $year, $modal_trigger); //get events
		//$items = 'emeka';
		$calendar = $this->calendar->generate($year, $month, $items); //generate 
		return $calendar;
	}


	/**
	* create events calendar using CI calendaring class 
	*/
	public function same_day_events_ajax($date_int) {
		$same_day_events = $this->events_model->get_events_by_date($date_int);
		$events = "";
		foreach ($same_day_events as $single_event_arr) {
			//cast into object
        	$event = (Object) $single_event_arr; 
        	//parse
			$events .= '<div class="event_item">';
			$events .= '<h3>' . $event->title . '</h3>';
			$events .= '<div>Time: ' . $event->time . '</div>';
			$events .= '<div>Venue: ' . $event->venue . '</div>';
			$events .= '<p>' . $event->description . '</p>';
			$events .= '</div>';
		}
		$json_data = array('events' => $events);
		//json encode data
		echo json_encode($json_data);
	}	


	/**
	* create new event
	* Not used yet...
	*/
	public function create_new_event_ajax() { 
		$this->form_validation->set_rules('date', 'Event Date', 'required');
		$this->form_validation->set_rules('time', 'Event Time', 'required');
		$this->form_validation->set_rules('title', 'Event Title', 'trim|required');
		$this->form_validation->set_rules('description', 'Event Description', 'trim|required');
		if ($this->form_validation->run())  {		
			$this->events_model->create_new_event();
			echo 1;
		} else {
			echo validation_errors();
		}
	}
	
	
}