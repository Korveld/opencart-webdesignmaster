<?php
class ControllerExtensionModuleStarter extends Controller {

	public function index($setting) {

    //Load language file
    $this->language->load('extension/module/starter');

    //Set title from language file
    $data['heading_title'] = $this->language->get('heading_title');

    //Load Styles & Scripts
    // $this->document->addStyle('catalog/view/javascript/path/to/library.css');
    // $this->document->addScript('catalog/view/javascript/path/to/library.js');

		if (isset($setting['name'][$this->config->get('config_language_id')])) {
			$data['html'] = html_entity_decode($setting['module_description'][$this->config->get('config_language_id')]['title'], ENT_QUOTES, 'UTF-8');
			return $this->load->view('extension/module/starter', $data);
		}

	}

}
