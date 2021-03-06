<?php

namespace App;
use Session;

class Cart
{
	// private $items;


	// public function __construct()
	// {
	// 	$this->items = session('cart', []);
	// }

	// public function addItem($id)
	// {
	// 	if(array_key_exists($id, $this->items)) {

	// 	} else {
	// 		$this->items[$id] = ['name' => 'iphone x', 'amount' => 1, 'price' = 700];
	// 	}
	// }

	public $items = null;
	public $totalQty = 0;
	public $totalPrice = 0;

	public function __construct($oldCart)
	{
		if ($oldCart) 
		{
			$this->items = $oldCart->items;
			$this->totalQty = $oldCart->totalQty;
			$this->totalPrice = $oldCart->totalPrice;
		}
	}

	public function add($item, $id)
	{
		$storedItem = ['qty' => 0, 'product_price' => $item->product_price, 'item' => $item];
		if ($this->items) {
			if (array_key_exists($id, $this->items)) 
			{
				$storedItem = $this->items[$id];
			}
		}
		$storedItem['qty']++;
		$storedItem['product_price'] = $item->product_price * $storedItem['qty'];
		$this->items[$id] = $storedItem;
		$this->totalQty++;
		$this->totalPrice += $item->product_price;
	}

	public function delete()
	{
		session()->put('cart', null);
	}

	public function deleteOne($id)
	{
		$this->items[$id]['qty']--;
		$this->items[$id]['product_price'] -= $this->items[$id]['item']['product_price'];
		$this->totalQty--;
		$this->totalPrice -= $this->items[$id]['item']['product_price'];

		if ($this->items[$id]['qty'] <= 0) {
			unset($this->items[$id]);
		}
	}

	public function removeProduct($id) 
	{
		$this->totalQty -= $this->items[$id]['qty'];
		$this->totalPrice -= $this->items[$id]['product_price'];
		unset($this->items[$id]);
	}

	public function deleteAfterOrder()
	{
		session()->put('cart', null);
	}
}