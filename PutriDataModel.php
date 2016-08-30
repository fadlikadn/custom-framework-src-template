<?php
namespace KS\Putri;

class PutriDataModel{
	use \KS\Mixin\Request;
	use \PP\Mixin\ExecSQL;
	
	public function getSampleList(){
		return \PutriQuery::create()
			->filterBySPID($this->request->getSPID())
			->orderByName()
			->find();
	}
}