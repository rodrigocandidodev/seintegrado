<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\CollaboratorScholarityCreateRequest;
use App\Http\Requests\CollaboratorScholarityUpdateRequest;
use App\Repositories\CollaboratorScholarityRepository;
use App\Validators\CollaboratorScholarityValidator;

/**
 * Class CollaboratorScholarshipsController.
 *
 * @package namespace App\Http\Controllers;
 */
class CollaboratorScholaritiesController extends Controller
{

    protected $repository;

    protected $validator;

    public function __construct(CollaboratorScholarityRepository $repository, CollaboratorScholarityValidator $validator)
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
        $collaboratorScholarships = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $collaboratorScholarity,
            ]);
        }

        return view('collaboratorScholarity.index', compact('collaboratorScholarity'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CollaboratorScholarshipCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(CollaboratorScholarityCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $collaboratorScholarity = $this->repository->create($request->all());

            $response = [
                'message' => 'CollaboratorScholarity created.',
                'data'    => $collaboratorScholarity->toArray(),
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
        $collaboratorScholarity = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $collaboratorScholarity,
            ]);
        }

        return view('collaboratorScholarities.show', compact('collaboratorScholarity'));
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
        $collaboratorScholarity = $this->repository->find($id);

        return view('collaboratorScholarities.edit', compact('collaboratorScholarity'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  CollaboratorScholarshipUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(CollaboratorScholarityUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $collaboratorScholarity = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'CollaboratorScholarity updated.',
                'data'    => $collaboratorScholarity->toArray(),
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
                'message' => 'CollaboratorScholarity deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'CollaboratorScholarity deleted.');
    }
}
