<?php

namespace CodeDelivery\Http\Controllers\Api\Deliveryman;

use CodeDelivery\Repositories\OrderRepository;
use CodeDelivery\Repositories\UserRepository;
use CodeDelivery\Services\OrderService;
use Illuminate\Http\Request;

use CodeDelivery\Http\Requests;
use CodeDelivery\Http\Controllers\Controller;
use LucaDegasperi\OAuth2Server\Facades\Authorizer;

class DeliverymanCheckoutController extends Controller
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

    public function __construct(
        OrderRepository $orderRepository,
        UserRepository $userRepository,
        OrderService $orderService
    )
    {
        $this->orderRepository = $orderRepository;
        $this->orderService = $orderService;
        $this->userRepository = $userRepository;
    }

    public function index()
    {
        $id = Authorizer::getResourceOwnerId();
        $orders = $this->orderRepository->with(['items'])->scopeQuery(function ($query) use($id){
            return $query->where('user_deliveryman_id' , '=', $id);
        })->paginate();

        return $orders;
    }

    public function show($id)
    {
        $idDeliveriman = Authorizer::getResourceOwnerId();
        return $this->orderRepository->getByIdAndDeliveryman($id, $idDeliveriman);

    }

    public function updateStatus(Request $request, $id)
    {
        $idDeliveriman = Authorizer::getResourceOwnerId();
        $order = $this->orderService->updateStatus($id, $idDeliveriman , $request->get('status'));
        if($order){
            return $order;
        }
        abort(400, 'Order não encontrado!!');
    }

    public function destroy($id)
    {
        //
    }
    
    
    
    
    
}
