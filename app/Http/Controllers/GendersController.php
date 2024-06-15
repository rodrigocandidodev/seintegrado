<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\GenderCreateRequest;
use App\Http\Requests\GenderUpdateRequest;
use App\Repositories\GenderRepository;
use App\Validators\GenderValidator;

/**
 * Class GendersController.
 *
 * @package namespace App\Http\Controllers;
 */
class GendersController extends Controller
{
    /**
     * @var GenderRepository
     */
    protected $repository;

    /**
     * @var GenderValidator
     */
    protected $validator;

    /**
     * GendersController constructor.
     *
     * @param GenderRepository $repository
     * @param GenderValidator $validator
     */
    public function __construct(GenderRepository $repository, GenderValidator $validator)
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
        $genders = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $genders,
            ]);
        }

        return view('genders.index', compact('genders'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  GenderCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(GenderCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $gender = $this->repository->create($request->all());

            $response = [
                'message' => 'Gender created.',
                'data'    => $gender->toArray(),
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
        $gender = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $gender,
            ]);
        }

        return view('genders.show', compact('gender'));
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
        $gender = $this->repository->find($id);

        return view('genders.edit', compact('gender'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  GenderUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(GenderUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $gender = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Gender updated.',
                'data'    => $gender->toArray(),
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
                'message' => 'Gender deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Gender deleted.');
    }
}
