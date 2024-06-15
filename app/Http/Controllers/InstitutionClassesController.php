<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\InstitutionClassCreateRequest;
use App\Http\Requests\InstitutionClassUpdateRequest;
use App\Repositories\InstitutionClassRepository;
use App\Validators\InstitutionClassValidator;

/**
 * Class InstitutionClassesController.
 *
 * @package namespace App\Http\Controllers;
 */
class InstitutionClassesController extends Controller
{
    /**
     * @var InstitutionClassRepository
     */
    protected $repository;

    /**
     * @var InstitutionClassValidator
     */
    protected $validator;

    /**
     * institutionClassesController constructor.
     *
     * @param InsitutionClassRepository $repository
     * @param InstitutionClassValidator $validator
     */
    public function __construct(InstitutionClassRepository $repository, InstitutionClassValidator $validator)
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
        $institution_classes = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $institution_classes,
            ]);
        }

        return view('institution_classes.index', compact('institution_classes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  InstitutionClassCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(InstitutionClassCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $institution_class = $this->repository->create($request->all());

            $response = [
                'message' => 'InstitutionClass created.',
                'data'    => $institution_class->toArray(),
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
        $institution_class = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $institution_class,
            ]);
        }

        return view('institution_classes.show', compact('institution_class'));
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
        $institution_class = $this->repository->find($id);

        return view('institution_classes.edit', compact('institution_class'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  InstitutionClassUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(InstitutionClassUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $institution_class = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'InstitutionClass updated.',
                'data'    => $institution_class->toArray(),
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
                'message' => 'InstitutionClass deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'InstitutionClass deleted.');
    }
}
