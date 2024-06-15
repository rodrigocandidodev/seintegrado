<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\PlanPltaCreateRequest;
use App\Http\Requests\PlanPltaUpdateRequest;
use App\Repositories\PlanPltaRepository;
use App\Validators\PlanPltaValidator;

/**
 * Class PlanPltasController.
 *
 * @package namespace App\Http\Controllers;
 */
class PlanPltasController extends Controller
{
    /**
     * @var PlanPltaRepository
     */
    protected $repository;

    /**
     * @var PlanPltaValidator
     */
    protected $validator;

    /**
     * PlanPltasController constructor.
     *
     * @param PlanPltaRepository $repository
     * @param PlanPltaValidator $validator
     */
    public function __construct(PlanPltaRepository $repository, PlanPltaValidator $validator)
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
        $planPltas = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $planPltas,
            ]);
        }

        return view('planPltas.index', compact('planPltas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  PlanPltaCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(PlanPltaCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $planPltum = $this->repository->create($request->all());

            $response = [
                'message' => 'PlanPlta created.',
                'data'    => $planPltum->toArray(),
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
        $planPltum = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $planPltum,
            ]);
        }

        return view('planPltas.show', compact('planPltum'));
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
        $planPltum = $this->repository->find($id);

        return view('planPltas.edit', compact('planPltum'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  PlanPltaUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(PlanPltaUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $planPltum = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'PlanPlta updated.',
                'data'    => $planPltum->toArray(),
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
                'message' => 'PlanPlta deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'PlanPlta deleted.');
    }
}
