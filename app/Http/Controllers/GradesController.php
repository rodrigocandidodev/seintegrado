<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\GradeCreateRequest;
use App\Http\Requests\GradeUpdateRequest;
use App\Repositories\GradeRepository;
use App\Validators\GradeValidator;

/**
 * Class GradesController.
 *
 * @package namespace App\Http\Controllers;
 */
class GradesController extends Controller
{
    /**
     * @var GradeRepository
     */
    protected $repository;

    /**
     * @var GradeValidator
     */
    protected $validator;

    /**
     * GradesController constructor.
     *
     * @param GradeRepository $repository
     * @param GradeValidator $validator
     */
    public function __construct(GradeRepository $repository, GradeValidator $validator)
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
        $grades = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $grades,
            ]);
        }

        return view('grades.index', compact('grades'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  GradeCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(GradeCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $grade = $this->repository->create($request->all());

            $response = [
                'message' => 'Grade created.',
                'data'    => $grade->toArray(),
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
        $grade = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $grade,
            ]);
        }

        return view('grades.show', compact('grade'));
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
        $grade = $this->repository->find($id);

        return view('grades.edit', compact('grade'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  GradeUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(GradeUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $grade = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Grade updated.',
                'data'    => $grade->toArray(),
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
                'message' => 'Grade deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Grade deleted.');
    }
}
