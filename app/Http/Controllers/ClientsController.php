<?php

namespace CodeDelivery\Http\Controllers;

use CodeDelivery\Http\Requests;
use CodeDelivery\Http\Requests\AdminClientRequest;
use CodeDelivery\Repositories\ClientRepository;
use CodeDelivery\Services\ClientService;

class ClientsController extends Controller
{

    /**
     * @var ClientRepository
     */
    private $clientRepository;
    /**
     * @var ClientService
     */
    private $clientService;

    public function __construct(ClientRepository $clientRepository, ClientService $clientService)
    {

        $this->clientRepository = $clientRepository;
        $this->clientService = $clientService;
    }
    
    public function index(ClientRepository $clientRepository)
    {
        $clients = $clientRepository->paginate();

        return view('admin.clients.index', compact('clients'));
    }

    public function create()
    {
        return view('admin.clients.create');
    }

    public function store(AdminClientRequest $request)
    {
        $client = $request->all();
        $this->clientService->create($client);
        
        return redirect()->route('admin.clients.index');
    }


    public function edit($id)
    {
        $client = $this->clientRepository->find($id);
        
        return view('admin.clients.edit', compact('client'));
    }

    public function update(AdminClientRequest $request, $id)
    {

        
        $client = $request->all();
        $this->clientService->update($client, $id);

        return redirect()->route('admin.clients.index');
    }
    
}
