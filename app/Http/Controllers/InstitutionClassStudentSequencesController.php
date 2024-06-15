<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\InstitutionClassStudentSequenceCreateRequest;
use App\Http\Requests\InstitutionClassStudentSequenceUpdateRequest;
use App\Repositories\InstitutionClassStudentSequenceRepository;
use App\Validators\InstitutionClassStudentSequenceValidator;

/**
 * Class InstitutionClassStudentSequencesController.
 *
 * @package namespace App\Http\Controllers;
 */
class InstitutionClassStudentSequencesController extends Controller
{
    /**
     * @var InstitutionClassStudentSequenceRepository
     */
    protected $repository;

    /**
     * @var InstitutionClassStudentSequenceValidator
     */
    protected $validator;

    /**
     * InstitutionClassStudentSequencesController constructor.
     *
     * @param InstitutionClassStudentSequenceRepository $repository
     * @param InstitutionClassStudentSequenceValidator $validator
     */
    public function __construct(InstitutionClassStudentSequenceRepository $repository, InstitutionClassStudentSequenceValidator $validator)
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
        $institutionClassStudentSequences = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $institutionClassStudentSequences,
            ]);
        }

        return view('institutionClassStudentSequences.index', compact('institutionClassStudentSequences'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  InstitutionClassStudentSequenceCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(InstitutionClassStudentSequenceCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $institutionClassStudentSequence = $this->repository->create($request->all());

            $response = [
                'message' => 'InstitutionClassStudentSequence created.',
                'data'    => $institutionClassStudentSequence->toArray(),
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
        $institutionClassStudentSequence = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $institutionClassStudentSequence,
            ]);
        }

        return view('institutionClassStudentSequences.show', compact('institutionClassStudentSequence'));
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
        $institutionClassStudentSequence = $this->repository->find($id);

        return view('institutionClassStudentSequences.edit', compact('institutionClassStudentSequence'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  InstitutionClassStudentSequenceUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(InstitutionClassStudentSequenceUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $institutionClassStudentSequence = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'InstitutionClassStudentSequence updated.',
                'data'    => $institutionClassStudentSequence->toArray(),
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
                'message' => 'InstitutionClassStudentSequence deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'InstitutionClassStudentSequence deleted.');
    }
}
