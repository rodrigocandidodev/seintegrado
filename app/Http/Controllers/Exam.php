<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\ExamCreateRequest;
use App\Http\Requests\ExamUpdateRequest;
use App\Repositories\ExamRepository;
use App\Validators\ExamValidator;

/**
 * Class ExamController.
 *
 * @package namespace App\Http\Controllers;
 */
class ExamController extends Controller
{
    /**
     * @var ExamRepository
     */
    protected $repository;

    /**
     * @var ExamValidator
     */
    protected $validator;

    /**
     * ExamController constructor.
     *
     * @param ExamRepository $repository
     * @param ExamValidator $validator
     */
    public function __construct(ExamRepository $repository, ExamValidator $validator)
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
        $exam = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $exam,
            ]);
        }

        return view('exam.index', compact('exam'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  ExamCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(ExamCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $exam = $this->repository->create($request->all());

            $response = [
                'message' => 'exam created.',
                'data'    => $exam->toArray(),
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
        $exam = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $exam,
            ]);
        }

        return view('exam.show', compact('exam'));
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
        $exam = $this->repository->find($id);

        return view('exam.edit', compact('exam'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  ExamUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(ExamUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $exam = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'exam updated.',
                'data'    => $exam->toArray(),
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
                'message' => 'exam deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'exam deleted.');
    }
}
