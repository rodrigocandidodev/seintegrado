<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\ScholarityCreateRequest;
use App\Http\Requests\ScholarityUpdateRequest;
use App\Repositories\ScholarityRepository;
use App\Validators\ScholarityValidator;


class ScholaritiesController extends Controller
{

    protected $repository;


    protected $validator;


    public function __construct(ScholarityRepository $repository, ScholarityValidator $validator)
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
        $scholarities = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $scholarities,
            ]);
        }

        return view('scholarities.index', compact('scholarities'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  ScholarshipCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(ScholarityCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $scholarity = $this->repository->create($request->all());

            $response = [
                'message' => 'Scholarity created.',
                'data'    => $scholarity->toArray(),
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
        $scholarity = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $scholarity,
            ]);
        }

        return view('scholarities.show', compact('scholarity'));
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
        $scholarity = $this->repository->find($id);

        return view('scholarities.edit', compact('scholarity'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  ScholarshipUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(ScholarityUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $scholarity = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Scholarity updated.',
                'data'    => $scholarity->toArray(),
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
                'message' => 'Scholarity deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Scholarity deleted.');
    }
}
