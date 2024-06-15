<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\InstitutionSchoolYearDivisionCreateRequest;
use App\Http\Requests\InstitutionSchoolYearDivisionUpdateRequest;
use App\Repositories\InstitutionSchoolYearDivisionRepository;
use App\Validators\InstitutionSchoolYearDivisionValidator;

/**
 * Class InstitutionSchoolYearDivisionsController.
 *
 * @package namespace App\Http\Controllers;
 */
class InstitutionSchoolYearDivisionsController extends Controller
{
    /**
     * @var InstitutionSchoolYearDivisionRepository
     */
    protected $repository;

    /**
     * @var InstitutionSchoolYearDivisionValidator
     */
    protected $validator;

    /**
     * InstitutionSchoolYearDivisionsController constructor.
     *
     * @param InstitutionSchoolYearDivisionRepository $repository
     * @param InstitutionSchoolYearDivisionValidator $validator
     */
    public function __construct(InstitutionSchoolYearDivisionRepository $repository, InstitutionSchoolYearDivisionValidator $validator)
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
        $institutionSchoolYearDivisions = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $institutionSchoolYearDivisions,
            ]);
        }

        return view('institutionSchoolYearDivisions.index', compact('institutionSchoolYearDivisions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  InstitutionSchoolYearDivisionCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(InstitutionSchoolYearDivisionCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $institutionSchoolYearDivision = $this->repository->create($request->all());

            $response = [
                'message' => 'InstitutionSchoolYearDivision created.',
                'data'    => $institutionSchoolYearDivision->toArray(),
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
        $institutionSchoolYearDivision = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $institutionSchoolYearDivision,
            ]);
        }

        return view('institutionSchoolYearDivisions.show', compact('institutionSchoolYearDivision'));
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
        $institutionSchoolYearDivision = $this->repository->find($id);

        return view('institutionSchoolYearDivisions.edit', compact('institutionSchoolYearDivision'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  InstitutionSchoolYearDivisionUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(InstitutionSchoolYearDivisionUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $institutionSchoolYearDivision = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'InstitutionSchoolYearDivision updated.',
                'data'    => $institutionSchoolYearDivision->toArray(),
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
                'message' => 'InstitutionSchoolYearDivision deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'InstitutionSchoolYearDivision deleted.');
    }
}
