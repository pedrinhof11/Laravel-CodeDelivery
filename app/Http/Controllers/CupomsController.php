<?php

namespace CodeDelivery\Http\Controllers;

use CodeDelivery\Http\Requests;
use CodeDelivery\Http\Requests\AdminCupomRequest;
use CodeDelivery\Repositories\CupomRepository;

class CupomsController extends Controller
{

    /**
     * @var CupomRepository
     */
    private $cupomRepository;

    public function __construct(CupomRepository $cupomRepository)
    {

        $this->cupomRepository = $cupomRepository;
    }
    
    public function index()
    {
        $cupoms = $this->cupomRepository->paginate();

        return view('admin.cupoms.index', compact('cupoms'));
    }

    public function create()
    {
        return view('admin.cupoms.create');
    }

    public function store(AdminCupomRequest $request)
    {
        $cupom = $request->all();
        $this->cupomRepository->create($cupom);
        
        return redirect()->route('admin.cupoms.index');
    }


    public function edit($id)
    {
        $cupom = $this->cupomRepository->find($id);
        
        return view('admin.cupoms.edit', compact('cupom'));
    }

    public function update(AdminCupomRequest $request, $id)
    {
        $cupom = $request->all();
        $this->cupomRepository->update($cupom, $id);

        return redirect()->route('admin.cupoms.index');
    }
    
}
