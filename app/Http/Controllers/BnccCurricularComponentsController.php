<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\BnccCurricularComponentCreateRequest;
use App\Http\Requests\BnccCurricularComponentUpdateRequest;
use App\Repositories\BnccCurricularComponentRepository;
use App\Validators\BnccCurricularComponentValidator;

/**
 * Class BnccCurricularComponentsController.
 *
 * @package namespace App\Http\Controllers;
 */
class BnccCurricularComponentsController extends Controller
{
    /**
     * @var BnccCurricularComponentRepository
     */
    protected $repository;

    /**
     * @var BnccCurricularComponentValidator
     */
    protected $validator;

    /**
     * BnccCurricularComponentsController constructor.
     *
     * @param BnccCurricularComponentRepository $repository
     * @param BnccCurricularComponentValidator $validator
     */
    public function __construct(BnccCurricularComponentRepository $repository, BnccCurricularComponentValidator $validator)
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
        $bnccCurricularComponents = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $bnccCurricularComponents,
            ]);
        }

        return view('bnccCurricularComponents.index', compact('bnccCurricularComponents'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  BnccCurricularComponentCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(BnccCurricularComponentCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $bnccCurricularComponent = $this->repository->create($request->all());

            $response = [
                'message' => 'BnccCurricularComponent created.',
                'data'    => $bnccCurricularComponent->toArray(),
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
        $bnccCurricularComponent = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $bnccCurricularComponent,
            ]);
        }

        return view('bnccCurricularComponents.show', compact('bnccCurricularComponent'));
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
        $bnccCurricularComponent = $this->repository->find($id);

        return view('bnccCurricularComponents.edit', compact('bnccCurricularComponent'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  BnccCurricularComponentUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(BnccCurricularComponentUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $bnccCurricularComponent = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'BnccCurricularComponent updated.',
                'data'    => $bnccCurricularComponent->toArray(),
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
                'message' => 'BnccCurricularComponent deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'BnccCurricularComponent deleted.');
    }
}
