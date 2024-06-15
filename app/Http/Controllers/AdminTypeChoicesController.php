<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\AdminTypeChoiceCreateRequest;
use App\Http\Requests\AdminTypeChoiceUpdateRequest;
use App\Repositories\AdminTypeChoiceRepository;
use App\Validators\AdminTypeChoiceValidator;

/**
 * Class AdminTypeChoicesController.
 *
 * @package namespace App\Http\Controllers;
 */
class AdminTypeChoicesController extends Controller
{
    /**
     * @var AdminTypeChoiceRepository
     */
    protected $repository;

    /**
     * @var AdminTypeChoiceValidator
     */
    protected $validator;

    /**
     * AdminTypeChoicesController constructor.
     *
     * @param AdminTypeChoiceRepository $repository
     * @param AdminTypeChoiceValidator $validator
     */
    public function __construct(AdminTypeChoiceRepository $repository, AdminTypeChoiceValidator $validator)
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
        $adminTypeChoices = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $adminTypeChoices,
            ]);
        }

        return view('adminTypeChoices.index', compact('adminTypeChoices'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  AdminTypeChoiceCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(AdminTypeChoiceCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $adminTypeChoice = $this->repository->create($request->all());

            $response = [
                'message' => 'AdminTypeChoice created.',
                'data'    => $adminTypeChoice->toArray(),
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
        $adminTypeChoice = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $adminTypeChoice,
            ]);
        }

        return view('adminTypeChoices.show', compact('adminTypeChoice'));
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
        $adminTypeChoice = $this->repository->find($id);

        return view('adminTypeChoices.edit', compact('adminTypeChoice'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  AdminTypeChoiceUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(AdminTypeChoiceUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $adminTypeChoice = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'AdminTypeChoice updated.',
                'data'    => $adminTypeChoice->toArray(),
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
                'message' => 'AdminTypeChoice deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'AdminTypeChoice deleted.');
    }
}
