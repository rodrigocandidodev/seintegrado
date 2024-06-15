<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\ApplicationFieldThematicUnitCreateRequest;
use App\Http\Requests\ApplicationFieldThematicUnitUpdateRequest;
use App\Repositories\ApplicationFieldThematicUnitRepository;
use App\Validators\ApplicationFieldThematicUnitValidator;

/**
 * Class ApplicationFieldThematicUnitsController.
 *
 * @package namespace App\Http\Controllers;
 */
class ApplicationFieldThematicUnitsController extends Controller
{
    /**
     * @var ApplicationFieldThematicUnitRepository
     */
    protected $repository;

    /**
     * @var ApplicationFieldThematicUnitValidator
     */
    protected $validator;

    /**
     * ApplicationFieldThematicUnitsController constructor.
     *
     * @param ApplicationFieldThematicUnitRepository $repository
     * @param ApplicationFieldThematicUnitValidator $validator
     */
    public function __construct(ApplicationFieldThematicUnitRepository $repository, ApplicationFieldThematicUnitValidator $validator)
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
        $applicationFieldThematicUnits = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $applicationFieldThematicUnits,
            ]);
        }

        return view('applicationFieldThematicUnits.index', compact('applicationFieldThematicUnits'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  ApplicationFieldThematicUnitCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(ApplicationFieldThematicUnitCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $applicationFieldThematicUnit = $this->repository->create($request->all());

            $response = [
                'message' => 'ApplicationFieldThematicUnit created.',
                'data'    => $applicationFieldThematicUnit->toArray(),
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
        $applicationFieldThematicUnit = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $applicationFieldThematicUnit,
            ]);
        }

        return view('applicationFieldThematicUnits.show', compact('applicationFieldThematicUnit'));
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
        $applicationFieldThematicUnit = $this->repository->find($id);

        return view('applicationFieldThematicUnits.edit', compact('applicationFieldThematicUnit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  ApplicationFieldThematicUnitUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(ApplicationFieldThematicUnitUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $applicationFieldThematicUnit = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'ApplicationFieldThematicUnit updated.',
                'data'    => $applicationFieldThematicUnit->toArray(),
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
                'message' => 'ApplicationFieldThematicUnit deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'ApplicationFieldThematicUnit deleted.');
    }
}
