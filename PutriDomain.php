<?php
namespace KS\Putri;

class PutriDomain {
	
	use \KS\Mixin\Request;
	
	private $sampleDM;
	
	private $childDM;
	
	public function __construct(\KS\Putri\PutriDataModel $sampleDM, $childDataModel) {
		$this->sampleDM = $sampleDM;
		$this->childDM = $childDataModel;
	}
	
	public function getSampleList(){
		return $this->sampleDM->getSampleList();
	}
}