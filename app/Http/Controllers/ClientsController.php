<?php

namespace CodeDelivery\Http\Controllers;

use CodeDelivery\Http\Requests;
use CodeDelivery\Http\Requests\AdminCategoriesRequest;
use CodeDelivery\Repositories\ClientRepository;

class ClientsController extends Controller
{

    /**
     * @var ClientRepository
     */
    private $clientRepository;

    public function __construct(ClientRepository $clientRepository)
    {

        $this->clientRepository = $clientRepository;
    }
    
    public function index(ClientRepository $clientRepository)
    {
        $clients = $clientRepository->paginate(10);

        return view('admin.clients.index', compact('clients'));
    }

    public function create()
    {
        return view('admin.clients.create');
    }

    public function store(AdminClientRequest $request)
    {
        $client = $request->all();
        $this->clientRepository->create($client);
        
        return redirect()->route('admin.clients.index');
    }


    public function edit($id)
    {
        $category = $this->clientRepository->find($id);
        
        return view('admin.clients.edit', compact('category'));
    }

    public function update(AdminCategoriesRequest $request, $id)
    {
        $client = $request->all();
        $this->clientRepository->update($client, $id);

        return redirect()->route('admin.clients.index');
    }
    
}
