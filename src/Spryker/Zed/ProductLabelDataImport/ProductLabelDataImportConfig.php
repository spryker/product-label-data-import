<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Spryker\Zed\ProductLabelDataImport;

use Generated\Shared\Transfer\DataImporterConfigurationTransfer;
use Spryker\Zed\DataImport\DataImportConfig;

class ProductLabelDataImportConfig extends DataImportConfig
{
    /**
     * @var string
     */
    public const IMPORT_TYPE_PRODUCT_LABEL = 'product-label';

    /**
     * @var string
     */
    public const IMPORT_TYPE_PRODUCT_LABEL_STORE = 'product-label-store';

    /**
     * @var int
     */
    public const MODULE_ROOT_DIRECTORY_LEVEL = 4;

    /**
     * @api
     *
     * @return \Generated\Shared\Transfer\DataImporterConfigurationTransfer
     */
    public function getProductLabelDataImporterConfiguration(): DataImporterConfigurationTransfer
    {
        $moduleDataImportDirectory = $this->getModuleRoot() . 'data' . DIRECTORY_SEPARATOR . 'import' . DIRECTORY_SEPARATOR;

        return $this->buildImporterConfiguration(
            $moduleDataImportDirectory . 'product_label.csv',
            static::IMPORT_TYPE_PRODUCT_LABEL,
        );
    }

    /**
     * @api
     *
     * @return \Generated\Shared\Transfer\DataImporterConfigurationTransfer
     */
    public function getProductLabelStoreImporterConfiguration(): DataImporterConfigurationTransfer
    {
        $moduleDataImportDirectory = $this->getModuleRoot() . 'data' . DIRECTORY_SEPARATOR . 'import' . DIRECTORY_SEPARATOR;

        return $this->buildImporterConfiguration(
            $moduleDataImportDirectory . 'product_label_store.csv',
            static::IMPORT_TYPE_PRODUCT_LABEL_STORE,
        );
    }

    /**
     * @return string
     */
    protected function getModuleDataImportDirectoryPath(): string
    {
        return $this->getModuleRoot() . 'data' . DIRECTORY_SEPARATOR . 'import' . DIRECTORY_SEPARATOR;
    }

    /**
     * @return string
     */
    protected function getModuleRoot(): string
    {
        return realpath(
            dirname(__DIR__, static::MODULE_ROOT_DIRECTORY_LEVEL),
        ) . DIRECTORY_SEPARATOR;
    }
}
