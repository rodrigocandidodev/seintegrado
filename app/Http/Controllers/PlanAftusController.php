<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\PlanAftuCreateRequest;
use App\Http\Requests\PlanAftuUpdateRequest;
use App\Repositories\PlanAftuRepository;
use App\Validators\PlanAftuValidator;

/**
 * Class PlanAftusController.
 *
 * @package namespace App\Http\Controllers;
 */
class PlanAftusController extends Controller
{
    /**
     * @var PlanAftuRepository
     */
    protected $repository;

    /**
     * @var PlanAftuValidator
     */
    protected $validator;

    /**
     * PlanAftusController constructor.
     *
     * @param PlanAftuRepository $repository
     * @param PlanAftuValidator $validator
     */
    public function __construct(PlanAftuRepository $repository, PlanAftuValidator $validator)
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
        $planAftus = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $planAftus,
            ]);
        }

        return view('planAftus.index', compact('planAftus'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  PlanAftuCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(PlanAftuCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $planAftu = $this->repository->create($request->all());

            $response = [
                'message' => 'PlanAftu created.',
                'data'    => $planAftu->toArray(),
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
        $planAftu = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $planAftu,
            ]);
        }

        return view('planAftus.show', compact('planAftu'));
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
        $planAftu = $this->repository->find($id);

        return view('planAftus.edit', compact('planAftu'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  PlanAftuUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(PlanAftuUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $planAftu = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'PlanAftu updated.',
                'data'    => $planAftu->toArray(),
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
                'message' => 'PlanAftu deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'PlanAftu deleted.');
    }
}
