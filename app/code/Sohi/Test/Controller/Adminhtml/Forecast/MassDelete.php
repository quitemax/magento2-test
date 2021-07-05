<?php
/**
 * Copyright © Sohi. All rights reserved.
 * See LICENSE_SOHI.txt for license details.
 */

declare(strict_types=1);

namespace Sohi\Test\Controller\Adminhtml\Forecast;

use Exception;
use Sohi\Test\Api\ForecastRepositoryInterface;
use Sohi\Test\Logger\Logger;
use Sohi\Test\Model\ResourceModel\Forecast\CollectionFactory as ForecastCollectionFactory;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Backend\Model\View\Result\Redirect;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Ui\Component\MassAction\Filter;

/**
 * Delete Forecasts list action
 */
class MassDelete extends Action implements HttpPostActionInterface
{
    /**
     * Authorization level of a basic admin session
     */
    const ADMIN_RESOURCE = 'Fwc_Forecast::certificate_delete';

    /**
     * @var Filter
     */
    private Filter $filter;

    /**
     * @var ForecastCollectionFactory
     */
    private ForecastCollectionFactory $forecastCollectionFactory;

    /**
     * @var ForecastRepositoryInterface
     */
    private ForecastRepositoryInterface $forecastRepository;

    /**
     * @var Logger
     */
    private $logger;

    /**
     * @param Context $context
     * @param Filter $filter
     * @param ForecastCollectionFactory $forecastCollectionFactory
     * @param ForecastRepositoryInterface $forecastRepository
     * @param Logger $logger
     */
    public function __construct(
        Context $context,
        Filter $filter,
        ForecastCollectionFactory $forecastCollectionFactory,
        ForecastRepositoryInterface $forecastRepository,
        Logger $logger
    ) {
        $this->filter = $filter;
        $this->forecastCollectionFactory = $forecastCollectionFactory;
        $this->forecastRepository = $forecastRepository;
        $this->logger = $logger;
        parent::__construct($context);
    }

    /**
     * @inheritDoc
     */
    public function execute()
    {
        /** @var Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();

        try {
            $forecastCollection = $this->filter->getCollection($this->forecastCollectionFactory->create());
            $deleted = 0;
            $errors = 0;

            foreach ($forecastCollection->getItems() as $forecast) {
                try {
                    $this->forecastRepository->delete($forecast);
                    $deleted++;
                } catch (CouldNotDeleteException $e) {
                    $this->logger->error($e->getLogMessage());
                    $errors++;
                }
            }

            if ($deleted) {
                $this->messageManager->addSuccessMessage(
                    __('A total of %1 record(s) have been deleted.', $deleted)
                );
            }

            if ($errors) {
                $this->messageManager->addErrorMessage(
                    __(
                        'A total of %1 record(s) haven\'t been deleted. Please see server logs for more details.',
                        $errors
                    )
                );
            }
        } catch (Exception $e) {
            $this->logger->error($e->getMessage());
            $this->messageManager->addSuccessMessage(__('Sorry, something went wrong. Please see log for details.'));
        }

        return $resultRedirect->setPath('*/*/');
    }
}
