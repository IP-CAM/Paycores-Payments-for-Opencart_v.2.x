<?php
/**
 * Created by Paycores.com.
 * User: paycores-02
 * Date: 30/10/17
 * Time: 09:41 AM
 */

class ControllerPaymentPaycores extends Controller {
    public function index() {
        $this->language->load('payment/paycores');
        $this->document->setTitle('Custom Payment Method Configuration');
        $this->load->model('setting/setting');

        if (($this->request->server['REQUEST_METHOD'] == 'POST')) {
            $this->model_setting_setting->editSetting('paycores', $this->request->post);
            $this->session->data['success'] = 'Saved.';
            $this->response->redirect($this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL'));
        }

        $data['heading_title']          = $this->language->get('heading_title');
        $data['button_save']            = $this->language->get('text_button_save');
        $data['button_cancel']          = $this->language->get('text_button_cancel');
        $data['entry_order_status']     = $this->language->get('entry_order_status');
        $data['entry_order_approved']   = $this->language->get('entry_order_approved');
        $data['entry_order_failed']     = $this->language->get('entry_order_failed');
        $data['text_enabled']           = $this->language->get('text_enabled');
        $data['text_disabled']          = $this->language->get('text_disabled');
        $data['entry_status']           = $this->language->get('entry_status');

        $data['paycores_api_key']       = $this->language->get('paycores_api_key');
        $data['paycores_api_login']     = $this->language->get('paycores_api_login');
        $data['paycores_commerce_id']   = $this->language->get('paycores_commerce_id');
        $data['paycores_test_mode']     = $this->language->get('paycores_test_mode');
        $data['paycores_tax']           = $this->language->get('paycores_tax');
        $data['paycores_tax_ret']       = $this->language->get('paycores_tax_ret');

        $data['paycores_yes']           = $this->language->get('text_yes');
        $data['paycores_no']            = $this->language->get('text_no');

        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_payment'),
            'href' => $this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL')
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('heading_title'),
            'href' => $this->url->link('payment/paycores', 'token=' . $this->session->data['token'], 'SSL')
        );

        $data['action'] = $this->url->link('payment/paycores', 'token=' . $this->session->data['token'], 'SSL');
        $data['cancel'] = $this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL');

        $data["paycores_status"]               = isset($this->request->post['paycores_status']) ? $this->request->post['paycores_status'] : $this->config->get('paycores_status');
        $data["paycores_settings_api_key"]     = isset($this->request->post['paycoresApikey']) ? $this->request->post['paycoresApikey'] : $this->config->get('paycoresApikey');
        $data["paycores_settings_api_login"]   = isset($this->request->post['paycoresApiLogin']) ? $this->request->post['paycoresApiLogin'] : $this->config->get('paycoresApiLogin');
        $data["paycores_settings_commerce_id"] = isset($this->request->post['paycoresCommerceID']) ? $this->request->post['paycoresCommerceID'] : $this->config->get('paycoresCommerceID');
        $data["paycores_settings_test_mode"]   = isset($this->request->post['paycoresTestMode']) ? $this->request->post['paycoresTestMode'] : $this->config->get('paycoresTestMode');
        $data["paycores_order_approved_id"]    = isset($this->request->post['paycoresOrderApprovedId']) ? $this->request->post['paycoresOrderApprovedId'] : $this->config->get('paycoresOrderApprovedId');
        $data["paycores_order_failed_id"]      = isset($this->request->post['paycoresOrderCancelId']) ? $this->request->post['paycoresOrderCancelId'] : $this->config->get('paycoresOrderCancelId');

        $this->load->model('localisation/order_status');
        $data['order_statuses'] = $this->model_localisation_order_status->getOrderStatuses();

        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('payment/paycores.tpl', $data));
    }
}