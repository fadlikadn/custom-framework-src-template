<?php

namespace KS\Putri;

class PutriFEResources {

	/**
	 * @param \KS\App\FEResources $FEResources
	 */
	public function __invoke($FEResources) {

		$FEResources->addRes(\KS\App\FEResources::PKG_KIDSOFT, __DIR__.'/PutriList.js', 'Putri/PutriList', ['Putri/PutriTemplate']);
		
		$FEResources->addTemplateRes(\KS\App\FEResources::PKG_KIDSOFT_TEMPLATES, __DIR__.'/PutriTemplate.html', 'Putri/PutriTemplate');
		
	}

}
