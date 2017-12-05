<?php

namespace Tudai\CuentaCorriente\Block;

class MyAccount
    extends \Magento\Framework\View\Element\AbstractBlock
    {
      protected $session;

      public function __construct(
        \Magento\Customer\Model\Session $session,
        \Magento\Framework\View\Element\Context $context,
        \Magento\Checkout\Block\Cart\AbstractCart $quote,
        array $data = []
      ){
        $this->session = $session;
        $this->quote = $quote;
        parent::__construct($context, $data);
      }
      public function _toHtml()
      {
        $userCreditAvailable = (bool) $this->session->getCustomer ()->getData('enable_customer_credit');
        if($userCreditAvailable && $quote<=1000){
            return 'El usuario puede comprar con Cuenta Corriente';
        }else{
            return 'El usuario no puede comprar con Cuenta Corriente';
          }

      }



  }
