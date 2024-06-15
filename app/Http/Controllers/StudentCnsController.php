<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\StudentCnCreateRequest;
use App\Http\Requests\StudentCnUpdateRequest;
use App\Repositories\StudentCnRepository;
use App\Repositories\CollaboratorRepository;
use App\Repositories\InstitutionClassRepository;
use App\Validators\StudentCnValidator;
use Auth;

/**
 * Class StudentCnsController.
 *
 * @package namespace App\Http\Controllers;
 */
class StudentCnsController extends Controller
{
    protected $repository;
    protected $validator;
    protected $collaborator_repository;
    protected $institution_class_repository;

    public function __construct(
        StudentCnRepository         $repository,
        CollaboratorRepository      $collaborator_repository,
        InstitutionClassRepository  $institution_class_repository,
        StudentCnValidator          $validator
    )
    {
        $this->repository                       = $repository;
        $this->collaborator_repository          = $collaborator_repository;
        $this->institution_class_repository     = $institution_class_repository;
        $this->validator                        = $validator;
    }
    public function ShowStudentCnForm()
    {
        $guard = 'admins';
        $page_title = 'Matrícula';
        dd(Auth::user());
        $collaborator_id = Auth::user()->collaborator_id;

        //Database searches
        $admin                          = $this->repository->all();
        $institution_classes            = $this->institution_class_repository->all();

        $online_collaborator_data       = $this->collaborator_repository->findWhere([
            'id'=> $collaborator_id
        ])->first();

        $online_collaborator_institution_id = $online_collaborator_data->institution_id;
        $active_students  = $this->student_enrollment_repository->findWhere([
            'institution_id'    => $online_collaborator_institution_id,
            'enrollment_status_id' => '1'
        ])->first();
        return view('admins.config',[
            'guard'   => $guard, 
            'title' => $page_title,
            'online_collaborator_name'  => $online_collaborator_data->name
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $studentCns = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $studentCns,
            ]);
        }

        return view('studentCns.index', compact('studentCns'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StudentCnCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(StudentCnCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $studentCn = $this->repository->create($request->all());

            $response = [
                'message' => 'StudentCn created.',
                'data'    => $studentCn->toArray(),
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
        $studentCn = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $studentCn,
            ]);
        }

        return view('studentCns.show', compact('studentCn'));
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
        $studentCn = $this->repository->find($id);

        return view('studentCns.edit', compact('studentCn'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  StudentCnUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(StudentCnUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $studentCn = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'StudentCn updated.',
                'data'    => $studentCn->toArray(),
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
                'message' => 'StudentCn deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'StudentCn deleted.');
    }
}
