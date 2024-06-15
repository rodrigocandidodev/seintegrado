<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\StudentSchoolAttendanceCreateRequest;
use App\Http\Requests\StudentSchoolAttendanceUpdateRequest;
use App\Repositories\StudentSchoolAttendanceRepository;
use App\Validators\StudentSchoolAttendanceValidator;

/**
 * Class StudentSchoolAttendancesController.
 *
 * @package namespace App\Http\Controllers;
 */
class StudentSchoolAttendancesController extends Controller
{
    /**
     * @var StudentSchoolAttendanceRepository
     */
    protected $repository;

    /**
     * @var StudentSchoolAttendanceValidator
     */
    protected $validator;

    /**
     * StudentSchoolAttendancesController constructor.
     *
     * @param StudentSchoolAttendanceRepository $repository
     * @param StudentSchoolAttendanceValidator $validator
     */
    public function __construct(StudentSchoolAttendanceRepository $repository, StudentSchoolAttendanceValidator $validator)
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
        $studentSchoolAttendances = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $studentSchoolAttendances,
            ]);
        }

        return view('studentSchoolAttendances.index', compact('studentSchoolAttendances'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StudentSchoolAttendanceCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(StudentSchoolAttendanceCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $studentSchoolAttendance = $this->repository->create($request->all());

            $response = [
                'message' => 'StudentSchoolAttendance created.',
                'data'    => $studentSchoolAttendance->toArray(),
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
        $studentSchoolAttendance = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $studentSchoolAttendance,
            ]);
        }

        return view('studentSchoolAttendances.show', compact('studentSchoolAttendance'));
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
        $studentSchoolAttendance = $this->repository->find($id);

        return view('studentSchoolAttendances.edit', compact('studentSchoolAttendance'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  StudentSchoolAttendanceUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(StudentSchoolAttendanceUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $studentSchoolAttendance = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'StudentSchoolAttendance updated.',
                'data'    => $studentSchoolAttendance->toArray(),
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
                'message' => 'StudentSchoolAttendance deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'StudentSchoolAttendance deleted.');
    }
}
