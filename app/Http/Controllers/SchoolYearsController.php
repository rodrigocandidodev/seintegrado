<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\SchoolYearCreateRequest;
use App\Http\Requests\SchoolYearUpdateRequest;
use App\Repositories\SchoolYearRepository;
use App\Validators\SchoolYearValidator;

/**
 * Class SchoolYearsController.
 *
 * @package namespace App\Http\Controllers;
 */
class SchoolYearsController extends Controller
{
    /**
     * @var SchoolYearRepository
     */
    protected $repository;

    /**
     * @var SchoolYearValidator
     */
    protected $validator;

    /**
     * SchoolYearsController constructor.
     *
     * @param SchoolYearRepository $repository
     * @param SchoolYearValidator $validator
     */
    public function __construct(SchoolYearRepository $repository, SchoolYearValidator $validator)
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
        $schoolYears = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $schoolYears,
            ]);
        }

        return view('schoolYears.index', compact('schoolYears'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  SchoolYearCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(SchoolYearCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $schoolYear = $this->repository->create($request->all());

            $response = [
                'message' => 'SchoolYear created.',
                'data'    => $schoolYear->toArray(),
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
        $schoolYear = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $schoolYear,
            ]);
        }

        return view('schoolYears.show', compact('schoolYear'));
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
        $schoolYear = $this->repository->find($id);

        return view('schoolYears.edit', compact('schoolYear'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  SchoolYearUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(SchoolYearUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $schoolYear = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'SchoolYear updated.',
                'data'    => $schoolYear->toArray(),
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
                'message' => 'SchoolYear deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'SchoolYear deleted.');
    }
}
