<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\InstitutionClassScheduleCreateRequest;
use App\Http\Requests\InstitutionClassScheduleUpdateRequest;
use App\Repositories\InstitutionClassScheduleRepository;
use App\Validators\InstitutionClassScheduleValidator;

/**
 * Class InstitutionClassSchedulesController.
 *
 * @package namespace App\Http\Controllers;
 */
class InstitutionClassSchedulesController extends Controller
{
    /**
     * @var InstitutionClassScheduleRepository
     */
    protected $repository;

    /**
     * @var InstitutionClassScheduleValidator
     */
    protected $validator;

    /**
     * InstitutionClassSchedulesController constructor.
     *
     * @param InstitutionClassScheduleRepository $repository
     * @param InstitutionClassScheduleValidator $validator
     */
    public function __construct(InstitutionClassScheduleRepository $repository, InstitutionClassScheduleValidator $validator)
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
        $institutionClassSchedules = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $institutionClassSchedules,
            ]);
        }

        return view('institutionClassSchedules.index', compact('institutionClassSchedules'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  InstitutionClassScheduleCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(InstitutionClassScheduleCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $institutionClassSchedule = $this->repository->create($request->all());

            $response = [
                'message' => 'InstitutionClassSchedule created.',
                'data'    => $institutionClassSchedule->toArray(),
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
        $institutionClassSchedule = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $institutionClassSchedule,
            ]);
        }

        return view('institutionClassSchedules.show', compact('institutionClassSchedule'));
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
        $institutionClassSchedule = $this->repository->find($id);

        return view('institutionClassSchedules.edit', compact('institutionClassSchedule'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  InstitutionClassScheduleUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(InstitutionClassScheduleUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $institutionClassSchedule = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'InstitutionClassSchedule updated.',
                'data'    => $institutionClassSchedule->toArray(),
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
                'message' => 'InstitutionClassSchedule deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'InstitutionClassSchedule deleted.');
    }
}
