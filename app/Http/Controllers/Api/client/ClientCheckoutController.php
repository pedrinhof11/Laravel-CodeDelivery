<?php

namespace CodeDelivery\Http\Controllers\Api\Client;

use CodeDelivery\Http\Controllers\Controller;
use CodeDelivery\Http\Requests\CheckoutRequest;
use CodeDelivery\Repositories\OrderRepository;
use CodeDelivery\Repositories\ProductRepository;
use CodeDelivery\Repositories\UserRepository;
use CodeDelivery\Services\OrderService;
use LucaDegasperi\OAuth2Server\Facades\Authorizer;

class ClientCheckoutController extends Controller
{

    /**
     * @var OrderRepository
     */
    private $orderRepository;
    /**
     * @var OrderService
     */
    private $orderService;
    /**
     * @var UserRepository
     */
    private $userRepository;
    /**
     * @var ProductRepository
     */
    private $productRepository;

    private $with = ['client', 'cupom', 'items'];

    public function __construct(
        OrderRepository $orderRepository,
        ProductRepository $productRepository,
        UserRepository $userRepository,
        OrderService $orderService
    )
    {
        $this->orderRepository = $orderRepository;
        $this->orderService = $orderService;
        $this->userRepository = $userRepository;
        $this->productRepository = $productRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = Authorizer::getResourceOwnerId();
        $clientId = $this->userRepository->find($id)->client->id;
        $orders = $this->orderRepository
            ->skipPresenter(false)
            ->with($this->with)
            ->scopeQuery(function ($query) use($clientId){
            return $query->where('client_id' , '=', $clientId);
        })->paginate();

        return $orders;
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CheckoutRequest $request)
    {

        $data = $request->all();
        $id = Authorizer::getResourceOwnerId();
        $clientId = $this->userRepository->find($id)->client->id;
        $data['client_id'] = $clientId;
        $o = $this->orderService->create($data);
        return $this->orderRepository
            ->skipPresenter(false)
            ->with($this->with)
            ->find($o->id);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->orderRepository
            ->skipPresenter(false)
            ->with($this->with)
            ->find($id);

    }

}
