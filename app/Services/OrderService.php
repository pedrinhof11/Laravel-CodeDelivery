<?php
/**
 * Created by PhpStorm.
 * User: Pedro Felipe
 * Date: 19/06/2016
 * Time: 14:00
 */

namespace CodeDelivery\Services;



use CodeDelivery\Repositories\UserRepository;

class OrderService
{

    public function list_status()
    {

        return $list_status = ['0' => 'Pendente', '1'=>'A Caminho', '2'=> 'Entrege', '3' => 'Cancelado'];
    }


}