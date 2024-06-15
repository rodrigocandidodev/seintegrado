<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\StudentMedicalCertificateCreateRequest;
use App\Http\Requests\StudentMedicalCertificateUpdateRequest;
use App\Repositories\StudentMedicalCertificateRepository;
use App\Validators\StudentMedicalCertificateValidator;

/**
 * Class StudentMedicalCertificatesController.
 *
 * @package namespace App\Http\Controllers;
 */
class StudentMedicalCertificatesController extends Controller
{
    /**
     * @var StudentMedicalCertificateRepository
     */
    protected $repository;

    /**
     * @var StudentMedicalCertificateValidator
     */
    protected $validator;

    /**
     * StudentMedicalCertificatesController constructor.
     *
     * @param StudentMedicalCertificateRepository $repository
     * @param StudentMedicalCertificateValidator $validator
     */
    public function __construct(StudentMedicalCertificateRepository $repository, StudentMedicalCertificateValidator $validator)
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
        $studentMedicalCertificates = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $studentMedicalCertificates,
            ]);
        }

        return view('studentMedicalCertificates.index', compact('studentMedicalCertificates'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StudentMedicalCertificateCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(StudentMedicalCertificateCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $studentMedicalCertificate = $this->repository->create($request->all());

            $response = [
                'message' => 'StudentMedicalCertificate created.',
                'data'    => $studentMedicalCertificate->toArray(),
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
        $studentMedicalCertificate = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $studentMedicalCertificate,
            ]);
        }

        return view('studentMedicalCertificates.show', compact('studentMedicalCertificate'));
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
        $studentMedicalCertificate = $this->repository->find($id);

        return view('studentMedicalCertificates.edit', compact('studentMedicalCertificate'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  StudentMedicalCertificateUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(StudentMedicalCertificateUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $studentMedicalCertificate = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'StudentMedicalCertificate updated.',
                'data'    => $studentMedicalCertificate->toArray(),
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
                'message' => 'StudentMedicalCertificate deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'StudentMedicalCertificate deleted.');
    }
}
