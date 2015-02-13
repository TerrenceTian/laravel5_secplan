<?php
namespace Repositories;

use App\Shop;
use Repositories\Api\IShopRepository;

class ShopRepository implements IShopRepository
{
    public function getPopularShops() {
        $shops = Shop::popular();

        return $shops;
	}

    public function getNewShops() {
        $shops = Shop::recent();

        return $shops;
    }

    public function getAllShops() {
        $shops = Shop::with('user')->get();

        return $shops;
    }

    public function getShopById($id) {
        $shop = Shop::findOrFail($id);

        return $shop;
    }


    public function createOrUpdate($data, $id = null) {
        if (is_null($id)) {
            return Shop::create($data);
        } else {
            $shop = Shop::findOrFail($id);
            return $shop->update($data);
        }
    }

    public function destroy($id) {
        $shop = Shop::findOrFail($id);

        return $shop->delete();
    }

    public function getItemsInShop($id) {
        $itemRepo = new ItemRepository();

        return $itemRepo->getItemsByShopId($id);
    }
}
