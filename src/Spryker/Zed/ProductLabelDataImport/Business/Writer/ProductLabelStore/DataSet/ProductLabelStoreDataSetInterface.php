<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Spryker\Zed\ProductLabelDataImport\Business\Writer\ProductLabelStore\DataSet;

interface ProductLabelStoreDataSetInterface
{
    /**
     * @var string
     */
    public const COL_NAME = 'name';

    /**
     * @var string
     */
    public const COL_STORE_NAME = 'store_name';

    /**
     * @var string
     */
    public const COL_ID_PRODUCT_LABEL = 'id_product_label';

    /**
     * @var string
     */
    public const COL_ID_STORE = 'id_store';
}
