<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\CollaboratorJobCreateRequest;
use App\Http\Requests\CollaboratorJobUpdateRequest;
use App\Repositories\CollaboratorJobRepository;
use App\Validators\CollaboratorJobValidator;

/**
 * Class CollaboratorJobsController.
 *
 * @package namespace App\Http\Controllers;
 */
class CollaboratorJobsController extends Controller
{
    /**
     * @var CollaboratorJobRepository
     */
    protected $repository;

    /**
     * @var CollaboratorJobValidator
     */
    protected $validator;

    /**
     * CollaboratorJobsController constructor.
     *
     * @param CollaboratorJobRepository $repository
     * @param CollaboratorJobValidator $validator
     */
    public function __construct(CollaboratorJobRepository $repository, CollaboratorJobValidator $validator)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $collaboratorJobs = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $collaboratorJobs,
            ]);
        }

        return view('collaboratorJobs.index', compact('collaboratorJobs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CollaboratorJobCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(CollaboratorJobCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $collaboratorJob = $this->repository->create($request->all());

            $response = [
                'message' => 'CollaboratorJob created.',
                'data'    => $collaboratorJob->toArray(),
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
        $collaboratorJob = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $collaboratorJob,
            ]);
        }

        return view('collaboratorJobs.show', compact('collaboratorJob'));
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
        $collaboratorJob = $this->repository->find($id);

        return view('collaboratorJobs.edit', compact('collaboratorJob'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  CollaboratorJobUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(CollaboratorJobUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $collaboratorJob = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'CollaboratorJob updated.',
                'data'    => $collaboratorJob->toArray(),
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
                'message' => 'CollaboratorJob deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'CollaboratorJob deleted.');
    }
}
