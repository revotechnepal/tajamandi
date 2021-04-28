<?php

namespace App\Http\Controllers;

use App\Mail\VerifyUserEmail;
use App\Models\Cart;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Subcategory;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class FrontController extends Controller
{
    public function index()
    {
        if(Auth::user()->role_id == 1) {
            return view('backend.dashboard');

        } elseif(Auth::user()->role_id == 3) {
            $subcategories = Subcategory::latest()->get();
            $featuredproducts = Product::latest()->where('featured', 1)->get();
            $offerproducts = Product::latest()->where('discount', '>', 0)->take(6)->get();
            $filterproducts = Product::latest()->take(6)->get();
            return view('frontend.index', compact('subcategories', 'featuredproducts', 'offerproducts', 'filterproducts'));
        }
    }
    public function shop()
    {
        $subcategories = Subcategory::latest()->get();
        $products = Product::latest()->get();
        $filterproducts = Product::latest()->take(6)->get();
        return view('frontend.shop', compact('subcategories', 'products', 'filterproducts'));
    }

    public function subcategory($slug)
    {
        $subcategory = Subcategory::where('slug', $slug)->first();
        $products = Product::latest()->where('subcategory_id', $subcategory->id)->get();
        $filterproducts = Product::latest()->take(6)->get();
        $subcategories = Subcategory::latest()->get();
        return view('frontend.subcategory', compact('subcategories', 'products', 'subcategory', 'filterproducts'));
    }

    public function contact()
    {
        $subcategories = Subcategory::latest()->get();
        return view('frontend.contact', compact('subcategories'));
    }

    public function products($slug)
    {
        $product = Product::where('slug', $slug)->first();
        $productimage = ProductImage::where('product_id', $product->id)->first();
        $productimages = ProductImage::where('product_id', $product->id)->get();
        $relatedproducts = Product::where('subcategory_id', $product->subcategory_id)->take(4)->get();
        $subcategories = Subcategory::latest()->get();
        return view('frontend.products', compact('subcategories', 'product', 'productimage', 'productimages', 'relatedproducts'));
    }

    public function checkout()
    {
        $subcategories = Subcategory::latest()->get();
        return view('frontend.checkout', compact('subcategories'));
    }

    public static function verifyEmail($name, $email, $verification_code)
    {
        $mailData = [
            'name' => $name,
            'verification_code' => $verification_code,
        ];
        Mail::to($email)->send(new VerifyUserEmail($mailData));
    }

    public function cart()
    {
        $subcategories = Subcategory::latest()->get();
        $cartproducts = Cart::latest()->where('user_id', Auth::user()->id)->get();
        return view('frontend.cart', compact('subcategories', 'cartproducts'));
    }

    public function addtocart(Request $request, $id)
    {
        // dd($request['price']);
        $product = Product::findorFail($id);
        $cart = Cart::where('product_id', $id)->where('user_id', Auth::user()->id)->first();
        if($cart) {
            return redirect()->back()->with('failure', 'Product is already in cart. Go to cart.');
        } else{
            if ($product->quantity < $request['quantity']) {
                return redirect()->back()->with('failure', 'Quantity selected is more than of available.');
            } else{
                $cartproduct = Cart::create([
                    'user_id' => Auth::user()->id,
                    'product_id' => $id,
                    'quantity' => $request['quantity'],
                    'price' => $request['price']
                ]);

                $cartproduct->save();
                return redirect()->back()->with('success', 'Product is added in cart successfully.');
            }
        }
    }

    public function wishlist()
    {
        $subcategories = Subcategory::latest()->get();
        $wishlistproducts = Wishlist::latest()->where('user_id', Auth::user()->id)->get();
        return view('frontend.wishlist', compact('subcategories', 'wishlistproducts'));
    }

    public function addtowishlist($id)
    {
        $wishlist = Wishlist::where('product_id', $id)->where('user_id', Auth::user()->id)->first();
        if($wishlist) {
            return redirect()->back()->with('failure', 'Product is already to wishlist. Go to wishlist.');
        } else{
            $wishlistproduct = Wishlist::create([
                'user_id' => Auth::user()->id,
                'product_id' => $id,
            ]);

            $wishlistproduct->save();
            return redirect()->back()->with('success', 'Product is added in wishlist successfully.');
        }
    }

    public function removefromwishlist($id)
    {
        $wishlist = Wishlist::where('user_id', Auth::user()->id)->where('product_id', $id)->first();
        $wishlist->delete();

        return redirect()->back()->with('success', 'Product is removed from wishlist successfully.');
    }
}
