<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\CurricularComponentClassCreateRequest;
use App\Http\Requests\CurricularComponentClassUpdateRequest;
use App\Repositories\CurricularComponentClassRepository;
use App\Validators\CurricularComponentClassValidator;

/**
 * Class CurricularComponentClassesController.
 *
 * @package namespace App\Http\Controllers;
 */
class CurricularComponentClassesController extends Controller
{
    /**
     * @var CurricularComponentClassRepository
     */
    protected $repository;

    /**
     * @var CurricularComponentClassValidator
     */
    protected $validator;

    /**
     * CurricularComponentClassesController constructor.
     *
     * @param CurricularComponentClassRepository $repository
     * @param CurricularComponentClassValidator $validator
     */
    public function __construct(CurricularComponentClassRepository $repository, CurricularComponentClassValidator $validator)
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
        $curricularComponentClasses = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $curricularComponentClasses,
            ]);
        }

        return view('curricularComponentClasses.index', compact('curricularComponentClasses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CurricularComponentClassCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(CurricularComponentClassCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $curricularComponentClass = $this->repository->create($request->all());

            $response = [
                'message' => 'CurricularComponentClass created.',
                'data'    => $curricularComponentClass->toArray(),
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
        $curricularComponentClass = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $curricularComponentClass,
            ]);
        }

        return view('curricularComponentClasses.show', compact('curricularComponentClass'));
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
        $curricularComponentClass = $this->repository->find($id);

        return view('curricularComponentClasses.edit', compact('curricularComponentClass'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  CurricularComponentClassUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(CurricularComponentClassUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $curricularComponentClass = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'CurricularComponentClass updated.',
                'data'    => $curricularComponentClass->toArray(),
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
                'message' => 'CurricularComponentClass deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'CurricularComponentClass deleted.');
    }
}
