<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\TeacherClassCreateRequest;
use App\Http\Requests\TeacherClassUpdateRequest;
use App\Repositories\TeacherClassRepository;
use App\Validators\TeacherClassValidator;

/**
 * Class TeacherClassesController.
 *
 * @package namespace App\Http\Controllers;
 */
class TeacherClassesController extends Controller
{
    /**
     * @var TeacherClassRepository
     */
    protected $repository;

    /**
     * @var TeacherClassValidator
     */
    protected $validator;

    /**
     * TeacherClassesController constructor.
     *
     * @param TeacherClassRepository $repository
     * @param TeacherClassValidator $validator
     */
    public function __construct(TeacherClassRepository $repository, TeacherClassValidator $validator)
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
        $teacherClasses = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $teacherClasses,
            ]);
        }

        return view('teacherClasses.index', compact('teacherClasses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  TeacherClassCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(TeacherClassCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $teacherClass = $this->repository->create($request->all());

            $response = [
                'message' => 'TeacherClass created.',
                'data'    => $teacherClass->toArray(),
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
        $teacherClass = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $teacherClass,
            ]);
        }

        return view('teacherClasses.show', compact('teacherClass'));
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
        $teacherClass = $this->repository->find($id);

        return view('teacherClasses.edit', compact('teacherClass'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  TeacherClassUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(TeacherClassUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $teacherClass = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'TeacherClass updated.',
                'data'    => $teacherClass->toArray(),
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
                'message' => 'TeacherClass deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'TeacherClass deleted.');
    }
}
