<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\CoreAdminCreateRequest;
use App\Http\Requests\CoreAdminUpdateRequest;
use App\Repositories\CoreAdminRepository;
use App\Validators\CoreAdminValidator;

/**
 * Class CoreAdminsController.
 *
 * @package namespace App\Http\Controllers;
 */
class CoreAdminsController extends Controller
{
    /**
     * @var CoreAdminRepository
     */
    protected $repository;

    /**
     * @var CoreAdminValidator
     */
    protected $validator;

    /**
     * CoreAdminsController constructor.
     *
     * @param CoreAdminRepository $repository
     * @param CoreAdminValidator $validator
     */
    public function __construct(CoreAdminRepository $repository, CoreAdminValidator $validator)
    {
        $this->repository = $repository;
        $this->validator  = $validator;

        $this->middleware('auth:core-admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function dashboard()
    {
        $page_title = 'Home';
        return view('core-admins.admin',[
            'title' => $page_title
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
        $coreAdmins = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $coreAdmins,
            ]);
        }

        return view('coreAdmins.index', compact('coreAdmins'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CoreAdminCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(CoreAdminCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $coreAdmin = $this->repository->create($request->all());

            $response = [
                'message' => 'CoreAdmin created.',
                'data'    => $coreAdmin->toArray(),
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
        $coreAdmin = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $coreAdmin,
            ]);
        }

        return view('coreAdmins.show', compact('coreAdmin'));
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
        $coreAdmin = $this->repository->find($id);

        return view('coreAdmins.edit', compact('coreAdmin'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  CoreAdminUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(CoreAdminUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $coreAdmin = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'CoreAdmin updated.',
                'data'    => $coreAdmin->toArray(),
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
                'message' => 'CoreAdmin deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'CoreAdmin deleted.');
    }
}
