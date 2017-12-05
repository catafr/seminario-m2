<?php


namespace Tudai\CuentaCorriente\Model;

class CustomerCredit
    extends \Magento\Payment\Model\Method\AbstractMethod
{

    const PAYMENT_METHOD_USERCREDIT_CODE = 'customer_credit';
    const LIMIT = 'Payment\CustomerCredit\Limit';

    protected $scopeConfig;

    /**
     * Payment method code
     *
     * @var string
     */
    protected $_code = self::PAYMENT_METHOD_USERCREDIT_CODE;


    /**
     * Availability option
     *
     * @var bool
     */
    protected $_isOffline = true;

    /**
     * @var \Magento\Customer\Model\Session
     */
    protected $customerSession;


    public function __construct(
        \Magento\Customer\Model\Session $customerSession,
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Api\ExtensionAttributesFactory $extensionFactory,
        \Magento\Framework\Api\AttributeValueFactory $customAttributeFactory,
        \Magento\Payment\Helper\Data $paymentData,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Magento\Payment\Model\Method\Logger $logger,
        \Magento\Framework\Model\ResourceModel\AbstractResource $resource = null,
        \Magento\Framework\Data\Collection\AbstractDb $resourceCollection = null,
      //  \Magento\Checkout\Block\Cart\AbstractCart $quote,
        array $data = []
    ) {
        //Me traigo por injección de dependencia la sesión del usuario
        $this->customerSession = $customerSession;
        $this->scopeConfig = $scopeConfig;
        //$this->quote = $quote;
        parent::__construct($context, $registry, $extensionFactory, $customAttributeFactory, $paymentData, $scopeConfig,
            $logger, $resource, $resourceCollection, $quote, $data);
    }

    public function getLimit() {

     $limit =  $this->scopeConfig->getValue(self::LIMIT);
}

    public function isAvailable(\Magento\Quote\Api\Data\CartInterface $quote = null)
    {
        $isAvailable = parent::isAvailable($quote);

        //Si ya viene habilitado el método (verificando si está activo)
        if($isAvailable && $quote <= $limit){
            //Tomo el valor de si tiene habilitado el credito o no para saber si lo muestro
            $isAvailable = (bool) $this->customerSession->getCustomer()->getData('enable_customer_credit');
                return $isAvailable;
        }
        else{
            return 'El usuario no puede comprar con Cuenta Corriente';
  
        }

    }
