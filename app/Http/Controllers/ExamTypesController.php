<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\ExamTypeCreateRequest;
use App\Http\Requests\ExamTypeUpdateRequest;
use App\Repositories\ExamTypeRepository;
use App\Validators\ExamTypeValidator;

/**
 * Class ExamTypesController.
 *
 * @package namespace App\Http\Controllers;
 */
class ExamTypesController extends Controller
{
    /**
     * @var ExamTypeRepository
     */
    protected $repository;

    /**
     * @var ExamTypeValidator
     */
    protected $validator;

    /**
     * ExamTypesController constructor.
     *
     * @param ExamTypeRepository $repository
     * @param ExamTypeValidator $validator
     */
    public function __construct(ExamTypeRepository $repository, ExamTypeValidator $validator)
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
        $examTypes = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $examTypes,
            ]);
        }

        return view('examTypes.index', compact('examTypes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  ExamTypeCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(ExamTypeCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $examType = $this->repository->create($request->all());

            $response = [
                'message' => 'ExamType created.',
                'data'    => $examType->toArray(),
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
        $examType = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $examType,
            ]);
        }

        return view('examTypes.show', compact('examType'));
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
        $examType = $this->repository->find($id);

        return view('examTypes.edit', compact('examType'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  ExamTypeUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(ExamTypeUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $examType = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'ExamType updated.',
                'data'    => $examType->toArray(),
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
                'message' => 'ExamType deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'ExamType deleted.');
    }
}
