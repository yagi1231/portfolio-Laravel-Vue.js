<?php
declare(strict_types=1);

namespace App\Service;

use App\Repositories\Customer\CustomerParams;

interface CustomerService 
{
     /**
     * 丸々
     */
    public function featchAllCustomer(bool $withtranshed);

    /**
     * 
     */
    public function findCustomer(int $customerId, bool $withtranshed);

    /**
     * 
     */
    public function storeCustomer(CustomerParams $params);

    //  /**
    //  * 
    //  */
    public function updateCustomer(CustomerParams $params, $cutomer);

    /**
     * 
     */
    public function deletetCustomer($customer): void;

    /**
     * 削除したお客様情報を復元させる
     */
    public function restoreCustomer($customer): void;
}
?>