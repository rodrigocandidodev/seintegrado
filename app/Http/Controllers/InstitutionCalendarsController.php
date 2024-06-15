<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\InstitutionCalendarCreateRequest;
use App\Http\Requests\InstitutionCalendarUpdateRequest;
use App\Repositories\InstitutionCalendarRepository;
use App\Validators\InstitutionCalendarValidator;

/**
 * Class InstitutionCalendarsController.
 *
 * @package namespace App\Http\Controllers;
 */
class InstitutionCalendarsController extends Controller
{
    /**
     * @var InstitutionCalendarRepository
     */
    protected $repository;

    /**
     * @var InstitutionCalendarValidator
     */
    protected $validator;

    /**
     * InstitutionCalendarsController constructor.
     *
     * @param InstitutionCalendarRepository $repository
     * @param InstitutionCalendarValidator $validator
     */
    public function __construct(InstitutionCalendarRepository $repository, InstitutionCalendarValidator $validator)
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
        $institutionCalendars = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $institutionCalendars,
            ]);
        }

        return view('institutionCalendars.index', compact('institutionCalendars'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  InstitutionCalendarCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(InstitutionCalendarCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $institutionCalendar = $this->repository->create($request->all());

            $response = [
                'message' => 'InstitutionCalendar created.',
                'data'    => $institutionCalendar->toArray(),
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
        $institutionCalendar = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $institutionCalendar,
            ]);
        }

        return view('institutionCalendars.show', compact('institutionCalendar'));
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
        $institutionCalendar = $this->repository->find($id);

        return view('institutionCalendars.edit', compact('institutionCalendar'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  InstitutionCalendarUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(InstitutionCalendarUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $institutionCalendar = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'InstitutionCalendar updated.',
                'data'    => $institutionCalendar->toArray(),
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
                'message' => 'InstitutionCalendar deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'InstitutionCalendar deleted.');
    }
}
