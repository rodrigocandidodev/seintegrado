<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\PracticalLanguageThematicAxisCreateRequest;
use App\Http\Requests\PracticalLanguageThematicAxisUpdateRequest;
use App\Repositories\PracticalLanguageThematicAxisRepository;
use App\Validators\PracticalLanguageThematicAxisValidator;

/**
 * Class PracticalLanguageThematicAxesController.
 *
 * @package namespace App\Http\Controllers;
 */
class PracticalLanguageThematicAxesController extends Controller
{
    /**
     * @var PracticalLanguageThematicAxisRepository
     */
    protected $repository;

    /**
     * @var PracticalLanguageThematicAxisValidator
     */
    protected $validator;

    /**
     * PracticalLanguageThematicAxesController constructor.
     *
     * @param PracticalLanguageThematicAxisRepository $repository
     * @param PracticalLanguageThematicAxisValidator $validator
     */
    public function __construct(PracticalLanguageThematicAxisRepository $repository, PracticalLanguageThematicAxisValidator $validator)
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
        $practicalLanguageThematicAxes = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $practicalLanguageThematicAxes,
            ]);
        }

        return view('practicalLanguageThematicAxes.index', compact('practicalLanguageThematicAxes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  PracticalLanguageThematicAxisCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(PracticalLanguageThematicAxisCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $practicalLanguageThematicAxi = $this->repository->create($request->all());

            $response = [
                'message' => 'PracticalLanguageThematicAxis created.',
                'data'    => $practicalLanguageThematicAxi->toArray(),
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
        $practicalLanguageThematicAxi = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $practicalLanguageThematicAxi,
            ]);
        }

        return view('practicalLanguageThematicAxes.show', compact('practicalLanguageThematicAxi'));
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
        $practicalLanguageThematicAxi = $this->repository->find($id);

        return view('practicalLanguageThematicAxes.edit', compact('practicalLanguageThematicAxi'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  PracticalLanguageThematicAxisUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(PracticalLanguageThematicAxisUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $practicalLanguageThematicAxi = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'PracticalLanguageThematicAxis updated.',
                'data'    => $practicalLanguageThematicAxi->toArray(),
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
                'message' => 'PracticalLanguageThematicAxis deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'PracticalLanguageThematicAxis deleted.');
    }
}
