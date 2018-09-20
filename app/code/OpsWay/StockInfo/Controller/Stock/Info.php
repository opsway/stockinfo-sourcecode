<?php

namespace OpsWay\StockInfo\Controller\Stock;

use \Magento\Framework\App\Action\Action;
use \Magento\Framework\App\Action\Context;
use \Magento\CatalogInventory\Model\Stock\StockItemRepository;
use \Magento\Framework\Controller\Result\JsonFactory;

class Info extends Action
{
	protected $resultJsonFactory;

	protected $stockItemRepository;

    public function __construct(
		Context $context,
        StockItemRepository $stockItemRepository,
		JsonFactory $jsonFactory)
	{
	    $this->stockItemRepository = $stockItemRepository;
		$this->resultJsonFactory = $jsonFactory;
		return parent::__construct($context);
	}

    public function execute()
	{
        if ($this->getRequest()->isAjax() && $this->getRequest()->getParam('productId')) {
            $stock = $this->stockItemRepository->get($this->getRequest()->getParam('productId'));

            $result = $this->resultJsonFactory->create();
            $result = $result->setData([
                'success' => 'true',
                'qty' => $stock->getQty()
            ]);

            return $result;
        }

        $this->_forward('noroute');
        return;
	}
}
