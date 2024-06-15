<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\StudentEnrollmentCreateRequest;
use App\Http\Requests\StudentEnrollmentUpdateRequest;
use App\Repositories\StudentEnrollmentRepository;
use App\Validators\StudentEnrollmentValidator;

/**
 * Class StudentEnrollmentsController.
 *
 * @package namespace App\Http\Controllers;
 */
class StudentEnrollmentsController extends Controller
{
    /**
     * @var StudentEnrollmentRepository
     */
    protected $repository;

    /**
     * @var StudentEnrollmentValidator
     */
    protected $validator;

    /**
     * StudentEnrollmentsController constructor.
     *
     * @param StudentEnrollmentRepository $repository
     * @param StudentEnrollmentValidator $validator
     */
    public function __construct(StudentEnrollmentRepository $repository, StudentEnrollmentValidator $validator)
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
        $studentEnrollments = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $studentEnrollments,
            ]);
        }

        return view('studentEnrollments.index', compact('studentEnrollments'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StudentEnrollmentCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(StudentEnrollmentCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $studentEnrollment = $this->repository->create($request->all());

            $response = [
                'message' => 'StudentEnrollment created.',
                'data'    => $studentEnrollment->toArray(),
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
        $studentEnrollment = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $studentEnrollment,
            ]);
        }

        return view('studentEnrollments.show', compact('studentEnrollment'));
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
        $studentEnrollment = $this->repository->find($id);

        return view('studentEnrollments.edit', compact('studentEnrollment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  StudentEnrollmentUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(StudentEnrollmentUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $studentEnrollment = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'StudentEnrollment updated.',
                'data'    => $studentEnrollment->toArray(),
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
                'message' => 'StudentEnrollment deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'StudentEnrollment deleted.');
    }
}
