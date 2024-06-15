<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\StudentAddressCreateRequest;
use App\Http\Requests\StudentAddressUpdateRequest;
use App\Repositories\StudentAddressRepository;
use App\Validators\StudentAddressValidator;

/**
 * Class StudentAdressesController.
 *
 * @package namespace App\Http\Controllers;
 */
class StudentAddressesController extends Controller
{
    /**
     * @var StudentAdressRepository
     */
    protected $repository;

    /**
     * @var StudentAdressValidator
     */
    protected $validator;

    /**
     * StudentAdressesController constructor.
     *
     * @param StudentAdressRepository $repository
     * @param StudentAdressValidator $validator
     */
    public function __construct(StudentAddressRepository $repository, StudentAddressValidator $validator)
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
        $studentAddresses = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $studentAddresses,
            ]);
        }

        return view('studentAddresses.index', compact('studentAddresses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StudentAdressCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(StudentAddressCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $studentAddress = $this->repository->create($request->all());

            $response = [
                'message' => 'StudentAddress created.',
                'data'    => $studentAddress->toArray(),
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
        $studentAddress = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $studentAddress,
            ]);
        }

        return view('studentAddresses.show', compact('studentAddress'));
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
        $studentAddress = $this->repository->find($id);

        return view('studentAddresses.edit', compact('studentAddress'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  StudentAdressUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(StudentAddressUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $studentAddress = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'StudentAddress updated.',
                'data'    => $studentAddress->toArray(),
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
                'message' => 'StudentAddress deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'StudentAddress deleted.');
    }
}
