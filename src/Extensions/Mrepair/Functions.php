<?php
/**
 * m'Manager | Invoices Management System
 * 
 * This content is released under the Proprietary License (Proprietary)
 *
 * Copyright (c) 2017, Eric Claver AKAFFOU - All Rights Reserved
 * Unauthorized copying of this file, via any medium is strictly prohibited
 * Proprietary and confidential
 * 
 * @package m'Manager
 * @author  Eric Claver AKAFFOU
 * @copyright   Copyright (c) 2017, on'Eric Computing, Inc. (https://www.onericcomputing.com/)
 * @license https://www.mmanager.fr  Proprietary License
 * @link    https://codecanyon.net/item/mmanager-invoices-management-system/19866435?s_rank=1
 * @since   Version 1.0.0
 * @filesource
 */

namespace Mmanager\Extensions\Mrepair;
use Mmanager\Extensions\Database\Builder;

class Functions {
	protected $db;
	protected $builder;
	protected $options;
	
	public function __construct() {
		$this->builder = new Builder();
		$this->db = $this->builder->getDB();
		$this->options = $this->getOptions();
	}
	
	public function getOptions() {
		$query = "SELECT * FROM oc_options";
		return $this->db->get_results($query);
	}
	public function getOption($option_name) {
		$options = $this->getOptions();
		foreach ($options as $option) {
			if ($option->option_name == $option_name) {
				return $option->option_value;
			}
		}
	}

	public function createTables() {
		if ( ! db_table_exists('oc_tickets'))
		{
			$this->db->query("CREATE TABLE IF NOT EXISTS `oc_tickets` (`id` int(11) NOT NULL AUTO_INCREMENT, `client_id` int(11) NOT NULL DEFAULT 0,`user_id` int(11) NULL,`updated_by` int(11) NULL,`name_company` varchar(225) NULL,`client_phone` varchar(225) NULL,`ticket_number` int(11) NOT NULL,`ticket_reference` VARCHAR(225) NULL, `ticket_external_reference` VARCHAR(225) NULL,`ticket_status` INT(11) NULL,`ticket_title` varchar(225) NOT NULL,`notification_emails` TEXT NULL,`issue_type` int(11) NULL,`issue_description` TEXT NULL, `is_approved_to_proceed` tinyint(1) NOT NULL DEFAULT 1,`is_prediagnosed` tinyint(1) NOT NULL DEFAULT 1,`email_opt_out` tinyint(1) NOT NULL DEFAULT 0,`appointment_type` int(11) NULL,`appointment_location` TEXT NULL,`appointment_datetime` DATETIME NULL,`appointment_owner` INT(11) NULL,`appointment_attendees` TEXT NULL,`attachments` TEXT NULL,`asset_type` INT(11) NULL,`asset_name` VARCHAR(225) NULL,`asset_lock_code` VARCHAR(225) NULL,`asset_serial` VARCHAR(225) NULL,`asset_model` VARCHAR(225) NULL,`asset_make` VARCHAR(225) NULL,`asset_imei` VARCHAR(225) NULL,`asset_brand` VARCHAR(225) NULL,`asset_vin` VARCHAR(225) NULL, `qa_diagnosis` TEXT NULL,`pre_diagnosis` TEXT NULL,`post_diagnosis` TEXT NULL, `created_on` DATETIME NULL,`updated_on` TIMESTAMP DEFAULT CURRENT_TIMESTAMP, PRIMARY KEY (`id`)) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;");
			$this->db->query("CREATE TABLE IF NOT EXISTS `oc_tickets_issue_types` (`id` int(11) NOT NULL AUTO_INCREMENT,`name` VARCHAR(225) NULL,  PRIMARY KEY (`id`)) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;");
			$this->db->query("CREATE TABLE IF NOT EXISTS `oc_tickets_canned_responses` (`id` int(11) NOT NULL AUTO_INCREMENT,`category_id` int(11) NOT NULL DEFAULT 0, `ticket_canned_response_title` VARCHAR(225) NULL, `ticket_canned_response_body` LONGTEXT NULL, PRIMARY KEY (`id`)) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;");
			$this->db->query("CREATE TABLE IF NOT EXISTS `oc_tickets_canned_responses_categories` (`id` int(11) NOT NULL AUTO_INCREMENT,`category_name` VARCHAR(225) NULL, PRIMARY KEY (`id`)) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;");
			$this->db->query("CREATE TABLE IF NOT EXISTS `oc_tickets_messaging` (`id` int(11) NOT NULL AUTO_INCREMENT, `ticket_id` int(11) NULL, `ticket_reference` varchar(225) NULL,`message_from` int(11) DEFAULT NULL, `message_to` int(11) DEFAULT NULL, `message` text, `account_id` int(11) NULL, `user_id` int(11) NULL,`is_client` int(11) NOT NULL DEFAULT 0, `is_read` tinyint(1) NULL DEFAULT 0, `created_on` TIMESTAMP DEFAULT CURRENT_TIMESTAMP, PRIMARY KEY (`id`)) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;");
			
			// Alter tables
			if ( ! col_exists('ticket', 'quote_number')) {
				$this->db->query("ALTER TABLE `oc_tickets` ADD `quote_number` VARCHAR(20) DEFAULT NULL");
			}
			if ( ! col_exists('ticket', 'invoice_number')) {
				$this->db->query("ALTER TABLE `oc_tickets` ADD `invoice_number` VARCHAR(20) DEFAULT NULL");
			}
			if ( ! col_exists('purchases', 'repair_number')) {
				$this->db->query("ALTER TABLE `oc_purchases` ADD `repair_number` VARCHAR(20) DEFAULT NULL");
			}
			if ( ! col_exists('purchases_items', 'repair_number')) {
				$this->db->query("ALTER TABLE `oc_purchaseitems` ADD `repair_number` VARCHAR(20) DEFAULT NULL");
			}
			if ( ! col_exists('invoices', 'repair_number')) {
				$this->db->query("ALTER TABLE `oc_invoices` ADD `repair_number` VARCHAR(20) DEFAULT NULL");
			}
			if ( ! col_exists('invoices_items', 'repair_number')) {
				$this->db->query("ALTER TABLE `oc_invoiceitems` ADD `repair_number` VARCHAR(20) DEFAULT NULL");
			}
			if ( ! col_exists('quotes', 'repair_number')) {
				$this->db->query("ALTER TABLE `oc_quotes` ADD `repair_number` VARCHAR(20) DEFAULT NULL");
			}
			if ( ! col_exists('quotes_items', 'repair_number')) {
				$this->db->query("ALTER TABLE `oc_quoteitems` ADD `repair_number` VARCHAR(20) DEFAULT NULL");
			}
			
			$this->registerPluginMenu([
				__('link_repair_center') => [
					'id' => 'repaircenter',
					'settings-id' => 'repairsettings',
					'settings-arrowid' => 'repairsettingsarrow',
					'href' => 'index.php/repair',
					'settings_href' => 'index.php/repair/settings',
					'icon' => 'icon-wrench',
					'title' => __('link_repair_center'),
					'settings_title' => __('label_repair_settings')
				],
			]);
		}
	}

	public function getRepairTickets() {
		return $this->db->get_results("SELECT * FROM oc_tickets ORDER BY id DESC");
	}
	public function getClientRepairTickets($client_id) {
		if ($client_id) {
			return $this->db->get_results("SELECT * FROM oc_tickets WHERE client_id = {$client_id} ORDER BY id DESC");
		} else {
			return [];
		}
	}

	public function getRepairTicket($id, $var = null) {
		if ( ! $var) {
			return $this->db->get_row("SELECT * FROM oc_tickets WHERE id = {$id}");
		} else {
			if (is_numeric($id)) {
				return $this->db->get_row("SELECT $var FROM oc_tickets WHERE id = {$id}")->{$var};
			} else {
				return $this->db->get_row("SELECT $var FROM oc_tickets WHERE ticket_reference LIKE '{$id}'")->{$var};
			}
		}
	}
	
	public function get_repair_status_by_reference($ref) {
		return $this->db->get_row("SELECT ticket_status FROM oc_tickets WHERE ticket_reference LIKE '{$ref}'")->ticket_status;
	}

	public function searchRepairByReference($ref) {
		return $this->db->get_results("SELECT * FROM oc_tickets WHERE ticket_reference LIKE '{$ref}' OR ticket_external_reference LIKE '{$ref}'");
	}
	public function generateRepairReference() {
		$time = time();
		return 'REPAIR-'.date('ymd').'-'.strtoupper($this->generateRandomString());
	}
	public function generateRandomString($length = 5) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}
	public function getTicketIssueTypes($id = null) {
		if ( ! $id) {
			return $this->db->get_results("SELECT * FROM oc_tickets_issue_types ORDER BY name");
		} else {
			return $this->db->get_row("SELECT name FROM oc_tickets_issue_types WHERE id = '{$id}'")->name;
		}
	}
	public function getTicketAdditionalEmailsToNotify() {
		$list = [];

		$results = $this->db->get_results("SELECT id, email FROM users");
		if ($results) {
			foreach ($results as $user) {
				array_push($list, array('id' => $user->id, 'text' => $user->email));
			}
		}
		return $list;
	}
	public function getTicketCannedResponsesCategories() {
		$list = [];

		$results = $this->db->get_results("SELECT id, category_name FROM oc_tickets_canned_responses_categories");
		if ($results) {
			foreach ($results as $cat) {
				array_push($list, array('id' => $cat->id, 'text' => $cat->category_name));
			}
		}
		return $list;
	}
	public function getTicketCannedResponses() {
		$list = [];

		$results = $this->db->get_results("SELECT id, ticket_canned_response_title FROM oc_tickets_canned_responses");
		if ($results) {
			foreach ($results as $response) {
				array_push($list, array('id' => $response->id, 'text' => $response->ticket_canned_response_title));
			}
		}
		return $list;
	}
	public function getTicketResponseCategoryId($name) {
		$name = addslashes($name);
		return $this->db->get_row("SELECT id FROM oc_tickets_canned_responses_categories where category_name LIKE '{$name}'")->id;
	}
	public function getTicketResponseBody($id) {
		return $this->db->get_row("SELECT ticket_canned_response_body FROM oc_tickets_canned_responses where id = '{$id}'")->ticket_canned_response_body;
	}
	public function getTicketsAppointments() {
		$list = [];

		$results = $this->db->get_results("SELECT id, ticket_reference, appointment_datetime, appointment_owner, appointment_attendees, client_id  FROM oc_tickets");
		if ($results) {
			foreach ($results as $appointment) {
				if ($appointment->appointment_datetime) {
					array_push($list, array(
						'id' => $appointment->id,
						'title' => $appointment->ticket_reference.' ( '.$appointment->appointment_datetime.' ) ',
						'start' => $appointment->appointment_datetime,
					));
				}
			}
		}
		return $list;
	}
	public function format_appointment_address() {
		return array(
			'user_address1' => get_option('address1'),
			'user_address2' => get_option('address2'),
			'user_city' => get_option('city'),
			'user_postcode' => get_option('postcode'),
			'user_state' => get_option('state'),
			'user_country' => 'None' == get_countries(get_option('country')) ? '' : get_countries(get_option('country'))
		);
	}
	
	public function getRepairStatuses($id = null, $str = false) {
		$statuses = array(
			'1' => __('label_new'),
			'2' => __('label_progress'),
			'3' => __('label_resolved'),
			'4' => __('label_invoiced'),
			'5' => __('label_waiting_for_parts'),
			'6' => __('label_waiting_on_customer'),
			'7' => __('label_scheduled'),
			'8' => __('label_customer_reply')
		);

		if ( ! $id && ! $str) {
			return $statuses;
		} else {
			return $statuses[$id]; 
		}
	} 
	
	public function getAppointmentTypes($id = null, $str = false) {
		if ( ! $id) {
			$id = 1;
		}
		$types = array(
			'1' => array('id' => 1, 'value' => __('label_in_shop')),
			'2' => array('id' => 2, 'value' => __('label_onsite')),
			'3' => array('id' => 3, 'value' => __('label_phone_call')),
		);

		if ( ! $id && ! $str) {
			return $types;
		} else {
			return $types[$id]['value']; 
		}
	}
	
	public function booleanToYesNo($int) {
		return 1 == $int ? __('label_yes') : __('label_no');
	}

	public function ticketNotificationEmails($id) {
		$list = [];

		$ccs = json_decode($this->getRepairTicket($id, 'notification_emails'), true);
		if ($ccs) {
			foreach ($ccs as $cc) {
				array_push($list, get_user_var($cc, 'email'));
			}
			return $list;
		}
		return [];
	}

	public function ticketAttendees($id) {
		$list = [];

		$atts = json_decode($this->getRepairTicket($id, 'appointment_attendees'), true);
		if ($atts) {
			foreach ($atts as $att) {
				array_push($list, get_user_var($att, 'first_name'));
			}
			return $list;
		}
		return [];
	}

	public function getTicketAttachemnts($id) {
		$list = [];

		$atts = json_decode($this->getRepairTicket($id, 'attachments'), true);
		if ($atts) {
			foreach ($atts as $att) {
				array_push($list, $att);
			}
			return $list;
		}
		return [];
	}

	public function implodeAddress($id = null, $context) {
		
		switch ($context) {
			case 'client':
				return implode(', ', array_values(array_filter((array) client($id, 'address'))));
			case 'company':
				$user_address = array(
					'user_address1' => get_option('address1'),
					'user_address2' => get_option('address2'),
					'user_city' => get_option('city'),
					'user_postcode' => get_option('postcode'),
					'user_state' => get_option('state'),
					'user_country' => 'None' == get_countries(get_option('country')) ? '' : get_countries(get_option('country'))
				);
				return implode(', ', array_values(array_filter($user_address)));
		}
	}

	public function getTicketDiagnosis($id = null, $var = null, $context = null) {
		switch ($context) {
			case 'qa':
				$response = json_decode($this->getRepairTicket($id, 'qa_diagnosis'), true);
				if ($response) {
					if ($var) {
						foreach ($response as $key => $value) {
							if ($key == $var) {
								return $value;
							}
						}
					} else {
						return $response;
					}
				}
			case 'pre':
				$response = json_decode($this->getRepairTicket($id, 'pre_diagnosis'), true);
				if ($response) {
					if ($var) {
						foreach ($response as $key => $value) {
							if ($key == $var) {
								return $value;
							}
						}
					} else {
						return $response;
					}
				}
			case 'post':
				$response = json_decode($this->getRepairTicket($id, 'post_diagnosis'), true);
				if ($response) {
					if ($var) {
						foreach ($response as $key => $value) {
							if ($key == $var) {
								return $value;
							}
						}
					} else {
						return $response;
					}
				}
		}
	}

	public function getRepairMessages($id) {
		if (is_numeric($id)) {
			return $this->db->get_results("SELECT * FROM oc_tickets_messaging WHERE ticket_id = {$id} ORDER BY id DESC");
		} else {
			return $this->db->get_results("SELECT * FROM oc_tickets_messaging WHERE ticket_reference LIKE '{$id}' ORDER BY id DESC");
		}
	}
	public function registerPluginMenu($menu) {
		set_plugings($menu);
	}
	public function renderRepairDiagnosisKey($key) {
		switch ($key) {
			case 'qa_is_testable':
			case 'pre_is_testable':
			case 'post_is_testable':
				return __('label_is_testable');
			case 'qa_water_damaged':
			case 'pre_water_damaged':
			case 'post_water_damaged':
				return __('label_water_damaged');
			case 'qa_digitizer_test':
			case 'pre_digitizer_test':
			case 'post_digitizer_test':
				return __('label_digitizer_test');
			case 'qa_lcd_test':
			case 'pre_lcd_test':
			case 'post_lcd_test':
				return __('label_lcd_test');
			case 'qa_volume_test':
			case 'pre_volume_test':
			case 'post_volume_test':
				return __('label_volume_test');
			case 'qa_power_button_test':
			case 'pre_power_button_test':
			case 'post_power_button_test':
				return __('label_power_button_test');
			case 'qa_wifi_test':
			case 'pre_wifi_test':
			case 'post_wifi_test':
				return __('label_wifi_test');
			case 'qa_other_buttons_test':
			case 'pre_other_buttons_test':
			case 'post_other_buttons_test':
				return __('label_other_buttons_test');
			case 'qa_front_camera_test':
			case 'pre_front_camera_test':
			case 'post_front_camera_test':
				return __('label_front_camera_test');
			case 'qa_back_camera_test':
			case 'pre_back_camera_test':
			case 'post_back_camera_test':
				return __('label_back_camera_test');
			case 'qa_proximity_sensor_test':
			case 'pre_proximity_sensor_test':
			case 'post_proximity_sensor_test':
				return __('label_proximity_sensor_test');
			case 'qa_touch_id_test':
			case 'pre_touch_id_test':
			case 'post_touch_id_test':
				return __('label_touch_id_test');
		}
	}
	public function renderRepairDiagnosisValue($val) {
		switch ($val) {
			case '0':
				return __('label_n_a');
			case '1':
				return __('label_yes');
			case '2':
				return __('label_no');
			case 'fail':
				return __('label_fail');
			case 'pass':
				return __('label_pass');
			default:
				return __('label_n_a');
		}
	}
}

