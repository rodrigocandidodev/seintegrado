<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\EnrollmentStatusCreateRequest;
use App\Http\Requests\EnrollmentStatusUpdateRequest;
use App\Repositories\EnrollmentStatusRepository;
use App\Validators\EnrollmentStatusValidator;

/**
 * Class EnrollmentStatusesController.
 *
 * @package namespace App\Http\Controllers;
 */
class EnrollmentStatusesController extends Controller
{
    /**
     * @var EnrollmentStatusRepository
     */
    protected $repository;

    /**
     * @var EnrollmentStatusValidator
     */
    protected $validator;

    /**
     * EnrollmentStatusesController constructor.
     *
     * @param EnrollmentStatusRepository $repository
     * @param EnrollmentStatusValidator $validator
     */
    public function __construct(EnrollmentStatusRepository $repository, EnrollmentStatusValidator $validator)
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
        $enrollmentStatuses = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $enrollmentStatuses,
            ]);
        }

        return view('enrollmentStatuses.index', compact('enrollmentStatuses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  EnrollmentStatusCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(EnrollmentStatusCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $enrollmentStatus = $this->repository->create($request->all());

            $response = [
                'message' => 'EnrollmentStatus created.',
                'data'    => $enrollmentStatus->toArray(),
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
        $enrollmentStatus = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $enrollmentStatus,
            ]);
        }

        return view('enrollmentStatuses.show', compact('enrollmentStatus'));
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
        $enrollmentStatus = $this->repository->find($id);

        return view('enrollmentStatuses.edit', compact('enrollmentStatus'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  EnrollmentStatusUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(EnrollmentStatusUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $enrollmentStatus = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'EnrollmentStatus updated.',
                'data'    => $enrollmentStatus->toArray(),
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
                'message' => 'EnrollmentStatus deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'EnrollmentStatus deleted.');
    }
}
