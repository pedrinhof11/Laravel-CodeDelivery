<?php

namespace CodeDelivery\Http\Controllers;

use CodeDelivery\Http\Requests;
use CodeDelivery\Repositories\OrderRepository;
use CodeDelivery\Repositories\UserRepository;
use CodeDelivery\Services\OrderService;

class OrdersController extends Controller
{


    /**
     * @var OrderRepository
     */
    private $orderRepository;
    /**
     * @var OrderService
     */
    private $orderService;

    public function __construct(OrderRepository $orderRepository, OrderService $orderService)
    {

        $this->orderRepository = $orderRepository;
        $this->orderService = $orderService;
    }

    public function index()
    {
        $orders = $this->orderRepository->paginate();
        return view('admin.orders.index', compact('orders'));
    }


    public function edit($id, UserRepository $userRepository)
    {
        $list_status = $this->orderService->list_status();
        $order = $this->orderRepository->find($id);

        $deliveryMans = $userRepository->getDeliveryMans();

        return view('admin.orders.edit', compact('order', 'list_status', 'deliveryMans'));
    }

    public function update(Requests\AdminOrderRequest $request, $id)
    {
        $order = $request->all();;
        $this->orderRepository->update($order, $id);
        return redirect()->route('admin.orders.index');
    }

    
}
