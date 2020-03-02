<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\ProductLabelDataImport;

use Generated\Shared\Transfer\DataImporterConfigurationTransfer;
use Spryker\Zed\DataImport\DataImportConfig;

class ProductLabelDataImportConfig extends DataImportConfig
{
    public const IMPORT_TYPE_PRODUCT_LABEL = 'product-label';
    public const IMPORT_TYPE_PRODUCT_LABEL_STORE = 'product-label-store';

    /**
     * @return \Generated\Shared\Transfer\DataImporterConfigurationTransfer
     */
    public function getProductLabelDataImporterConfiguration(): DataImporterConfigurationTransfer
    {
        $moduleDataImportDirectory = $this->getModuleRoot() . 'data' . DIRECTORY_SEPARATOR . 'import' . DIRECTORY_SEPARATOR;

        return $this->buildImporterConfiguration(
            $moduleDataImportDirectory . 'product_label.csv',
            static::IMPORT_TYPE_PRODUCT_LABEL
        );
    }

    /**
     * @return \Generated\Shared\Transfer\DataImporterConfigurationTransfer
     */
    public function getProductLabelStoreImporterConfiguration(): DataImporterConfigurationTransfer
    {
        $moduleDataImportDirectory = $this->getModuleRoot() . 'data' . DIRECTORY_SEPARATOR . 'import' . DIRECTORY_SEPARATOR;

        return $this->buildImporterConfiguration(
            $moduleDataImportDirectory . 'product_label_store.csv',
            static::IMPORT_TYPE_PRODUCT_LABEL_STORE
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
            dirname(__DIR__, 4)
        ) . DIRECTORY_SEPARATOR;
    }
}