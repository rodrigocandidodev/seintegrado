<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;

use App\Http\Requests\TeacherCreateRequest;
use App\Http\Requests\TeacherUpdateRequest;

use App\Repositories\TeacherRepository;
use App\Repositories\CollaboratorRepository;
use App\Repositories\InstitutionRepository;
use App\Repositories\InstitutionClassRepository;
use App\Repositories\SchoolYearRepository;
use App\Repositories\GroupRepository;
use App\Repositories\DailyPlanRepository;

use App\Validators\TeacherValidator;

use App\Services\TeacherService;

class TeachersController extends Controller
{

    protected $repository;
    protected $collaborator_repository;
    protected $institution_repository;
    protected $school_year_repository;
    protected $group_repository;
    protected $institution_class_repository;
    protected $daily_plan_repository;

    protected $validator;

    protected $teacher_service;

    /**
     * TeachersController constructor.
     *
     * @param TeacherRepository $repository
     * @param TeacherValidator $validator
     */
    public function __construct(
        TeacherRepository           $repository,
        CollaboratorRepository      $collaborator_repository, 
        InstitutionRepository       $institution_repository,
        SchoolYearRepository        $school_year_repository,
        GroupRepository             $group_repository,
        InstitutionClassRepository  $institution_class_repository,
        DailyPlanRepository         $daily_plan_repository,

        TeacherValidator            $validator,

        TeacherService              $teacher_service
        )
    {
        $this->repository                   = $repository;
        $this->collaborator_repository      = $collaborator_repository;
        $this->institution_repository       = $institution_repository;
        $this->school_year_repository       = $school_year_repository;
        $this->group_repository             = $group_repository;
        $this->institution_class_repository = $institution_class_repository;
        $this->daily_plan_repository        = $daily_plan_repository;


        $this->validator                    = $validator;

        $this->teacher_service              = $teacher_service;

        $this->middleware('auth:teacher');
    }
    
    /**
     * Starting up Methods
     *
     */

    public function initialization()
    {
        $collaborator_id = Auth::user()->collaborator_id;

        $online_collaborator_data       = $this->collaborator_repository->findWhere([
            'id'=> $collaborator_id
        ])->first();

        $online_collaborator_institution_id = $online_collaborator_data->institution_id;
        

        $online_institution_data  = $this->institution_repository->findWhere([
            'id'    => $online_collaborator_institution_id
        ])->first();

        $school_years = $this->school_year_repository->findWhere([
            'institution_id'     => $online_collaborator_institution_id,
            'school_year_status' => 'active'
        ])->first();

        $current_school_year = $school_years->year;

        $school_year_id = $this->school_year_repository->findWhere([
            'institution_id'    => $online_collaborator_institution_id,
            'year'              => $school_years->year
        ])->first();
        return redirect()->route('teacher.show.dashboard',['year' => $current_school_year]);
    }

    /**
     * Showing Methods
     *
     */
    
    public function ShowDashboard($year)
    {
        $guard = 'teachers';
        $page_title = 'Home';
        $collaborator_id = Auth::user()->collaborator_id;
        $current_school_year = $year;

        $online_collaborator_data = $this->collaborator_repository->findWhere([
            'id'=> $collaborator_id
        ])->first();

        $online_collaborator_institution_id = $online_collaborator_data->institution_id;

        $online_institution_data  = $this->institution_repository->findWhere([
            'id'    => $online_collaborator_institution_id
        ])->first();

        $all_school_years = $this->school_year_repository->findWhere([
            'institution_id'       => $online_collaborator_institution_id
        ])->all();

        $school_year_id = $this->school_year_repository->findWhere([
            'institution_id'    => $online_collaborator_institution_id,
            'year'              => $year
        ])->first();
        $admin_type_data = 'Teacher';

        //find the bncc curricular components
        $bncc_components = DB::table('bncc_curricular_components')
            ->select('id','bncc_curricular_component')
            ->get();
        //iterator counter for loop
        $bncc_components_counter = count($bncc_components);
        //amount of components for restore the iterator counter
        $amount_components = $bncc_components_counter;

        //find the application fields of each bncc curricular component
        $application_field_thematic_units = array();
        foreach ($bncc_components as $item) {
            $data = DB::table('application_field_thematic_units')
                ->where('bncc_curricular_component_id',$item->id)
                ->select('bncc_curricular_component_id','application_field_thematic_unit','id')
                ->get();
            foreach ($data as $d) {
                if ($d) {
                    array_push($application_field_thematic_units,[
                        'bncc_curricular_component_id'  => $item->id,
                        'bncc_curricular_component'     => $item->bncc_curricular_component,
                        'aftu'                          => $d->application_field_thematic_unit,
                        'aftu_id'                       => $d->id
                    ]);
                }
            }
        }

        //find the practical languages of each bncc curricular component
        $practical_language_thematic_axes = array();
        foreach ($bncc_components as $item) {
            $data = DB::table('practical_language_thematic_axes')
                ->where('bncc_curricular_component_id',$item->id)
                ->select('bncc_curricular_component_id','practical_language_thematic_axis','id')
                ->get();
            foreach ($data as $d) {
                if ($d) {
                    array_push($practical_language_thematic_axes,[
                        'bncc_curricular_component_id'  => $item->id,
                        'bncc_curricular_component'     => $item->bncc_curricular_component,
                        'plta'                          => $d->practical_language_thematic_axis,
                        'plta_id'                       => $d->id
                    ]);
                }
            }
        }
        //dd($application_field_thematic_units);
        $divisions = DB::table('institution_school_year_divisions')
            ->where('institution_id','=',$online_collaborator_institution_id)
            ->get();

        return view('teachers.home',[
            'guard'                              => $guard, 
            'title'                              => $page_title,
            'current_school_year'                => $current_school_year,
            'all_school_years'                   => $all_school_years,
            'online_collaborator_name'           => $online_collaborator_data->name,
            'online_collaborator_institution_id' => $online_collaborator_institution_id,
            'online_institution_name'            => $online_institution_data->name,
            'online_collaborator_id'             => $collaborator_id,
            'admin_type_data'                    => $admin_type_data,
            'application_field_thematic_units'   => $application_field_thematic_units,
            'bncc_components_counter'            => $bncc_components_counter,
            'amount_components'                  => $amount_components,
            'practical_language_thematic_axes'   => $practical_language_thematic_axes,
            'divisions'                          => $divisions
        ]);
    }

    public function ShowCollaboratorData($year,$id)
    {
        //dd($id);
        $guard      = 'teachers';
        $page_title = 'Dados';

        $collaborator_id = Auth::user()->collaborator_id;

        $online_collaborator_data = $this->collaborator_repository->findWhere([
            'id'=> $collaborator_id
        ])->first();

        //Ao inves de fazer uma busca com joins de todas as tabelas, fazer buscas separadas de cada tabela, para não ter o problema de não ter resultados caso o collaborator não ter completado todos os dados no cadastro

        $collaborator_data = DB::table('collaborators')
            ->join('collaborator_contacts', 'collaborators.id', '=', 'collaborator_contacts.collaborator_id')
            ->join('collaborator_addresses', 'collaborators.id', '=', 'collaborator_addresses.collaborator_id')
            ->join('collaborator_jobs', 'collaborators.id', '=', 'collaborator_jobs.collaborator_id')
            ->join('jobs', 'jobs.id', '=', 'collaborator_jobs.job_id')
            ->join('collaborator_scholarities', 'collaborators.id', '=', 'collaborator_scholarities.collaborator_id')
            ->join('scholarities', 'scholarities.id', '=', 'collaborator_scholarities.scholarity_id')
            ->where('collaborators.id', $id)
            ->select(
                'collaborators.name','collaborators.cpf', 'collaborators.date_birth', 'collaborators.place_birth', 'collaborators.rg', 'collaborators.rg_emissor',
                'collaborator_contacts.phone1','collaborator_contacts.phone2',
                'collaborator_addresses.street', 'collaborator_addresses.block', 'collaborator_addresses.land_lot', 'collaborator_addresses.number', 'collaborator_addresses.neighborhood', 'collaborator_addresses.zipcode', 'collaborator_addresses.complement',
                'jobs.office',
                'scholarities.scholarity'
            )->first();

        $online_collaborator_institution_id = $online_collaborator_data->institution_id;

        $school_years = $this->school_year_repository->findWhere([
            'institution_id'     => $online_collaborator_institution_id,
            'school_year_status' => 'active'
        ])->first();

        $all_school_years = $this->school_year_repository->findWhere([
            'institution_id'  => $online_collaborator_institution_id
        ])->all();

        $online_institution_data  = $this->institution_repository->findWhere([
            'id'    => $online_collaborator_institution_id
        ])->first();
        $admin_type_data = 'Teacher';

        return view('admins.show-collaborator-data',[
            'guard'                              => $guard, 
            'title'                              => $page_title,
            'online_collaborator_name'           => $online_collaborator_data->name,
            'online_collaborator_institution_id' => $online_collaborator_institution_id,
            'online_institution_name'            => $online_institution_data->name,
            'current_school_year'                => $school_years->year,
            'all_school_years'                   => $all_school_years,
            'online_collaborator_id'             => $collaborator_id,
            'collaborator_data'                  => $collaborator_data,
            'admin_type_data'                    => $admin_type_data
        ]);
    }
    public function ShowPlanGroup($year,$group_id)
    {
        //Show the group's plans
        $page_title = 'Planejamentos diários';
        $guard = 'teachers';

        $collaborator_id = Auth::user()->collaborator_id;
        
        $current_school_year = $year;

        $online_collaborator_data = $this->collaborator_repository->findWhere([
            'id'=> $collaborator_id
        ])->first();

        $online_collaborator_institution_id = $online_collaborator_data->institution_id;

        $online_institution_data  = $this->institution_repository->findWhere([
            'id'    => $online_collaborator_institution_id
        ])->first();

        $school_years = $this->school_year_repository->findWhere([
            'institution_id'     => $online_collaborator_institution_id,
            'school_year_status' => 'active'
        ])->first();

        $all_school_years = $this->school_year_repository->findWhere([
            'institution_id' => $online_collaborator_institution_id
        ])->all();

        $school_year_id = $this->school_year_repository->findWhere([
            'institution_id'    => $online_collaborator_institution_id,
            'year'              => $year
        ])->first();

        $school_year_division_data = DB::table('institution_school_year_divisions')
            ->where('institution_id','=',$online_collaborator_institution_id)
            ->select('id','division')
            ->get();
        $admin_type_data = 'Teacher';

        //find institution classes
        $institution_classes = $this->institution_class_repository->findWhere([
            'institution_id' => $online_collaborator_institution_id,
            'school_year_id' => $school_year_id->id
        ])->all();

        //find the teacher's id
        $online_teacher_id = Auth::user()->id;

        //find the group info
        $group_data = $this->group_repository->findWhere([
            'institution_id' => $online_collaborator_institution_id,
            'school_year_id' => $school_year_id->id,
            'id'             => $group_id
        ])->first();

        //find the daily plans
        $daily_plans = DB::table('daily_plans')
            ->join('institution_classes','daily_plans.class_plan','=','institution_classes.id')
            ->join('institution_school_year_divisions','daily_plans.school_year_division_id','=','institution_school_year_divisions.id')
            ->where('daily_plans.institution_id', $online_collaborator_institution_id)
            ->where('daily_plans.school_year_id', $school_year_id->id)
            ->where('daily_plans.group_id',$group_id)
            ->where('daily_plans.teacher_id',$online_teacher_id)
            ->select('institution_classes.institution_class','daily_plans.plan_date','institution_school_year_divisions.division','daily_plans.scholarity_id','daily_plans.id')
            ->get();
            //dd($daily_plans);
        $daily_plans_counter = 1;

        //find all institution curricular components
        $curricular_components = DB::table('curricular_components')
            ->where('institution_id',$online_collaborator_institution_id)
            ->select('id','component')
            ->get();

        //find the bncc curricular components
        $bncc_components = DB::table('bncc_curricular_components')
            ->select('id','bncc_curricular_component')
            ->get();
        //iterator counter for loop
        $bncc_components_counter = count($bncc_components);
        //amount of components for restore the iterator counter
        $amount_components = $bncc_components_counter;

        //find the application fields of each bncc curricular component
        $application_field_thematic_units = array();
        foreach ($bncc_components as $item) {
            $data = DB::table('application_field_thematic_units')
                ->where('bncc_curricular_component_id',$item->id)
                ->select('bncc_curricular_component_id','application_field_thematic_unit','id')
                ->get();
            foreach ($data as $d) {
                if ($d) {
                    array_push($application_field_thematic_units,[
                        'bncc_curricular_component_id'  => $item->id,
                        'bncc_curricular_component'     => $item->bncc_curricular_component,
                        'aftu'                          => $d->application_field_thematic_unit,
                        'aftu_id'                       => $d->id
                    ]);
                }
            }
        }

        //find the practical languages of each bncc curricular component
        $practical_language_thematic_axes = array();
        foreach ($bncc_components as $item) {
            $data = DB::table('practical_language_thematic_axes')
                ->where('bncc_curricular_component_id',$item->id)
                ->select('bncc_curricular_component_id','practical_language_thematic_axis','id')
                ->get();
            foreach ($data as $d) {
                if ($d) {
                    array_push($practical_language_thematic_axes,[
                        'bncc_curricular_component_id'  => $item->id,
                        'bncc_curricular_component'     => $item->bncc_curricular_component,
                        'plta'                          => $d->practical_language_thematic_axis,
                        'plta_id'                       => $d->id
                    ]);
                }
            }
        }

        return view('teachers.daily_plans',[
            'current_school_year'                => $current_school_year,
            'guard'                              => $guard,
            'title'                              => $page_title,
            'online_collaborator_institution_id' => $online_collaborator_institution_id,
            'online_institution_name'            => $online_institution_data->name,
            'all_school_years'                   => $all_school_years,
            'online_collaborator_id'             => $collaborator_id,
            'admin_type_data'                    => $admin_type_data,
            'online_collaborator_name'           => $online_collaborator_data->name,
            'school_year_id'                     => $school_year_id->id,
            'collaborator_id'                    => $collaborator_id,
            'school_year_divisions'              => $school_year_division_data,
            'institution_classes'                => $institution_classes,
            'online_teacher_id'                  => $online_teacher_id,
            'group_info'                         => $group_data,
            'daily_plans'                        => $daily_plans,
            'daily_plans_counter'                => $daily_plans_counter,
            'curricular_components'              => $curricular_components,
            'application_field_thematic_units'   => $application_field_thematic_units,
            'bncc_components_counter'            => $bncc_components_counter,
            'amount_components'                  => $amount_components,
            'practical_language_thematic_axes'   => $practical_language_thematic_axes
        ]);
    }

    public function PlansHome($year)
    {
        $page_title = 'Grupos';
        $guard = 'teachers';

        $collaborator_id = Auth::user()->collaborator_id;
        $current_school_year = $year;

        $online_collaborator_data = $this->collaborator_repository->findWhere([
            'id'=> $collaborator_id
        ])->first();

        $online_collaborator_institution_id = $online_collaborator_data->institution_id;

        $online_institution_data  = $this->institution_repository->findWhere([
            'id'    => $online_collaborator_institution_id
        ])->first();

        $school_years = $this->school_year_repository->findWhere([
            'institution_id'     => $online_collaborator_institution_id,
            'school_year_status' => 'active'
        ])->first();

        $all_school_years = $this->school_year_repository->findWhere([
            'institution_id' => $online_collaborator_institution_id
        ])->all();

        $school_year_id = $this->school_year_repository->findWhere([
            'institution_id'    => $online_collaborator_institution_id,
            'year'              => $year
        ])->first();

        //find the group data
        $all_groups_data = $this->group_repository->findWhere([
            'institution_id'    => $online_collaborator_institution_id,
            'school_year_id'    => $school_year_id->id
        ])->all();
        $all_groups_counter_br = 0;

        $admin_type_data = 'Teacher';

        return view('teachers.plan-groups',[
            'current_school_year'                => $current_school_year,
            'guard'                              => $guard,
            'title'                              => $page_title,
            'online_collaborator_institution_id' => $online_collaborator_institution_id,
            'online_institution_name'            => $online_institution_data->name,
            'all_school_years'                   => $all_school_years,
            'online_collaborator_id'             => $collaborator_id,
            'admin_type_data'                    => $admin_type_data,
            'online_collaborator_name'           => $online_collaborator_data->name,
            'school_year_id'                     => $school_year_id->id,
            'collaborator_id'                    => $collaborator_id,
            'all_plan_groups_data'               => $all_groups_data,
            'all_groups_counter_br'              => $all_groups_counter_br
        ]);
    }
    public function Exams($year,$division_id)
    {
        $page_title = 'Avaliações';
        $guard = 'teachers';
        $admin_type_data = 'Teacher';

        $collaborator_id = Auth::user()->collaborator_id;
        $current_school_year = $year;

        $online_collaborator_data = $this->collaborator_repository->findWhere([
            'id'=> $collaborator_id
        ])->first();

        $online_collaborator_institution_id = $online_collaborator_data->institution_id;

        $online_institution_data  = $this->institution_repository->findWhere([
            'id'    => $online_collaborator_institution_id
        ])->first();

        $school_year_id = $this->school_year_repository->findWhere([
            'institution_id'    => $online_collaborator_institution_id,
            'year'              => $year
        ])->first();

        $school_years = $this->school_year_repository->findWhere([
            'institution_id'     => $online_collaborator_institution_id,
            'school_year_status' => 'active'
        ])->first();

        $all_school_years = $this->school_year_repository->findWhere([
            'institution_id' => $online_collaborator_institution_id
        ])->all();

        $teacher_data = DB::table('teachers')
            ->join('collaborators','teachers.collaborator_id','=','collaborators.id')
            ->where('collaborators.institution_id','=',$online_collaborator_institution_id)
            ->where('collaborators.id','=',$online_collaborator_data->id)
            ->select('teachers.name','teachers.id')
            ->first();

        $exams = DB::table('exams')
            ->join('curricular_components','curricular_components.id','=','exams.curricular_component_id')
            ->join('teachers','teachers.id','=','exams.teacher_id')
            ->join('institution_school_year_divisions','institution_school_year_divisions.id','=','exams.division_id')
            ->join('institution_classes','institution_classes.id','=','exams.institution_class_id')
            ->where('exams.institution_id',$online_collaborator_institution_id)
            ->where('exams.school_year_id',$school_year_id->id)
            ->where('teachers.id','=',$teacher_data->id)
            ->where('exams.division_id','=',$division_id)
            ->select('exams.id','exams.exam','exams.exam_date','exams.value','exams.institution_class_id','exams.division_id','exams.curricular_component_id','teachers.name','curricular_components.component','institution_school_year_divisions.division','institution_classes.institution_class')
            ->orderBy('exam_date','ASC')
            ->orderBy('institution_classes.grade_id','ASC')
            ->get();
        $division = DB::table('institution_school_year_divisions')
            ->where('id','=',$division_id)
            ->first();
            //dd($exams,$teacher_data);
        return view('teachers.exams',[
            'current_school_year'                => $current_school_year,
            'guard'                              => $guard,
            'title'                              => $page_title,
            'online_collaborator_institution_id' => $online_collaborator_institution_id,
            'online_institution_name'            => $online_institution_data->name,
            'all_school_years'                   => $all_school_years,
            'online_collaborator_id'             => $collaborator_id,
            'admin_type_data'                    => $admin_type_data,
            'online_collaborator_name'           => $online_collaborator_data->name,
            'school_year_id'                     => $school_year_id->id,
            'collaborator_id'                    => $collaborator_id,
            'teacher_data'                       => $teacher_data,
            'exams'                              => $exams,
            'current_division'                   => $division->division
        ]);
    }
    public function ExamResults($year,$exam_id)
    {
        $page_title = 'Resultado';
        $guard = 'teachers';
        $admin_type_data = 'Teacher';

        $collaborator_id = Auth::user()->collaborator_id;
        $current_school_year = $year;

        $online_collaborator_data = $this->collaborator_repository->findWhere([
            'id'=> $collaborator_id
        ])->first();

        $online_collaborator_institution_id = $online_collaborator_data->institution_id;

        $online_institution_data  = $this->institution_repository->findWhere([
            'id'    => $online_collaborator_institution_id
        ])->first();

        $school_year_id = $this->school_year_repository->findWhere([
            'institution_id'    => $online_collaborator_institution_id,
            'year'              => $year
        ])->first();

        $school_years = $this->school_year_repository->findWhere([
            'institution_id'     => $online_collaborator_institution_id,
            'school_year_status' => 'active'
        ])->first();

        $all_school_years = $this->school_year_repository->findWhere([
            'institution_id' => $online_collaborator_institution_id
        ])->all();

        $exam = DB::table('exams')
            ->join('curricular_components','curricular_components.id','=','exams.curricular_component_id')
            ->join('teachers','teachers.id','=','exams.teacher_id')
            ->join('institution_school_year_divisions','institution_school_year_divisions.id','=','exams.division_id')
            ->join('institution_classes','institution_classes.id','=','exams.institution_class_id')
            ->where('exams.id','=',$exam_id)
            ->select('exams.id','exams.exam','exams.exam_date','exams.value','exams.institution_class_id','exams.division_id','exams.curricular_component_id','teachers.name','curricular_components.component','institution_school_year_divisions.division','institution_classes.institution_class')
            ->first();

        $students = DB::table('student_enrollments')
                ->join('students','student_enrollments.student_id','=','students.id')
                ->join('institution_classes','student_enrollments.institution_class_id','=','institution_classes.id')
                ->where('student_enrollments.enrollment_year',$current_school_year)
                ->where('student_enrollments.enrollment_status_id',1)
                ->where('student_enrollments.institution_class_id',$exam->institution_class_id)
                ->select('students.id','students.name')
                ->orderBy('students.name','ASC')
                ->get();
        $results = [];
        foreach ($students as $data) {
            $exam_result = DB::table('student_exam_results')
                ->where('exam_id','=',$exam_id)
                ->where('student_id','=',$data->id)
                ->select('id','result')
                ->first();

            if(is_null($exam_result)){
                array_push($results, [
                    'id'        => $data->id,
                    'name'      => $data->name,
                    'result_id' => null,
                    'result'    => null
                ]);
            }else{
                array_push($results, [
                    'id'        => $data->id,
                    'name'      => $data->name,
                    'result_id' => $exam_result->id,
                    'result'    => $exam_result->result
                ]);
            }
        }

        return view('teachers.exam-results',[
            'current_school_year'                => $current_school_year,
            'guard'                              => $guard,
            'title'                              => $page_title,
            'online_collaborator_institution_id' => $online_collaborator_institution_id,
            'online_institution_name'            => $online_institution_data->name,
            'all_school_years'                   => $all_school_years,
            'online_collaborator_id'             => $collaborator_id,
            'admin_type_data'                    => $admin_type_data,
            'online_collaborator_name'           => $online_collaborator_data->name,
            'school_year_id'                     => $school_year_id->id,
            'collaborator_id'                    => $collaborator_id,
            'exam'                               => $exam,
            'exam_results'                       => $results,
            'students'                           => $students,
            'division_id'                        => $exam->division_id,
            'division'                           => $exam->division
        ]);
        
    }

    /**
     * Storing Methods
     *
     */

    public function StoreDailyPlan($year, Request $request)
    {
        //find the scholarity_id
        $scholarity = DB::table('institution_classes')
            ->join('grades','institution_classes.grade_id','=','grades.id')
            ->join('scholarities','grades.scholarity_id','=','scholarities.id')
            ->where('institution_classes.id','=',$request['class_plan'])
            ->where('institution_classes.school_year_id','=',$request['school_year_id'])
            ->select('grades.scholarity_id','institution_classes.school_year_id')
            ->first();
            
        $data = [
            'plan_date'                 => $request['plan_date'],
            'class_plan'                => $request['class_plan'],
            'teacher_id'                => $request['teacher_id'],
            'delivery_date'             => $request['delivery_date'],
            'plan_created_at'           => $request['plan_created_at'],
            'group_id'                  => $request['group_id'],
            'institution_id'            => $request['institution_id'],
            'school_year_division_id'   => $request['school_year_division_id'],
            'school_year_id'            => $request['school_year_id'],
            'scholarity_id'             => $scholarity->scholarity_id
        ];

        $request = $this->teacher_service->storeDailyPlan($data);

        session()->flash('success', [
            'success'      => $request['success'],
            'messages'     => $request['messages']
            
        ]);
        $current_school_year = $year;
        return redirect()->route('teacher.plans.home',$current_school_year);
    }
    public function StoreExamResults($year, $exam_id, $student_id, Request $request)
    {
        $collaborator_id = Auth::user()->collaborator_id;

        $current_school_year = $year;

        $online_collaborator_data = $this->collaborator_repository->findWhere([
            'id'=> $collaborator_id
        ])->first();

        $online_collaborator_institution_id = $online_collaborator_data->institution_id;

        $online_institution_data  = $this->institution_repository->findWhere([
            'id'    => $online_collaborator_institution_id
        ])->first();

        $school_year_id = $this->school_year_repository->findWhere([
            'institution_id'    => $online_collaborator_institution_id,
            'year'              => $year
        ])->first();

        $data = [
            'result'            => $request['result'],
            'student_id'        => $student_id,
            'exam_id'           => $exam_id,
            'school_year_id'    => $school_year_id->id,
            'stored_by'         => Auth::user()->id
        ];

        $request = $this->teacher_service->storeExamResult($data);

        session()->flash('message',  $request['messages']);
        return redirect()->route('teacher.exams.results',[
            'year'      => $current_school_year,
            'exam_id'   => $exam_id
        ]);
    }
    public function UpdateExamResult($year, $exam_id, $result_id, Request $request)
    {
        $current_school_year = $year;
        if(is_null($request['result'])){
            session()->flash('message','O campo Resultado está vazio!');
            return redirect()->route('teacher.exams.results',[
                'year'      => $current_school_year,
                'exam_id'   => $exam_id
            ]);
        }else{
            $updated = $this->teacher_service->updateExamResult($request->all(),$result_id);
            session()->flash('message',  $updated['messages']);
            return redirect()->route('teacher.exams.results',[
                'year'      => $current_school_year,
                'exam_id'   => $exam_id
            ]);
        }
    }
    

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $teachers = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $teachers,
            ]);
        }

        return view('teachers.index', compact('teachers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  TeacherCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(TeacherCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $teacher = $this->repository->create($request->all());

            $response = [
                'message' => 'Teacher created.',
                'data'    => $teacher->toArray(),
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
        $teacher = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $teacher,
            ]);
        }

        return view('teachers.show', compact('teacher'));
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
        $teacher = $this->repository->find($id);

        return view('teachers.edit', compact('teacher'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  TeacherUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(TeacherUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $teacher = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Teacher updated.',
                'data'    => $teacher->toArray(),
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
                'message' => 'Teacher deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Teacher deleted.');
    }
}
