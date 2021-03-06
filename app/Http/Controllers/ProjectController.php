<?php

namespace CodeProject\Http\Controllers;


use CodeProject\Services\ProjectMemberService;
use CodeProject\Services\ProjectService;

use Illuminate\Http\Request;

use CodeProject\Http\Requests;
use LucaDegasperi\OAuth2Server\Facades\Authorizer;


class ProjectController extends Controller
{
    /**
     * @var ClientService
     */
    private $service;


    /**
     * @param ProjectService $service
     */
    public function __construct(ProjectService $service)
    {
        $this->service = $service;

    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return  $this->service->index(['notes','owner','client','members']);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {

        return $this->service->store($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $userId = Authorizer::getResourceOwnerId();
        return $this->service->show($id, $userId, ['notes','owner','client','members']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        return $this->service->update($request->all(),$id);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
       return  $this->service->destroy($id);
    }

    /**
     * @param Request $request
     * @return array
     */
    public function addMember(Request $request)
    {
        return  $this->service->addMember($request->all());
    }

    public function removeMember($mid,$id)
    {
        return  $this->service->removeMember($mid,$id);
    }

}
