<?php
declare(strict_types=1);

namespace App\Service;

use App\Repositories\Menu\Params\MenuParams;

interface MenuService 
{
     /**
     * 丸々
     */
    public function featchAllMenu(bool $withtranshed);

    /**
     * 
     */
    // public function findMenu(int $customerId, bool $withtranshed);

    /**
     * 
     */
    public function storeMenu(MenuParams $params);

    /**
     * 
     */
    // public function getImageMenu();

    /**
     * 
     */
    // public function storeImagePhoto();

    //  /**
    //  * 
    //  */
    // public function updateMenu(CustomerParams $params, $cutomer);
}
?>