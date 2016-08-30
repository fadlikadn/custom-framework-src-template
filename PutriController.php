<?php

namespace KS\Putri;

class PutriController extends \KS\RequestFieldController {

	protected $fields = [
		'SampleID' => ['type' => 'ID', 'caption' => 'Sample'],
		'Name' => ['type' => 'ID', 'caption' => 'Name', '*'],
		'SampleDate' => ['type' => 'Date', 'caption' => 'Sample Date'],
		
	];

	protected $fieldsets = [
		'PrepareEdit' => ['SampleID', 'Name', 'SampleDate'],
		'Save' => ['SampleID', 'Name', 'SampleDate'],
	];

	/**
	 * @param \KS\Type\TypeMediator $typeMediator
	 */
	public function prepareList(\KS\Putri\PutriDomain $putriDomain) {
		$sample = $putriDomain->getSampleList();
		
		return [			
			'Records' => $sample,			
		];
	}

	/**
	 * @param \KS\Type\TypeMediator $typeMediator
	 */
	public function prepareEdit(\KS\Reminder\ReminderDomain $reminderDomain, $typeMediator, $reminderID, $foreignType) {
		$this->checkAccessPermission(KS_OBJECT_TYPE_REMINDER, \KS\AccessType::READ_ACCESS, $foreignType);

		$showParentPortal = $this->showParentPortal($foreignType);
		$IType = $reminderDomain->getValueForObjectType(\KS\Reminder\ReminderDomain::VALUE_TYPE_ITYPE, $foreignType);
		$documentForeignType = $reminderDomain->getValueForObjectType(\KS\Reminder\ReminderDomain::VALUE_TYPE_DOCUMENT_FOREIGN_TYPE, $foreignType);

		if ($showParentPortal and ($foreignType === KS_OBJECT_TYPE_SP)) {
			$parentPortalWarning = 'This reminder is visible to all parents.';
		} else {
			$parentPortalWarning = null;
		}

		$document = null;
		$reminder = null;
		if (!empty($reminderID)) {
			/* @var $reminder \Reminder */
			$reminder = $reminderDomain->getReminderDetailed($reminderID);
			$reminder = $this->formatReminderForEdit($reminder);
			$document = $reminderDomain->getDocumentForReminder($reminderID, $reminder["SPID"]);
		}

		$this->setFieldsRequired(false, 'ForeignID', 'ForeignType');

		return [
			'Fields' => $this->fieldsets['Save'],
			'Record' => $reminder,
			'IType' => $IType,
			'Types' => $typeMediator->getTypeDropdown($IType, [KS_REMINDER_TYPE_CHILD_HEALTH_CARD_EXPIRY, KS_REMINDER_TYPE_GUARDIAN_CREDIT_CARD_EXPIRY]),
			'CanAddNewType' => $this->request->hasRoleAccess(\KS\SecurityRole::SUPER_USER),
			'Document' => $document,
			'DocumentForeignType' => $documentForeignType,
			'ShowParentPortal' => $showParentPortal,
			'ShowMultipleAlerts' => isOneOf($foreignType, KS_OBJECT_TYPE_FDC_EDUCATOR),
			'ShowSendEmail' => $this->showSendEmail($foreignType),
			'ParentPortalWarning' => $parentPortalWarning,
			'ReminderAlertUnits' => [
				KS_REMINDER_UNIT_PERIOD_DAY => 'Day',
				KS_REMINDER_UNIT_PERIOD_WEEK => 'Week',
			],
		];
	}

	public function save(\KS\Reminder\ReminderDomain $reminderDomain, $fieldValues) {
		$this->checkAccessPermission(KS_OBJECT_TYPE_REMINDER, \KS\AccessType::FULL_ACCESS, $fieldValues['ForeignType']);

		$fieldValues['Alerts'] = $this->formatFieldValuesForSave($fieldValues['AlertUnit'], $fieldValues['AlertValue']);

		$reminder = $reminderDomain->saveReminder($fieldValues);

		return [
			'Record' => $reminder,
		];
	}

	public function delete(\KS\Reminder\ReminderDomain $reminderDomain, $reminderID, $foreignType) {
		$this->checkAccessPermission(KS_OBJECT_TYPE_REMINDER, \KS\AccessType::FULL_ACCESS, $foreignType);

		if (!$reminderID) {
			return;
		}

		$reminderDomain->deleteReminders($reminderID, $foreignType);
	}

	
}
