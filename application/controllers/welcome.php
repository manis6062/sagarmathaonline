<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this -> load -> model('news_model');
				$this -> load -> model('Team_model');
		$this -> load -> model('Theme_option_model');
		$this -> load -> library('pagination');
		$this -> form_validation -> set_error_delimiters('<div class="error">* ', '</div>');
		// if ( $this->input->post( 'remember' ) ) // set sess_expire_on_close to 0 or FALSE when remember me is checked.
		// $this->config->set_item('sess_expire_on_close', '0'); // do change session config
		//
		// $this->load->library('session');
	}

	public function index() {

		$themeoptionLists = $this -> Theme_option_model -> getAllLists();
		$data['sliderList'] = $this -> Advertisement_model -> getAllSliderWithLimit();
		$data['teamList'] = $this -> Team_model -> getAllTeams();
		$data['themeoptionLists'] = $themeoptionLists;
		$data['main_content'] = 'welcome';
		$this -> load -> view('includes/template', $data);
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */

