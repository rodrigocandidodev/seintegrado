<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\CollaboratorCreateRequest;
use App\Http\Requests\CollaboratorUpdateRequest;
use App\Repositories\CollaboratorRepository;
use App\Validators\CollaboratorValidator;
use App\Services\CollaboratorService;

/**
 * Class CollaboratorsController.
 *
 * @package namespace App\Http\Controllers;
 */
class CollaboratorsController extends Controller
{
    /**
     * @var CollaboratorRepository
     */
    protected $repository;

    /**
     * @var CollaboratorService
     */
    protected $service;

    /**
     * CollaboratorsController constructor.
     *
     * @param CollaboratorRepository $repository
     * @param CollaboratorService $service
     */
    public function __construct(CollaboratorRepository $repository, CollaboratorService $service)
    {
        $this->repository = $repository;
        $this->service  = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $collaborators = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $collaborators,
            ]);
        }

        return view('collaborators.index', compact('collaborators'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CollaboratorCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(CollaboratorCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $collaborator = $this->repository->create($request->all());

            $response = [
                'message' => 'Collaborator created.',
                'data'    => $collaborator->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {
            if ($request->wantsJson()) {
                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $collaborator = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $collaborator,
            ]);
        }

        return view('collaborators.show', compact('collaborator'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $collaborator = $this->repository->find($id);

        return view('collaborators.edit', compact('collaborator'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  CollaboratorUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(CollaboratorUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $collaborator = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Collaborator updated.',
                'data'    => $collaborator->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {

            if ($request->wantsJson()) {

                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted = $this->repository->delete($id);

        if (request()->wantsJson()) {

            return response()->json([
                'message' => 'Collaborator deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Collaborator deleted.');
    }
}
