<?php
class ControllerExtensionModuleVantage extends Controller
{
	private $error = array();



	public function index() {
		$this->load->language('extension/module/vantage');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('setting/module');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			if (!isset($this->request->get['module_id'])) {
				$this->model_setting_module->addModule('vantage', $this->request->post);
			} else {
				$this->model_setting_module->editModule($this->request->get['module_id'], $this->request->post);
			}
			$this->session->data['success'] = $this->language->get('text_success');
			$this->response->redirect($this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=module', true));
		}

    $text_strings = array(
      'heading_title',
      'button_save',
      'button_cancel',
      'button_add_module',
      'button_remove',
      'placeholder',
      'text_enabled',
      'text_disabled',
      'error_name',
      'entry_name',
      'entry_status',
      'custom_text',
      'custom_warranty',
      'custom_icon',
      'custom_service',
      'custom_prices',
      'custom_delivery',
    );

    foreach ($text_strings as $text) {
      $data[$text] = $this->language->get($text);
    }

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->error['name'])) {
			$data['error_name'] = $this->error['name'];
		} else {
			$data['error_name'] = '';
		}

    if (isset($this->error['text_warranty'])) {
      $data['error_text_warranty'] = $this->error['text_warranty'];
    } else {
      $data['error_text_warranty'] = '';
    }

    if (isset($this->error['icon_warranty'])) {
      $data['error_icon_warranty'] = $this->error['icon_warranty'];
    } else {
      $data['error_icon_warranty'] = '';
    }

    if (isset($this->error['text_service'])) {
      $data['error_text_service'] = $this->error['text_service'];
    } else {
      $data['error_text_service'] = '';
    }

    if (isset($this->error['icon_service'])) {
      $data['error_icon_service'] = $this->error['icon_service'];
    } else {
      $data['error_icon_service'] = '';
    }

    if (isset($this->error['text_price'])) {
      $data['error_text_price'] = $this->error['text_price'];
    } else {
      $data['error_text_price'] = '';
    }

    if (isset($this->error['icon_price'])) {
      $data['error_icon_price'] = $this->error['icon_price'];
    } else {
      $data['error_icon_price'] = '';
    }

    if (isset($this->error['text_delivery'])) {
      $data['error_text_delivery'] = $this->error['text_delivery'];
    } else {
      $data['error_text_delivery'] = '';
    }

    if (isset($this->error['icon_delivery'])) {
      $data['error_icon_delivery'] = $this->error['icon_delivery'];
    } else {
      $data['error_icon_delivery'] = '';
    }

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'user_token=' . $this->session->data['user_token'], true)
		);
		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_extension'),
			'href' => $this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=module', true)
		);
		if (!isset($this->request->get['module_id'])) {
			$data['breadcrumbs'][] = array(
				'text' => $this->language->get('heading_title'),
				'href' => $this->url->link('extension/module/vantage', 'user_token=' . $this->session->data['user_token'], true)
			);
		} else {
			$data['breadcrumbs'][] = array(
				'text' => $this->language->get('heading_title'),
				'href' => $this->url->link('extension/module/vantage', 'user_token=' . $this->session->data['user_token'] . '&module_id=' . $this->request->get['module_id'], true)
			);
		}

		if (!isset($this->request->get['module_id'])) {
			$data['action'] = $this->url->link('extension/module/vantage', 'user_token=' . $this->session->data['user_token'], true);
		} else {
			$data['action'] = $this->url->link('extension/module/vantage', 'user_token=' . $this->session->data['user_token'] . '&module_id=' . $this->request->get['module_id'], true);
		}

		$data['cancel'] = $this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=module', true);

		if (isset($this->request->get['module_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			$module_info = $this->model_setting_module->getModule($this->request->get['module_id']);
		}

		if (isset($this->request->post['name'])) {
			$data['name'] = $this->request->post['name'];
		} elseif (!empty($module_info)) {
			$data['name'] = $module_info['name'];
		} else {
			$data['name'] = '';
		}

    if (isset($this->request->post['text_warranty'])) {
      $data['text_warranty'] = $this->request->post['text_warranty'];
    } elseif (!empty($module_info)) {
      $data['text_warranty'] = $module_info['text_warranty'];
    } else {
      $data['text_warranty'] = '';
    }

    if (isset($this->request->post['icon_warranty'])) {
      $data['icon_warranty'] = $this->request->post['icon_warranty'];
    } elseif (!empty($module_info)) {
      $data['icon_warranty'] = $module_info['icon_warranty'];
    } else {
      $data['icon_warranty'] = '';
    }

    if (isset($this->request->post['text_service'])) {
      $data['text_service'] = $this->request->post['text_service'];
    } elseif (!empty($module_info)) {
      $data['text_service'] = $module_info['text_service'];
    } else {
      $data['text_service'] = '';
    }

    if (isset($this->request->post['icon_service'])) {
      $data['icon_service'] = $this->request->post['icon_service'];
    } elseif (!empty($module_info)) {
      $data['icon_service'] = $module_info['icon_service'];
    } else {
      $data['icon_service'] = '';
    }

    if (isset($this->request->post['text_price'])) {
      $data['text_price'] = $this->request->post['text_price'];
    } elseif (!empty($module_info)) {
      $data['text_price'] = $module_info['text_price'];
    } else {
      $data['text_price'] = '';
    }

    if (isset($this->request->post['icon_price'])) {
      $data['icon_price'] = $this->request->post['icon_price'];
    } elseif (!empty($module_info)) {
      $data['icon_price'] = $module_info['icon_price'];
    } else {
      $data['icon_price'] = '';
    }

    if (isset($this->request->post['text_delivery'])) {
      $data['text_delivery'] = $this->request->post['text_delivery'];
    } elseif (!empty($module_info)) {
      $data['text_delivery'] = $module_info['text_delivery'];
    } else {
      $data['text_delivery'] = '';
    }

    if (isset($this->request->post['icon_delivery'])) {
      $data['icon_delivery'] = $this->request->post['icon_delivery'];
    } elseif (!empty($module_info)) {
      $data['icon_delivery'] = $module_info['icon_delivery'];
    } else {
      $data['icon_delivery'] = '';
    }

		/*if (isset($this->request->post['module_description'])) {
			$data['module_description'] = $this->request->post['module_description'];
		} elseif (!empty($module_info)) {
			$data['module_description'] = $module_info['module_description'];
		} else {
			$data['module_description'] = array();
		}*/

		if (isset($this->request->post['status'])) {
			$data['status'] = $this->request->post['status'];
		} elseif (!empty($module_info)) {
			$data['status'] = $module_info['status'];
		} else {
			$data['status'] = '';
		}

		$this->load->model('localisation/language');
		$data['languages'] = $this->model_localisation_language->getLanguages();

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');
		$this->response->setOutput($this->load->view('extension/module/vantage', $data));
	}


	protected function validate()
	{
		if (!$this->user->hasPermission('modify', 'extension/module/vantage')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		if ((utf8_strlen($this->request->post['name']) < 3) || (utf8_strlen($this->request->post['name']) > 64)) {
			$this->error['name'] = $this->language->get('error_name');
		}

    if ((utf8_strlen($this->request->post['text_warranty']) < 3) || (utf8_strlen($this->request->post['text_warranty']) > 128)) {
      $this->error['text_warranty'] = $this->language->get('error_text_warranty');
    }

    if ((utf8_strlen($this->request->post['icon_warranty']) < 2) || (utf8_strlen($this->request->post['icon_warranty']) > 32)) {
      $this->error['icon_warranty'] = $this->language->get('error_icon_warranty');
    }

    if ((utf8_strlen($this->request->post['text_service']) < 3) || (utf8_strlen($this->request->post['text_service']) > 128)) {
      $this->error['text_service'] = $this->language->get('error_text_service');
    }

    if ((utf8_strlen($this->request->post['icon_service']) < 2) || (utf8_strlen($this->request->post['icon_service']) > 32)) {
      $this->error['icon_service'] = $this->language->get('error_icon_service');
    }

    if ((utf8_strlen($this->request->post['text_price']) < 3) || (utf8_strlen($this->request->post['text_price']) > 128)) {
      $this->error['text_price'] = $this->language->get('error_text_price');
    }

    if ((utf8_strlen($this->request->post['icon_price']) < 2) || (utf8_strlen($this->request->post['icon_price']) > 32)) {
      $this->error['icon_price'] = $this->language->get('error_icon_price');
    }

    if ((utf8_strlen($this->request->post['text_delivery']) < 3) || (utf8_strlen($this->request->post['text_delivery']) > 128)) {
      $this->error['text_delivery'] = $this->language->get('error_text_delivery');
    }

    if ((utf8_strlen($this->request->post['icon_delivery']) < 2) || (utf8_strlen($this->request->post['icon_delivery']) > 32)) {
      $this->error['icon_delivery'] = $this->language->get('error_icon_delivery');
    }

		return !$this->error;
	}

	public function install()
	{
		$this->load->model('setting/setting');
		$this->model_setting_setting->editSetting('module_vantage', ['module_vantage_status' => 1]);
	}

	public function uninstall()
	{
		$this->load->model('setting/setting');
		$this->model_setting_setting->deleteSetting('module_vantage');
	}
}
