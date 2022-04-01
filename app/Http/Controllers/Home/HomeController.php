<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Mail\ContactFormMail;
use App\Models\Cart;
use App\Models\MainCategory;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\Shipping;
use App\Models\User;
use App\Models\WishList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    public function home(MainCategory $mainCategory){
        return view('front.home', compact('mainCategory'));
    }
    public function products(){
        // $products = Product::all();
        $query = request()->get('query');
        if($query){
            $products = Product::orWhere('price', "LIKE", "%$query%")
            ->orWhere('quantity', "LIKE", "%$query%")
            ->orWhereHas('mainCategory', function($mainCategory) use($query){
               $mainCategory->where('name', "LIKE", "%$query%");
            })
            ->orWhereHas('subCategory', function($subCategory) use($query){
                $subCategory->where('name', "LIKE", "%$query%");
            })->paginate(18);
        }else{

            $products = Product::latest()->paginate(18);
        }
        return view('front.home.product', compact('products'));
    }
    public function categories(){
        // $products = Product::all();
        $categories = MainCategory::all();
        // $products = Product::latest()->paginate(6);
        $products = Product::all()->random(6);
        return view('front.home.categories', compact('products', 'categories'));
    }
    // Users Show Profile Method
    public function profile(){
        $user = auth()->user();
        return view('front.home.profile', compact('user'));
    }
    // Users Password Change Method
    public function passwordChange(Request $request){
        $request->validate([
            'newPassword' => 'required|min:8',
        ]);
        if(!$request->newPassword || (!$request->newPassword == $request->confirmPassword)){
            return back()->with('error', 'Both password should be same!');
        }
        else{
            $matchedOldPassword = Hash::check($request->oldPassword, auth()->user()->password);
            if(!$matchedOldPassword){
                return back()->with('error', 'Old password not matched!');
            }else{
                $hashNewPassword = Hash::make($request->newPassword);
                $user = User::find(auth()->id());
                $user->password = $hashNewPassword;
                $user->save();
                return back()->with('success', 'The password changed successfuly!');
            }
        }
    }
    // Contact Us
    public function contact(){
        return view('front.home.contact');
    }
    public function contactFormStore(Request $request){
        $request->validate([
            'email' => 'required',
            'mailSubject' => 'required|max:50',
            'name' => 'required',
            'massage' => 'required|max:200',
            'phoneNumber' => 'required',
        ]);

        $contact_form_data = $request->all();
        Mail::to('riktasiddique17@gmal.com')->send(new ContactFormMail($contact_form_data));
        return back()->with('success', 'The mail send successfuly!');
    }
    public function wishListStore($id)
    {
        $user = Auth::user();
        $product = Product::find($id);
        $wishList = new WishList();
        $wishList->user_id = $user->id;
        $wishList->image1 = $product->image1;
        $wishList->category_id = $product->mainCategory->id;
        $wishList->sub_category_id = $product->subCategory->id;
        $wishList->price = $product->price;
        $wishList->quantity = $product->quantity;
        $wishList->save();
        return back()->with('success', 'The product added to wish list!');
        
    }
    // Wish List
    public function wishList(){
        $user = Auth::user();
        $wishLists = WishList::Where('user_id', $user->id)->latest()->get();
        return view('front.home.wish-list', compact('wishLists', 'user'));
    }
    public function addCart(){
        $user = Auth::user();
        $addCarts = Cart::Where('user_id', $user->id)->latest()->get();
        return view('front.home.add-cart', compact('addCarts', 'user'));

    }
    public function addCartStore(Request $request, $id){
        $user = Auth()->user();
        $product = Product::find($id);
        $cart = new Cart();
        $cart->user_id = $user->id;
        $cart->image1 = $product->image1;
        $cart->category_id = $product->mainCategory->id;
        $cart->sub_category_id = $product->subCategory->id;
        $cart->price = $product->price;
        $cart->quantity = $request->quantity;
        $cart->save();
        return back()->with('success', 'The Product Added Successfuly!');
    }
    public function viewDetails(Product $product){
        return view('front.home.product-details', compact('product'));
    }
    public function order(){

        $user = Auth::user();
        $carts = Cart::Where('user_id', $user->id)->get();
        if(count($carts) < 1){
            // return redirect()->route('home.order')->with('error', 'Sorry yor cart is empty!');
            return redirect('/');
        }else{

            return view('front.home.order', compact('carts'));
        }
    }
    public function orderStore(Request $request){

        $request->validate([
            'phone_number' => 'required',
            'division' => 'required',
            'district' => 'required',
            'upazila' => 'required',
            'address' => 'required',
            'cashOnDelivery' =>'required',
        ]);
        $user = Auth::user();
        $order = new Order();
        $order->phone = $request->phone_number;
        $order->user_id = $user->id;
        $order->division = $request->division;
        $order->district = $request->district;
        $order->upazila = $request->upazila;
        $order->address = $request->address;
        $order->total_price = $request->total_price;
        $order->delivery_type = $request->cashOnDelivery;
        $order->id;
          $order->save();
        $carts = Cart::Where('user_id', $user->id)->get();
        // $carts->delete();
        foreach($carts as $cart){
            OrderProduct::create([
                'order_id' => $order->id,
                'user_id' => $user->id,
                'image1' => $cart->image1,
               'price' => $cart->price,
                'quantity' => $cart->quantity,
                'category_id' => $cart->category_id,
                'sub_category_id' => $cart->sub_category_id,
            ]);
            $cart->delete();
        }
        return redirect()->route('home-add-cart')->with('success', 'Thank You for order sir! We will contact with you as soon as possible');
    }
    public function paymentType(Request $request){
        // return $name = $request->input('name');
        if($request->input('name') == 'national_card'){
            return redirect()->route('easyPay.sslCommerce');
        }
        else if($request->input('name') == 'international_card'){
            return redirect()->route('stripe-checkout.index');
        }else if($request->input('name') == 'cash_on_delivery'){
            return 'c';
        }
        return back()->with('error', 'please select any of payment type');
    }
}

