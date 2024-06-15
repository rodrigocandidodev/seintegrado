<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\ColorCreateRequest;
use App\Http\Requests\ColorUpdateRequest;
use App\Repositories\ColorRepository;
use App\Validators\ColorValidator;

/**
 * Class ColorsController.
 *
 * @package namespace App\Http\Controllers;
 */
class ColorsController extends Controller
{
    /**
     * @var ColorRepository
     */
    protected $repository;

    /**
     * @var ColorValidator
     */
    protected $validator;

    /**
     * ColorsController constructor.
     *
     * @param ColorRepository $repository
     * @param ColorValidator $validator
     */
    public function __construct(ColorRepository $repository, ColorValidator $validator)
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
        $colors = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $colors,
            ]);
        }

        return view('colors.index', compact('colors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  ColorCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(ColorCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $color = $this->repository->create($request->all());

            $response = [
                'message' => 'Color created.',
                'data'    => $color->toArray(),
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
        $color = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $color,
            ]);
        }

        return view('colors.show', compact('color'));
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
        $color = $this->repository->find($id);

        return view('colors.edit', compact('color'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  ColorUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(ColorUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $color = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Color updated.',
                'data'    => $color->toArray(),
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
                'message' => 'Color deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Color deleted.');
    }
}
