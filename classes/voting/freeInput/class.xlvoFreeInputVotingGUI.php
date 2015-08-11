<?php

require_once('./Customizing/global/plugins/Services/Repository/RepositoryObject/LiveVoting/classes/voting/class.xlvoVotingGUI.php');
require_once('./Customizing/global/plugins/Services/Repository/RepositoryObject/LiveVoting/classes/voting/freeInput/class.xlvoFreeInputVotingFormGUI.php');

class xlvoFreeInputVotingGUI extends xlvoVotingGUI {

	public function __construct() {
		parent::__construct();
	}


	public function executeCommand() {
		$this->tabs->setTabActive(self::TAB_STANDARD);
		$nextClass = $this->ctrl->getNextClass();
		switch ($nextClass) {
			default:
				$cmd = $this->ctrl->getCmd(self::CMD_STANDARD);
				$this->{$cmd}();
				break;
		}
	}

	protected function add() {
		if (! $this->access->hasWriteAccess()) {
			ilUtil::sendFailure($this->pl->txt('permission_denied'), true);
			$this->ctrl->redirect(new xlvoVotingGUI(), self::CMD_STANDARD);
		} else {
			$xlvoFreeInputVotingFormGUI = new xlvoFreeInputVotingFormGUI($this, xlvoVoting::find($_GET[parent::IDENTIFIER]));
			$this->tpl->setContent($xlvoFreeInputVotingFormGUI->getHTML());
		}
	}


	protected function create() {
		if (! $this->access->hasWriteAccess()) {
			ilUtil::sendFailure($this->pl->txt('permission_denied'), true);
			$this->ctrl->redirect(new xlvoVotingGUI(), self::CMD_STANDARD);
		} else {
			$xlvoFreeInputVotingFormGUI = new xlvoFreeInputVotingFormGUI($this, xlvoVoting::find($_GET[parent::IDENTIFIER]));
			$xlvoFreeInputVotingFormGUI->setValuesByPost();
			if ($xlvoFreeInputVotingFormGUI->saveObject()) {
				ilUtil::sendSuccess($this->pl->txt('system_account_msg_success'), true);
				$this->ctrl->redirect($this, self::CMD_EDIT);
			}
			$this->tpl->setContent($xlvoFreeInputVotingFormGUI->getHTML());
		}
	}


	protected function edit() {
		if (! $this->access->hasWriteAccess()) {
			ilUtil::sendFailure($this->pl->txt('permission_denied'), true);
			$this->ctrl->redirect(new xlvoVotingGUI(), self::CMD_STANDARD);
		} else {
			$xlvoFreeInputVotingFormGUI = new xlvoFreeInputVotingFormGUI($this, xlvoVoting::find($_GET[parent::IDENTIFIER]));
			$xlvoFreeInputVotingFormGUI->fillForm();
			$this->tpl->setContent($xlvoFreeInputVotingFormGUI->getHTML());
		}
	}


	protected function update() {
		if (! $this->access->hasWriteAccess()) {
			ilUtil::sendFailure($this->pl->txt('permission_denied'), true);
			$this->ctrl->redirect(new xlvoVotingGUI(), self::CMD_STANDARD);
		} else {
			$xlvoFreeInputVotingFormGUI = new xlvoFreeInputVotingFormGUI($this, xlvoVoting::find($_GET[parent::IDENTIFIER]));
			$xlvoFreeInputVotingFormGUI->setValuesByPost();
			if ($xlvoFreeInputVotingFormGUI->saveObject()) {
				ilUtil::sendSuccess($this->pl->txt('system_account_msg_success'), true);
				$this->ctrl->redirect($this, self::CMD_EDIT);
			}
			$this->tpl->setContent($xlvoFreeInputVotingFormGUI->getHTML());
		}
	}
}