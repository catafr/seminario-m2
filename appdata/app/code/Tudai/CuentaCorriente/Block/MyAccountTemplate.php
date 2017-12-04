<?php
/**
 * Class MyAccountTemplate
 *
 * @author   Facundo Capua <fcapua@summasolutions.net>
 * @license  http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 * @link     http://www.summasolutions.net/
 */

namespace Tudai\CuentaCorriente\Block;

use Magento\Framework\View\Element\Template;

class MyAccountTemplate
    extends \Magento\Framework\View\Element\Template
{

        protected $session;

        public function __construct(
            \Magento\Customer\Model\Session $session,
            Template\Context $context,
            array $data = [])
        {
            $this->session = $session;

            parent::__construct($context, $data);
        }

        public function isUserCreditAvailable()
        {
            return (bool) $this->session->getCustomer()->getData('enable_customer_credit');
        }
}