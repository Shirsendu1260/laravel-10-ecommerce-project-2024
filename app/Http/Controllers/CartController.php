<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartController extends Controller
{
    public function add_to_cart(Request $request)
    {
        $product = Product::where("id", $request->input("product_id"))->with("get_product_images")->first();
        $qty = $request->input("qty");
        $status = null;
        $session_flash_type = "";
        $msg = "";
        // dd($product->get_product_images->first());

        if (empty($product)) {
            return response()->json([
                'status' => false,
                'msg' => 'Product not found.',
            ]);
        }

        // If products are already there in cart
        if (Cart::count() > 0) {
            // echo "Products are already there in cart.";

            $cart_content = Cart::content(); // Collection of all items that are already added to the cart
            $product_already_in_cart = false;

            foreach ($cart_content as $item) {
                // If the product exists in the cart
                if ($item->id == $product->id) {
                    $product_already_in_cart = true;
                }
            }

            // If the product does not exist in the cart, then add the product to cart
            if ($product_already_in_cart == false) {
                Cart::add([
                    'id' => $product->id,
                    'name' => $product->title,
                    'qty' => $qty,
                    'price' => $product->price,
                    'options' =>
                        [
                            'product_image' => (!empty($product->get_product_images)) ? $product->get_product_images->first()->name : '',
                            'slug' => $product->slug,
                        ],
                ]);

                $status = true;
                $session_flash_type = "success";
                $msg = $product->title . ' is added to cart.';

                session()->flash($session_flash_type, $msg);
            }
            // If the product exists in the cart
            else {
                $status = false;
                $msg = $product->title . " was already there in cart.";
            }
        }
        // If cart is empty
        else {
            // echo "Cart is empty. Now the product is going to be added to cart.";

            Cart::add([
                'id' => $product->id,
                'name' => $product->title,
                'qty' => $qty,
                'price' => $product->price,
                'options' =>
                    [
                        'product_image' => (!empty($product->get_product_images)) ? $product->get_product_images->first()->name : '',
                        'slug' => $product->slug,
                    ],
            ]);

            $status = true;
            $session_flash_type = "success";
            $msg = $product->title . ' is added to cart.';

            session()->flash($session_flash_type, $msg);
        }

        return response()->json([
            'status' => $status,
            'msg' => $msg,
        ]);
    }

    public function cart()
    {
        // dd(Cart::content());
        $cart_content = Cart::content();

        return view("user_end.cart", compact("cart_content"));
    }

    public function update_cart_qty(Request $request)
    {
        $row_id = $request->input("row_id");
        $qty = $request->input("qty");
        $status = null;
        $session_flash_type = "";
        $msg = "";

        $item = Cart::get($row_id);
        $product = Product::find($item->id);

        // Check if requested product is available in stock (if the product's track quantity was set by admin)
        if ($product->track_qty == 1) {
            if ($qty <= $product->qty) {
                Cart::update($row_id, $qty);
                $status = true;
                $session_flash_type = "success";
                $msg = 'Cart updated successfully.';
            } else {
                $status = true;
                $session_flash_type = "error";
                $msg = "Requested quantity (" . $qty . ") is unavailable at this moment.";
            }
        }
        // If the product's track quantity was not set by admin, then no need to check for available qty, update cart qty without any issue
        else {
            Cart::update($row_id, $qty);
            $status = true;
            $session_flash_type = "success";
            $msg = 'Cart updated successfully.';
        }

        session()->flash($session_flash_type, $msg);

        return response()->json([
            'status' => $status,
            'msg' => $msg,
        ]);
    }

    public function delete_cart_item(Request $request)
    {
        $row_id = $request->input("row_id");
        $status = null;
        $session_flash_type = "";
        $msg = "";

        $item = Cart::get($row_id);

        // Check if the item is available in cart or not
        if (empty($item)) {
            $status = true;
            $session_flash_type = "error";
            $msg = 'Item not found, unable to delete the item.';
        } else {
            Cart::remove($row_id);
            $status = true;
            $session_flash_type = "success";
            $msg = 'Item deleted successfully.';
        }

        if (Cart::count() == 0) {
            session()->forget('discount_coupon');
        }

        session()->flash($session_flash_type, $msg);

        return response()->json([
            'status' => $status,
            'msg' => $msg,
        ]);
    }
}
