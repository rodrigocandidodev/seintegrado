<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\PlanBnccEfCreateRequest;
use App\Http\Requests\PlanBnccEfUpdateRequest;
use App\Repositories\PlanBnccEfRepository;
use App\Validators\PlanBnccEfValidator;

/**
 * Class PlanBnccEfsController.
 *
 * @package namespace App\Http\Controllers;
 */
class PlanBnccEfsController extends Controller
{
    /**
     * @var PlanBnccEfRepository
     */
    protected $repository;

    /**
     * @var PlanBnccEfValidator
     */
    protected $validator;

    /**
     * PlanBnccEfsController constructor.
     *
     * @param PlanBnccEfRepository $repository
     * @param PlanBnccEfValidator $validator
     */
    public function __construct(PlanBnccEfRepository $repository, PlanBnccEfValidator $validator)
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
        $planBnccEfs = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $planBnccEfs,
            ]);
        }

        return view('planBnccEfs.index', compact('planBnccEfs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  PlanBnccEfCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(PlanBnccEfCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $planBnccEf = $this->repository->create($request->all());

            $response = [
                'message' => 'PlanBnccEf created.',
                'data'    => $planBnccEf->toArray(),
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
        $planBnccEf = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $planBnccEf,
            ]);
        }

        return view('planBnccEfs.show', compact('planBnccEf'));
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
        $planBnccEf = $this->repository->find($id);

        return view('planBnccEfs.edit', compact('planBnccEf'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  PlanBnccEfUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(PlanBnccEfUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $planBnccEf = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'PlanBnccEf updated.',
                'data'    => $planBnccEf->toArray(),
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
                'message' => 'PlanBnccEf deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'PlanBnccEf deleted.');
    }
}
