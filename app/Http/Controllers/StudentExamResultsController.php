<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\StudentExamResultCreateRequest;
use App\Http\Requests\StudentExamResultUpdateRequest;
use App\Repositories\StudentExamResultRepository;
use App\Validators\StudentExamResultValidator;

/**
 * Class StudentExamResultsController.
 *
 * @package namespace App\Http\Controllers;
 */
class StudentExamResultsController extends Controller
{
    /**
     * @var StudentExamResultRepository
     */
    protected $repository;

    /**
     * @var StudentExamResultValidator
     */
    protected $validator;

    /**
     * StudentExamResultsController constructor.
     *
     * @param StudentExamResultRepository $repository
     * @param StudentExamResultValidator $validator
     */
    public function __construct(StudentExamResultRepository $repository, StudentExamResultValidator $validator)
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
        $studentExamResults = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $studentExamResults,
            ]);
        }

        return view('studentExamResults.index', compact('studentExamResults'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StudentExamResultCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(StudentExamResultCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $studentExamResult = $this->repository->create($request->all());

            $response = [
                'message' => 'StudentExamResult created.',
                'data'    => $studentExamResult->toArray(),
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
        $studentExamResult = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $studentExamResult,
            ]);
        }

        return view('studentExamResults.show', compact('studentExamResult'));
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
        $studentExamResult = $this->repository->find($id);

        return view('studentExamResults.edit', compact('studentExamResult'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  StudentExamResultUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(StudentExamResultUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $studentExamResult = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'StudentExamResult updated.',
                'data'    => $studentExamResult->toArray(),
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
                'message' => 'StudentExamResult deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'StudentExamResult deleted.');
    }
}
