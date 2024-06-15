<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\StudentWaitingListCreateRequest;
use App\Http\Requests\StudentWaitingListUpdateRequest;
use App\Repositories\StudentWaitingListRepository;
use App\Validators\StudentWaitingListValidator;

/**
 * Class StudentWaitingListsController.
 *
 * @package namespace App\Http\Controllers;
 */
class StudentWaitingListsController extends Controller
{
    /**
     * @var StudentWaitingListRepository
     */
    protected $repository;

    /**
     * @var StudentWaitingListValidator
     */
    protected $validator;

    /**
     * StudentWaitingListsController constructor.
     *
     * @param StudentWaitingListRepository $repository
     * @param StudentWaitingListValidator $validator
     */
    public function __construct(StudentWaitingListRepository $repository, StudentWaitingListValidator $validator)
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
        $studentWaitingLists = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $studentWaitingLists,
            ]);
        }

        return view('studentWaitingLists.index', compact('studentWaitingLists'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StudentWaitingListCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(StudentWaitingListCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $studentWaitingList = $this->repository->create($request->all());

            $response = [
                'message' => 'StudentWaitingList created.',
                'data'    => $studentWaitingList->toArray(),
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
        $studentWaitingList = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $studentWaitingList,
            ]);
        }

        return view('studentWaitingLists.show', compact('studentWaitingList'));
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
        $studentWaitingList = $this->repository->find($id);

        return view('studentWaitingLists.edit', compact('studentWaitingList'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  StudentWaitingListUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(StudentWaitingListUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $studentWaitingList = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'StudentWaitingList updated.',
                'data'    => $studentWaitingList->toArray(),
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
                'message' => 'StudentWaitingList deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'StudentWaitingList deleted.');
    }
}
