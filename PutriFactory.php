<?php

namespace KS\Putri;

class PutriFactory extends \PP\ModuleFactory {

	public function __construct($master) {
		parent::__construct($master);

// 		// TODO remove when possible
// 		$this->fallbackToMaster[] = 'createParentPortalChildDataModel';
		$this->fallbackToMaster[] = 'createChildDataModel';
// 		$this->fallbackToMaster[] = 'createGuardianDataModel';
// 		$this->fallbackToMaster[] = 'createFDCEducatorDataModel';
// 		$this->fallbackToMaster[] = 'createReportGenerator';
// 		$this->fallbackToMaster[] = 'createDocumentDomain';
// 		$this->fallbackToMaster[] = 'createEmailCommunicationsDomain';
// 		$this->fallbackToMaster[] = 'createTemplateDataModel';

// 		$this->fallbackToMaster[] = 'createCurrentService';

// 		$this->fallbackToMaster[] = 'createTypeMediator';
// 		$this->fallbackToMaster[] = 'createUserMediator';
// 		$this->fallbackToMaster[] = 'createJobMediator';
// 		$this->fallbackToMaster[] = 'createReminderAlertDataModel';
	}

// 	public function createReminderMediator() {
// 		return $this->get(ReminderMediator::class, ['Factory' => $this]);
// 	}

// 	/**
// 	 * @return ReminderDomain
// 	 */
// 	public function createReminderDomain() {
// 		return $this->get(ReminderDomain::class);
// 	}

// 	/**
// 	 * @return ReminderDataModel
// 	 */
// 	public function createReminderDataModel() {
// 		return $this->get(ReminderDataModel::class);
// 	}

// 	/**
// 	 * @return ReminderEmailSender
// 	 */
// 	public function createReminderEmailSender() {
// 		return $this->get(ReminderEmailSender::class);
// 	}

// 	/**
// 	 * @return ReminderAlertDataModel
// 	 */
// 	public function createReminderAlertDataModel() {
// 		return $this->get(ReminderAlertDataModel::class);
// 	}

}
