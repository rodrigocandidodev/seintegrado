<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\PrevisionSetupCreateRequest;
use App\Http\Requests\PrevisionSetupUpdateRequest;
use App\Repositories\PrevisionSetupRepository;
use App\Validators\PrevisionSetupValidator;

/**
 * Class PrevisionSetupsController.
 *
 * @package namespace App\Http\Controllers;
 */
class PrevisionSetupsController extends Controller
{
    /**
     * @var PrevisionSetupRepository
     */
    protected $repository;

    /**
     * @var PrevisionSetupValidator
     */
    protected $validator;

    /**
     * PrevisionSetupsController constructor.
     *
     * @param PrevisionSetupRepository $repository
     * @param PrevisionSetupValidator $validator
     */
    public function __construct(PrevisionSetupRepository $repository, PrevisionSetupValidator $validator)
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
        $previsionSetups = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $previsionSetups,
            ]);
        }

        return view('previsionSetups.index', compact('previsionSetups'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  PrevisionSetupCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(PrevisionSetupCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $previsionSetup = $this->repository->create($request->all());

            $response = [
                'message' => 'PrevisionSetup created.',
                'data'    => $previsionSetup->toArray(),
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
        $previsionSetup = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $previsionSetup,
            ]);
        }

        return view('previsionSetups.show', compact('previsionSetup'));
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
        $previsionSetup = $this->repository->find($id);

        return view('previsionSetups.edit', compact('previsionSetup'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  PrevisionSetupUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(PrevisionSetupUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $previsionSetup = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'PrevisionSetup updated.',
                'data'    => $previsionSetup->toArray(),
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
                'message' => 'PrevisionSetup deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'PrevisionSetup deleted.');
    }
}
