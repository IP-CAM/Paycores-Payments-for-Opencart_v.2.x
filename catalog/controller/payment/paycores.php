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
        $data['button_confirm'] = $this->language->get('button_confirm');
        $data['paycores_tanks_orden'] = $this->language->get('thanks_orden');
        $data["action"] = $this->config->get('paycoresTestMode') ? 'http://localhost/business_core/web-checkout/' : 'http://localhost/business_core/web-checkout/';//'https://sandbox.paycores.com/web-checkout/' : 'https://business.paycores.com/web-checkout/';

        $this->load->model('checkout/order');

        $order_info = $this->model_checkout_order->getOrder($this->session->data['order_id']);

        $paycores = "paycores";

        if ($order_info) {
            $products = '';
            $paycoresQuantity = 0;
            foreach ($this->cart->getProducts() as $product) {
                $paycoresQuantity += $product['quantity'];
                $products .= $product['quantity'] . ' x ' . $product['name'] . ', ';
            }

            $paycoresAmount = $this->currency->format($order_info['total'], $order_info['currency_code'], $order_info['currency_value'], false);
            $paycoresData = array();
            $usrAddress = $order_info['payment_address_1'] . " " . $order_info['payment_address_2'];

            $paycoresData[$paycores.'_is_ecommerce']        = true;
            $paycoresData[$paycores.'_type_ecommerce']      = $paycores."OpenCart";
            $paycoresData[$paycores.'_order_id']            = $this->session->data['order_id'];
            $paycoresData[$paycores.'_access_commerceid']   = trim($this->config->get('paycoresCommerceID'));
            $paycoresData[$paycores.'_access_key']          = trim($this->config->get('paycoresApikey'));
            $paycoresData[$paycores.'_access_login']        = trim($this->config->get('paycoresApiLogin'));
            $paycoresData[$paycores.'_test']                = trim($this->config->get('paycoresTestMode')) ? "1" : "2";
            $paycoresData[$paycores.'_amount']              = $paycoresAmount;
            $paycoresData[$paycores.'_currency']            = $order_info['currency_code'];
            $paycoresData[$paycores.'_usr_name']            = html_entity_decode($order_info['shipping_firstname'], ENT_QUOTES, 'UTF-8');
            $paycoresData[$paycores.'_usr_lname']           = html_entity_decode($order_info['shipping_lastname'], ENT_QUOTES, 'UTF-8');
            $paycoresData[$paycores.'_usr_email']           = $order_info['email'];
            $paycoresData[$paycores.'_usr_phone']           = html_entity_decode($order_info['telephone'], ENT_QUOTES, 'UTF-8');
            $paycoresData[$paycores.'_usr_cellphone']       = html_entity_decode($order_info['telephone'], ENT_QUOTES, 'UTF-8');
            $paycoresData[$paycores.'_usr_address']         = html_entity_decode(substr($usrAddress, 0, 40).(strlen($usrAddress)>40 ? '...' : ""), ENT_QUOTES, 'UTF-8');
            $paycoresData[$paycores.'_usr_city']            = html_entity_decode($order_info['payment_city'], ENT_QUOTES, 'UTF-8');
            $paycoresData[$paycores.'_usr_state']           = html_entity_decode($order_info['payment_zone'], ENT_QUOTES, 'UTF-8');
            $paycoresData[$paycores.'_usr_country_ad']      = html_entity_decode($order_info['payment_iso_code_2'], ENT_QUOTES, 'UTF-8');
            $paycoresData[$paycores.'_usr_nation']          = html_entity_decode($order_info['payment_iso_code_2'], ENT_QUOTES, 'UTF-8');
            $paycoresData[$paycores.'_usr_postal_code']     = html_entity_decode($order_info['payment_postcode'], ENT_QUOTES, 'UTF-8');
            $paycoresData[$paycores.'_description']         = html_entity_decode(substr($products, 0, 25).(strlen($products)>25 ? '...' : ""), ENT_QUOTES, 'UTF-8');
            $paycoresData[$paycores.'_gd_name']             = html_entity_decode(substr($products, 0, 16).(strlen($products)>16 ? '...' : ""), ENT_QUOTES, 'UTF-8');
            $paycoresData[$paycores.'_gd_descript']         = html_entity_decode(substr($products, 0, 16).(strlen($products)>16 ? '...' : ""), ENT_QUOTES, 'UTF-8');
            $paycoresData[$paycores.'_gd_quantity']         = html_entity_decode($paycoresQuantity, ENT_QUOTES, 'UTF-8');
            $paycoresData[$paycores.'_gd_item']             = intval($paycoresAmount);
            $paycoresData[$paycores.'_gd_code']             = intval($paycoresAmount);
            $paycoresData[$paycores.'_gd_amount']           = $paycoresAmount;
            $paycoresData[$paycores.'_gd_unitPrice']        = $paycoresAmount;
            $paycoresData[$paycores.'_tax']                 = "0.00";
            $paycoresData[$paycores.'_tax_ret']             = "0.00";
            $paycoresData[$paycores.'_extra1']              = date('His') . $this->session->data['order_id'];
            $paycoresData[$paycores.'_response_url']        = $this->url->link('payment/paycores/callback');
            $paycoresData[$paycores.'_confirmation_url']    = $this->url->link('payment/paycores/callback');

            $data['paycoresData'] = $paycoresData;
        }

        if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/payment/paycores.tpl')){
            return $this->load->view($this->config->get('config_template') . '/template/payment/paycores.tpl', $data);
        } else {
            return $this->load->view('payment/paycores.tpl', $data);
        }
    }

    public function callback() {
        if (isset($this->request->post)) {
            $this->load->model('checkout/order');
            $order_id = $this->request->post["paycores_order_id"];
            $paycoresResponse = $this->request->post["codeResponse"];

            switch ($paycoresResponse){
                case "001":
                    $order_info = $this->model_checkout_order->getOrder($order_id);

                    if ($order_info) {
                        $this->model_checkout_order->addOrderHistory($order_id, $this->config->get('paycoresOrderApprovedId'));
                        $this->response->redirect($this->url->link('checkout/success', '', 'SSL'));
                    }
                    break;
                default :
                    $this->language->load('payment/paycores');

                    $data['breadcrumbs'] = array();

                    $data['breadcrumbs'][] = array(
                        'text' => $this->language->get('text_home'),
                        'href' => $this->url->link('common/home')
                    );

                    $data['breadcrumbs'][] = array(
                        'text' => $this->language->get('paycores_basket'),
                        'href' => $this->url->link('checkout/cart')
                    );

                    $data['breadcrumbs'][] = array(
                        'text' => $this->language->get('paycores_checkout'),
                        'href' => $this->url->link('checkout/checkout', '', 'SSL')
                    );

                    $data['breadcrumbs'][] = array(
                        'text' => $this->language->get('paycores_failed'),
                        'href' => $this->url->link('checkout/success')
                    );

                    $data['heading_title'] = $this->language->get('order_denied');
                    $data['text_message'] = sprintf($this->language->get('description_error'), $this->url->link('information/contact'),  sprintf($this->language->get('code_error'), $paycoresResponse));
                    $data['button_continue'] = $this->language->get('button_continue');
                    $data['continue'] = $this->url->link('common/home');

                    $data['column_left'] = $this->load->controller('common/column_left');
                    $data['column_right'] = $this->load->controller('common/column_right');
                    $data['content_top'] = $this->load->controller('common/content_top');
                    $data['content_bottom'] = $this->load->controller('common/content_bottom');
                    $data['footer'] = $this->load->controller('common/footer');
                    $data['header'] = $this->load->controller('common/header');

                    $this->model_checkout_order->addOrderHistory($order_id, $this->config->get('paycoresOrderCancelId'));

                    if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/payment/paycores.tpl')){
                        $this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/common/success.tpl', $data));
                    } else {
                        $this->response->setOutput($this->load->view('common/success.tpl', $data));
                    }
                    break;
            }
        } else {
            die('Illegal Access');
        }
    }
}