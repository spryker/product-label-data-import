<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\ProductLabelDataImport\Business\Writer\ProductLabelStore;

use Orm\Zed\ProductLabel\Persistence\SpyProductLabelStoreQuery;
use Spryker\Zed\DataImport\Business\Model\DataImportStep\DataImportStepInterface;
use Spryker\Zed\DataImport\Business\Model\DataImportStep\PublishAwareStep;
use Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface;
use Spryker\Zed\ProductLabelDataImport\Business\Writer\ProductLabelStore\DataSet\ProductLabelStoreDataSetInterface;

class ProductLabelStoreWriteStep extends PublishAwareStep implements DataImportStepInterface
{
    /**
     * @param \Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface $dataSet
     *
     * @return void
     */
    public function execute(DataSetInterface $dataSet): void
    {
        $productLabelStoreEntity = SpyProductLabelStoreQuery::create()
            ->filterByFkStore($dataSet[ProductLabelStoreDataSetInterface::COL_ID_STORE])
            ->filterByFkProductLabel($dataSet[ProductLabelStoreDataSetInterface::COL_ID_PRODUCT_LABEL])
            ->findOneOrCreate();

        $productLabelStoreEntity->save();

        $this->addPublishEvents('', $productLabelStoreEntity->getIdProductLabelStore());
    }
}
