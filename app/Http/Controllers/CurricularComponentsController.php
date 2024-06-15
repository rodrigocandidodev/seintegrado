<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\CurricularComponentCreateRequest;
use App\Http\Requests\CurricularComponentUpdateRequest;
use App\Repositories\CurricularComponentRepository;
use App\Validators\CurricularComponentValidator;

/**
 * Class CurricularComponentsController.
 *
 * @package namespace App\Http\Controllers;
 */
class CurricularComponentsController extends Controller
{
    /**
     * @var CurricularComponentRepository
     */
    protected $repository;

    /**
     * @var CurricularComponentValidator
     */
    protected $validator;

    /**
     * CurricularComponentsController constructor.
     *
     * @param CurricularComponentRepository $repository
     * @param CurricularComponentValidator $validator
     */
    public function __construct(CurricularComponentRepository $repository, CurricularComponentValidator $validator)
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
        $curricularComponents = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $curricularComponents,
            ]);
        }

        return view('curricularComponents.index', compact('curricularComponents'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CurricularComponentCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(CurricularComponentCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $curricularComponent = $this->repository->create($request->all());

            $response = [
                'message' => 'CurricularComponent created.',
                'data'    => $curricularComponent->toArray(),
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
        $curricularComponent = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $curricularComponent,
            ]);
        }

        return view('curricularComponents.show', compact('curricularComponent'));
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
        $curricularComponent = $this->repository->find($id);

        return view('curricularComponents.edit', compact('curricularComponent'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  CurricularComponentUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(CurricularComponentUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $curricularComponent = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'CurricularComponent updated.',
                'data'    => $curricularComponent->toArray(),
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
                'message' => 'CurricularComponent deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'CurricularComponent deleted.');
    }
}
