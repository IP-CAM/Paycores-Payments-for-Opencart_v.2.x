<?php
/**
 * Created by Paycores.com.
 * User: paycores-02
 * Date: 30/10/17
 * Time: 09:41 AM
 */

class ModelPaymentPaycores extends Model {
    public function getMethod($address, $total) {
        $this->load->language('payment/paycores');

        $method_data = array(
            'code'          => 'paycores',
            'title'         => $this->language->get('text_title'),
            'terms'         => '',
            'sort_order'    => $this->config->get('paycores_sort_order')
        );

        return $method_data;
    }
}