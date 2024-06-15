<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\CollaboratorContactsCreateRequest;
use App\Http\Requests\CollaboratorContactsUpdateRequest;
use App\Repositories\CollaboratorContactsRepository;
use App\Validators\CollaboratorContactsValidator;

/**
 * Class CollaboratorContactsController.
 *
 * @package namespace App\Http\Controllers;
 */
class CollaboratorContactsController extends Controller
{
    /**
     * @var CollaboratorContactsRepository
     */
    protected $repository;

    /**
     * @var CollaboratorContactsValidator
     */
    protected $validator;

    /**
     * CollaboratorContactsController constructor.
     *
     * @param CollaboratorContactsRepository $repository
     * @param CollaboratorContactsValidator $validator
     */
    public function __construct(CollaboratorContactsRepository $repository, CollaboratorContactsValidator $validator)
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
        $collaboratorContacts = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $collaboratorContacts,
            ]);
        }

        return view('collaboratorContacts.index', compact('collaboratorContacts'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CollaboratorContactsCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(CollaboratorContactsCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $collaboratorContact = $this->repository->create($request->all());

            $response = [
                'message' => 'CollaboratorContacts created.',
                'data'    => $collaboratorContact->toArray(),
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
        $collaboratorContact = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $collaboratorContact,
            ]);
        }

        return view('collaboratorContacts.show', compact('collaboratorContact'));
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
        $collaboratorContact = $this->repository->find($id);

        return view('collaboratorContacts.edit', compact('collaboratorContact'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  CollaboratorContactsUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(CollaboratorContactsUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $collaboratorContact = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'CollaboratorContacts updated.',
                'data'    => $collaboratorContact->toArray(),
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
                'message' => 'CollaboratorContacts deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'CollaboratorContacts deleted.');
    }
}
