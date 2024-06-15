<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\InstitutionCalendarActivityCreateRequest;
use App\Http\Requests\InstitutionCalendarActivityUpdateRequest;
use App\Repositories\InstitutionCalendarActivityRepository;
use App\Validators\InstitutionCalendarActivityValidator;

/**
 * Class InstitutionCalendarActivitiesController.
 *
 * @package namespace App\Http\Controllers;
 */
class InstitutionCalendarActivitiesController extends Controller
{
    /**
     * @var InstitutionCalendarActivityRepository
     */
    protected $repository;

    /**
     * @var InstitutionCalendarActivityValidator
     */
    protected $validator;

    /**
     * InstitutionCalendarActivitiesController constructor.
     *
     * @param InstitutionCalendarActivityRepository $repository
     * @param InstitutionCalendarActivityValidator $validator
     */
    public function __construct(InstitutionCalendarActivityRepository $repository, InstitutionCalendarActivityValidator $validator)
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
        $institutionCalendarActivities = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $institutionCalendarActivities,
            ]);
        }

        return view('institutionCalendarActivities.index', compact('institutionCalendarActivities'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  InstitutionCalendarActivityCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(InstitutionCalendarActivityCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $institutionCalendarActivity = $this->repository->create($request->all());

            $response = [
                'message' => 'InstitutionCalendarActivity created.',
                'data'    => $institutionCalendarActivity->toArray(),
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
        $institutionCalendarActivity = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $institutionCalendarActivity,
            ]);
        }

        return view('institutionCalendarActivities.show', compact('institutionCalendarActivity'));
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
        $institutionCalendarActivity = $this->repository->find($id);

        return view('institutionCalendarActivities.edit', compact('institutionCalendarActivity'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  InstitutionCalendarActivityUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(InstitutionCalendarActivityUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $institutionCalendarActivity = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'InstitutionCalendarActivity updated.',
                'data'    => $institutionCalendarActivity->toArray(),
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
                'message' => 'InstitutionCalendarActivity deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'InstitutionCalendarActivity deleted.');
    }
}
