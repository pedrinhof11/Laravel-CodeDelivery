<?php

namespace CodeDelivery\Http\Controllers;

use CodeDelivery\Repositories\CategoryRepository;
use CodeDelivery\Repositories\OrderRepository;
use CodeDelivery\Repositories\ProductRepository;
use CodeDelivery\Repositories\UserRepository;
use Illuminate\Http\Request;
use CodeDelivery\Http\Requests\AdminCategoriesRequest;

use CodeDelivery\Http\Requests;
use CodeDelivery\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;

class CheckoutController extends Controller
{

    /**
     * @var OrderRepository
     */
    private $orderRepository;
    /**
     * @var UserRepository
     */
    private $userRepository;
    /**
     * @var ProductRepository
     */
    private $productRepository;

    public function __construct(OrderRepository $orderRepository, UserRepository $userRepository, ProductRepository $productRepository)
    {

        $this->orderRepository = $orderRepository;
        $this->userRepository = $userRepository;
        $this->productRepository = $productRepository;

    }

    public function create()
    {
        $products = $this->productRepository->getLists();
        return view('customer.order.create', compact('products'));
    }






    
}
