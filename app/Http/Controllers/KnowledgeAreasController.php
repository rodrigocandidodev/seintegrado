<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\KnowledgeAreaCreateRequest;
use App\Http\Requests\KnowledgeAreaUpdateRequest;
use App\Repositories\KnowledgeAreaRepository;
use App\Validators\KnowledgeAreaValidator;

/**
 * Class KnowledgeAreasController.
 *
 * @package namespace App\Http\Controllers;
 */
class KnowledgeAreasController extends Controller
{
    /**
     * @var KnowledgeAreaRepository
     */
    protected $repository;

    /**
     * @var KnowledgeAreaValidator
     */
    protected $validator;

    /**
     * KnowledgeAreasController constructor.
     *
     * @param KnowledgeAreaRepository $repository
     * @param KnowledgeAreaValidator $validator
     */
    public function __construct(KnowledgeAreaRepository $repository, KnowledgeAreaValidator $validator)
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
        $knowledgeAreas = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $knowledgeAreas,
            ]);
        }

        return view('knowledgeAreas.index', compact('knowledgeAreas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  KnowledgeAreaCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(KnowledgeAreaCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $knowledgeArea = $this->repository->create($request->all());

            $response = [
                'message' => 'KnowledgeArea created.',
                'data'    => $knowledgeArea->toArray(),
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
        $knowledgeArea = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $knowledgeArea,
            ]);
        }

        return view('knowledgeAreas.show', compact('knowledgeArea'));
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
        $knowledgeArea = $this->repository->find($id);

        return view('knowledgeAreas.edit', compact('knowledgeArea'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  KnowledgeAreaUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(KnowledgeAreaUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $knowledgeArea = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'KnowledgeArea updated.',
                'data'    => $knowledgeArea->toArray(),
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
                'message' => 'KnowledgeArea deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'KnowledgeArea deleted.');
    }
}
