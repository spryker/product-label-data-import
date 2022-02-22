<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Spryker\Zed\ProductLabelDataImport\Business;

use Spryker\Zed\DataImport\Business\DataImportBusinessFactory;
use Spryker\Zed\DataImport\Business\Model\DataImporterAfterImportInterface;
use Spryker\Zed\DataImport\Business\Model\DataImporterInterface;
use Spryker\Zed\DataImport\Business\Model\DataImportStep\DataImportStepInterface;
use Spryker\Zed\ProductLabelDataImport\Business\Writer\ProductLabel\DataSet\ProductLabelDataSetInterface;
use Spryker\Zed\ProductLabelDataImport\Business\Writer\ProductLabel\Hook\ProductLabelAfterImportPublishHook;
use Spryker\Zed\ProductLabelDataImport\Business\Writer\ProductLabel\ProductLabelAttributeWriterStep;
use Spryker\Zed\ProductLabelDataImport\Business\Writer\ProductLabel\ProductLabelProductAbstractWriterStep;
use Spryker\Zed\ProductLabelDataImport\Business\Writer\ProductLabel\ProductLabelWriterStep;
use Spryker\Zed\ProductLabelDataImport\Business\Writer\ProductLabel\SkusToProductAbstractIdsStep;
use Spryker\Zed\ProductLabelDataImport\Business\Writer\ProductLabelStore\ProductLabelNameToIdProductLabelStep;
use Spryker\Zed\ProductLabelDataImport\Business\Writer\ProductLabelStore\ProductLabelStoreWriteStep;
use Spryker\Zed\ProductLabelDataImport\Business\Writer\ProductLabelStore\StoreNameToIdStoreStep;

/**
 * @method \Spryker\Zed\ProductLabelDataImport\ProductLabelDataImportConfig getConfig()
 * @method \Spryker\Zed\DataImport\Business\Model\DataSet\DataSetStepBrokerTransactionAware createTransactionAwareDataSetStepBroker($bulkSize = null)
 * @method \Spryker\Zed\DataImport\Business\Model\DataImporter getCsvDataImporterFromConfig(\Generated\Shared\Transfer\DataImporterConfigurationTransfer $dataImporterConfigurationTransfer)
 */
class ProductLabelDataImportBusinessFactory extends DataImportBusinessFactory
{
    /**
     * @return \Spryker\Zed\DataImport\Business\Model\DataImporterInterface
     */
    public function getProductLabelImporter(): DataImporterInterface
    {
        $dataImporter = $this->getCsvDataImporterFromConfig($this->getConfig()->getProductLabelDataImporterConfiguration());

        $dataSetStepBroker = $this->createTransactionAwareDataSetStepBroker();
        $dataSetStepBroker
            ->addStep($this->createAddLocalesStep())
            ->addStep($this->createLocalizedAttributesExtractorStep([ProductLabelDataSetInterface::COL_NAME]))
            ->addStep($this->createSkusToProductAbstractIdsStep())
            ->addStep($this->createProductLabelWriterStep())
            ->addStep($this->createProductLabelAttributeWriteStep())
            ->addStep($this->createProductLabelProductAbstractWriterStep());

        $dataImporter->addDataSetStepBroker($dataSetStepBroker);
        $dataImporter->addAfterImportHook($this->createProductLabelAfterImportPublishHook());

        return $dataImporter;
    }

    /**
     * @return \Spryker\Zed\DataImport\Business\Model\DataImporterInterface
     */
    public function getProductLabelStoreImporter(): DataImporterInterface
    {
        $dataImporter = $this->getCsvDataImporterFromConfig($this->getConfig()->getProductLabelStoreImporterConfiguration());

        $dataSetStepBroker = $this->createTransactionAwareDataSetStepBroker();
        $dataSetStepBroker
            ->addStep($this->createProductLabelNameToIdProductLabelStep())
            ->addStep($this->createStoreNameToIdStoreStep())
            ->addStep($this->createProductLabelStoreWriteStep());

        $dataImporter->addDataSetStepBroker($dataSetStepBroker);

        return $dataImporter;
    }

    /**
     * @return \Spryker\Zed\DataImport\Business\Model\DataImportStep\DataImportStepInterface
     */
    public function createSkusToProductAbstractIdsStep(): DataImportStepInterface
    {
        return new SkusToProductAbstractIdsStep();
    }

    /**
     * @return \Spryker\Zed\DataImport\Business\Model\DataImportStep\DataImportStepInterface
     */
    public function createProductLabelWriterStep(): DataImportStepInterface
    {
        return new ProductLabelWriterStep();
    }

    /**
     * @return \Spryker\Zed\DataImport\Business\Model\DataImportStep\DataImportStepInterface
     */
    public function createProductLabelAttributeWriteStep(): DataImportStepInterface
    {
        return new ProductLabelAttributeWriterStep();
    }

    /**
     * @return \Spryker\Zed\DataImport\Business\Model\DataImportStep\DataImportStepInterface
     */
    public function createProductLabelProductAbstractWriterStep(): DataImportStepInterface
    {
        return new ProductLabelProductAbstractWriterStep();
    }

    /**
     * @return \Spryker\Zed\DataImport\Business\Model\DataImporterAfterImportInterface
     */
    public function createProductLabelAfterImportPublishHook(): DataImporterAfterImportInterface
    {
        return new ProductLabelAfterImportPublishHook();
    }

    /**
     * @return \Spryker\Zed\DataImport\Business\Model\DataImportStep\DataImportStepInterface
     */
    public function createProductLabelNameToIdProductLabelStep(): DataImportStepInterface
    {
        return new ProductLabelNameToIdProductLabelStep();
    }

    /**
     * @return \Spryker\Zed\DataImport\Business\Model\DataImportStep\DataImportStepInterface
     */
    public function createStoreNameToIdStoreStep(): DataImportStepInterface
    {
        return new StoreNameToIdStoreStep();
    }

    /**
     * @return \Spryker\Zed\DataImport\Business\Model\DataImportStep\DataImportStepInterface
     */
    public function createProductLabelStoreWriteStep(): DataImportStepInterface
    {
        return new ProductLabelStoreWriteStep();
    }
}
