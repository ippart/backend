<?php

class ControllerCommonHeader extends \iMega\Controller
{
    public function index()
    {
        if ($this->getRequest()->server['HTTPS']) {
            $server = $this->getConfig()->get('config_ssl');
        } else {
            $server = $this->getConfig()->get('config_url');
        }

        if (is_file(DIR_IMAGE . $this->config->get('config_icon'))) {
            $this->getDocument()->addLink($server . 'image/' . $this->getConfig()->get('config_icon'), 'icon');
        }

        $data = [
            'title'       => $this->getDocument()->getTitle(),
            'base'        => $server,
            'description' => $this->getDocument()->getDescription(),
            'keywords'    => $this->getDocument()->getKeywords(),
            'links'       => $this->getDocument()->getLinks(),
            'styles'      => $this->getDocument()->getStyles(),
            'scripts'     => $this->getDocument()->getScripts(),
            'name'        => $this->getConfig()->get('config_name'),
        ];
        if (is_file(DIR_IMAGE . $this->getConfig()->get('config_logo'))) {
            $data['logo'] = $server . 'image/' . $this->getConfig()->get('config_logo');
        } else {
            $data['logo'] = '';
        }

        $this->load->language('common/header');

        $data['text_home'] = $this->getLanguage()->get('text_home');

        // Wishlist
        if ($this->customer->isLogged()) {
            $this->load->model('account/wishlist');

            $data['text_wishlist'] = sprintf(
                $this->language->get('text_wishlist'),
                $this->model_account_wishlist->getTotalWishlist()
            );
        } else {
            $data['text_wishlist'] = sprintf(
                $this->language->get('text_wishlist'),
                (isset($this->session->data['wishlist']) ? count($this->session->data['wishlist']) : 0)
            );
        }

        $data['text_shopping_cart'] = $this->language->get('text_shopping_cart');
        $data['text_logged']        = sprintf(
            $this->language->get('text_logged'),
            $this->url->link('account/account', '', true),
            $this->customer->getFirstName(),
            $this->url->link('account/logout', '', true)
        );

        $data['text_account']     = $this->language->get('text_account');
        $data['text_register']    = $this->language->get('text_register');
        $data['text_login']       = $this->language->get('text_login');
        $data['text_order']       = $this->language->get('text_order');
        $data['text_transaction'] = $this->language->get('text_transaction');
        $data['text_download']    = $this->language->get('text_download');
        $data['text_logout']      = $this->language->get('text_logout');
        $data['text_checkout']    = $this->language->get('text_checkout');
        $data['text_category']    = $this->language->get('text_category');
        $data['text_all']         = $this->language->get('text_all');

        $data['home']          = $this->url->link('common/home');
        $data['wishlist']      = $this->url->link('account/wishlist', '', true);
        $data['logged']        = $this->customer->isLogged();
        $data['account']       = $this->url->link('account/account', '', true);
        $data['register']      = $this->url->link('account/register', '', true);
        $data['login']         = $this->url->link('account/login', '', true);
        $data['order']         = $this->url->link('account/order', '', true);
        $data['transaction']   = $this->url->link('account/transaction', '', true);
        $data['download']      = $this->url->link('account/download', '', true);
        $data['logout']        = $this->url->link('account/logout', '', true);
        $data['shopping_cart'] = $this->url->link('checkout/cart');
        $data['checkout']      = $this->url->link('checkout/checkout', '', true);
        $data['contact']       = $this->url->link('information/contact');
        $data['telephone']     = $this->config->get('config_telephone');

        $data['language'] = $this->load->controller('common/language');
        $data['currency'] = $this->load->controller('common/currency');
        $data['search']   = $this->load->controller('common/search');
        $data['cart']     = $this->load->controller('common/cart');

        // For page specific css
        if (isset($this->request->get['route'])) {
            if (isset($this->request->get['product_id'])) {
                $class = '-' . $this->request->get['product_id'];
            } elseif (isset($this->request->get['path'])) {
                $class = '-' . $this->request->get['path'];
            } elseif (isset($this->request->get['manufacturer_id'])) {
                $class = '-' . $this->request->get['manufacturer_id'];
            } elseif (isset($this->request->get['information_id'])) {
                $class = '-' . $this->request->get['information_id'];
            } else {
                $class = '';
            }

            $data['class'] = str_replace('/', '-', $this->request->get['route']) . $class;
        } else {
            $data['class'] = 'common-home';
        }

        return $this->load->view('common/header', $data);
    }
}