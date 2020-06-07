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

use Mmanager\Extensions\Mrepair\Functions;
use Mmanager\Domain\Factory\QuoteFactory as Quote;
/**
 * MRepair Entity
 */
class MRepair {
	protected $fn;
	public function __construct() {
		$this->fn = new Functions();
		$this->fn->createTables();
	}
	
	public function getOptions() {
		return $this->fn->getOptions();
	}
	public function getOption($option_name) {
		return $this->fn->getOption($option_name);
	}
	public static function generateRepairReference() {
		$fn = new Functions();
		return $fn->generateRepairReference();
	}
	public static function implodeAddress($id = null, $context) {
		$fn = new Functions();
		return $fn->implodeAddress($id, $context);
	}
	public static function getRepairStatuses($id = null, $str = false) {
		$fn = new Functions();
		return $fn->getRepairStatuses($id, $str);
	}
	public static function getAppointmentTypes($id = null, $str = false) {
		$fn = new Functions();
		return $fn->getAppointmentTypes($id, $str);
	}
	public static function ticketAttendees($id) {
		$fn = new Functions();
		return $fn->ticketAttendees($id);
	}
	public static function getTicketAttachemnts($id) {
		$fn = new Functions();
		return $fn->getTicketAttachemnts($id);
	}
	public static function getTicketResponseBody($id) {
		$fn = new Functions();
		return $fn->getTicketResponseBody($id);
	}
	public static function getTicketDiagnosis($id = null, $var = null, $context = null) {
		$fn = new Functions();
		return $fn->getTicketDiagnosis($id, $var, $context);
	}
	public static function getRepairTicket($id, $var = null) {
		$fn = new Functions();
		return $fn->getRepairTicket($id, $var);
	}
	public static function getRepairTickets() {
		$fn = new Functions();
		return $fn->getRepairTickets();
	}
	public static function getClientRepairTickets($client_id) {
		$fn = new Functions();
		return $fn->getClientRepairTickets($client_id);
	}
	public static function getTicketAdditionalEmailsToNotify() {
		$fn = new Functions();
		return $fn->getTicketAdditionalEmailsToNotify();
	}
	public static function getTicketCannedResponses() {
		$fn = new Functions();
		return $fn->getTicketCannedResponses();
	}
	public static function getTicketCannedResponsesCategories() {
		$fn = new Functions();
		return $fn->getTicketCannedResponsesCategories();
	}
	public static function getTicketsAppointments() {
		$fn = new Functions();
		return $fn->getTicketsAppointments();
	}
	public static function getRepairMessages($id) {
		$fn = new Functions();
		return $fn->getRepairMessages($id);
	}
	public static function getRepairTotalCharges($id) {
		$quote = new Quote();
		return $quote->getCustomer($id, 'client_email');
	}
	public static function getTicketResponseCategoryId($name) {
		$fn = new Functions();
		return $fn->getTicketResponseCategoryId($name);
	}
	public static function booleanToYesNo($int) {
		$fn = new Functions();
		return $fn->booleanToYesNo($int);
	}
	public static function getTicketIssueTypes($id = null) {
		$fn = new Functions();
		return $fn->getTicketIssueTypes($id);
	}
	public static function ticketNotificationEmails($id = null) {
		$fn = new Functions();
		return $fn->ticketNotificationEmails($id);
	}
	public static function renderRepairDiagnosisKey($key) {
		$fn = new Functions();
		return $fn->renderRepairDiagnosisKey($key);
	}
	public static function renderRepairDiagnosisValue($val) {
		$fn = new Functions();
		return $fn->renderRepairDiagnosisValue($val);
	}
	public static function searchRepairByReference($ref) {
		$fn = new Functions();
		return $fn->searchRepairByReference($ref);
	}
}