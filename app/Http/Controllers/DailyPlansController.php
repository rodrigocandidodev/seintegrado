<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\DailyPlanCreateRequest;
use App\Http\Requests\DailyPlanUpdateRequest;
use App\Repositories\DailyPlanRepository;
use App\Validators\DailyPlanValidator;

/**
 * Class DailyPlansController.
 *
 * @package namespace App\Http\Controllers;
 */
class DailyPlansController extends Controller
{
    /**
     * @var DailyPlanRepository
     */
    protected $repository;

    /**
     * @var DailyPlanValidator
     */
    protected $validator;

    /**
     * DailyPlansController constructor.
     *
     * @param DailyPlanRepository $repository
     * @param DailyPlanValidator $validator
     */
    public function __construct(DailyPlanRepository $repository, DailyPlanValidator $validator)
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
        $dailyPlans = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $dailyPlans,
            ]);
        }

        return view('dailyPlans.index', compact('dailyPlans'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  DailyPlanCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(DailyPlanCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $dailyPlan = $this->repository->create($request->all());

            $response = [
                'message' => 'DailyPlan created.',
                'data'    => $dailyPlan->toArray(),
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
        $dailyPlan = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $dailyPlan,
            ]);
        }

        return view('dailyPlans.show', compact('dailyPlan'));
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
        $dailyPlan = $this->repository->find($id);

        return view('dailyPlans.edit', compact('dailyPlan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  DailyPlanUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(DailyPlanUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $dailyPlan = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'DailyPlan updated.',
                'data'    => $dailyPlan->toArray(),
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
                'message' => 'DailyPlan deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'DailyPlan deleted.');
    }
}
