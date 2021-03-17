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

namespace Lof\Sitemap\Setup;

use Magento\Catalog\Model\Category;
use Magento\Catalog\Model\Product;
use Magento\Catalog\Setup\CategorySetupFactory;
use Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface;
use Magento\Eav\Model\Entity\Attribute\Source\Boolean;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

/**
 * Class InstallData
 * @package Lof\Sitemap\Setup
 */
class InstallData implements InstallDataInterface
{
    /**
     * @var CategorySetupFactory
     */
    protected $categorySetupFactory;

    /**
     * @var EavSetupFactory
     */
    protected $eavSetupFactory;

    /**
     * InstallData constructor.
     *
     * @param EavSetupFactory $eavSetupFactory
     * @param CategorySetupFactory $categorySetupFactory
     */
    public function __construct(
        EavSetupFactory $eavSetupFactory,
        CategorySetupFactory $categorySetupFactory
    ) {
        $this->categorySetupFactory = $categorySetupFactory;
        $this->eavSetupFactory      = $eavSetupFactory;
    }

    /**
     * @param ModuleDataSetupInterface $setup
     * @param ModuleContextInterface $context
     */
    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();
        $eavSetup = $this->eavSetupFactory->create(['setup' => $setup]);

        /**
         * Product attribute
         */
        $eavSetup->removeAttribute(Product::ENTITY, 'mp_exclude_sitemap');
        $eavSetup->addAttribute(Product::ENTITY, 'mp_exclude_sitemap', [
            'type'                    => 'varchar',
            'backend'                 => '',
            'frontend'                => '',
            'label'                   => 'Exclude Sitemap',
            'note'                    => 'Added by Lof Sitemap',
            'input'                   => 'select',
            'class'                   => '',
            'source'                  => Boolean::class,
            'global'                  => ScopedAttributeInterface::SCOPE_GLOBAL,
            'visible'                 => true,
            'required'                => false,
            'user_defined'            => false,
            'default'                 => '',
            'searchable'              => false,
            'filterable'              => false,
            'comparable'              => false,
            'visible_on_front'        => false,
            'used_in_product_listing' => true,
            'unique'                  => false,
            'group'                   => 'Search Engine Optimization',
            'sort_order'              => 100,
            'apply_to'                => '',
        ]);

        /**
         * Category attribute
         */
        $categorySetup = $this->categorySetupFactory->create(['setup' => $setup]);

        $categorySetup->removeAttribute(Category::ENTITY, 'mp_exclude_sitemap');
        $categorySetup->addAttribute(Category::ENTITY, 'mp_exclude_sitemap', [
            'type'       => 'int',
            'label'      => '',
            'input'      => 'select',
            'source'     => Boolean::class,
            'required'   => false,
            'sort_order' => 100,
            'global'     => ScopedAttributeInterface::SCOPE_STORE,
            'group'      => 'Search Engine Optimization',
        ]);

        $setup->endSetup();
    }
}
