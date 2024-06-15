<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\StudentContactsCreateRequest;
use App\Http\Requests\StudentContactsUpdateRequest;
use App\Repositories\StudentContactsRepository;
use App\Validators\StudentContactsValidator;

/**
 * Class StudentContactsController.
 *
 * @package namespace App\Http\Controllers;
 */
class StudentContactsController extends Controller
{
    /**
     * @var StudentContactsRepository
     */
    protected $repository;

    /**
     * @var StudentContactsValidator
     */
    protected $validator;

    /**
     * StudentContactsController constructor.
     *
     * @param StudentContactsRepository $repository
     * @param StudentContactsValidator $validator
     */
    public function __construct(StudentContactsRepository $repository, StudentContactsValidator $validator)
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
        $studentContacts = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $studentContacts,
            ]);
        }

        return view('studentContacts.index', compact('studentContacts'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StudentContactsCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(StudentContactsCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $studentContact = $this->repository->create($request->all());

            $response = [
                'message' => 'StudentContacts created.',
                'data'    => $studentContact->toArray(),
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
        $studentContact = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $studentContact,
            ]);
        }

        return view('studentContacts.show', compact('studentContact'));
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
        $studentContact = $this->repository->find($id);

        return view('studentContacts.edit', compact('studentContact'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  StudentContactsUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(StudentContactsUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $studentContact = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'StudentContacts updated.',
                'data'    => $studentContact->toArray(),
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
                'message' => 'StudentContacts deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'StudentContacts deleted.');
    }
}
