<?php

class ProductForm extends Form {
	public function build() {
		$this->addFormField('name');
		$this->addFormField('description');
		$this->addFormField('salePrice');
		$this->addFormField('Recette');
	}
} 