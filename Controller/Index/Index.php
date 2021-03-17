<?php
/**
 * Lof
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Lof.com license that is
 * available through the world-wide-web at this URL:
 * https://landofcoder.com/LICENSE.txt
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade this extension to newer
 * version in the future.
 *
 * @category    Lof
 * @package     Lof_Sitemap
 * @copyright   Copyright (c) Lof (http://landofcoder.com/)
 * @license     https://landofcoder.com/LICENSE.txt
 */

namespace Lof\Sitemap\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Exception\NotFoundException;
use Magento\Framework\View\Result\Page;
use Magento\Framework\View\Result\PageFactory;
use Lof\Sitemap\Helper\Data as HelperConfig;

/**
 * Class Index
 * @package Lof\Sitemap\Controller\Index
 */
class Index extends Action
{
    /**
     * @var PageFactory
     */
    protected $pageFactory;

    /**
     * @var HelperConfig
     */
    protected $helperConfig;

    /**
     * Index constructor.
     *
     * @param Context $context
     * @param PageFactory $pageFactory
     * @param HelperConfig $helperConfig
     */
    public function __construct(Context $context, PageFactory $pageFactory, HelperConfig $helperConfig)
    {
        $this->pageFactory  = $pageFactory;
        $this->helperConfig = $helperConfig;

        return parent::__construct($context);
    }

    /**
     * @return Page
     * @throws NotFoundException
     */
    public function execute()
    {
        if (!$this->helperConfig->isEnableHtmlSiteMap()) {
            throw new NotFoundException(__('Parameter is incorrect.'));
        }

        $page = $this->pageFactory->create();
        $page->getConfig()->getTitle()->set(__('HTML Sitemap'));

        return $page;
    }
}
