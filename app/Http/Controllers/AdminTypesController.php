<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\AdminTypeCreateRequest;
use App\Http\Requests\AdminTypeUpdateRequest;
use App\Repositories\AdminTypeRepository;
use App\Validators\AdminTypeValidator;

/**
 * Class AdminTypesController.
 *
 * @package namespace App\Http\Controllers;
 */
class AdminTypesController extends Controller
{
    /**
     * @var AdminTypeRepository
     */
    protected $repository;

    /**
     * @var AdminTypeValidator
     */
    protected $validator;

    /**
     * AdminTypesController constructor.
     *
     * @param AdminTypeRepository $repository
     * @param AdminTypeValidator $validator
     */
    public function __construct(AdminTypeRepository $repository, AdminTypeValidator $validator)
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
        $adminTypes = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $adminTypes,
            ]);
        }

        return view('adminTypes.index', compact('adminTypes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  AdminTypeCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(AdminTypeCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $adminType = $this->repository->create($request->all());

            $response = [
                'message' => 'AdminType created.',
                'data'    => $adminType->toArray(),
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
        $adminType = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $adminType,
            ]);
        }

        return view('adminTypes.show', compact('adminType'));
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
        $adminType = $this->repository->find($id);

        return view('adminTypes.edit', compact('adminType'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  AdminTypeUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(AdminTypeUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $adminType = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'AdminType updated.',
                'data'    => $adminType->toArray(),
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
                'message' => 'AdminType deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'AdminType deleted.');
    }
}
