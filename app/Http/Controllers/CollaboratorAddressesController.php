<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\CollaboratorAddressCreateRequest;
use App\Http\Requests\CollaboratorAddressUpdateRequest;
use App\Repositories\CollaboratorAddressRepository;
use App\Validators\CollaboratorAddressValidator;

/**
 * Class CollaboratorAdressesController.
 *
 * @package namespace App\Http\Controllers;
 */
class CollaboratorAddressesController extends Controller
{
    /**
     * @var CollaboratorAdressRepository
     */
    protected $repository;

    /**
     * @var CollaboratorAdressValidator
     */
    protected $validator;

    /**
     * CollaboratorAdressesController constructor.
     *
     * @param CollaboratorAdressRepository $repository
     * @param CollaboratorAdressValidator $validator
     */
    public function __construct(CollaboratorAdressRepository $repository, CollaboratorAdressValidator $validator)
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
        $collaboratorAdresses = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $collaboratorAdresses,
            ]);
        }

        return view('collaboratorAdresses.index', compact('collaboratorAdresses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CollaboratorAdressCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(CollaboratorAdressCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $collaboratorAdress = $this->repository->create($request->all());

            $response = [
                'message' => 'CollaboratorAdress created.',
                'data'    => $collaboratorAdress->toArray(),
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
        $collaboratorAdress = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $collaboratorAdress,
            ]);
        }

        return view('collaboratorAdresses.show', compact('collaboratorAdress'));
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
        $collaboratorAdress = $this->repository->find($id);

        return view('collaboratorAdresses.edit', compact('collaboratorAdress'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  CollaboratorAdressUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(CollaboratorAdressUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $collaboratorAdress = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'CollaboratorAdress updated.',
                'data'    => $collaboratorAdress->toArray(),
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
                'message' => 'CollaboratorAdress deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'CollaboratorAdress deleted.');
    }
}
