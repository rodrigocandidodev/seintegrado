<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade as PDF;
use App\Http\Requests;
use Illuminate\Support\Facades\Storage;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\AdminCreateRequest;
use App\Http\Requests\AdminUpdateRequest;
use App\Http\Requests\CollaboratorCreateRequest;
use App\Http\Requests\CollaboratorUpdateRequest;
use App\Http\Requests\CollaboratorAddressCreateRequest;
use App\Http\Requests\CollaboratorAddressUpdateRequest;
use App\Http\Requests\CollaboratorScholarityCreateRequest;
use App\Http\Requests\CollaboratorScholarityUpdateRequest;
use App\Http\Requests\CollaboratorContactsCreateRequest;
use App\Http\Requests\CollaboratorContactsUpdateRequest;
use App\Http\Requests\CollaboratorJobCreateRequest;
use App\Http\Requests\CollaboratorJobUpdateRequest;
use App\Http\Requests\InstitutionClassCreateRequest;
use App\Http\Requests\InstitutionClassUpdateRequest;
use App\Http\Requests\StudentEnrollmentCreateRequest;
use App\Http\Requests\StudentEnrollmentUpdateRequest;
use App\Http\Requests\StudentCnCreateRequest;
use App\Http\Requests\StudentCnUpdateRequest;
use App\Http\Requests\StudentAddressCreateRequest;
use App\Http\Requests\StudentAddressUpdateRequest;
use App\Http\Requests\StudentContactsCreateRequest;
use App\Http\Requests\StudentContactsUpdateRequest;
use App\Http\Requests\EnrollmentApplicantCreateRequest;
use App\Http\Requests\EnrollmentApplicantUpdateRequest;
use App\Http\Requests\StudentCreateRequest;
use App\Http\Requests\StudentUpdateRequest;
use App\Http\Requests\InstitutionUpdateRequest;
use App\Http\Requests\SchoolYearCreateRequest;
use App\Http\Requests\SchoolYearUpdateRequest;
use App\Http\Requests\ScholarityCreateRequest;
use App\Http\Requests\ScholarityUpdateRequest;
use App\Http\Requests\DepartmentCreateRequest;
use App\Http\Requests\DepartmentUpdateRequest;
use App\Http\Requests\JobCreateRequest;
use App\Http\Requests\JobUpdateRequest;
use App\Http\Requests\TeacherCreateRequest;
use App\Http\Requests\TeacherUpdateRequest;
use App\Http\Requests\KnowledgeAreaCreateRequest;
use App\Http\Requests\KnowledgeAreaUpdateRequest;
use App\Http\Requests\CurricularComponentCreateRequest;
use App\Http\Requests\CurricularComponentUpdateRequest;

use App\Repositories\AdminRepository;
use App\Repositories\AdminTypeRepository;
use App\Repositories\AdminTypeChoiceRepository;
use App\Repositories\CollaboratorRepository;
use App\Repositories\CollaboratorAddressRepository;
use App\Repositories\CollaboratorScholarityRepository;
use App\Repositories\CollaboratorContactsRepository;
use App\Repositories\CollaboratorJobRepository;
use App\Repositories\InstitutionClassRepository;
use App\Repositories\StudentEnrollmentRepository;
use App\Repositories\StudentCnRepository;
use App\Repositories\StudentAddressRepository;
use App\Repositories\StudentContactsRepository;
use App\Repositories\StudentRepository;
use App\Repositories\InstitutionRepository;
use App\Repositories\ScholarityRepository;
use App\Repositories\JobRepository;
use App\Repositories\SchoolYearRepository;
use App\Repositories\GenderRepository;
use App\Repositories\ColorRepository;
use App\Repositories\GradeRepository;
use App\Repositories\DepartmentRepository;
use App\Repositories\TeacherRepository;
use App\Repositories\KnowledgeAreaRepository;
use App\Repositories\CurricularComponentRepository;
use App\Repositories\GroupRepository;
use App\Repositories\StudentSchoolAttendanceRepository;
use App\Repositories\InstitutionClassScheduleRepository;

use App\Validators\AdminValidator;

use App\Services\StudentService;
use App\Services\CollaboratorService;
use App\Services\InstitutionService;
use App\Services\TeacherService;

use Auth;

/**
 * Class AdminsController.
 *
 * @package namespace App\Http\Controllers;
 */
class AdminsController extends Controller
{

    protected $repository;
    protected $admin_type_repository;
    protected $admin_type_choice_repository;
    protected $collaborator_repository;
    protected $collaborator_address_repository;
    protected $collaborator_scholarity_repository;
    protected $collaborator_contacts_repository;
    protected $collaborator_job_repository;
    protected $institution_class_repository;
    protected $student_enrollment_repository;
    protected $student_cn_repository;
    protected $student_address_repository;
    protected $student_contacts_repository;
    protected $student_repository;
    protected $institution_repository;
    protected $scholarity_repository;
    protected $job_repository;
    protected $school_year_repository;
    protected $color_repository;
    protected $gender_repository;
    protected $grade_repository;
    protected $department_repository;
    protected $teacher_repository;
    protected $knowledge_area_repository;
    protected $curricular_component_repository;
    protected $group_repository;
    protected $student_school_attendance_repository;
    protected $institution_class_schedule_repository;
    
    protected $validator;

    protected $student_service;
    protected $collaborator_service;
    protected $institution_service;
    protected $teacher_service;

    public function __construct(
        AdminRepository                     $repository,
        AdminTypeRepository                 $admin_type_repository,
        AdminTypeChoiceRepository           $admin_type_choice_repository,
        CollaboratorRepository              $collaborator_repository, 
        CollaboratorAddressRepository       $collaborator_address_repository,
        CollaboratorScholarityRepository    $collaborator_scholarity_repository,
        CollaboratorContactsRepository      $collaborator_contacts_repository,
        CollaboratorJobRepository           $collaborator_job_repository,
        InstitutionClassRepository          $institution_class_repository,
        StudentEnrollmentRepository         $student_enrollment_repository,
        StudentCnRepository                 $student_cn_repository,
        StudentAddressRepository            $student_address_repository,
        StudentContactsRepository           $student_contacts_repository,
        StudentRepository                   $student_repository,
        InstitutionRepository               $institution_repository,
        ScholarityRepository                $scholarity_repository,
        GenderRepository                    $gender_repository, 
        ColorRepository                     $color_repository,
        JobRepository                       $job_repository,
        SchoolYearRepository                $school_year_repository,
        GradeRepository                     $grade_repository,
        DepartmentRepository                $department_repository,
        TeacherRepository                   $teacher_repository,
        KnowledgeAreaRepository             $knowledge_area_repository,
        CurricularComponentRepository       $curricular_component_repository,
        GroupRepository                     $group_repository,
        StudentSchoolAttendanceRepository   $student_school_attendance_repository,
        InstitutionClassScheduleRepository  $institution_class_schedule_repository,

        AdminValidator                      $validator,

        StudentService                      $student_service,
        CollaboratorService                 $collaborator_service,
        InstitutionService                  $institution_service,
        TeacherService                      $teacher_service

    )
    {
        $this->repository                               = $repository;
        $this->admin_type_repository                    = $admin_type_repository;
        $this->admin_type_choice_repository             = $admin_type_choice_repository;
        $this->collaborator_repository                  = $collaborator_repository;
        $this->collaborator_address_repository          = $collaborator_address_repository;
        $this->collaborator_scholarity_repository       = $collaborator_scholarity_repository;
        $this->collaborator_contacts_repository         = $collaborator_contacts_repository;
        $this->collaborator_job_repository              = $collaborator_job_repository;
        $this->institution_class_repository             = $institution_class_repository;
        $this->student_enrollment_repository            = $student_enrollment_repository;
        $this->student_cn_repository                    = $student_cn_repository;
        $this->student_address_repository               = $student_address_repository;
        $this->student_contacts_repository              = $student_contacts_repository;
        $this->student_repository                       = $student_repository;
        $this->institution_repository                   = $institution_repository;
        $this->scholarity_repository                    = $scholarity_repository;
        $this->color_repository                         = $color_repository;
        $this->gender_repository                        = $gender_repository;
        $this->job_repository                           = $job_repository;
        $this->school_year_repository                   = $school_year_repository;
        $this->grade_repository                         = $grade_repository;
        $this->department_repository                    = $department_repository;
        $this->teacher_repository                       = $teacher_repository;
        $this->knowledge_area_repository                = $knowledge_area_repository;
        $this->curricular_component_repository          = $curricular_component_repository;
        $this->group_repository                         = $group_repository;
        $this->student_school_attendance_repository     = $student_school_attendance_repository;
        $this->institution_class_schedule_repository    = $institution_class_schedule_repository;
        
        $this->validator                                = $validator;

        $this->student_service                          = $student_service;
        $this->collaborator_service                     = $collaborator_service;
        $this->institution_service                      = $institution_service;
        $this->teacher_service                          = $teacher_service;

        $this->middleware('auth:admin');
    }

    /*
     * ===========================================================================
     * Admin Pages Methods
     * ===========================================================================
     */
    public function ShowDashboard($year)
    {
        $guard = 'admins';
        $page_title = 'Home';
        $collaborator_id = Auth::user()->collaborator_id;
        $current_school_year = $year;

        //Database searches
        $admin           = $this->repository->all();
        $genders         = $this->gender_repository->all();
        $colors          = $this->color_repository->all();
        $grades          = $this->grade_repository->all();

        $knowledge_areas = DB::table('knowledge_areas')
            ->select('id','knowledge_area')
            ->get();

        $online_collaborator_data = $this->collaborator_repository->findWhere([
            'id'=> $collaborator_id
        ])->first();

        $online_collaborator_institution_id = $online_collaborator_data->institution_id;
        $active_students           = $this->student_enrollment_repository->findWhere([
            'institution_id'       => $online_collaborator_institution_id,
            'enrollment_status_id' => '1', //list all active students
            'enrollment_year'      => $year
        ]);

        $active_collaborators = DB::table('collaborators')
            ->join('collaborator_jobs', 'collaborators.id', '=', 'collaborator_jobs.collaborator_id')
            ->where('collaborators.collaborator_status', 'Active')
            ->where('collaborators.institution_id',$online_collaborator_institution_id)
            ->where('collaborator_jobs.job_year',$year)
            ->select('collaborators.id','collaborators.name','collaborators.cpf','collaborators.rg','collaborators.rg_emissor','collaborators.date_birth','collaborators.place_birth')
            ->get();
        //dd($active_collaborators);

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

        /*$institution_classes = $this->institution_class_repository->findWhere([
            'institution_id' => $online_collaborator_institution_id,
            'school_year_id' => $school_year_id->id
        ])->all();*/

        $institution_classes = DB::table('institution_classes')
            ->where('institution_id', $online_collaborator_institution_id)
            ->where('school_year_id', $school_year_id->id)
            ->orderBy('grade_id','ASC')
            ->get();
            //dd($institution_classes);

        //list the latest student registers
        $latest_registers = DB::table('student_enrollments')
            ->join('students','student_enrollments.student_id','=','students.id')
            ->join('institution_classes','student_enrollments.institution_class_id','=','institution_classes.id')
            ->latest('student_enrollments.created_at')
            ->where('student_enrollments.enrollment_year',$current_school_year)
            ->select('students.id','students.name','students.date_birth','student_enrollments.enrollment_date','institution_classes.institution_class','student_enrollments.institution_class_id')
            ->limit(20)
            ->get();
        $latest_registers_counter = 1;

        //List all student registers
        $all_registers = DB::table('student_enrollments')
            ->join('students','student_enrollments.student_id','=','students.id')
            ->join('institution_classes','student_enrollments.institution_class_id','=','institution_classes.id')
            ->latest('student_enrollments.created_at')
            ->where('student_enrollments.enrollment_year',$current_school_year)
            ->select('students.id','students.name','student_enrollments.enrollment_date','institution_classes.institution_class','student_enrollments.institution_class_id')
            ->get();
        $all_registers_counter = 1;

        $i=0;
        $classes_amount = array();
        //find the amount of students of each class
        foreach ($institution_classes as $ic) {
            $amount = DB::table('student_enrollments')
                ->join('students','student_enrollments.student_id','=','students.id')
                ->join('institution_classes','student_enrollments.institution_class_id','=','institution_classes.id')
                ->where('student_enrollments.enrollment_year',$current_school_year)
                ->where('student_enrollments.enrollment_status_id',1)
                ->where('student_enrollments.institution_class_id',$ic->id)
                ->select('students.id','students.name','student_enrollments.enrollment_date','institution_classes.institution_class')
                ->get();
            $class_name = DB::table('institution_classes')
                ->where('id','=',$ic->id)
                ->select('institution_class')
                ->first();
            array_push($classes_amount,[
                'id'  => $ic->id,
                'institution_class'     => $class_name->institution_class,
                'amount'                => count($amount)
            ]);
        }

        //dd($classes_amount);

        //find the admin id
        $admin_data = $this->repository->findWhere([
            'collaborator_id'   => $collaborator_id,
            'email'             => Auth::user()->email
        ])->first();
        $admin_id = $admin_data->id;

        //find the admin type
        $admin_type_choice_data = $this->admin_type_choice_repository->findWhere([
            'admin_id' => $admin_id
        ])->first();

        $admin_type_data = DB::table('admin_types')
            ->where('id', $admin_type_choice_data->admin_type_id)
            ->select('admin_type')
            ->first();

        //find all curricular components stored
        $all_curricular_components = DB::table('curricular_components')
            ->where('institution_id',$online_collaborator_institution_id)
            ->where('year',$current_school_year)
            ->select('id','component')
            ->get();

        $exams = DB::table('exams')
            ->join('curricular_components','curricular_components.id','=','exams.curricular_component_id')
            ->join('teachers','teachers.id','=','exams.teacher_id')
            ->join('exam_types','exams.exam_type_id','=','exam_types.id')
            ->join('institution_school_year_divisions','institution_school_year_divisions.id','=','exams.division_id')
            ->join('institution_classes','institution_classes.id','=','exams.institution_class_id')
            ->where('exams.institution_id',$online_collaborator_institution_id)
            ->where('exams.school_year_id',$school_year_id->id)
            ->select('exams.id','exams.exam','exams.exam_date','exams.institution_class_id','exams.division_id','exams.curricular_component_id','exams.value','exam_types.exam_type','teachers.name','curricular_components.component','institution_school_year_divisions.division','institution_classes.institution_class')
            ->orderBy('exam_date','ASC')
            ->get();

        $institution_classes_a  = $this->institution_class_repository->findWhere([
            'institution_id' => $online_collaborator_institution_id,
            'school_year_id' => $school_year_id->id
        ])->all();

        // get distinct institution grades

        $institution_grades = array();
        $all_institution_grades = array(
            'grade_id' => array(),
            'grade' => array()
        );
        $counting = 0;

        $institution_classes_length = count($institution_classes_a);

        for($i=0;$i <$institution_classes_length;$i++){
            if(!($i == $institution_classes_length-1)){
                if (!($institution_classes_a[$i]['grade_id'] == $institution_classes_a[$i+1]['grade_id'])) {
                    array_push($institution_grades, $institution_classes_a[$i]['grade_id']);
                    $counting = $counting+1;
                }
            }else{    
                array_push($institution_grades, $institution_classes_a[$i]['grade_id']);
                $counting = $counting+1;
            }
        }
        
        foreach ($institution_grades as $g) {
            $institution_grades_data = $this->grade_repository->findWhere([
                'id' => $g
            ])->first();
            array_push($all_institution_grades['grade_id'], $g); 
            array_push($all_institution_grades['grade'], $institution_grades_data->grade); 
        }


        $previsions = DB::table('prevision_setups')
            ->join('curricular_components','curricular_components.id','=','prevision_setups.curricular_component_id')
            ->join('grades','grades.id','=','prevision_setups.grade_id')
            ->where('prevision_setups.institution_id','=',$online_collaborator_institution_id)
            ->select('prevision_setups.id','prevision_setups.curricular_component_id','curricular_components.component','prevision_setups.total_hours','grades.grade')
            ->orderBy('grades.grade','ASC')
            ->orderBy('curricular_components.component','ASC')
            ->get();

        $schedules_by_class = DB::table('institution_class_schedules')
            ->distinct()
            ->get('institution_class_id');

        $schedule = [];
        foreach ($schedules_by_class as $data) {
            $schedule[$data->institution_class_id] = DB::table('institution_class_schedules')
                ->join('institution_classes','institution_classes.id','=','institution_class_schedules.institution_class_id')
                ->join('curricular_components','curricular_components.id','=','institution_class_schedules.curricular_component_id')
                ->select('institution_class_schedules.hour','institution_class_schedules.institution_class_id','institution_class_schedules.week_day','institution_class_schedules.sequence','institution_classes.institution_class','curricular_components.component')
                ->where('institution_class_schedules.institution_class_id','=',$data->institution_class_id)
                ->orderBy('institution_class_schedules.week_day','ASC')
                ->orderBy('institution_class_schedules.sequence','ASC')
                ->orderBy('institution_class_schedules.hour','ASC')
                ->get();
        }
        //dd($schedule);
        $divisions = DB::table('institution_school_year_divisions')
            ->where('institution_id','=',$online_collaborator_institution_id)
            ->get();
        $exam_types = DB::table('exam_types')
            ->where('institution_id','=',$online_collaborator_institution_id)
            ->get();

        //verify and redirect
        if($admin_type_choice_data->admin_type_id == 1){
            //redirect to secretary home
            return view('admins.home',[
                'guard'                              => $guard,  
                'title'                              => $page_title,
                'online_collaborator_name'           => $online_collaborator_data->name,
                'online_institution_name'            => $online_institution_data->name,
                'online_collaborator_institution_id' => $online_collaborator_institution_id,
                'genders'                            => $genders,
                'colors'                             => $colors,
                'amount_classes'                     => count($institution_classes),
                'all_institution_classes'            => $institution_classes,
                'amount_active_students'             => count($active_students),
                'amount_collaborators'               => count($active_collaborators),
                'collaborators'                      => $active_collaborators,
                'current_school_year'                => $current_school_year,
                'school_year_id'                     => $school_year_id->id,
                'all_school_years'                   => $all_school_years,
                'grades'                             => $grades,
                'online_collaborator_id'             => $collaborator_id,
                'latest_student_registers'           => $latest_registers,
                'latest_registers_counter'           => $latest_registers_counter,
                'all_student_registers'              => $all_registers,
                'all_registers_counter'              => $all_registers_counter,
                'admin_type_data'                    => $admin_type_data->admin_type,
                'each_class_amount'                  => $classes_amount
            ]);
        }elseif ($admin_type_choice_data->admin_type_id == 2){
            //redirect to coordination home
            return view('admins.coordination-home',[
                'guard'                              => $guard,  
                'title'                              => $page_title,
                'online_collaborator_name'           => $online_collaborator_data->name,
                'online_institution_name'            => $online_institution_data->name,
                'online_collaborator_institution_id' => $online_collaborator_institution_id,
                'genders'                            => $genders,
                'colors'                             => $colors,
                'amount_classes'                     => count($institution_classes),
                'all_institution_classes'            => $institution_classes,
                'amount_active_students'             => count($active_students),
                'amount_collaborators'               => count($active_collaborators),
                'collaborators'                      => $active_collaborators,
                'current_school_year'                => $current_school_year,
                'school_year_id'                     => $school_year_id->id,
                'all_school_years'                   => $all_school_years,
                'grades'                             => $grades,
                'online_collaborator_id'             => $collaborator_id,
                'latest_student_registers'           => $latest_registers,
                'latest_registers_counter'           => $latest_registers_counter,
                'all_student_registers'              => $all_registers,
                'all_registers_counter'              => $all_registers_counter,
                'admin_type_data'                    => $admin_type_data->admin_type,
                'knowledge_areas'                    => $knowledge_areas,
                'all_curricular_components'          => $all_curricular_components,
                'each_class_amount'                  => $classes_amount,
                'exams'                              => $exams,
                'institution_classes_length'         => $counting,
                'all_institution_grades_id'          => $all_institution_grades['grade_id'],
                'all_institution_grades'             => $all_institution_grades['grade'],
                'previsions'                         => $previsions,
                'schedules_by_class'                 => $schedules_by_class,
                'schedule'                           => $schedule,
                'divisions'                          => $divisions,
                'exam_types'                         => $exam_types
            ]);
        }elseif ($admin_type_choice_data->admin_type_id == 3){
            //redirect to school management home
            return view('admins.school-management-home',[
                'guard'                              => $guard,  
                'title'                              => $page_title,
                'online_collaborator_name'           => $online_collaborator_data->name,
                'online_institution_name'            => $online_institution_data->name,
                'online_collaborator_institution_id' => $online_collaborator_institution_id,
                'genders'                            => $genders,
                'colors'                             => $colors,
                'amount_classes'                     => count($institution_classes),
                'all_institution_classes'            => $institution_classes,
                'amount_active_students'             => count($active_students),
                'amount_collaborators'               => count($active_collaborators),
                'collaborators'                      => $active_collaborators,
                'current_school_year'                => $current_school_year,
                'school_year_id'                     => $school_year_id->id,
                'all_school_years'                   => $all_school_years,
                'grades'                             => $grades,
                'online_collaborator_id'             => $collaborator_id,
                'latest_student_registers'           => $latest_registers,
                'latest_registers_counter'           => $latest_registers_counter,
                'all_student_registers'              => $all_registers,
                'all_registers_counter'              => $all_registers_counter,
                'admin_type_data'                    => $admin_type_data->admin_type,
                'each_class_amount'                  => $classes_amount,
                'each_class_amount'                  => $classes_amount,
                'classes_amount_counter'             => $classes_amount_counter,
                'each_class_amount'                  => $classes_amount
            ]);
        }else{
            dd('Erro ao definir o tipo de administrador!');
        }   
    }

    public function initialization()
    {
        $collaborator_id = Auth::user()->collaborator_id;

        $online_collaborator_data       = $this->collaborator_repository->findWhere([
            'id'=> $collaborator_id
        ])->first();

        $online_collaborator_institution_id = $online_collaborator_data->institution_id;
        
        $active_students  = $this->student_enrollment_repository->findWhere([
            'institution_id'       => $online_collaborator_institution_id,
            'enrollment_status_id' => '1'
        ]);

        $active_collaborators = $this->collaborator_repository->findWhere([
            'institution_id'      => $online_collaborator_institution_id,
            'collaborator_status' => 'Active'
        ])->all();

        $online_institution_data  = $this->institution_repository->findWhere([
            'id'    => $online_collaborator_institution_id
        ])->first();

        $school_years = $this->school_year_repository->findWhere([
            'institution_id'     => $online_collaborator_institution_id,
            'school_year_status' => 'active'
        ])->first();

        return redirect()->route('admin.store.school-year');
        /*
        $current_school_year = $school_years->year;

        if ($school_years==null) {
            return redirect()->route('admin.store.school-year');
        }else{
            $school_year_id = $this->school_year_repository->findWhere([
                'institution_id'    => $online_collaborator_institution_id,
                'year'              => $school_years->year
            ])->first();

            $department_data = $this->department_repository->findWhere([
                'institution_id' => $online_collaborator_institution_id
            ])->all();

            $jobs_data = $this->job_repository->findWhere([
                'institution_id' => $online_collaborator_institution_id
            ])->all();

            if ($department_data==null) {
                return redirect()->route('admin.store.department',[
                    'current_school_year'   => $current_school_year
                ]);
            }
            if ($jobs_data==null) {
               return redirect()->route('admin.store.jobs',[
                    'current_school_year'   => $current_school_year
                ]);
            }
        }

        return redirect()->route('admin.show.dashboard',['year' => $current_school_year]);*/
    }
    
    /**
     * Show the configuration page.
     */
    public function configPage($year)
    {
        $guard = 'admins';
        $page_title = 'Configurações';
        $collaborator_id = Auth::user()->collaborator_id;
        $current_school_year = $year;

        $online_collaborator_data = $this->collaborator_repository->findWhere([
            'id'=> $collaborator_id
        ])->first();
        $online_collaborator_institution_id = $online_collaborator_data->institution_id;

        //find the school year id
        $school_year_id = DB::table('school_years')
            ->where('institution_id',$online_collaborator_institution_id)
            ->where('year',$current_school_year)
            ->select('id')
            ->first();

        $institution_classes  = $this->institution_class_repository->findWhere([
            'institution_id' => $online_collaborator_institution_id,
            'school_year_id' => $school_year_id->id
        ])->all();

        // get distinct institution grades

        $institution_grades = array();
        $all_institution_grades = array(
            'grade_id' => array(),
            'grade' => array()
        );
        $counting = 0;

        $institution_classes_length = count($institution_classes);

        for($i=0;$i <$institution_classes_length;$i++){
            if(!($i == $institution_classes_length-1)){
                if (!($institution_classes[$i]['grade_id'] == $institution_classes[$i+1]['grade_id'])) {
                    array_push($institution_grades, $institution_classes[$i]['grade_id']);
                    $counting = $counting+1;
                }
            }else{    
                array_push($institution_grades, $institution_classes[$i]['grade_id']);
                $counting = $counting+1;
            }
        }
        
        foreach ($institution_grades as $g) {
            $institution_grades_data = $this->grade_repository->findWhere([
                'id' => $g
            ])->first();
            array_push($all_institution_grades['grade_id'], $g); 
            array_push($all_institution_grades['grade'], $institution_grades_data->grade); 
        }

        //Database searches

        $online_institution_data = $this->institution_repository->findWhere([
            'id'    => $online_collaborator_institution_id
        ])->first();

        $all_online_institution_data = [
            'name'      => $online_institution_data->name,
            'inep'      => $online_institution_data->inep_number,
            'address'   => $online_institution_data->address,
            'city'      => $online_institution_data->city,
            'state'     => $online_institution_data->state,
            'cnpj'      => $online_institution_data->cnpj,
            'phone'     => $online_institution_data->phone,
            'email'     => $online_institution_data->email,
            'maintainer'=> $online_institution_data->maintainer,
            'motto'     => $online_institution_data->motto
        ];

        $department_data = $this->department_repository->findWhere([
            'institution_id' => $online_collaborator_institution_id
        ])->all();

        $jobs_data = DB::table('jobs')
            ->join('departments', 'jobs.department_id', '=', 'departments.id')
            ->where('jobs.institution_id', $online_collaborator_institution_id)
            ->select(
                'jobs.id','jobs.office','jobs.department_id','jobs.institution_id',
                'departments.department'
            )->get();

        $all_school_years = $this->school_year_repository->findWhere([
                'institution_id' => $online_collaborator_institution_id
        ])->all();

        $school_years = $this->school_year_repository->findWhere([
            'institution_id'     => $online_collaborator_institution_id,
            'school_year_status' => 'active'
        ])->first();

        $all_admins = DB::table('admins')
            ->where('institution_id','=',$online_collaborator_institution_id)
            ->where('admin_status','=','active')
            ->select('id','name')
            ->get();

        $all_admin_types = $this->admin_type_repository->all();
            
        $all_inactive_admins = DB::table('admins')
            ->where('institution_id','=',$online_collaborator_institution_id)
            ->where('admin_status','=','inactive')
            ->select('id','name')
            ->get();
        
        $active_collaborators_count = DB::table('collaborators')
            ->join('collaborator_jobs', 'collaborators.id', '=', 'collaborator_jobs.collaborator_id')
            ->where('collaborators.collaborator_status', 'Active')
            ->where('collaborators.institution_id',$online_collaborator_institution_id)
            ->where('collaborator_jobs.job_year',$current_school_year)
            ->get();

        $active_collaborators = DB::table('collaborators')
            ->where('collaborators.collaborator_status', 'Active')
            ->where('collaborators.institution_id',$online_collaborator_institution_id)
            ->get();

        //find the admin id
        $admin_data = $this->repository->findWhere([
            'collaborator_id'   => $collaborator_id,
            'email'             => Auth::user()->email
        ])->first();
        $admin_id = $admin_data->id;

        //find the admin type
        $admin_type_choice_data = $this->admin_type_choice_repository->findWhere([
            'admin_id' => $admin_id
        ])->first();

        $admin_type_data = DB::table('admin_types')
            ->where('id', $admin_type_choice_data->admin_type_id)
            ->select('admin_type')
            ->first();

        $school_year_division_data = DB::table('institution_school_year_divisions')
            ->where('institution_id','=',$online_collaborator_institution_id)
            ->select('id','division')
            ->get();

        $exam_types = DB::table('exam_types')
            ->where('institution_id','=',$online_collaborator_institution_id)
            ->get();

        if ($school_years == null) {
            return view('admins.show-school-year-form',[
                'guard'                              => $guard, 
                'title'                              => $page_title,
                'online_collaborator_name'           => $online_collaborator_data->name,
                'online_collaborator_institution_id' => $online_collaborator_institution_id,
                'online_institution_name'            => $online_institution_data->name,
                'all_online_institution_data'        => $all_online_institution_data,
                'all_institution_classes'            => $institution_classes,
                'institution_classes_length'         => $counting,
                'all_institution_grades_id'          => $all_institution_grades['grade_id'],
                'all_institution_grades'             => $all_institution_grades['grade'],
                'online_collaborator_id'             => $collaborator_id,
                'all_admins'                         => $all_admins,
                'all_inactiveadmins'                 => $all_inactive_admins,
                'collaborators'                      => $active_collaborators_count,
                'active_collaborators'               => $active_collaborators,
                'admin_type_data'                    => $admin_type_data->admin_type
            ]);
        }else{
            return view('admins.config',[
                'guard'                              => $guard, 
                'title'                              => $page_title,
                'online_collaborator_name'           => $online_collaborator_data->name,
                'online_collaborator_institution_id' => $online_collaborator_institution_id,
                'online_institution_name'            => $online_institution_data->name,
                'all_online_institution_data'        => $all_online_institution_data,
                'current_school_year'                => $current_school_year,
                'all_school_years'                   => $all_school_years,
                'all_institution_classes'            => $institution_classes,
                'institution_classes_length'         => $counting,
                'all_institution_grades_id'          => $all_institution_grades['grade_id'],
                'all_institution_grades'             => $all_institution_grades['grade'],
                'departments'                        => $department_data,
                'jobs'                               => $jobs_data,
                'online_collaborator_id'             => $collaborator_id,
                'all_admins'                         => $all_admins,
                'all_inactiveadmins'                 => $all_inactive_admins,
                'collaborators'                      => $active_collaborators_count,
                'active_collaborators'               => $active_collaborators,
                'all_admin_types'                    => $all_admin_types,
                'admin_type_data'                    => $admin_type_data->admin_type,
                'school_year_divisions'              => $school_year_division_data,
                'exam_types'                         => $exam_types
            ]);
        }
    }

    /*
     * ===========================================================================
     * Student Enrollment Methods
     * ===========================================================================
     */
    public function storeStudentTestShow($year){
        $guard      = 'admins';
        $page_title = 'Matrícula';

        $collaborator_id = Auth::user()->collaborator_id;
        $current_school_year = $year;

        //Database searches
        $admin                    = $this->repository->all();
        $institution_classes      = $this->institution_class_repository->all();

        $online_collaborator_data = $this->collaborator_repository->findWhere([
            'id'=> $collaborator_id
        ])->first();

        $online_collaborator_institution_id = $online_collaborator_data->institution_id;

        $school_years = $this->school_year_repository->findWhere([
            'institution_id'     => $online_collaborator_institution_id,
            'school_year_status' => 'active'
        ])->first();

        $all_school_years = $this->school_year_repository->findWhere([
            'institution_id' => $online_collaborator_institution_id
        ])->all();

        $online_institution_data  = $this->institution_repository->findWhere([
            'id'    => $online_collaborator_institution_id
        ])->first();

        //find the admin id
        $admin_data = $this->repository->findWhere([
            'collaborator_id'   => $collaborator_id,
            'email'             => Auth::user()->email
        ])->first();
        $admin_id = $admin_data->id;

        //find the admin type
        $admin_type_choice_data = $this->admin_type_choice_repository->findWhere([
            'admin_id' => $admin_id
        ])->first();

        $admin_type_data = DB::table('admin_types')
            ->where('id', $admin_type_choice_data->admin_type_id)
            ->select('admin_type')
            ->first();

        $genders = $this->gender_repository->all();
        $colors  = $this->color_repository->all();
        $grades  = $this->grade_repository->all();

        $school_year_id = $this->school_year_repository->findWhere([
            'institution_id'    => $online_collaborator_institution_id,
            'year'              => $year
        ])->first();

        $institution_classes = $this->institution_class_repository->findWhere([
            'institution_id' => $online_collaborator_institution_id,
            'school_year_id' => $school_year_id->id,
        ])->all();

        return view('admins.enroll-student',[
            'guard'                              => $guard, 
            'title'                              => $page_title,
            'online_collaborator_name'           => $online_collaborator_data->name,
            'online_collaborator_institution_id' => $online_collaborator_institution_id,
            'online_institution_name'            => $online_institution_data->name,
            'current_school_year'                => $current_school_year,
            'all_school_years'                   => $all_school_years,
            'online_collaborator_id'             => $collaborator_id,
            'admin_type_data'                    => $admin_type_data->admin_type,
            'genders'                            => $genders,
            'colors'                             => $colors,
            'all_institution_classes'            => $institution_classes,
        ]);
    }
    public function storeStudentMainData($year, Request $request){
        //dd($request->all());
        session()->flash('maindata_success',true);
        session()->flash('success','Salvo com sucesso!');
        session()->flash('student','Student');
        session()->flash('id','ID');
        //PASSAR O ID E O NOME DO ALUNO
        return redirect()->route('admin.store.student.home.show',$year);
    }
    public function storeStudentBirthCertificate($year, Request $request){
        //dd($request->all());
        session()->flash('maindata_success',true);
        session()->flash('birth_certificate_success',true);
        session()->flash('success','Salvo com sucesso!');
        session()->flash('student','Student');
        session()->flash('id','ID');
        //PASSAR O ID E O NOME DO ALUNO
        return redirect()->route('admin.store.student.home.show',$year);
    }
    public function storeStudentAddress1($year, Request $request){
        //dd($request->all());
        session()->flash('maindata_success',true);
        session()->flash('birth_certificate_success',true);
        session()->flash('address_success',true);
        session()->flash('success','Salvo com sucesso!');
        session()->flash('student','Student');
        session()->flash('id','ID');
        //PASSAR O ID E O NOME DO ALUNO
        return redirect()->route('admin.store.student.home.show',$year);
    }
    public function storeStudentContact($year, Request $request){
        //dd($request->all());
        session()->flash('maindata_success',true);
        session()->flash('birth_certificate_success',true);
        session()->flash('address_success',true);
        session()->flash('contact_success',true);
        session()->flash('success','Salvo com sucesso!');
        session()->flash('student','Student');
        session()->flash('id','ID');
        //PASSAR O ID E O NOME DO ALUNO
        return redirect()->route('admin.store.student.home.show',$year);
    }
    public function storeStudentEnrollment1($year, Request $request){
        //dd($request->all());
        session()->flash('maindata_success',true);
        session()->flash('birth_certificate_success',true);
        session()->flash('address_success',true);
        session()->flash('contact_success',true);
        session()->flash('enrollment_success',true);
        session()->flash('success','O novo Aluno foi matriculado com sucesso!');
        session()->flash('student','Student');
        session()->flash('id','ID');
        //PASSAR O ID E O NOME DO ALUNO
        return redirect()->route('admin.store.student.home.show',$year);
    }

    public function storeStudent($year, StudentCreateRequest $request)
    {
        $request      = $this->student_service->store($request->all());
        $student      = $request['success'] ? $request['data'] : null;
        $student_id   = $request['student-id'];
        $student_name = $request['student-name'];

        session()->flash('success', [
            'success'      => $request['success'],
            'messages'     => $request['messages']
            
        ]);
        $guard      = 'admins';
        $page_title = 'Matrícula';

        $collaborator_id = Auth::user()->collaborator_id;
        $current_school_year = $year;

        //Database searches
        $admin                    = $this->repository->all();
        $institution_classes      = $this->institution_class_repository->all();

        $online_collaborator_data = $this->collaborator_repository->findWhere([
            'id'=> $collaborator_id
        ])->first();

        $online_collaborator_institution_id = $online_collaborator_data->institution_id;

        $school_years = $this->school_year_repository->findWhere([
            'institution_id'     => $online_collaborator_institution_id,
            'school_year_status' => 'active'
        ])->first();

        $all_school_years = $this->school_year_repository->findWhere([
            'institution_id' => $online_collaborator_institution_id
        ])->all();

        $online_institution_data  = $this->institution_repository->findWhere([
            'id'    => $online_collaborator_institution_id
        ])->first();

        //find the admin id
        $admin_data = $this->repository->findWhere([
            'collaborator_id'   => $collaborator_id,
            'email'             => Auth::user()->email
        ])->first();
        $admin_id = $admin_data->id;

        //find the admin type
        $admin_type_choice_data = $this->admin_type_choice_repository->findWhere([
            'admin_id' => $admin_id
        ])->first();

        $admin_type_data = DB::table('admin_types')
            ->where('id', $admin_type_choice_data->admin_type_id)
            ->select('admin_type')
            ->first();

        return view('admins.store-student-cn',[
            'guard'                              => $guard, 
            'title'                              => $page_title,
            'online_collaborator_name'           => $online_collaborator_data->name,
            'online_collaborator_institution_id' => $online_collaborator_institution_id,
            'online_institution_name'            => $online_institution_data->name,
            'student_id'                         => $student_id,
            'student_name'                       => $student_name,
            'current_school_year'                => $current_school_year,
            'all_school_years'                   => $all_school_years,
            'online_collaborator_id'             => $collaborator_id,
            'admin_type_data'                    => $admin_type_data->admin_type
        ]);

    }

    public function storeStudentCn($year, StudentCnCreateRequest $request)
    {
        $request        = $this->student_service->storeStudentCn($request->all());
        $student        = $request['success'] ? $request['data'] : null;
        $student_id     = $request['student-id'];
        $student_name   = $request['student-name'];
        $current_school_year = $year;

        session()->flash('success', [
            'success'    => $request['success'],
            'messages'   => $request['messages']
        ]);

        $collaborator_id = Auth::user()->collaborator_id;

        $online_collaborator_data = $this->collaborator_repository->findWhere([
            'id'=> $collaborator_id
        ])->first();
        $online_collaborator_institution_id = $online_collaborator_data->institution_id;
        $school_years = $this->school_year_repository->findWhere([
            'institution_id'     => $online_collaborator_institution_id,
            'school_year_status' => 'active'
        ])->first();
        $all_school_years = $this->school_year_repository->findWhere([
            'institution_id' => $online_collaborator_institution_id
        ])->all();

        $online_institution_data  = $this->institution_repository->findWhere([
            'id'    => $online_collaborator_institution_id
        ])->first();

        //find the admin id
        $admin_data = $this->repository->findWhere([
            'collaborator_id'   => $collaborator_id,
            'email'             => Auth::user()->email
        ])->first();
        $admin_id = $admin_data->id;

        //find the admin type
        $admin_type_choice_data = $this->admin_type_choice_repository->findWhere([
            'admin_id' => $admin_id
        ])->first();

        $admin_type_data = DB::table('admin_types')
            ->where('id', $admin_type_choice_data->admin_type_id)
            ->select('admin_type')
            ->first();

        return redirect()->route('admin.store.student.address',[
            'current_school_year'                => $current_school_year,
            'student_id'                         => $student_id, 
            'student_name'                       => $student_name,
            'online_collaborator_institution_id' => $online_collaborator_institution_id,
            'online_institution_name'            => $online_institution_data->name,
            'all_school_years'                   => $all_school_years,
            'online_collaborator_id'             => $collaborator_id,
            'admin_type_data'                    => $admin_type_data->admin_type
        ]);
    }

    public function storeStudentAddress($year,StudentAddressCreateRequest $request)
    {
        $student_enrollment_year = $request['enrollment_year'];
        $request        = $this->student_service->storeStudentAddress($request->all());
        $student        = $request['success'] ? $request['data'] : null;
        $student_id     = $request['student-id'];
        $student_name   = $request['student-name'];
        
        $current_school_year = $year;

        $collaborator_id = Auth::user()->collaborator_id;
        $online_collaborator_data = $this->collaborator_repository->findWhere([
            'id'=> $collaborator_id
        ])->first();
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

        session()->flash('success', [
            'success'    => $request['success'],
            'messages'   => $request['messages']
        ]);

        //find the admin id
        $admin_data = $this->repository->findWhere([
            'collaborator_id'   => $collaborator_id,
            'email'             => Auth::user()->email
        ])->first();
        $admin_id = $admin_data->id;

        //find the admin type
        $admin_type_choice_data = $this->admin_type_choice_repository->findWhere([
            'admin_id' => $admin_id
        ])->first();

        $admin_type_data = DB::table('admin_types')
            ->where('id', $admin_type_choice_data->admin_type_id)
            ->select('admin_type')
            ->first();

        return redirect()->route('admin.store.student.contacts',[
            'current_school_year'                => $current_school_year,
            'student_id'                         => $student_id, 
            'student_name'                       => $student_name,
            'enrollment_year'                    => $student_enrollment_year,
            'online_collaborator_institution_id' => $online_collaborator_institution_id,
            'online_institution_name'            => $online_institution_data->name,
            'all_school_years'                   => $all_school_years,
            'online_collaborator_id'             => $collaborator_id,
            'admin_type_data'                    => $admin_type_data->admin_type
        ]);
    }

    public function storeStudentContacts($year,StudentContactsCreateRequest $request)
    {
        $enrollment_year = $request['enrollment_year'];
        $request        = $this->student_service->storeStudentContacts($request->all());
        $student        = $request['success'] ? $request['data'] : null;
        $student_id     = $request['student-id'];
        $student_name   = $request['student-name'];
        $current_school_year = $year;

        $collaborator_id = Auth::user()->collaborator_id;
        $online_collaborator_data = $this->collaborator_repository->findWhere([
            'id'=> $collaborator_id
        ])->first();
        $online_collaborator_institution_id = $online_collaborator_data->institution_id;
        $school_years = $this->school_year_repository->findWhere([
            'institution_id'     => $online_collaborator_institution_id,
            'school_year_status' => 'active'
        ])->first();
        $all_school_years = $this->school_year_repository->findWhere([
            'institution_id' => $online_collaborator_institution_id
        ])->all();
        $online_institution_data  = $this->institution_repository->findWhere([
            'id'    => $online_collaborator_institution_id
        ])->first();

        session()->flash('success', [
            'success'    => $request['success'],
            'messages'   => $request['messages']
        ]);

        //find the admin id
        $admin_data = $this->repository->findWhere([
            'collaborator_id'   => $collaborator_id,
            'email'             => Auth::user()->email
        ])->first();
        $admin_id = $admin_data->id;

        //find the admin type
        $admin_type_choice_data = $this->admin_type_choice_repository->findWhere([
            'admin_id' => $admin_id
        ])->first();

        $admin_type_data = DB::table('admin_types')
            ->where('id', $admin_type_choice_data->admin_type_id)
            ->select('admin_type')
            ->first();

        return redirect()->route('admin.store.student.class',[
            'current_school_year'                => $current_school_year,
            'student_id'                         => $student_id, 
            'student_name'                       => $student_name,
            'enrollment_year'                    => $enrollment_year,
            'online_collaborator_institution_id' => $online_collaborator_institution_id,
            'online_institution_name'            => $online_institution_data->name,
            'all_school_years'                   => $all_school_years,
            'online_collaborator_id'             => $collaborator_id,
            'admin_type_data'                    => $admin_type_data->admin_type
        ]);
    }

    public function storeStudentEnrollment($year,StudentEnrollmentCreateRequest $request)
    {
        $current_school_year = $year;
        //find how many students were enrolled
        $all_registers = DB::table('student_enrollments')
            ->join('students','student_enrollments.student_id','=','students.id')
            ->join('institution_classes','student_enrollments.institution_class_id','=','institution_classes.id')
            ->latest('student_enrollments.created_at')
            ->where('student_enrollments.enrollment_year',$request['enrollment_year'])
            ->select('students.id','students.name','student_enrollments.enrollment_date','institution_classes.institution_class')
            ->get();
        $amout_students = count($all_registers) + 1;
        $enrollment_number = $amout_students.'/'.$current_school_year;

        $enrollment_data = [
            'enrollment_code'       => $request['enrollment_code'],
            'enrollment_date'       => $request['enrollment_date'],
            'enrollment_year'       => $request['enrollment_year'],
            'enrollment_number'     => $enrollment_number,
            'degree_relatedness'    => $request['degree_relatedness'],
            'name'                  => $request['name'],
            'cpf'                   => $request['cpf'],
            'rg'                    => $request['rg'],
            'rg_emissor'            => $request['rg_emissor'],
            'institution_class_id'  => $request['institution_class_id'],
            'enrollment_status_id'  => $request['enrollment_status_id'],
            'student_id'            => $request['student_id'],
            'institution_id'        => $request['institution_id'],
            'collaborator_id'       => $request['collaborator_id']
        ];

        $request        = $this->student_service->storeStudentEnrollment($enrollment_data);
        $student        = $request['success'] ? $request['data'] : null;
        $student_id     = $request['student-id'];
        $student_name   = $request['student-name'];

        session()->flash('success', [
            'success'    => $request['success'],
            'messages'   => $request['messages']
        ]);

        $collaborator_id = Auth::user()->collaborator_id;
        $online_collaborator_data = $this->collaborator_repository->findWhere([
            'id'=> $collaborator_id
        ])->first();
        $online_collaborator_institution_id = $online_collaborator_data->institution_id;
        $school_years = $this->school_year_repository->findWhere([
            'institution_id'     => $online_collaborator_institution_id,
            'school_year_status' => 'active'
        ])->first();
        $all_school_years = $this->school_year_repository->findWhere([
            'institution_id' => $online_collaborator_institution_id
        ])->all();

        $online_institution_data  = $this->institution_repository->findWhere([
            'id'    => $online_collaborator_institution_id
        ])->first();

        //find the admin id
        $admin_data = $this->repository->findWhere([
            'collaborator_id'   => $collaborator_id,
            'email'             => Auth::user()->email
        ])->first();
        $admin_id = $admin_data->id;

        //find the admin type
        $admin_type_choice_data = $this->admin_type_choice_repository->findWhere([
            'admin_id' => $admin_id
        ])->first();

        $admin_type_data = DB::table('admin_types')
            ->where('id', $admin_type_choice_data->admin_type_id)
            ->select('admin_type')
            ->first();

        return redirect()->route('admin.show.student.data.byclass',[
            'year'     => $current_school_year,
            'id'       => $student_id,
            'class_id' => $enrollment_data['institution_class_id']
        ]);
    }

    public function storeStudentEnrollmentRematricula($year,StudentEnrollmentCreateRequest $request)
    {
        //dd($request);
        //find how many students were enrolled
        $all_registers = DB::table('student_enrollments')
            ->join('students','student_enrollments.student_id','=','students.id')
            ->join('institution_classes','student_enrollments.institution_class_id','=','institution_classes.id')
            ->latest('student_enrollments.created_at')
            ->where('student_enrollments.enrollment_year',$request['enrollment_year'])
            ->select('students.id','students.name','student_enrollments.enrollment_date','institution_classes.institution_class')
            ->get();
        $amout_students = count($all_registers) + 1;
        $enrollment_number = $amout_students.'/'.$current_school_year;

        $enrollment_data = [
            'enrollment_code'       => $request['enrollment_code'],
            'enrollment_date'       => $request['enrollment_date'],
            'enrollment_year'       => $request['enrollment_year'],
            'enrollment_number'     => $enrollment_number,
            'degree_relatedness'    => $request['degree_relatedness'],
            'name'                  => $request['name'],
            'cpf'                   => $request['cpf'],
            'rg'                    => $request['rg'],
            'rg_emissor'            => $request['rg_emissor'],
            'institution_class_id'  => $request['institution_class_id'],
            'enrollment_status_id'  => $request['enrollment_status_id'],
            'student_id'            => $request['student_id'],
            'institution_id'        => $request['institution_id'],
            'collaborator_id'       => $request['collaborator_id']
        ];

        $address_data = [
            'street'            => $request['street'],
            'block'             => $request['block'],
            'land_lot'          => $request['land_lot'],
            'number'            => $request['number'],
            'neighborhood'      => $request['neighborhood'],
            'zipcode'           => $request['zipcode'],
            'complement'        => $request['complement'],
            'student_id'        => $request['student_id'],
            'enrollment_year'   => $request['enrollment_year']
        ];

        $contacts_data = [
            'phone1'                => $request['phone1'],
            'phone1_responsable'    => $request['phone1_responsable'],
            'phone2'                => $request['phone2'],
            'phone2_responsable'    => $request['phone2_responsable'],
            'phone3'                => $request['phone3'],
            'phone3_responsable'    => $request['phone3_responsable'],
            'student_id'            => $request['student_id'],
            'enrollment_year'       => $request['enrollment_year']
        ];
        //dd($request);

        //Store student enrollment data through the student service layer
        $request        = $this->student_service->storeStudentEnrollment($enrollment_data);
        $student        = $request['success'] ? $request['data'] : null;

        //ATUALIZAR O STATUS DA MATRICULA ANTIGA

        //Store student address data through the student service layer
        $request        = $this->student_service->storeStudentAddress($address_data);
        $address        = $request['success'] ? $request['data'] : null;

        //Store student contacts data through the student service layer
        $request        = $this->student_service->storeStudentContacts($contacts_data);
        $contact        = $request['success'] ? $request['data'] : null;
        
        $current_school_year = $year;

        session()->flash('success', [
            'success'    => $request['success'],
            'messages'   => $request['messages']
        ]);

        $collaborator_id = Auth::user()->collaborator_id;
        $online_collaborator_data = $this->collaborator_repository->findWhere([
            'id'=> $collaborator_id
        ])->first();
        $online_collaborator_institution_id = $online_collaborator_data->institution_id;
        $school_years = $this->school_year_repository->findWhere([
            'institution_id'     => $online_collaborator_institution_id,
            'school_year_status' => 'active'
        ])->first();
        $all_school_years = $this->school_year_repository->findWhere([
            'institution_id' => $online_collaborator_institution_id
        ])->all();

        $online_institution_data  = $this->institution_repository->findWhere([
            'id'    => $online_collaborator_institution_id
        ])->first();

        //find the admin id
        $admin_data = $this->repository->findWhere([
            'collaborator_id'   => $collaborator_id,
            'email'             => Auth::user()->email
        ])->first();
        $admin_id = $admin_data->id;

        //find the admin type
        $admin_type_choice_data = $this->admin_type_choice_repository->findWhere([
            'admin_id' => $admin_id
        ])->first();

        $admin_type_data = DB::table('admin_types')
            ->where('id', $admin_type_choice_data->admin_type_id)
            ->select('admin_type')
            ->first();

        return redirect()->route('admin.show.rematricular.success',[
            'current_school_year'   => $current_school_year,
            'student_id'            => $enrollment_data['student_id'],
            'enrollment_year'       => $enrollment_data['enrollment_year'],
            'admin_type_data'       => $admin_type_data->admin_type
        ]);
    }

    public function ShowSuccessRematricula($year,$id,$enrollment_year)
    {
        $guard = 'admins';
        $page_title = 'Rematricular';
        $collaborator_id = Auth::user()->collaborator_id;
        $current_school_year = $year;

        $institution_classes  = $this->institution_class_repository->all();

        $online_collaborator_data = $this->collaborator_repository->findWhere([
            'id'=> $collaborator_id
        ])->first();

        $online_collaborator_institution_id = $online_collaborator_data->institution_id;

        $school_years = $this->school_year_repository->findWhere([
            'institution_id'     => $online_collaborator_institution_id,
            'school_year_status' => 'active'
        ])->first();
        $all_school_years = $this->school_year_repository->findWhere([
            'institution_id' => $online_collaborator_institution_id
        ])->all();

        $online_institution_data  = $this->institution_repository->findWhere([
            'id'    => $online_collaborator_institution_id
        ])->first();

        $student_data = DB::table('students')
            ->where('students.id', $id)
            ->select('students.name')->first();

        //find the admin id
        $admin_data = $this->repository->findWhere([
            'collaborator_id'   => $collaborator_id,
            'email'             => Auth::user()->email
        ])->first();
        $admin_id = $admin_data->id;

        //find the admin type
        $admin_type_choice_data = $this->admin_type_choice_repository->findWhere([
            'admin_id' => $admin_id
        ])->first();

        $admin_type_data = DB::table('admin_types')
            ->where('id', $admin_type_choice_data->admin_type_id)
            ->select('admin_type')
            ->first();

        return view('admins.success-rematricular-student',[
            'title'                              => $page_title,
            'current_school_year'                => $current_school_year,
            'guard'                              => $guard,
            'enrollment_year'                    => $enrollment_year,
            'student_name'                       => $student_data->name,
            'student_id'                         => $id,
            'online_collaborator_name'           => $online_collaborator_data->name,
            'online_institution_name'            => $online_institution_data->name,
            'online_collaborator_institution_id' => $online_collaborator_institution_id,
            'online_collaborator_id'             => $collaborator_id,
            'all_school_years'                   => $all_school_years,
            'admin_type_data'                    => $admin_type_data->admin_type
        ]);
    }
    public function ShowStudentCnForm()
    {
        
    }

    public function ShowStudentAddressForm($year,$student_id, $student_name,$enrollment_year)
    {
        $guard          = 'admins';
        $page_title     = 'Matrícula';

        $collaborator_id = Auth::user()->collaborator_id;
        $current_school_year = $year;

        //Database searches
        $admin                    = $this->repository->all();
        $institution_classes      = $this->institution_class_repository->all();

        $online_collaborator_data = $this->collaborator_repository->findWhere([
            'id'=> $collaborator_id
        ])->first();

        $online_collaborator_institution_id = $online_collaborator_data->institution_id;
        
        $school_years = $this->school_year_repository->findWhere([
            'institution_id'     => $online_collaborator_institution_id,
            'school_year_status' => 'active'
        ])->first();

        $all_school_years = $this->school_year_repository->findWhere([
            'institution_id' => $online_collaborator_institution_id
        ])->all();

        $online_institution_data  = $this->institution_repository->findWhere([
            'id'    => $online_collaborator_institution_id
        ])->first();

        //find the admin id
        $admin_data = $this->repository->findWhere([
            'collaborator_id'   => $collaborator_id,
            'email'             => Auth::user()->email
        ])->first();
        $admin_id = $admin_data->id;

        //find the admin type
        $admin_type_choice_data = $this->admin_type_choice_repository->findWhere([
            'admin_id' => $admin_id
        ])->first();

        $admin_type_data = DB::table('admin_types')
            ->where('id', $admin_type_choice_data->admin_type_id)
            ->select('admin_type')
            ->first();
        
        return view('admins.store-student-address',[
            'current_school_year'                => $current_school_year,
            'guard'                              => $guard, 
            'title'                              => $page_title,
            'online_collaborator_name'           => $online_collaborator_data->name,
            'online_collaborator_institution_id' => $online_collaborator_institution_id,
            'online_institution_name'            => $online_institution_data->name,
            'student_id'                         => $student_id,
            'student_name'                       => $student_name,
            'all_school_years'                   => $all_school_years,
            'online_collaborator_id'             => $collaborator_id,
            'enrollment_year'                    => $enrollment_year,
            'admin_type_data'                    => $admin_type_data->admin_type
        ]);
    }

    public function ShowStudentContactsForm($year,$student_id, $student_name,$enrollment_year)
    {
        $guard      = 'admins';
        $page_title = 'Matrícula';

        $collaborator_id = Auth::user()->collaborator_id;
        $current_school_year = $year;

        //Database searches
        $admin                    = $this->repository->all();
        $institution_classes      = $this->institution_class_repository->all();

        $online_collaborator_data = $this->collaborator_repository->findWhere([
            'id'=> $collaborator_id
        ])->first();

        $online_collaborator_institution_id = $online_collaborator_data->institution_id;
        
        $school_years = $this->school_year_repository->findWhere([
            'institution_id'     => $online_collaborator_institution_id,
            'school_year_status' => 'active'
        ])->first();

        $all_school_years = $this->school_year_repository->findWhere([
            'institution_id' => $online_collaborator_institution_id
        ])->all();
        $online_institution_data  = $this->institution_repository->findWhere([
            'id'    => $online_collaborator_institution_id
        ])->first();

        //find the admin id
        $admin_data = $this->repository->findWhere([
            'collaborator_id'   => $collaborator_id,
            'email'             => Auth::user()->email
        ])->first();
        $admin_id = $admin_data->id;

        //find the admin type
        $admin_type_choice_data = $this->admin_type_choice_repository->findWhere([
            'admin_id' => $admin_id
        ])->first();

        $admin_type_data = DB::table('admin_types')
            ->where('id', $admin_type_choice_data->admin_type_id)
            ->select('admin_type')
            ->first();

        return view('admins.store-student-contacts',[
            'current_school_year'                => $current_school_year,
            'guard'                              => $guard, 
            'title'                              => $page_title,
            'online_collaborator_name'           => $online_collaborator_data->name,
            'online_collaborator_institution_id' => $online_collaborator_institution_id,
            'online_institution_name'            => $online_institution_data->name,
            'collaborator_id'                    => $collaborator_id,
            'student_id'                         => $student_id,
            'student_name'                       => $student_name,
            'all_school_years'                   => $all_school_years,
            'online_collaborator_id'             => $collaborator_id,
            'enrollment_year'                    => $enrollment_year,
            'admin_type_data'                    => $admin_type_data->admin_type
        ]);
    }

    public function ShowStudentClassForm($year,$student_id, $student_name,$enrollment_year)
    {
        $guard      = 'admins';
        $page_title = 'Matrícula';

        $collaborator_id = Auth::user()->collaborator_id;
        $current_school_year = $year;

        //Database searches
        $admin                    = $this->repository->all();
        
        $online_collaborator_data = $this->collaborator_repository->findWhere([
            'id'=> $collaborator_id
        ])->first();

        $online_collaborator_institution_id = $online_collaborator_data->institution_id;

        $online_institution_data = $this->institution_repository->findWhere([
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
            'year'              => $current_school_year
        ])->first();

        $institution_classes = $this->institution_class_repository->findWhere([
            'institution_id' => $online_collaborator_institution_id,
            'school_year_id' => $school_year_id->id,
        ])->all();

        //find the admin id
        $admin_data = $this->repository->findWhere([
            'collaborator_id'   => $collaborator_id,
            'email'             => Auth::user()->email
        ])->first();
        $admin_id = $admin_data->id;

        //find the admin type
        $admin_type_choice_data = $this->admin_type_choice_repository->findWhere([
            'admin_id' => $admin_id
        ])->first();

        $admin_type_data = DB::table('admin_types')
            ->where('id', $admin_type_choice_data->admin_type_id)
            ->select('admin_type')
            ->first();
        
        
        return view('admins.store-student-class',[
            'current_school_year'                => $current_school_year,
            'guard'                              => $guard, 
            'title'                              => $page_title,
            'enrollment_year'                    => $enrollment_year,
            'online_collaborator_name'           => $online_collaborator_data->name,
            'online_institution_name'            => $online_institution_data->name,
            'online_collaborator_institution_id' => $online_collaborator_institution_id,
            'collaborator_id'                    => $collaborator_id,
            'all_institution_classes'            => $institution_classes,
            'student_id'                         => $student_id,
            'student_name'                       => $student_name,
            'all_school_years'                   => $all_school_years,
            'online_collaborator_id'             => $collaborator_id,
            'admin_type_data'                    => $admin_type_data->admin_type
        ]);
    }

    /*public function ShowStudentData($year, $id)
    {
        if(file_exists('enrollment.xlsx')){
            unlink('enrollment.xlsx');
        }
        if(file_exists('enrollment.pdf')){
            unlink('enrollment.pdf');
        }
        
        $guard      = 'admins';
        $page_title = 'Dados';

        $genders  = $this->gender_repository->all();
        $colors   = $this->color_repository->all();

        $collaborator_id = Auth::user()->collaborator_id;
        $current_school_year = $year;

        $online_collaborator_data = $this->collaborator_repository->findWhere([
            'id'=> $collaborator_id
        ])->first();

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

        $student_data = DB::table('students')
            ->join('colors','students.color_id','=','colors.id')
            ->join('genders', 'students.gender_id', '=', 'genders.id')
            ->join('student_addresses', 'students.id', '=', 'student_addresses.student_id')
            ->join('student_cns', 'students.id', '=', 'student_cns.student_id')
            ->join('student_contacts', 'students.id', '=', 'student_contacts.student_id')
            ->join('student_enrollments', 'students.id', '=', 'student_enrollments.student_id')
            ->where('students.id', $id)
            ->where('student_contacts.enrollment_year',$current_school_year)
            ->select(
                'colors.color','genders.gender',
                'students.id','students.name','students.date_birth','students.place_birth','students.mother','students.father', 'students.legal_responsable','students.email','students.cpf', 'students.sus_number','students.auth_image_use', 'students.health_special_needs','students.health_problem',
                'student_addresses.street','student_addresses.block','student_addresses.land_lot', 'student_addresses.number','student_addresses.neighborhood', 'student_addresses.zipcode','student_addresses.complement',
                'student_cns.matricula_cn','student_cns.date_cn','student_cns.termo','student_cns.livro','student_cns.folha',
                'student_contacts.phone1','student_contacts.phone1_responsable','student_contacts.phone2','student_contacts.phone2_responsable','student_contacts.phone3','student_contacts.phone3_responsable'
            )->first();
        //dd($student_data);
        $student_enrollment_data = DB::table('student_enrollments')
            ->join('institution_classes', 'student_enrollments.institution_class_id', '=', 'institution_classes.id')
            ->join('enrollment_statuses', 'student_enrollments.enrollment_status_id', '=', 'enrollment_statuses.id')
            ->where('student_enrollments.student_id', $id)
            ->where('student_enrollments.enrollment_year',$current_school_year)
            ->select(
                'student_enrollments.enrollment_code','student_enrollments.enrollment_number','student_enrollments.enrollment_date','student_enrollments.enrollment_year','student_enrollments.degree_relatedness','student_enrollments.name','student_enrollments.cpf','student_enrollments.rg','student_enrollments.rg_emissor','student_enrollments.collaborator_id','institution_classes.institution_class','student_enrollments.institution_class_id','student_enrollments.transfer_type','student_enrollments.transfer_date','enrollment_statuses.enrollment_status'
            )->first();
        $student_enrollment_collaborator  = $this->collaborator_repository->findWhere([
            'id'    => $student_enrollment_data->collaborator_id
        ])->first();

        $institution_class_data = DB::table('institution_classes')
            ->where('institution_class',$student_enrollment_data->institution_class)
            ->select('id')
            ->first();

        $school_year_id = $this->school_year_repository->findWhere([
            'institution_id'    => $online_collaborator_institution_id,
            'year'              => $year
        ])->first();

        $institution_classes = $this->institution_class_repository->findWhere([
            'institution_id' => $online_collaborator_institution_id,
            'school_year_id' => $school_year_id->id
        ])->all();

        //find the admin id
        $admin_data = $this->repository->findWhere([
            'collaborator_id'   => $collaborator_id,
            'email'             => Auth::user()->email
        ])->first();
        $admin_id = $admin_data->id;

        //find the admin type
        $admin_type_choice_data = $this->admin_type_choice_repository->findWhere([
            'admin_id' => $admin_id
        ])->first();

        $admin_type_data = DB::table('admin_types')
            ->where('id', $admin_type_choice_data->admin_type_id)
            ->select('admin_type')
            ->first();

        $classes_amount = array();
        //find the amount of students of each class
        foreach ($institution_classes as $ic) {
            $amount = DB::table('student_enrollments')
                ->join('students','student_enrollments.student_id','=','students.id')
                ->join('institution_classes','student_enrollments.institution_class_id','=','institution_classes.id')
                ->where('student_enrollments.enrollment_year',$current_school_year)
                ->where('student_enrollments.enrollment_status_id',1)
                ->where('student_enrollments.institution_class_id',$ic->id)
                ->select('students.id','students.name','student_enrollments.enrollment_date','institution_classes.institution_class')
                ->get();
            $class_name = DB::table('institution_classes')
                ->where('id','=',$ic->id)
                ->select('institution_class')
                ->first();
            array_push($classes_amount,[
                'id'  => $ic->id,
                'institution_class'     => $class_name->institution_class,
                'amount'                => count($amount)
            ]);
        }

        return view('admins.show-student-data',[
            'current_school_year'                => $current_school_year,
            'guard'                              => $guard, 
            'title'                              => $page_title,
            'collaborator_id'                    => $collaborator_id,
            'online_collaborator_name'           => $online_collaborator_data->name,
            'online_collaborator_institution_id' => $online_collaborator_institution_id,
            'online_institution_name'            => $online_institution_data->name,
            'all_school_years'                   => $all_school_years,
            'online_collaborator_id'             => $collaborator_id,
            'student_data'                       => $student_data,
            'student_enrollment_data'            => $student_enrollment_data,
            'student_enrollment_collaborator'    => $student_enrollment_collaborator,
            'current_institution_class_id'       => $institution_class_data->id,
            'genders'                            => $genders,
            'colors'                             => $colors,
            'admin_type_data'                    => $admin_type_data->admin_type,
            'each_class_amount'                  => $classes_amount
        ]);
    }*/
    public function ShowStudentDataByClass($year, $id, $class_id)
    {
        if(file_exists('enrollment.xlsx')){
            unlink('enrollment.xlsx');
        }
        if(file_exists('enrollment.pdf')){
            unlink('enrollment.pdf');
        }
        
        $guard      = 'admins';
        $page_title = 'Dados';

        $genders  = $this->gender_repository->all();
        $colors   = $this->color_repository->all();

        $collaborator_id = Auth::user()->collaborator_id;
        $current_school_year = $year;

        $online_collaborator_data = $this->collaborator_repository->findWhere([
            'id'=> $collaborator_id
        ])->first();

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

        $student_data = DB::table('students')
            ->join('colors','students.color_id','=','colors.id')
            ->join('genders', 'students.gender_id', '=', 'genders.id')
            ->join('student_addresses', 'students.id', '=', 'student_addresses.student_id')
            ->join('student_cns', 'students.id', '=', 'student_cns.student_id')
            ->join('student_contacts', 'students.id', '=', 'student_contacts.student_id')
            ->join('student_enrollments', 'students.id', '=', 'student_enrollments.student_id')
            ->where('students.id', $id)
            ->where('student_contacts.enrollment_year',$current_school_year)
            ->where('student_enrollments.institution_class_id',$class_id)
            ->select(
                'colors.color','genders.gender',
                'students.id','students.name','students.date_birth','students.place_birth','students.mother','students.father', 'students.legal_responsable','students.email','students.cpf', 'students.sus_number','students.auth_image_use', 'students.health_special_needs','students.health_problem',
                'student_addresses.street','student_addresses.block','student_addresses.land_lot', 'student_addresses.number','student_addresses.neighborhood', 'student_addresses.zipcode','student_addresses.complement',
                'student_cns.matricula_cn','student_cns.date_cn','student_cns.termo','student_cns.livro','student_cns.folha',
                'student_contacts.phone1','student_contacts.phone1_responsable','student_contacts.phone2','student_contacts.phone2_responsable','student_contacts.phone3','student_contacts.phone3_responsable','student_enrollments.transfer_type'
            )->first();
        //dd($student_data);
        $student_enrollment_data = DB::table('student_enrollments')
            ->join('institution_classes', 'student_enrollments.institution_class_id', '=', 'institution_classes.id')
            ->join('enrollment_statuses', 'student_enrollments.enrollment_status_id', '=', 'enrollment_statuses.id')
            ->where('student_enrollments.student_id', $id)
            ->where('student_enrollments.enrollment_year',$current_school_year)
            ->where('student_enrollments.institution_class_id',$class_id)
            ->select(
                'student_enrollments.enrollment_code','student_enrollments.enrollment_number','student_enrollments.enrollment_date','student_enrollments.enrollment_year','student_enrollments.degree_relatedness','student_enrollments.name','student_enrollments.cpf','student_enrollments.rg','student_enrollments.rg_emissor','student_enrollments.collaborator_id','institution_classes.institution_class','student_enrollments.institution_class_id','student_enrollments.transfer_type','student_enrollments.transfer_date','enrollment_statuses.enrollment_status'
            )->first();
        
        $student_enrollment_collaborator  = $this->collaborator_repository->findWhere([
            'id'    => $student_enrollment_data->collaborator_id
        ])->first();

        $school_year_id = $this->school_year_repository->findWhere([
            'institution_id'    => $online_collaborator_institution_id,
            'year'              => $year
        ])->first();

        $institution_classes = $this->institution_class_repository->findWhere([
            'institution_id' => $online_collaborator_institution_id,
            'school_year_id' => $school_year_id->id
        ])->all();

        //find the admin id
        $admin_data = $this->repository->findWhere([
            'collaborator_id'   => $collaborator_id,
            'email'             => Auth::user()->email
        ])->first();
        $admin_id = $admin_data->id;

        //find the admin type
        $admin_type_choice_data = $this->admin_type_choice_repository->findWhere([
            'admin_id' => $admin_id
        ])->first();

        $admin_type_data = DB::table('admin_types')
            ->where('id', $admin_type_choice_data->admin_type_id)
            ->select('admin_type')
            ->first();

        $classes_amount = array();
        //find the amount of students of each class
        foreach ($institution_classes as $ic) {
            $amount = DB::table('student_enrollments')
                ->join('students','student_enrollments.student_id','=','students.id')
                ->join('institution_classes','student_enrollments.institution_class_id','=','institution_classes.id')
                ->where('student_enrollments.enrollment_year',$current_school_year)
                ->where('student_enrollments.enrollment_status_id',1)
                ->where('student_enrollments.institution_class_id',$ic->id)
                ->select('students.id','students.name','student_enrollments.enrollment_date','institution_classes.institution_class')
                ->get();
            $class_name = DB::table('institution_classes')
                ->where('id','=',$ic->id)
                ->select('institution_class')
                ->first();
            array_push($classes_amount,[
                'id'  => $ic->id,
                'institution_class'     => $class_name->institution_class,
                'amount'                => count($amount)
            ]);
        }

        //get the attendances
        $student_attendances = DB::table('student_school_attendances')
            ->where('student_id','=',$id)
            ->distinct()
            ->get('day');

        //get the exam results and calculate the average

        //get the curricular components of the class
        //get the results of each exam related to each curricular component of the class and add to an array whit three dimensions: results[curricular_component][division][exam]
        //sum all exam results of one division related to one curricular component to get the result of one specific component. Do this for all curricular components. result[curricular_component][division] = sum of all exams
        //sum all result[][] and divide per amount of divisions that is found doing a distinct select in the exams table. result_average[curricular_component]
        //sum all result_average[] and divide per amount of curricular components that is found in curricular_component_classes table. general_average = sum
            
        $exam_result = DB::table('student_exam_results')
            ->join('exams','exams.id','=','student_exam_results.exam_id')
            ->where('student_id','=',$id)
            //->select('id','result')
            ->get();

        return view('admins.show-student-data',[
            'current_school_year'                => $current_school_year,
            'guard'                              => $guard, 
            'title'                              => $page_title,
            'collaborator_id'                    => $collaborator_id,
            'online_collaborator_name'           => $online_collaborator_data->name,
            'online_collaborator_institution_id' => $online_collaborator_institution_id,
            'online_institution_name'            => $online_institution_data->name,
            'all_school_years'                   => $all_school_years,
            'online_collaborator_id'             => $collaborator_id,
            'student_data'                       => $student_data,
            'student_enrollment_data'            => $student_enrollment_data,
            'student_enrollment_collaborator'    => $student_enrollment_collaborator,
            'current_institution_class_id'       => $class_id,
            'genders'                            => $genders,
            'colors'                             => $colors,
            'admin_type_data'                    => $admin_type_data->admin_type,
            'each_class_amount'                  => $classes_amount,
            'student_attendances'                => $student_attendances,
            'student_attendances_counter'        => count($student_attendances),
            'class_id'                           => $class_id
        ]);
    }
    public function ShowRematricularStudentData($year,$id,$next_year)
    {
        $guard      = 'admins';
        $page_title = 'Rematricular';

        $collaborator_id = Auth::user()->collaborator_id;
        $current_school_year = $year;

        $online_collaborator_data = $this->collaborator_repository->findWhere([
            'id'=> $collaborator_id
        ])->first();

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

        $student_data = DB::table('students')
            ->join('colors','students.color_id','=','colors.id')
            ->join('genders', 'students.gender_id', '=', 'genders.id')
            ->join('student_addresses', 'students.id', '=', 'student_addresses.student_id')
            ->join('student_cns', 'students.id', '=', 'student_cns.student_id')
            ->join('student_contacts', 'students.id', '=', 'student_contacts.student_id')
            ->join('student_enrollments', 'students.id', '=', 'student_enrollments.student_id')
            ->where('students.id', $id)
            ->select(
                'colors.color','genders.gender',
                'students.id','students.name','students.date_birth','students.place_birth','students.mother','students.father', 'students.legal_responsable','students.email','students.cpf', 'students.sus_number','students.auth_image_use', 'students.health_special_needs','students.health_problem',
                'student_addresses.street','student_addresses.block','student_addresses.land_lot', 'student_addresses.number','student_addresses.neighborhood', 'student_addresses.zipcode','student_addresses.complement',
                'student_cns.matricula_cn','student_cns.date_cn','student_cns.termo','student_cns.livro','student_cns.folha',
                'student_contacts.phone1','student_contacts.phone1_responsable','student_contacts.phone2','student_contacts.phone2_responsable','student_contacts.phone3','student_contacts.phone3_responsable'
            )->first();

        $school_year_id = $this->school_year_repository->findWhere([
            'institution_id'    => $online_collaborator_institution_id,
            'year'              => $next_year
        ])->first();

        $institution_classes = $this->institution_class_repository->findWhere([
            'institution_id' => $online_collaborator_institution_id,
            'school_year_id' => $school_year_id->id,
        ])->all();

        //find the admin id
        $admin_data = $this->repository->findWhere([
            'collaborator_id'   => $collaborator_id,
            'email'             => Auth::user()->email
        ])->first();
        $admin_id = $admin_data->id;

        //find the admin type
        $admin_type_choice_data = $this->admin_type_choice_repository->findWhere([
            'admin_id' => $admin_id
        ])->first();

        $admin_type_data = DB::table('admin_types')
            ->where('id', $admin_type_choice_data->admin_type_id)
            ->select('admin_type')
            ->first();

        $classes_amount = array();
        //find the amount of students of each class
        foreach ($institution_classes as $ic) {
            $amount = DB::table('student_enrollments')
                ->join('students','student_enrollments.student_id','=','students.id')
                ->join('institution_classes','student_enrollments.institution_class_id','=','institution_classes.id')
                ->where('student_enrollments.enrollment_year',$current_school_year)
                ->where('student_enrollments.enrollment_status_id',1)
                ->where('student_enrollments.institution_class_id',$ic->id)
                ->select('students.id','students.name','student_enrollments.enrollment_date','institution_classes.institution_class')
                ->get();
            $class_name = DB::table('institution_classes')
                ->where('id','=',$ic->id)
                ->select('institution_class')
                ->first();
            array_push($classes_amount,[
                'id'  => $ic->id,
                'institution_class'     => $class_name->institution_class,
                'amount'                => count($amount)
            ]);
        }

        return view('admins.rematricular-student-data',[
            'current_school_year'                => $current_school_year,
            'next_year'                          => $next_year,
            'guard'                              => $guard, 
            'title'                              => $page_title,
            'online_collaborator_name'           => $online_collaborator_data->name,
            'online_collaborator_institution_id' => $online_collaborator_institution_id,
            'online_institution_name'            => $online_institution_data->name,
            'all_school_years'                   => $all_school_years,
            'all_institution_classes'            => $institution_classes,
            'online_collaborator_id'             => $collaborator_id,
            'student_data'                       => $student_data,
            'admin_type_data'                    => $admin_type_data->admin_type
        ]);
    }

    public function ExportClassListDataPDF($year,$class_id)
    {
        $guard      = 'admins';
        $page_title = 'Exportar para PDF';
        
        $current_school_year = $year;

        $collaborator_id = Auth::user()->collaborator_id;

        $online_collaborator_data = $this->collaborator_repository->findWhere([
            'id'=> $collaborator_id
        ])->first();

        $online_collaborator_institution_id = $online_collaborator_data->institution_id;

        $online_institution_data  = $this->institution_repository->findWhere([
            'id'    => $online_collaborator_institution_id
        ])->first();

        $class_data = DB::table('institution_classes')
            ->join('grades','institution_classes.grade_id','=','grades.id')
            ->join('scholarities','grades.scholarity_id','=','scholarities.id')
            ->where('institution_classes.id','=',$class_id)
            ->select('institution_classes.institution_class','institution_classes.school_shifts','grades.beginnig_age','scholarities.scholarity')
            ->first();

        $students_data = DB::table('students')
            ->join('student_contacts', 'students.id', '=', 'student_contacts.student_id')
            ->join('student_enrollments', 'students.id', '=', 'student_enrollments.student_id')
            ->where('student_enrollments.institution_class_id', $class_id)
            ->where('student_enrollments.enrollment_year',$current_school_year)
            ->where('student_contacts.enrollment_year',$current_school_year)
            ->orderBy('students.name','ASC')
            ->select(
                'students.name','students.date_birth','students.gender_id','student_enrollments.enrollment_date', 'student_enrollments.transfer_date',
                'student_contacts.phone1','student_contacts.phone2','student_contacts.phone3'
            )->get();

        $students_counter            = 0;
        $amout_students_active       = 0;
        $transfered_students_counter = 0;
        $male                        = 0;
        $female                      = 0;
        
        foreach ($students_data as $sd) {
            if(!($sd->transfer_date==null)){
                //count the amout of transfered students
                $transfered_students_counter++;
            }else{
                //count the amout of male and female students
                $amout_students_active++;
                if($sd->gender_id == 1){
                    $male++;
                }else{
                    if($sd->gender_id == 2){
                        $female++;
                    }
                }
            }
        }
        //dd($transfered_students_counter);

        return view('admins.class-list-pdf', [
            'title'                       => $page_title,
            'online_institution_name'     => $online_institution_data->name,
            'online_institution_city'     => $online_institution_data->city,
            'online_institution_state'    => $online_institution_data->state,
            'class_data'                  => $class_data,
            'students_data'               => $students_data,
            'students_counter'            => $students_counter,
            'transfered_students_counter' => $transfered_students_counter,
            'male_counter'                => $male,
            'female_counter'              => $female,
            'amout_students_active'       => $amout_students_active
        ]);
    }

    public function ExportAllStudentsListToSheet($year)
    {
        $guard      = 'admins';
        
        $current_school_year = $year;

        $collaborator_id = Auth::user()->collaborator_id;

        $online_collaborator_data = $this->collaborator_repository->findWhere([
            'id'=> $collaborator_id
        ])->first();

        $online_collaborator_institution_id = $online_collaborator_data->institution_id;

        $online_institution_data  = $this->institution_repository->findWhere([
            'id'    => $online_collaborator_institution_id
        ])->first();

        //List all student registers
        $all_registers = DB::table('student_enrollments')
            ->join('students','student_enrollments.student_id','=','students.id')
            ->join('institution_classes','student_enrollments.institution_class_id','=','institution_classes.id')
            ->join('student_addresses','student_enrollments.student_id','=','student_addresses.student_id')
            ->where('student_enrollments.enrollment_year',$current_school_year)
            ->select('students.id AS student_id','students.name','students.date_birth','students.place_birth','students.father','students.mother','student_enrollments.enrollment_date','student_enrollments.enrollment_number','institution_classes.institution_class','student_enrollments.institution_class_id','student_addresses.street','student_addresses.block','student_addresses.land_lot','student_addresses.number','student_addresses.neighborhood','student_addresses.zipcode','student_addresses.complement')
            ->orderBy('student_enrollments.enrollment_date','ASC')->get();
        $all_registers_counter = 1;

        //dd($all_registers);

        /*Export to sheet format*/

        $templatePath = substr(__DIR__, 0,24) . '/storage/templates/all-students-list-template.xlsx';
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($templatePath);

        $worksheet = $spreadsheet->getActiveSheet();

        $worksheet->getCell('B1')->setValue($online_institution_data->name);
        $worksheet->getCell('B2')->setValue($online_institution_data->city.'-'.$online_institution_data->state);

        foreach ($all_registers as $ar) {

            $worksheet->getCell('A'.(9+$all_registers_counter))->setValue($all_registers_counter);
            $worksheet->getCell('B'.(9+$all_registers_counter))->setValue($ar->name);
            $worksheet->getCell('C'.(9+$all_registers_counter))->setValue(date('d/m/Y',strtotime($ar->date_birth)));
            $worksheet->getCell('D'.(9+$all_registers_counter))->setValue($ar->place_birth);
            $worksheet->getCell('E'.(9+$all_registers_counter))->setValue($ar->father);
            $worksheet->getCell('F'.(9+$all_registers_counter))->setValue($ar->mother);
            $worksheet->getCell('G'.(9+$all_registers_counter))->setValue($ar->name);
            $worksheet->getCell('H'.(9+$all_registers_counter))->setValue($ar->street.', Qd.'.$ar->block.', Lt.'.$ar->land_lot.', Nº '.$ar->number.', '.$ar->neighborhood.', '.$ar->zipcode.', '.$ar->complement);
            $worksheet->getCell('I'.(9+$all_registers_counter))->setValue(date('d/m/Y',strtotime($ar->enrollment_date)));
            $worksheet->getCell('J'.(9+$all_registers_counter))->setValue($ar->institution_class);
            $worksheet->getCell('K'.(9+$all_registers_counter))->setValue($ar->enrollment_number);
            $worksheet->getCell('L'.(9+$all_registers_counter))->setValue($ar->student_id);

            $all_registers_counter++;
        }


        // Redirect output to a client’s web browser (Xlsx)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="all-registers-list.xlsx"');
        header('Cache-Control: max-age=0');
        // If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');

        // If you're serving to IE over SSL, then the following may be needed
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
        header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header('Pragma: public'); // HTTP/1.0

        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
    }
    public function ExportAllStudentsDataListToSheet($year)
    {
        $guard      = 'admins';
        
        $current_school_year = $year;

        $collaborator_id = Auth::user()->collaborator_id;

        $online_collaborator_data = $this->collaborator_repository->findWhere([
            'id'=> $collaborator_id
        ])->first();

        $online_collaborator_institution_id = $online_collaborator_data->institution_id;

        $online_institution_data  = $this->institution_repository->findWhere([
            'id'    => $online_collaborator_institution_id
        ])->first();

        //List all student registers
        $all_registers = DB::table('student_enrollments')
            ->join('students','student_enrollments.student_id','=','students.id')
            ->join('institution_classes','student_enrollments.institution_class_id','=','institution_classes.id')
            ->join('student_addresses','student_enrollments.student_id','=','student_addresses.student_id')
            ->join('student_cns','student_enrollments.student_id','=','student_cns.student_id')
            ->join('student_contacts','student_enrollments.student_id','=','student_contacts.student_id')
            ->join('genders','students.gender_id','=','genders.id')
            ->join('colors','students.color_id','=','colors.id')
            ->where('student_enrollments.enrollment_year',$current_school_year)
            ->select(
                'students.id',
                'students.name AS student_name',
                'students.date_birth',
                'students.place_birth',
                'students.father',
                'students.mother',
                'students.legal_responsable',
                'students.cpf AS student_cpf',
                'students.sus_number',
                'students.auth_image_use',
                'students.health_special_needs',
                'students.health_problem',
                'genders.gender',
                'colors.color',
                'student_enrollments.enrollment_code',
                'student_enrollments.enrollment_date',
                'student_enrollments.enrollment_number',
                'student_enrollments.transfer_date',
                'student_enrollments.transfer_type',
                'student_enrollments.degree_relatedness',
                'student_enrollments.name',
                'student_enrollments.cpf',
                'student_enrollments.rg',
                'student_enrollments.rg_emissor',
                'institution_classes.institution_class',
                'student_addresses.street',
                'student_addresses.block',
                'student_addresses.land_lot',
                'student_addresses.number',
                'student_addresses.neighborhood',
                'student_addresses.zipcode',
                'student_addresses.complement',
                'student_cns.matricula_cn',
                'student_cns.date_cn',
                'student_cns.termo',
                'student_cns.livro',
                'student_cns.folha',
                'student_contacts.phone1',
                'student_contacts.phone1_responsable',
                'student_contacts.phone2',
                'student_contacts.phone2_responsable',
                'student_contacts.phone3',
                'student_contacts.phone3_responsable',
            )
            ->orderBy('student_enrollments.institution_class_id','ASC')
            ->orderBy('students.name','ASC')
            ->get();
        $all_registers_counter = 1;


        //dd($all_registers);

        /*Export to sheet format*/

        $templatePath = substr(__DIR__, 0,24) . '/storage/templates/all-students-data-list-template.xlsx';
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($templatePath);

        $worksheet = $spreadsheet->getActiveSheet();

        $worksheet->getCell('B1')->setValue($online_institution_data->name);
        $worksheet->getCell('B2')->setValue($online_institution_data->city.'-'.$online_institution_data->state);

        foreach ($all_registers as $ar) {

            $worksheet->getCell('A'.(9+$all_registers_counter))->setValue($all_registers_counter);
            $worksheet->getCell('B'.(9+$all_registers_counter))->setValue($ar->student_name);
            $worksheet->getCell('C'.(9+$all_registers_counter))->setValue(date('d/m/Y',strtotime($ar->date_birth)));
            $worksheet->getCell('D'.(9+$all_registers_counter))->setValue(date('d/m/Y',strtotime($ar->enrollment_date)));
            if($ar->transfer_date == null){
                $worksheet->getCell('E'.(9+$all_registers_counter))->setValue('');
            } else{
                $worksheet->getCell('E'.(9+$all_registers_counter))->setValue(date('d/m/Y',strtotime($ar->transfer_date)));
            }
            
            $worksheet->getCell('F'.(9+$all_registers_counter))->setValue($ar->phone1);
            $worksheet->getCell('G'.(9+$all_registers_counter))->setValue($ar->phone2);
            $worksheet->getCell('H'.(9+$all_registers_counter))->setValue($ar->phone3);
            $worksheet->getCell('I'.(9+$all_registers_counter))->setValue($ar->phone1_responsable);
            $worksheet->getCell('J'.(9+$all_registers_counter))->setValue($ar->phone2_responsable);
            $worksheet->getCell('K'.(9+$all_registers_counter))->setValue($ar->phone3_responsable);
            $worksheet->getCell('L'.(9+$all_registers_counter))->setValue($ar->student_cpf);
            $worksheet->getCell('M'.(9+$all_registers_counter))->setValue($ar->father);
            $worksheet->getCell('N'.(9+$all_registers_counter))->setValue($ar->mother);
            $worksheet->getCell('O'.(9+$all_registers_counter))->setValue($ar->legal_responsable);
            $worksheet->getCell('P'.(9+$all_registers_counter))->setValue($ar->color);
            $worksheet->getCell('Q'.(9+$all_registers_counter))->setValue($ar->gender);
            $worksheet->getCell('R'.(9+$all_registers_counter))->setValue($ar->folha);
            $worksheet->getCell('S'.(9+$all_registers_counter))->setValue($ar->livro);
            $worksheet->getCell('T'.(9+$all_registers_counter))->setValue($ar->termo);
            $worksheet->getCell('U'.(9+$all_registers_counter))->setValue($ar->date_cn);
            $worksheet->getCell('V'.(9+$all_registers_counter))->setValue($ar->place_birth);
            $worksheet->getCell('W'.(9+$all_registers_counter))->setValue($ar->matricula_cn);
            $worksheet->getCell('X'.(9+$all_registers_counter))->setValue($ar->sus_number);
            $worksheet->getCell('Y'.(9+$all_registers_counter))->setValue($ar->health_special_needs);
            $worksheet->getCell('Z'.(9+$all_registers_counter))->setValue($ar->health_problem);
            $worksheet->getCell('AA'.(9+$all_registers_counter))->setValue($ar->street);
            $worksheet->getCell('AB'.(9+$all_registers_counter))->setValue($ar->block);
            $worksheet->getCell('AC'.(9+$all_registers_counter))->setValue($ar->land_lot);
            $worksheet->getCell('AD'.(9+$all_registers_counter))->setValue($ar->number);
            $worksheet->getCell('AE'.(9+$all_registers_counter))->setValue($ar->neighborhood);
            $worksheet->getCell('AF'.(9+$all_registers_counter))->setValue($ar->zipcode);
            $worksheet->getCell('AG'.(9+$all_registers_counter))->setValue($ar->complement);
            $worksheet->getCell('AH'.(9+$all_registers_counter))->setValue($ar->name);
            $worksheet->getCell('AI'.(9+$all_registers_counter))->setValue($ar->cpf);
            $worksheet->getCell('AJ'.(9+$all_registers_counter))->setValue($ar->rg.' - '.$ar->rg_emissor);
            $worksheet->getCell('AK'.(9+$all_registers_counter))->setValue($ar->degree_relatedness);
            $worksheet->getCell('AL'.(9+$all_registers_counter))->setValue($ar->enrollment_number);
            $worksheet->getCell('AM'.(9+$all_registers_counter))->setValue($ar->enrollment_code);

            if($ar->transfer_type == null){
                $worksheet->getCell('AN'.(9+$all_registers_counter))->setValue('MAT');
            } else {
                $worksheet->getCell('AN'.(9+$all_registers_counter))->setValue($ar->transfer_type);
            }

            if($ar->auth_image_use == 'off') {
                $worksheet->getCell('AO'.(9+$all_registers_counter))->setValue('Não');
            } elseif ($ar->auth_image_use == 'on') {
                $worksheet->getCell('AO'.(9+$all_registers_counter))->setValue('Sim');
            } else{
                $worksheet->getCell('AO'.(9+$all_registers_counter))->setValue('');
            }

            $worksheet->getCell('AP'.(9+$all_registers_counter))->setValue($ar->institution_class);

            $all_registers_counter++;
        }


        // Redirect output to a client’s web browser (Xlsx)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="all-registers-data-list.xlsx"');
        header('Cache-Control: max-age=0');
        // If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');

        // If you're serving to IE over SSL, then the following may be needed
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
        header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header('Pragma: public'); // HTTP/1.0

        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
    }

    public function ExportClassListDataSheet($year,$class_id)
    {
        $guard      = 'admins';
        
        $current_school_year = $year;

        $collaborator_id = Auth::user()->collaborator_id;

        $online_collaborator_data = $this->collaborator_repository->findWhere([
            'id'=> $collaborator_id
        ])->first();

        $online_collaborator_institution_id = $online_collaborator_data->institution_id;

        $online_institution_data  = $this->institution_repository->findWhere([
            'id'    => $online_collaborator_institution_id
        ])->first();

        $class_data = DB::table('institution_classes')
            ->join('grades','institution_classes.grade_id','=','grades.id')
            ->join('scholarities','grades.scholarity_id','=','scholarities.id')
            ->where('institution_classes.id','=',$class_id)
            ->select('institution_classes.institution_class','institution_classes.school_shifts','grades.beginnig_age','scholarities.scholarity')
            ->first();

        $students_data = DB::table('students')
            ->join('student_contacts', 'students.id', '=', 'student_contacts.student_id')
            ->join('student_enrollments', 'students.id', '=', 'student_enrollments.student_id')
            ->where('student_enrollments.institution_class_id', $class_id)
            ->where('student_enrollments.enrollment_year',$current_school_year)
            ->where('student_contacts.enrollment_year',$current_school_year)
            ->orderBy('students.name','ASC')
            ->select(
                'students.name','students.date_birth','students.gender_id','students.cpf','student_enrollments.enrollment_date', 'student_enrollments.transfer_date',
                'student_contacts.phone1','student_contacts.phone2','student_contacts.phone3'
            )->get();


        /*Export to sheet format*/

        $templatePath = substr(__DIR__, 0,24) . '/storage/templates/class-list-template.xlsx';
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($templatePath);

        $worksheet = $spreadsheet->getActiveSheet();

        $worksheet->getCell('B1')->setValue($online_institution_data->name);
        $worksheet->getCell('B2')->setValue($online_institution_data->city.'-'.$online_institution_data->state);
        $worksheet->getCell('A6')->setValue($class_data->institution_class.' - '.$class_data->beginnig_age.' anos');
        $worksheet->getCell('A7')->setValue($class_data->scholarity.' - '.$class_data->school_shifts);

        $transfered_students = 0;
        $male = 0;
        $female = 0;

        for ($i=0; $i < count($students_data); $i++) { 
            $worksheet->getCell('B'.($i+10))->setValue($students_data[$i]->name);
            $worksheet->getCell('C'.($i+10))->setValue(date('d/m/Y',strtotime($students_data[$i]->date_birth)));
            $worksheet->getCell('D'.($i+10))->setValue(date('d/m/Y',strtotime($students_data[$i]->enrollment_date)));

            if ($students_data[$i]->transfer_date == null) {
                $worksheet->getCell('E'.($i+10))->setValue("");

                if($students_data[$i]->gender_id == 1){
                    $male++;
                }else{
                    if($students_data[$i]->gender_id == 2){
                        $female++;
                    }
                }
            } else{
                $worksheet->getCell('E'.($i+10))->setValue(date('d/m/Y',strtotime($students_data[$i]->transfer_date)));
                $transfered_students++;
            }

            $worksheet->getCell('F'.($i+10))->setValue($students_data[$i]->phone1);
            $worksheet->getCell('G'.($i+10))->setValue($students_data[$i]->phone2);
            $worksheet->getCell('H'.($i+10))->setValue($students_data[$i]->phone3);
            //formatting cpf
            if($students_data[$i]->cpf){
                $part1 = substr($students_data[$i]->cpf,0,3);
                $part2 = substr($students_data[$i]->cpf,3,3);
                $part3 = substr($students_data[$i]->cpf,6,3);
                $part4 = substr($students_data[$i]->cpf,-2);
                $formatted_cpf = $part1.'.'.$part2.'.'.$part3.'-'.$part4;
                $worksheet->getCell('I'.($i+10))->setValue($formatted_cpf);
            }else{
                $worksheet->getCell('I'.($i+10))->setValue('');
            }
            
        }
        $worksheet->getCell('C49')->setValue($male);
        $worksheet->getCell('C50')->setValue($female);
        $worksheet->getCell('F49')->setValue((count($students_data)-$transfered_students));
        $worksheet->getCell('F50')->setValue($transfered_students);
        // Redirect output to a client’s web browser (Xlsx)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="class-list-"'.$class_data->institution_class.'".xlsx"');
        header('Cache-Control: max-age=0');
        // If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');

        // If you're serving to IE over SSL, then the following may be needed
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
        header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header('Pragma: public'); // HTTP/1.0

        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
    }

    public function ExportStudentDataExcel($id,$year)
    {
        $guard      = 'admins';
        $page_title = 'Dados';

        $collaborator_id = Auth::user()->collaborator_id;

        $online_collaborator_data = $this->collaborator_repository->findWhere([
            'id'=> $collaborator_id
        ])->first();

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

        $student_data = DB::table('students')
            ->join('student_addresses', 'students.id', '=', 'student_addresses.student_id')
            ->join('student_cns', 'students.id', '=', 'student_cns.student_id')
            ->join('student_contacts', 'students.id', '=', 'student_contacts.student_id')
            ->join('student_enrollments', 'students.id', '=', 'student_enrollments.student_id')
            ->join('genders', 'students.gender_id', '=', 'genders.id')
            ->join('colors', 'students.color_id', '=', 'colors.id')
            ->where('students.id', $id)
            ->where('student_addresses.enrollment_year',$year)
            ->where('student_contacts.enrollment_year',$year)
            ->select(
                'students.id','students.name','students.date_birth','students.place_birth','students.mother','students.father', 'students.legal_responsable','students.email', 'students.cpf', 'students.sus_number','students.auth_image_use', 'students.health_special_needs','students.health_problem',
                'student_addresses.street','student_addresses.block','student_addresses.land_lot', 'student_addresses.number','student_addresses.neighborhood', 'student_addresses.zipcode','student_addresses.complement',
                'student_cns.matricula_cn','student_cns.date_cn','student_cns.termo','student_cns.livro','student_cns.folha',
                'student_contacts.phone1','student_contacts.phone1_responsable','student_contacts.phone2','student_contacts.phone2_responsable','student_contacts.phone3','student_contacts.phone3_responsable','genders.gender','colors.color'
            )->first();
        $student_enrollment_data = DB::table('student_enrollments')
            ->join('institution_classes', 'student_enrollments.institution_class_id', '=', 'institution_classes.id')
            ->join('enrollment_statuses', 'student_enrollments.enrollment_status_id', '=', 'enrollment_statuses.id')
            ->where('student_enrollments.student_id', $id)
            ->where('student_enrollments.enrollment_year',$year)
            ->select(
                'student_enrollments.enrollment_code','student_enrollments.enrollment_number','student_enrollments.enrollment_date','student_enrollments.enrollment_year','student_enrollments.degree_relatedness','student_enrollments.name','student_enrollments.cpf','student_enrollments.rg','student_enrollments.rg_emissor','student_enrollments.collaborator_id','institution_classes.institution_class','enrollment_statuses.enrollment_status'
            )->first();
        $student_enrollment_collaborator  = $this->collaborator_repository->findWhere([
            'id'    => $student_enrollment_data->collaborator_id
        ])->first();

        $data = [
            'guard'                             => $guard,
            'title'                             => $page_title,
            'online_collaborator_name'          => $online_collaborator_data->name,
            'online_institution_name'           => $online_institution_data->name,
            'student_data'                      => $student_data,
            'student_enrollment_data'           => $student_enrollment_data,
            'student_enrollment_collaborator'   => $student_enrollment_collaborator
        ];

        /*Export to sheet format*/
      
        //$templatePath = substr(__DIR__, 0,24) . $_ENV['EXCEL_TEMPLATES_PATH'] . 'enrollment-template.xlsx';
        $templatePath = substr(__DIR__, 0,24) . '/storage/templates/enrollment-template.xlsx';
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($templatePath);

        $worksheet = $spreadsheet->getActiveSheet();
        $worksheet->getCell('D1')->setValue($online_institution_data->name);
        $worksheet->getCell('D2')->setValue($online_institution_data->city.'-'.$online_institution_data->state);
        $worksheet->getCell('A6')->setValue($student_data->name);
        $worksheet->getCell('F8')->setValue(date("d/m/Y", strtotime($student_data->date_birth)));
        $worksheet->getCell('H8')->setValue('Naturalidade: ' . $student_data->place_birth);
        $worksheet->getCell('D9')->setValue($student_data->gender);
        $worksheet->getCell('J9')->setValue($student_data->cpf);
        $worksheet->getCell('U9')->setValue($student_data->color);
        $worksheet->getCell('A10')->setValue('Mãe: ' . $student_data->mother);
        $worksheet->getCell('A11')->setValue('Pai: ' . $student_data->father);
        $worksheet->getCell('A12')->setValue('Responsável Legal: ' . $student_data->legal_responsable);
        $worksheet->getCell('F16')->setValue($student_data->matricula_cn);
        $worksheet->getCell('D17')->setValue($student_data->termo);
        $worksheet->getCell('G17')->setValue($student_data->livro);
        $worksheet->getCell('M17')->setValue($student_data->folha);
        $worksheet->getCell('V17')->setValue(date("d/m/Y", strtotime($student_data->date_cn)));
        $worksheet->getCell('A21')->setValue('Cartão do SUS: ' . $student_data->sus_number);
        $worksheet->getCell('A22')->setValue('Necessidades Especiais: ' . $student_data->health_special_needs);
        $worksheet->getCell('A23')->setValue('Problema de Saúde: ' . $student_data->health_problem);
        $worksheet->getCell('C27')->setValue($student_data->street);
        $worksheet->getCell('D28')->setValue($student_data->block);
        $worksheet->getCell('G28')->setValue($student_data->land_lot);
        $worksheet->getCell('L28')->setValue($student_data->neighborhood);
        $worksheet->getCell('C29')->setValue($student_data->zipcode);
        $worksheet->getCell('A30')->setValue('Complemento: ' . $student_data->complement);
        $worksheet->getCell('E36')->setValue($student_enrollment_data->name);
        $worksheet->getCell('C37')->setValue($student_enrollment_data->cpf);
        $worksheet->getCell('G37')->setValue($student_enrollment_data->rg . '-' . $student_enrollment_data->rg_emissor);
        $worksheet->getCell('H38')->setValue($student_enrollment_data->degree_relatedness);
        $worksheet->getCell('D42')->setValue($student_enrollment_data->enrollment_code);
        $worksheet->getCell('N42')->setValue(date("d/m/Y", strtotime($student_enrollment_data->enrollment_date)));
        $worksheet->getCell('D43')->setValue($student_enrollment_data->institution_class);
        $worksheet->getCell('G43')->setValue($student_enrollment_data->enrollment_year);
        $worksheet->getCell('Q43')->setValue($student_enrollment_data->enrollment_number);
        $worksheet->getCell('G44')->setValue($student_enrollment_collaborator->name);
        $worksheet->getCell('D48')->setValue($student_data->phone1);
        $worksheet->getCell('G48')->setValue('Responsável pelo Tel.1: ' . $student_data->phone1_responsable);
        $worksheet->getCell('D49')->setValue($student_data->phone2);
        $worksheet->getCell('G49')->setValue('Responsável pelo Tel.2: ' . $student_data->phone2_responsable);
        $worksheet->getCell('D50')->setValue($student_data->phone3);
        $worksheet->getCell('G50')->setValue('Responsável pelo Tel.3: ' . $student_data->phone3_responsable);

        // Redirect output to a client’s web browser (Xlsx)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="enrollment.xlsx"');
        header('Cache-Control: max-age=0');
        // If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');

        // If you're serving to IE over SSL, then the following may be needed
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
        header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header('Pragma: public'); // HTTP/1.0

        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
    }

    public function PrintStudentEnrollment($id,$year)
    {
        $guard      = 'admins';
        $page_title = 'Dados';

        $collaborator_id = Auth::user()->collaborator_id;

        $online_collaborator_data = $this->collaborator_repository->findWhere([
            'id'=> $collaborator_id
        ])->first();

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
        
        $student_data = DB::table('students')
            ->join('student_addresses', 'students.id', '=', 'student_addresses.student_id')
            ->join('student_cns', 'students.id', '=', 'student_cns.student_id')
            ->join('student_contacts', 'students.id', '=', 'student_contacts.student_id')
            ->join('student_enrollments', 'students.id', '=', 'student_enrollments.student_id')
            ->join('colors', 'students.color_id', '=', 'colors.id')
            ->join('genders', 'students.gender_id', '=', 'genders.id')
            ->where('students.id', $id)
            ->where('student_addresses.enrollment_year',$year)
            ->where('student_contacts.enrollment_year',$year)
            ->select(
                'students.id','students.name','students.date_birth','students.place_birth','students.mother','students.father', 'students.legal_responsable','students.email', 'students.cpf', 'students.sus_number','students.auth_image_use', 'students.health_special_needs','students.health_problem',
                'student_addresses.street','student_addresses.block','student_addresses.land_lot', 'student_addresses.number','student_addresses.neighborhood', 'student_addresses.zipcode','student_addresses.complement',
                'student_cns.matricula_cn','student_cns.date_cn','student_cns.termo','student_cns.livro','student_cns.folha',
                'student_contacts.phone1','student_contacts.phone1_responsable','student_contacts.phone2','student_contacts.phone2_responsable','student_contacts.phone3','student_contacts.phone3_responsable','colors.color', 'genders.gender'
            )->first();
        $student_enrollment_data = DB::table('student_enrollments')
            ->join('institution_classes', 'student_enrollments.institution_class_id', '=', 'institution_classes.id')
            ->join('enrollment_statuses', 'student_enrollments.enrollment_status_id', '=', 'enrollment_statuses.id')
            ->where('student_enrollments.student_id', $id)
            ->where('student_enrollments.enrollment_year',$year)
            ->select(
                'student_enrollments.enrollment_code','student_enrollments.enrollment_number','student_enrollments.enrollment_date','student_enrollments.enrollment_year','student_enrollments.degree_relatedness','student_enrollments.name','student_enrollments.cpf','student_enrollments.rg','student_enrollments.rg_emissor','student_enrollments.collaborator_id','institution_classes.institution_class','enrollment_statuses.enrollment_status'
            )->first();
        $student_enrollment_collaborator  = $this->collaborator_repository->findWhere([
            'id'    => $student_enrollment_data->collaborator_id
        ])->first();

        $data = [
            'guard'                             => $guard,
            'title'                             => $page_title,
            'online_collaborator_name'          => $online_collaborator_data->name,
            'online_institution_name'           => $online_institution_data->name,
            'online_institution_city'           => $online_institution_data->city,
            'online_institution_state'          => $online_institution_data->state,
            'student_data'                      => $student_data,
            'student_enrollment_data'           => $student_enrollment_data,
            'student_enrollment_collaborator'   => $student_enrollment_collaborator
        ];
        return view('admins.enrollment',$data);
    }

    public function PrintStudentDeclaration($id, $year, $type){
        $guard = 'admins';
        $page_title = 'Declarações';

        $collaborator_id = Auth::user()->collaborator_id;

        $online_collaborator_data = $this->collaborator_repository->findWhere([
            'id'=> $collaborator_id
        ])->first();

        $online_collaborator_job_data = DB::table('collaborator_jobs')
            ->join('jobs','collaborator_jobs.job_id','=','jobs.id')
            ->where('collaborator_jobs.collaborator_id', $collaborator_id)
            ->select('jobs.office')->first();
        
        $student_data = DB::table('students')
            ->join('genders', 'students.gender_id', '=', 'genders.id')
            ->where('students.id', $id)
            ->select(
                'students.name','students.date_birth','students.place_birth','students.mother','students.father','genders.gender'
            )->first();
        $student_enrollment_data = DB::table('student_enrollments')
            ->join('institution_classes', 'student_enrollments.institution_class_id', '=', 'institution_classes.id')
            ->join('enrollment_statuses', 'student_enrollments.enrollment_status_id', '=', 'enrollment_statuses.id')
            ->where('student_enrollments.student_id', $id)
            ->where('student_enrollments.enrollment_year',$year)
            ->select(
                'student_enrollments.id','institution_classes.institution_class','institution_classes.school_shifts','institution_classes.grade_id'
            )->first();
        $student_enrollment_id = $student_enrollment_data->id;

        //verify if the transfer statement is for school year ending, and select the next class
        if ($type == 'TRF1') {
            $next_institution_class_query  = DB::table('grades')
                ->join('institution_classes','grades.id', '=','institution_classes.grade_id')
                ->where('grades.id',intval($student_enrollment_data->grade_id)+1)
                ->select(
                    'grades.grade'
                )->first();
            $next_institution_class = $next_institution_class_query->grade;
            //dd($student_data,$student_enrollment_data,$next_institution_class_query);
            //do the transfering process
            $transfer_data = [
                'transfer_date'         => date('Y-m-d'),
                'transfer_type'         => 'TRF',
                'enrollment_status_id'  => '2'
            ];
            
            $request = $this->student_service->updateStudentEnrollments($transfer_data,$student_enrollment_id);

            session()->flash('success', [
                'success'    => $request['success'],
                'messages'   => $request['messages']
            ]);
        }else{
            if ($type == 'TRF2') {
                $next_institution_class_query  = DB::table('grades')
                    ->join('institution_classes','grades.id', '=','institution_classes.grade_id')
                    ->where('grades.id',$student_enrollment_data->grade_id)
                    ->select(
                        'grades.grade'
                    )->first();
                $next_institution_class = $next_institution_class_query->grade;

                //do the transfering process
                $transfer_data = [
                    'transfer_date'         => date('Y-m-d'),
                    'transfer_type'         => 'TRF',
                    'enrollment_status_id'  => '2'
                ];
                
                $request = $this->student_service->updateStudentEnrollments($transfer_data,$student_enrollment_id);

                session()->flash('success', [
                    'success'    => $request['success'],
                    'messages'   => $request['messages']
                ]);
            }else{
                $next_institution_class = $student_enrollment_data->institution_class;
            }
        }
        $online_collaborator_institution_id = $online_collaborator_data->institution_id;
        $online_institution_data  = $this->institution_repository->findWhere([
            'id'    => $online_collaborator_institution_id
        ])->first();
        
        //dd($online_institution_logo);
        $data = [
            'guard'                             => $guard,
            'current_school_year'               => $year,
            'title'                             => $page_title,
            'statement_type'                    => $type,
            'next_institution_class'            => $next_institution_class,
            'student_data'                      => $student_data,
            'student_enrollment_data'           => $student_enrollment_data,
            'online_collaborator_name'          => $online_collaborator_data->name,
            'online_collaborator_office'        => $online_collaborator_job_data->office,
            'online_institution_name'           => $online_institution_data->name,
            'online_institution_inep'           => $online_institution_data->inep_number,
            'online_institution_phone'          => $online_institution_data->phone,
            'online_institution_address'        => $online_institution_data->address,
            'online_institution_email'          => $online_institution_data->email,
            'online_institution_city_state'     => $online_institution_data->city.'-'.$online_institution_data->state,
            'online_institution_state'          => $online_institution_data->state
        ];
        //dd($data);
        return view('admins.declaration', $data);
    }

    public function ShowStudentDataC($year,Request $request)
    {

        $code = $request['enrollment_code'];
        $guard      = 'admins';
        $page_title = 'Dados';

        $collaborator_id = Auth::user()->collaborator_id;
        $current_school_year = $year;

        $online_collaborator_data = $this->collaborator_repository->findWhere([
            'id'=> $collaborator_id
        ])->first();

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

        $student_data = DB::table('students')
            ->join('student_addresses', 'students.id', '=', 'student_addresses.student_id')
            ->join('student_cns', 'students.id', '=', 'student_cns.student_id')
            ->join('student_contacts', 'students.id', '=', 'student_contacts.student_id')
            ->join('student_enrollments', 'students.id', '=', 'student_enrollments.student_id')
            ->where('student_enrollments.enrollment_code', $code)
            ->select(
                'students.id','students.name','students.date_birth','students.place_birth','students.mother','students.father', 'students.legal_responsable','students.email', 'students.cpf', 'students.sus_number','students.auth_image_use', 'students.health_special_needs','students.health_problem',
                'student_addresses.street','student_addresses.block','student_addresses.land_lot', 'student_addresses.number','student_addresses.neighborhood', 'student_addresses.zipcode','student_addresses.complement',
                'student_cns.matricula_cn','student_cns.date_cn','student_cns.termo','student_cns.livro','student_cns.folha',
                'student_contacts.phone1','student_contacts.phone1_responsable','student_contacts.phone2','student_contacts.phone2_responsable','student_contacts.phone3','student_contacts.phone3_responsable'
            )->first();
        $student_enrollment_data = DB::table('student_enrollments')
            ->join('institution_classes', 'student_enrollments.institution_class_id', '=', 'institution_classes.id')
            ->join('enrollment_statuses', 'student_enrollments.enrollment_status_id', '=', 'enrollment_statuses.id')
            ->where('student_enrollments.enrollment_code', $code)
            ->select(
                'student_enrollments.enrollment_code','student_enrollments.enrollment_date','student_enrollments.enrollment_year','student_enrollments.degree_relatedness','student_enrollments.name','student_enrollments.cpf','student_enrollments.rg','student_enrollments.rg_emissor','student_enrollments.collaborator_id','institution_classes.institution_class','enrollment_statuses.enrollment_status'
            )->first();
        $student_enrollment_collaborator  = $this->collaborator_repository->findWhere([
            'id'    => $student_enrollment_data->collaborator_id
        ])->first();

        //find the admin id
        $admin_data = $this->repository->findWhere([
            'collaborator_id'   => $collaborator_id,
            'email'             => Auth::user()->email
        ])->first();
        $admin_id = $admin_data->id;

        //find the admin type
        $admin_type_choice_data = $this->admin_type_choice_repository->findWhere([
            'admin_id' => $admin_id
        ])->first();

        $admin_type_data = DB::table('admin_types')
            ->where('id', $admin_type_choice_data->admin_type_id)
            ->select('admin_type')
            ->first();

        return view('admins.show-student-data',[
            'current_school_year'                => $current_school_year,
            'guard'                              => $guard, 
            'title'                              => $page_title,
            'online_collaborator_name'           => $online_collaborator_data->name,
            'online_collaborator_institution_id' => $online_collaborator_institution_id,
            'online_institution_name'            => $online_institution_data->name,
            'all_school_years'                   => $all_school_years,
            'online_collaborator_id'             => $collaborator_id,
            'student_data'                       => $student_data,
            'student_enrollment_data'            => $student_enrollment_data,
            'student_enrollment_collaborator'    => $student_enrollment_collaborator,
            'admin_type_data'                    => $admin_type_data->admin_type
        ]);
    }

    public function ShowClassStudents($year,$class_id)
    {
        $guard      = 'admins';
        $page_title = 'Turma';

        $genders  = $this->gender_repository->all();
        $colors   = $this->color_repository->all();
        $grades   = $this->grade_repository->all();

        $collaborator_id = Auth::user()->collaborator_id;
        $current_school_year = $year;

        $online_collaborator_data = $this->collaborator_repository->findWhere([
            'id'=> $collaborator_id
        ])->first();

        $online_collaborator_institution_id = $online_collaborator_data->institution_id;

        $school_years = $this->school_year_repository->findWhere([
            'institution_id'     => $online_collaborator_institution_id,
            'school_year_status' => 'active'
        ])->first();

        $all_school_years = $this->school_year_repository->findWhere([
            'institution_id' => $online_collaborator_institution_id
        ])->all();

        $online_institution_data  = $this->institution_repository->findWhere([
            'id'    => $online_collaborator_institution_id
        ])->first();

        $students_data = DB::table('students')
            ->join('student_contacts', 'students.id', '=', 'student_contacts.student_id')
            ->join('student_enrollments', 'students.id', '=', 'student_enrollments.student_id')
            ->where('student_enrollments.institution_class_id', $class_id)
            ->where('student_enrollments.enrollment_year',$current_school_year)
            ->where('student_contacts.enrollment_year',$current_school_year)
            ->where('student_enrollments.enrollment_status_id','1')
            ->orderBy('students.name','ASC')
            ->select(
                'students.id','students.name','students.date_birth',
                'student_contacts.phone1','student_contacts.phone2','student_enrollments.enrollment_date','student_enrollments.enrollment_status_id','student_enrollments.institution_class_id'
            )->get();

        $inactive_students_data = DB::table('students')
            ->join('student_contacts', 'students.id', '=', 'student_contacts.student_id')
            ->join('student_enrollments', 'students.id', '=', 'student_enrollments.student_id')
            ->where('student_enrollments.institution_class_id', $class_id)
            ->where('student_enrollments.enrollment_year',$current_school_year)
            ->where('student_contacts.enrollment_year',$current_school_year)
            ->where('student_enrollments.enrollment_status_id','2')
            ->orderBy('students.name','ASC')
            ->select(
                'students.id','students.name','students.date_birth',
                'student_contacts.phone1','student_contacts.phone2','student_enrollments.enrollment_date','student_enrollments.enrollment_status_id','student_enrollments.institution_class_id'
            )->get();

        $student_counter = 1;
        $inactive_student_counter = 1;

        $school_year_id = $this->school_year_repository->findWhere([
            'institution_id'    => $online_collaborator_institution_id,
            'year'              => $year
        ])->first();


        $institution_classes = DB::table('institution_classes')
            ->where('institution_id', $online_collaborator_institution_id)
            ->where('school_year_id', $school_year_id->id)
            ->orderBy('grade_id','ASC')
            ->get();

        $i=0;
        $classes_amount = array();
        //find the amount of students of each class
        foreach ($institution_classes as $ic) {
            $amount = DB::table('student_enrollments')
                ->join('students','student_enrollments.student_id','=','students.id')
                ->join('institution_classes','student_enrollments.institution_class_id','=','institution_classes.id')
                ->where('student_enrollments.enrollment_year',$current_school_year)
                ->where('student_enrollments.enrollment_status_id',1)
                ->where('student_enrollments.institution_class_id',$ic->id)
                ->select('students.id','students.name','student_enrollments.enrollment_date','institution_classes.institution_class')
                ->get();
            $class_name = DB::table('institution_classes')
                ->where('id','=',$ic->id)
                ->select('institution_class')
                ->first();
            array_push($classes_amount,[
                'id'  => $ic->id,
                'institution_class'     => $class_name->institution_class,
                'amount'                => count($amount)
            ]);
        }

        $current_institution_class = DB::table('institution_classes')
            ->where('id',$class_id)
            ->select('institution_class')
            ->first();

        //find the admin id
        $admin_data = $this->repository->findWhere([
            'collaborator_id'   => $collaborator_id,
            'email'             => Auth::user()->email
        ])->first();
        $admin_id = $admin_data->id;

        //find the admin type
        $admin_type_choice_data = $this->admin_type_choice_repository->findWhere([
            'admin_id' => $admin_id
        ])->first();

        $admin_type_data = DB::table('admin_types')
            ->where('id', $admin_type_choice_data->admin_type_id)
            ->select('admin_type')
            ->first();

        $waiting_list = DB::table('student_waiting_lists')
            ->where('institution_class_id',$class_id)
            ->select('id','candidate_name','responsable','phone','created_at')
            ->orderBy('created_at','ASC')
            ->get();

        //find the schedule
        $schedule = DB::table('institution_class_schedules')
            ->join('curricular_components','institution_class_schedules.curricular_component_id','=','curricular_components.id')
            ->where('institution_class_schedules.institution_class_id', $class_id)
            ->where('institution_class_schedules.institution_id',$online_collaborator_institution_id)
            ->where('institution_class_schedules.school_year_id',$school_year_id->id)
            ->select(
                'institution_class_schedules.id',
                'institution_class_schedules.curricular_component_id',
                'curricular_components.component',
                'institution_class_schedules.sequence'
            )
            ->get();

        $curricular_components = DB::table('curricular_components')
            ->where('year',$current_school_year)
            ->where('institution_id',$online_collaborator_institution_id)
            ->select('id','component')
            ->get();

        $teachers_data = DB::table('teachers')
            ->join('collaborators','teachers.collaborator_id','=','collaborators.id')
            ->where('collaborators.institution_id','=',$online_collaborator_institution_id)
            ->where('collaborators.collaborator_status','=','Active')
            ->select('teachers.id','teachers.name')
            ->orderBy('teachers.name','ASC')
            ->get();
        $teacher_classes_list = DB::table('teacher_classes')
            ->join('teachers','teachers.id','=','teacher_classes.teacher_id')
            ->join('curricular_components','curricular_components.id','=','teacher_classes.curricular_component_id')
            ->where('teacher_classes.institution_id','=',$online_collaborator_institution_id)
            ->where('teacher_classes.institution_class_id', $class_id)
            ->select('teachers.id','teachers.name','curricular_components.component')
            ->get();

        return view('admins.show-class-students',[
            'current_school_year'                => $current_school_year,
            'guard'                              => $guard, 
            'title'                              => $page_title,
            'online_collaborator_name'           => $online_collaborator_data->name,
            'online_collaborator_institution_id' => $online_collaborator_institution_id,
            'online_institution_name'            => $online_institution_data->name,
            'all_school_years'                   => $all_school_years,
            'online_collaborator_id'             => $collaborator_id,
            'students_data'                      => $students_data,
            'counter'                            => $student_counter,
            'inactive_students_data'             => $inactive_students_data,
            'inactive_students_counter'          => $inactive_student_counter,
            'genders'                            => $genders,
            'colors'                             => $colors,
            'all_institution_classes'            => $institution_classes,
            'current_institution_class'          => $current_institution_class->institution_class,
            'current_institution_class_id'       => $class_id,
            'admin_type_data'                    => $admin_type_data->admin_type,
            'each_class_amount'                  => $classes_amount,
            'waiting_list_data'                  => $waiting_list,
            'schedule'                           => $schedule,
            'curricular_components'              => $curricular_components,
            'school_year_id'                     => $school_year_id,
            'teachers'                           => $teachers_data,
            'teacher_classes_list'               => $teacher_classes_list
        ]);
    }

    /*
     * ===========================================================================
     * Collaborator Enrollment Methods
     * ===========================================================================
     */

    public function storeCollaborator($year,CollaboratorCreateRequest $request)
    {
        $request                  = $this->collaborator_service->store($request->all());
        $stored_collaborator      = $request['success'] ? $request['data'] : null;
        $stored_collaborator_id   = $request['stored-collaborator-id'];
        $stored_collaborator_name = $request['stored-collaborator-name'];

        session()->flash('success', [
            'success'      => $request['success'],
            'messages'     => $request['messages']
            
        ]);
        $guard      = 'admins';
        $page_title = 'Novo Colaborador';

        $collaborator_id = Auth::user()->collaborator_id;
        $current_school_year = $year;

        //Database searches
        $admin                    = $this->repository->all();
        $institution_classes      = $this->institution_class_repository->all();

        $online_collaborator_data = $this->collaborator_repository->findWhere([
            'id'=> $collaborator_id
        ])->first();

        $online_collaborator_institution_id = $online_collaborator_data->institution_id;

        $school_years = $this->school_year_repository->findWhere([
            'institution_id'     => $online_collaborator_institution_id,
            'school_year_status' => 'active'
        ])->first();

        $all_school_years = $this->school_year_repository->findWhere([
            'institution_id' => $online_collaborator_institution_id
        ])->all();

        $online_institution_data  = $this->institution_repository->findWhere([
            'id'    => $online_collaborator_institution_id
        ])->first();

        //find the admin id
        $admin_data = $this->repository->findWhere([
            'collaborator_id'   => $collaborator_id,
            'email'             => Auth::user()->email
        ])->first();
        $admin_id = $admin_data->id;

        //find the admin type
        $admin_type_choice_data = $this->admin_type_choice_repository->findWhere([
            'admin_id' => $admin_id
        ])->first();

        $admin_type_data = DB::table('admin_types')
            ->where('id', $admin_type_choice_data->admin_type_id)
            ->select('admin_type')
            ->first();

        return view('admins.store-collaborator-address',[
            'current_school_year'                => $current_school_year,
            'guard'                              => $guard, 
            'title'                              => $page_title,
            'online_collaborator_name'           => $online_collaborator_data->name,
            'online_collaborator_institution_id' => $online_collaborator_institution_id,
            'online_institution_name'            => $online_institution_data->name,
            'stored_collaborator_id'             => $stored_collaborator_id,
            'stored_collaborator_name'           => $stored_collaborator_name,
            'all_school_years'                   => $all_school_years,
            'online_collaborator_id'             => $collaborator_id,
            'admin_type_data'                    => $admin_type_data->admin_type
        ]);
    }


    public function storeCollaboratorAddress($year,CollaboratorAddressCreateRequest $request)
    {
        $request                  = $this->collaborator_service->storeCollaboratorAddress($request->all());
        $stored_collaborator      = $request['success'] ? $request['data'] : null;
        $stored_collaborator_id   = $request['stored-collaborator-id'];
        $stored_collaborator_name = $request['stored-collaborator-name'];

        session()->flash('success', [
            'success'      => $request['success'],
            'messages'     => $request['messages']
        ]);

        $collaborator_id = Auth::user()->collaborator_id;
        $current_school_year = $year;

        $online_collaborator_data = $this->collaborator_repository->findWhere([
            'id'=> $collaborator_id
        ])->first();

        $online_collaborator_institution_id = $online_collaborator_data->institution_id;

        $school_years = $this->school_year_repository->findWhere([
            'institution_id'     => $online_collaborator_institution_id,
            'school_year_status' => 'active'
        ])->first();

        $all_school_years = $this->school_year_repository->findWhere([
            'institution_id'       => $online_collaborator_institution_id
        ])->all();

        $online_institution_data  = $this->institution_repository->findWhere([
            'id'    => $online_collaborator_institution_id
        ])->first();

        //find the admin id
        $admin_data = $this->repository->findWhere([
            'collaborator_id'   => $collaborator_id,
            'email'             => Auth::user()->email
        ])->first();
        $admin_id = $admin_data->id;

        //find the admin type
        $admin_type_choice_data = $this->admin_type_choice_repository->findWhere([
            'admin_id' => $admin_id
        ])->first();

        $admin_type_data = DB::table('admin_types')
            ->where('id', $admin_type_choice_data->admin_type_id)
            ->select('admin_type')
            ->first();

        return redirect()->route('admin.store.collaborator.scholarity',[
            'current_school_year'                => $current_school_year,
            'stored_collaborator_id'             => $stored_collaborator_id,
            'stored_collaborator_name'           => $stored_collaborator_name,
            'online_collaborator_institution_id' => $online_collaborator_institution_id,
            'online_institution_name'            => $online_institution_data->name,
            'all_school_years'                   => $all_school_years,
            'online_collaborator_id'             => $collaborator_id,
            'admin_type_data'                    => $admin_type_data->admin_type
        ]);
    }

    public function storeCollaboratorScholarity($year,CollaboratorScholarityCreateRequest $request)
    {
        $request                  = $this->collaborator_service->storeCollaboratorScholarity($request->all());
        $stored_collaborator      = $request['success'] ? $request['data'] : null;
        $stored_collaborator_id   = $request['stored-collaborator-id'];
        $stored_collaborator_name = $request['stored-collaborator-name'];

        $collaborator_id = Auth::user()->collaborator_id;
        $current_school_year = $year;

        session()->flash('success', [
            'success'    => $request['success'],
            'messages'   => $request['messages']
        ]);
        $online_collaborator_data = $this->collaborator_repository->findWhere([
            'id'=> $collaborator_id
        ])->first();

        $online_collaborator_institution_id = $online_collaborator_data->institution_id;

        $school_years = $this->school_year_repository->findWhere([
            'institution_id'     => $online_collaborator_institution_id,
            'school_year_status' => 'active'
        ])->first();

        $all_school_years = $this->school_year_repository->findWhere([
            'institution_id' => $online_collaborator_institution_id
        ])->all();

        $online_institution_data  = $this->institution_repository->findWhere([
            'id'    => $online_collaborator_institution_id
        ])->first();

        //find the admin id
        $admin_data = $this->repository->findWhere([
            'collaborator_id'   => $collaborator_id,
            'email'             => Auth::user()->email
        ])->first();
        $admin_id = $admin_data->id;

        //find the admin type
        $admin_type_choice_data = $this->admin_type_choice_repository->findWhere([
            'admin_id' => $admin_id
        ])->first();

        $admin_type_data = DB::table('admin_types')
            ->where('id', $admin_type_choice_data->admin_type_id)
            ->select('admin_type')
            ->first();

        return redirect()->route('admin.store.collaborator.contacts',[
            'current_school_year'                => $current_school_year,
            'stored_collaborator_id'             => $stored_collaborator_id,
            'stored_collaborator_name'           => $stored_collaborator_name,
            'online_collaborator_institution_id' => $online_collaborator_institution_id,
            'online_institution_name'            => $online_institution_data->name,
            'all_school_years'                   => $all_school_years,
            'online_collaborator_id'             => $collaborator_id,
            'admin_type_data'                    => $admin_type_data->admin_type
        ]);
    }

    public function storeCollaboratorContacts($year,CollaboratorContactsCreateRequest $request)
    {
        $request                  = $this->collaborator_service->storeCollaboratorContacts($request->all());
        $stored_collaborator      = $request['success'] ? $request['data'] : null;
        $stored_collaborator_id   = $request['stored-collaborator-id'];
        $stored_collaborator_name = $request['stored-collaborator-name'];

        $collaborator_id = Auth::user()->collaborator_id;
        $current_school_year = $year;

        session()->flash('success', [
            'success'    => $request['success'],
            'messages'   => $request['messages']
        ]);

        $online_collaborator_data = $this->collaborator_repository->findWhere([
            'id'=> $collaborator_id
        ])->first();

        $online_collaborator_institution_id = $online_collaborator_data->institution_id;

        $school_years = $this->school_year_repository->findWhere([
            'institution_id'     => $online_collaborator_institution_id,
            'school_year_status' => 'active'
        ])->first();

        $all_school_years = $this->school_year_repository->findWhere([
            'institution_id' => $online_collaborator_institution_id
        ])->all();

        $online_institution_data  = $this->institution_repository->findWhere([
            'id'    => $online_collaborator_institution_id
        ])->first();

        //find the admin id
        $admin_data = $this->repository->findWhere([
            'collaborator_id'   => $collaborator_id,
            'email'             => Auth::user()->email
        ])->first();
        $admin_id = $admin_data->id;

        //find the admin type
        $admin_type_choice_data = $this->admin_type_choice_repository->findWhere([
            'admin_id' => $admin_id
        ])->first();

        $admin_type_data = DB::table('admin_types')
            ->where('id', $admin_type_choice_data->admin_type_id)
            ->select('admin_type')
            ->first();

        return redirect()->route('admin.store.collaborator.job',[
            'current_school_year'                => $current_school_year,
            'stored_collaborator_id'             => $stored_collaborator_id,
            'stored_collaborator_name'           => $stored_collaborator_name,
            'online_collaborator_institution_id' => $online_collaborator_institution_id,
            'online_institution_name'            => $online_institution_data->name,
            'all_school_years'                   => $all_school_years,
            'online_collaborator_id'             => $collaborator_id,
            'admin_type_data'                    => $admin_type_data->admin_type
        ]);
    }

    public function storeTeacherAccessData($year,TeacherCreateRequest $request){
        //dd($request);
        $dt = $request->all();
        $dt['password'] = Hash::make($dt['password']);
        //dd($dt);
        $request = $this->collaborator_service->storeTeacherAccessData($dt);

        session()->flash('success', [
            'success'    => $request['success'],
            'messages'   => $request['messages']
        ]);

        $collaborator_id = Auth::user()->collaborator_id;
        $current_school_year = $year;

        $online_collaborator_data = $this->collaborator_repository->findWhere([
            'id'=> $collaborator_id
        ])->first();

        $online_collaborator_institution_id = $online_collaborator_data->institution_id;

        $school_years = $this->school_year_repository->findWhere([
            'institution_id'     => $online_collaborator_institution_id,
            'school_year_status' => 'active'
        ])->first();

        $all_school_years = $this->school_year_repository->findWhere([
            'institution_id' => $online_collaborator_institution_id
        ])->all();

        $online_institution_data  = $this->institution_repository->findWhere([
            'id'    => $online_collaborator_institution_id
        ])->first();

        //find the admin id
        $admin_data = $this->repository->findWhere([
            'collaborator_id'   => $collaborator_id,
            'email'             => Auth::user()->email
        ])->first();
        $admin_id = $admin_data->id;

        //find the admin type
        $admin_type_choice_data = $this->admin_type_choice_repository->findWhere([
            'admin_id' => $admin_id
        ])->first();

        $admin_type_data = DB::table('admin_types')
            ->where('id', $admin_type_choice_data->admin_type_id)
            ->select('admin_type')
            ->first();

        return redirect()->route('admin.show.collaborator.data',[
            'current_school_year'                => $current_school_year,
            'online_collaborator_id'             => $dt['collaborator_id'],
            'online_collaborator_institution_id' => $online_collaborator_institution_id,
            'online_institution_name'            => $online_institution_data->name,
            'all_school_years'                   => $all_school_years,
            'admin_type_data'                    => $admin_type_data->admin_type
        ]);
    }

    public function storeCollaboratorJob($year,CollaboratorJobCreateRequest $request)
    {
        $guard      = 'admins';
        $page_title = 'Dados de Acesso';

        $request                  = $this->collaborator_service->storeCollaboratorJob($request->all());
        $stored_collaborator      = $request['success'] ? $request['data'] : null;
        $stored_collaborator_id   = $request['stored-collaborator-id'];
        $stored_collaborator_name = $request['stored-collaborator-name'];
        $job_id                   = $request['job'];

        session()->flash('success', [
            'success'    => $request['success'],
            'messages'   => $request['messages']
        ]);
        $collaborator_id = Auth::user()->collaborator_id;
        $current_school_year = $year;

        $online_collaborator_data = $this->collaborator_repository->findWhere([
            'id'=> $collaborator_id
        ])->first();

        $online_collaborator_institution_id = $online_collaborator_data->institution_id;

        $school_years = $this->school_year_repository->findWhere([
            'institution_id'     => $online_collaborator_institution_id,
            'school_year_status' => 'active'
        ])->first();

        $all_school_years = $this->school_year_repository->findWhere([
            'institution_id' => $online_collaborator_institution_id
        ])->all();

        $online_institution_data  = $this->institution_repository->findWhere([
            'id'    => $online_collaborator_institution_id
        ])->first();

        //find the admin id
        $admin_data = $this->repository->findWhere([
            'collaborator_id'   => $collaborator_id,
            'email'             => Auth::user()->email
        ])->first();
        $admin_id = $admin_data->id;

        //find the admin type
        $admin_type_choice_data = $this->admin_type_choice_repository->findWhere([
            'admin_id' => $admin_id
        ])->first();

        $admin_type_data = DB::table('admin_types')
            ->where('id', $admin_type_choice_data->admin_type_id)
            ->select('admin_type')
            ->first();

        return redirect()->route('admin.show.collaborator.data',[
            'current_school_year'                => $current_school_year,
            'stored_collaborator_id'             => $stored_collaborator_id,
            'online_collaborator_id'             => $collaborator_id,
            'online_collaborator_institution_id' => $online_collaborator_institution_id,
            'online_institution_name'            => $online_institution_data->name,
            'all_school_years'                   => $all_school_years,
            'admin_type_data'                    => $admin_type_data->admin_type
        ]);
    }

    public function ShowCollaboratorAddressForm()
    {
        
    }

    public function ShowCollaboratorScholarityForm($year,$stored_collaborator_id, $stored_collaborator_name)
    {
        $guard      = 'admins';
        $page_title = 'Novo Colaborador';

        $collaborator_id = Auth::user()->collaborator_id;
        $current_school_year = $year;

        //Database searches
        $admin                    = $this->repository->all();
        $scholarities             = $this->scholarity_repository->all();
        $online_collaborator_data = $this->collaborator_repository->findWhere([
            'id'=> $collaborator_id
        ])->first();

        $online_collaborator_institution_id = $online_collaborator_data->institution_id;

        $school_years = $this->school_year_repository->findWhere([
            'institution_id'     => $online_collaborator_institution_id,
            'school_year_status' => 'active'
        ])->first();

        $all_school_years = $this->school_year_repository->findWhere([
            'institution_id' => $online_collaborator_institution_id
        ])->all();

        $online_institution_data  = $this->institution_repository->findWhere([
            'id'    => $online_collaborator_institution_id
        ])->first();

        //find the admin id
        $admin_data = $this->repository->findWhere([
            'collaborator_id'   => $collaborator_id,
            'email'             => Auth::user()->email
        ])->first();
        $admin_id = $admin_data->id;

        //find the admin type
        $admin_type_choice_data = $this->admin_type_choice_repository->findWhere([
            'admin_id' => $admin_id
        ])->first();

        $admin_type_data = DB::table('admin_types')
            ->where('id', $admin_type_choice_data->admin_type_id)
            ->select('admin_type')
            ->first();
        
        return view('admins.store-collaborator-scholarity',[
            'current_school_year'                => $current_school_year,
            'guard'                              => $guard, 
            'title'                              => $page_title,
            'online_collaborator_name'           => $online_collaborator_data->name,
            'online_collaborator_institution_id' => $online_collaborator_institution_id,
            'online_institution_name'            => $online_institution_data->name,
            'collaborator_id'                    => $collaborator_id,
            'scholarities'                       => $scholarities,
            'stored_collaborator_id'             => $stored_collaborator_id,
            'stored_collaborator_name'           => $stored_collaborator_name,
            'all_school_years'                   => $all_school_years,
            'online_collaborator_id'             => $collaborator_id,
            'admin_type_data'                    => $admin_type_data->admin_type
        ]);
    }

    public function ShowCollaboratorContactsForm($year,$stored_collaborator_id, $stored_collaborator_name)
    {
        $guard      = 'admins';
        $page_title = 'Novo Colaborador';

        $collaborator_id = Auth::user()->collaborator_id;
        $current_school_year = $year;

        //Database searches
        $admin                    = $this->repository->all();
        $online_collaborator_data = $this->collaborator_repository->findWhere([
            'id'=> $collaborator_id
        ])->first();

        $online_collaborator_institution_id = $online_collaborator_data->institution_id;

        $school_years = $this->school_year_repository->findWhere([
            'institution_id'     => $online_collaborator_institution_id,
            'school_year_status' => 'active'
        ])->first();

        $all_school_years = $this->school_year_repository->findWhere([
            'institution_id' => $online_collaborator_institution_id
        ])->all();

        $online_institution_data  = $this->institution_repository->findWhere([
            'id'    => $online_collaborator_institution_id
        ])->first();

        //find the admin id
        $admin_data = $this->repository->findWhere([
            'collaborator_id'   => $collaborator_id,
            'email'             => Auth::user()->email
        ])->first();
        $admin_id = $admin_data->id;

        //find the admin type
        $admin_type_choice_data = $this->admin_type_choice_repository->findWhere([
            'admin_id' => $admin_id
        ])->first();

        $admin_type_data = DB::table('admin_types')
            ->where('id', $admin_type_choice_data->admin_type_id)
            ->select('admin_type')
            ->first();

        return view('admins.store-collaborator-contacts',[
            'current_school_year'                => $current_school_year,
            'guard'                              => $guard, 
            'title'                              => $page_title,
            'online_collaborator_name'           => $online_collaborator_data->name,
            'online_collaborator_institution_id' => $online_collaborator_institution_id,
            'online_institution_name'            => $online_institution_data->name,
            'collaborator_id'                    => $collaborator_id,
            'stored_collaborator_id'             => $stored_collaborator_id,
            'stored_collaborator_name'           => $stored_collaborator_name,
            'all_school_years'                   => $all_school_years,
            'online_collaborator_id'             => $collaborator_id,
            'admin_type_data'                    => $admin_type_data->admin_type
        ]);
    }

    public function ShowCollaboratorJobForm($year,$stored_collaborator_id, $stored_collaborator_name)
    {
        $guard      = 'admins';
        $page_title = 'Novo Colaborador';

        $collaborator_id = Auth::user()->collaborator_id;
        $current_school_year = $year;

        //Database searches
        $admin                    = $this->repository->all();
        
        $online_collaborator_data = $this->collaborator_repository->findWhere([
            'id'=> $collaborator_id
        ])->first();
        $jobs  = $this->job_repository->findWhere([
            'institution_id' => $online_collaborator_data->institution_id
        ]);

        $online_collaborator_institution_id = $online_collaborator_data->institution_id;

        $school_years = $this->school_year_repository->findWhere([
            'institution_id'     => $online_collaborator_institution_id,
            'school_year_status' => 'active'
        ])->first();

        $all_school_years = $this->school_year_repository->findWhere([
            'institution_id' => $online_collaborator_institution_id
        ])->all();

        $online_institution_data  = $this->institution_repository->findWhere([
            'id'    => $online_collaborator_institution_id
        ])->first();

        //find the admin id
        $admin_data = $this->repository->findWhere([
            'collaborator_id'   => $collaborator_id,
            'email'             => Auth::user()->email
        ])->first();
        $admin_id = $admin_data->id;

        //find the admin type
        $admin_type_choice_data = $this->admin_type_choice_repository->findWhere([
            'admin_id' => $admin_id
        ])->first();

        $admin_type_data = DB::table('admin_types')
            ->where('id', $admin_type_choice_data->admin_type_id)
            ->select('admin_type')
            ->first();

        return view('admins.store-collaborator-job',[
            'current_school_year'                 => $current_school_year,
            'guard'                               => $guard, 
            'title'                               => $page_title,
            'online_collaborator_name'            => $online_collaborator_data->name,
            'online_collaborator_institution_id'  => $online_collaborator_data->institution_id,
            'online_institution_name'             => $online_institution_data->name,
            'collaborator_id'                     => $collaborator_id,
            'stored_collaborator_id'              => $stored_collaborator_id,
            'stored_collaborator_name'            => $stored_collaborator_name,
            'jobs'                                => $jobs,
            'all_school_years'                    => $all_school_years,
            'online_collaborator_id'             => $collaborator_id,
            'admin_type_data'                    => $admin_type_data->admin_type
        ]);
    }

    public function ShowCollaborators($year)
    {
        $guard      = 'admins';
        $page_title = 'Dados';
        $collaborator_id = Auth::user()->collaborator_id;
        $current_school_year = $year;

        $genders  = $this->gender_repository->all();

        $online_collaborator_data = $this->collaborator_repository->findWhere([
            'id'=> $collaborator_id
        ])->first();

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

        $collaborators_data = DB::table('collaborators')
            ->join('collaborator_contacts', 'collaborators.id', '=', 'collaborator_contacts.collaborator_id')
            ->join('collaborator_jobs', 'collaborators.id', '=', 'collaborator_jobs.collaborator_id')
            ->where('collaborators.collaborator_status', 'Active')
            ->where('collaborator_jobs.job_year',$year)
            ->select('collaborators.id','collaborators.name', 'collaborators.date_birth', 'collaborator_contacts.phone1','collaborator_contacts.phone2')
            ->orderBy('collaborators.name','ASC')
            ->get();
        $collaborators_counter = 1;

        //find the admin id
        $admin_data = $this->repository->findWhere([
            'collaborator_id'   => $collaborator_id,
            'email'             => Auth::user()->email
        ])->first();
        $admin_id = $admin_data->id;

        //find the admin type
        $admin_type_choice_data = $this->admin_type_choice_repository->findWhere([
            'admin_id' => $admin_id
        ])->first();

        $admin_type_data = DB::table('admin_types')
            ->where('id', $admin_type_choice_data->admin_type_id)
            ->select('admin_type')
            ->first();

        return view('admins.show-collaborators',[
            'current_school_year'                => $current_school_year,
            'title'                              => $page_title,
            'guard'                              => $guard,
            'online_collaborator_name'           => $online_collaborator_data->name,
            'online_collaborator_institution_id' => $online_collaborator_institution_id,
            'online_institution_name'            => $online_institution_data->name,
            'all_school_years'                   => $all_school_years,
            'collaborators_data'                 => $collaborators_data,
            'online_collaborator_id'             => $collaborator_id,
            'counter'                            => $collaborators_counter,
            'genders'                            => $genders,
            'admin_type_data'                    => $admin_type_data->admin_type
       ]);
    }

    public function ShowCollaboratorData($year,$id)
    {
        //dd($id);
        $guard      = 'admins';
        $page_title = 'Dados';

        $collaborator_id = Auth::user()->collaborator_id;
        $current_school_year = $year;

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
                'collaborators.id','collaborators.name','collaborators.cpf', 'collaborators.date_birth', 'collaborators.place_birth', 'collaborators.rg', 'collaborators.rg_emissor',
                'collaborator_contacts.phone1','collaborator_contacts.phone2',
                'collaborator_addresses.street', 'collaborator_addresses.block', 'collaborator_addresses.land_lot', 'collaborator_addresses.number', 'collaborator_addresses.neighborhood', 'collaborator_addresses.zipcode', 'collaborator_addresses.complement',
                'jobs.office', 'collaborator_jobs.job_id','collaborator_jobs.job_year','collaborator_jobs.job_status',
                'scholarities.scholarity','collaborator_scholarities.scholarity_id','collaborator_scholarities.collaborator_id'
            )->first();
        $scholarities = DB::table('scholarities')
            ->select('id','scholarity')
            ->get();
        
        $online_collaborator_institution_id = $online_collaborator_data->institution_id;

        $jobs = DB::table('jobs')
            ->where('institution_id','=',$online_collaborator_institution_id)
            ->get();

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

        //find the admin id
        $admin_data = $this->repository->findWhere([
            'collaborator_id'   => $collaborator_id,
            'email'             => Auth::user()->email
        ])->first();
        $admin_id = $admin_data->id;

        //find the admin type
        $admin_type_choice_data = $this->admin_type_choice_repository->findWhere([
            'admin_id' => $admin_id
        ])->first();

        $admin_type_data = DB::table('admin_types')
            ->where('id', $admin_type_choice_data->admin_type_id)
            ->select('admin_type')
            ->first();

        return view('admins.show-collaborator-data',[
            'current_school_year'                => $current_school_year,
            'guard'                              => $guard, 
            'title'                              => $page_title,
            'online_collaborator_name'           => $online_collaborator_data->name,
            'online_collaborator_institution_id' => $online_collaborator_institution_id,
            'online_institution_name'            => $online_institution_data->name,
            'all_school_years'                   => $all_school_years,
            'online_collaborator_id'             => $collaborator_id,
            'collaborator_data'                  => $collaborator_data,
            'admin_type_data'                    => $admin_type_data->admin_type,
            'scholarities'                       => $scholarities,
            'jobs'                               => $jobs
        ]);
    }

    public function ShowCollaboratorDataC($year,Request $request)
    {
        $cpf = $request['cpfsearch'];

        $guard      = 'admins';
        $page_title = 'Dados';

        $collaborator_id = Auth::user()->collaborator_id;
        $current_school_year = $year;

        $online_collaborator_data = $this->collaborator_repository->findWhere([
            'id'=> $collaborator_id
        ])->first();

        $collaborator_data = DB::table('collaborators')
            ->join('collaborator_contacts', 'collaborators.id', '=', 'collaborator_contacts.collaborator_id')
            ->join('collaborator_addresses', 'collaborators.id', '=', 'collaborator_addresses.collaborator_id')
            ->join('collaborator_jobs', 'collaborators.id', '=', 'collaborator_jobs.collaborator_id')
            ->join('jobs', 'jobs.id', '=', 'collaborator_jobs.job_id')
            ->join('collaborator_scholarities', 'collaborators.id', '=', 'collaborator_scholarities.collaborator_id')
            ->join('scholarities', 'scholarities.id', '=', 'collaborator_scholarities.scholarity_id')
            ->where('collaborators.cpf', $cpf)
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

        //find the admin id
        $admin_data = $this->repository->findWhere([
            'collaborator_id'   => $collaborator_id,
            'email'             => Auth::user()->email
        ])->first();
        $admin_id = $admin_data->id;

        //find the admin type
        $admin_type_choice_data = $this->admin_type_choice_repository->findWhere([
            'admin_id' => $admin_id
        ])->first();

        $admin_type_data = DB::table('admin_types')
            ->where('id', $admin_type_choice_data->admin_type_id)
            ->select('admin_type')
            ->first();

        return view('admins.show-collaborator-data',[
            'current_school_year'                => $current_school_year,
            'guard'                              => $guard, 
            'title'                              => $page_title,
            'online_collaborator_name'           => $online_collaborator_data->name,
            'online_collaborator_institution_id' => $online_collaborator_institution_id,
            'online_institution_name'            => $online_institution_data->name,
            'all_school_years'                   => $all_school_years,
            'online_collaborator_id'             => $collaborator_id,
            'collaborator_data'                  => $collaborator_data,
            'admin_type_data'                    => $admin_type_data->admin_type
        ]);
    }

    public function ShowTeacherAccessDataForm()
    {
        return view('admins.store-teacher-accessdata');
    }

    public function ShowStoreSchoolYearForm()
    {
        $guard = 'admins';
        $page_title = 'Ano Letivo';
        $collaborator_id = Auth::user()->collaborator_id;
        

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

        //find the admin id
        $admin_data = $this->repository->findWhere([
            'collaborator_id'   => $collaborator_id,
            'email'             => Auth::user()->email
        ])->first();
        $admin_id = $admin_data->id;

        //find the admin type
        $admin_type_choice_data = $this->admin_type_choice_repository->findWhere([
            'admin_id' => $admin_id
        ])->first();

        $admin_type_data = DB::table('admin_types')
            ->where('id', $admin_type_choice_data->admin_type_id)
            ->select('admin_type')
            ->first();

        return view('admins.show-school-year-form',[
            'guard'                              => $guard,
            'title'                              => $page_title,
            'online_collaborator_institution_id' => $online_collaborator_institution_id,
            'online_institution_name'            => $online_institution_data->name,
            'online_collaborator_id'             => $collaborator_id,
            'admin_type_data'                    => $admin_type_data->admin_type
        ]);
    }

    public function StoreSchoolYear(SchoolYearCreateRequest $request)
    {
        /*Ao cadastrar um ano letivo deve-se mudar o status de todos os outros anos letivos para inativo*/
        $request = $this->institution_service->storeSchoolYear($request->all());

        $guard = 'admins';
        $page_title = 'Home';
        $collaborator_id = Auth::user()->collaborator_id;

        //Database searches
        $admin                          = $this->repository->all();
        $genders                        = $this->gender_repository->all();
        $colors                         = $this->color_repository->all();
        $institution_classes            = $this->institution_class_repository->all();

        $online_collaborator_data       = $this->collaborator_repository->findWhere([
            'id'=> $collaborator_id
        ])->first();

        $online_collaborator_institution_id = $online_collaborator_data->institution_id;

        $online_institution_data  = $this->institution_repository->findWhere([
            'id'    => $online_collaborator_institution_id
        ])->first();

        session()->flash('success', [
            'success'    => $request['success'],
            'messages'   => $request['messages']
        ]);

        /*Change the old school years statuses to inactive*/

        $all_school_years = $this->school_year_repository->findWhere([
            'institution_id' => $online_collaborator_institution_id
        ])->all();
        
        foreach ($all_school_years as $status) {
            if ($status->year != $request['data']->year) {
                $updating_data = array(
                    'school_year_status' => 'inactive'
                );
                $updating = $this->institution_service->UpdateSchoolYearStatus($updating_data,$status->id);
            }
        }

        return redirect()->route('admin.show.dashboard',[$request['data']->year]);
    }

    public function storeInstitutionClass($year,InstitutionClassCreateRequest $request)
    {
        $request = $this->institution_service->storeInstitutionClass($request->all());

        session()->flash('success', [
            'success'      => $request['success'],
            'messages'     => $request['messages']
        ]);

        $guard = 'admins';
        $page_title = 'Home';
        $collaborator_id = Auth::user()->collaborator_id;
        $current_school_year = $year;

        //Database searches
        $admin                          = $this->repository->all();
        $genders                        = $this->gender_repository->all();
        $colors                         = $this->color_repository->all();
        $institution_classes            = $this->institution_class_repository->all();
        
        $grades   = $this->grade_repository->all();

        $online_collaborator_data       = $this->collaborator_repository->findWhere([
            'id'=> $collaborator_id
        ])->first();

        $online_collaborator_institution_id = $online_collaborator_data->institution_id;
        $active_students  = $this->student_enrollment_repository->findWhere([
            'institution_id'       => $online_collaborator_institution_id,
            'enrollment_status_id' => '1'
        ]);

        $active_collaborators = $this->collaborator_repository->findWhere([
            'institution_id'      => $online_collaborator_institution_id,
            'collaborator_status' => 'Active'
        ]);

        $online_institution_data  = $this->institution_repository->findWhere([
            'id'    => $online_collaborator_institution_id
        ])->first();

        $school_years = $this->school_year_repository->findWhere([
            'institution_id'     => $online_collaborator_institution_id,
            'school_year_status' => 'active'
        ])->first();

        $school_year_id = $this->school_year_repository->findWhere([
            'institution_id'    => $online_collaborator_institution_id,
            'year'              => $school_years->year
        ])->first();

        $all_school_years = $this->school_year_repository->findWhere([
                'institution_id' => $online_collaborator_institution_id
        ])->all();

        if ($school_years==null) {
            return redirect()->route('admin.store.school-year');
        }else{
            return redirect()->route('admin.show.dashboard',[
                'current_school_year'                => $current_school_year,
                'guard'                              => $guard,  
                'title'                              => $page_title,
                'online_collaborator_name'           => $online_collaborator_data->name,
                'online_institution_name'            => $online_institution_data->name,
                'online_collaborator_institution_id' => $online_collaborator_institution_id,
                'genders'                            => $genders,
                'colors'                             => $colors,
                'amount_classes'                     => count($institution_classes),
                'all_institution_classes'            => $institution_classes,
                'amount_active_students'             => count($active_students),
                'amount_collaborators'               => count($active_collaborators),
                'school_year_id'                     => $school_year_id->id,
                'all_school_years'                   => $all_school_years,
                'grades'                             => $grades,
                'online_collaborator_id'             => $collaborator_id
            ]);
        }
    }

    public function ShowStoreDepartmentForm($year)
    {
        $guard      = 'admins';
        $page_title = 'Departmantos';

        $collaborator_id = Auth::user()->collaborator_id;
        $current_school_year = $year;

        $online_collaborator_data = $this->collaborator_repository->findWhere([
            'id'=> $collaborator_id
        ])->first();

        $online_collaborator_institution_id = $online_collaborator_data->institution_id;

        $online_institution_data  = $this->institution_repository->findWhere([
            'id'    => $online_collaborator_institution_id
        ])->first();

        //find the admin id
        $admin_data = $this->repository->findWhere([
            'collaborator_id'   => $collaborator_id,
            'email'             => Auth::user()->email
        ])->first();
        $admin_id = $admin_data->id;

        //find the admin type
        $admin_type_choice_data = $this->admin_type_choice_repository->findWhere([
            'admin_id' => $admin_id
        ])->first();

        $admin_type_data = DB::table('admin_types')
            ->where('id', $admin_type_choice_data->admin_type_id)
            ->select('admin_type')
            ->first();

        return view('admins.store-department',[
            'current_school_year'               => $current_school_year,
            'guard'                             => $guard,
            'title'                             => $page_title,
            'online_collaborator_name'          => $online_collaborator_data->name,
            'online_collaborator_institution_id'=> $online_collaborator_institution_id,
            'online_institution_name'           => $online_institution_data->name,
            'online_collaborator_id'            => $collaborator_id,
            'admin_type_data'                    => $admin_type_data->admin_type
        ]);
    }
    public function ShowStoreJobForm($year)
    {
        $guard      = 'admins';
        $page_title = 'Cargos';

        $collaborator_id = Auth::user()->collaborator_id;
        $current_school_year = $year;

        $online_collaborator_data = $this->collaborator_repository->findWhere([
            'id'=> $collaborator_id
        ])->first();

        $online_collaborator_institution_id = $online_collaborator_data->institution_id;

        $online_institution_data  = $this->institution_repository->findWhere([
            'id'    => $online_collaborator_institution_id
        ])->first();

        $department_data = $this->department_repository->findWhere([
            'institution_id' => $online_collaborator_institution_id
        ])->all();

        //find the admin id
        $admin_data = $this->repository->findWhere([
            'collaborator_id'   => $collaborator_id,
            'email'             => Auth::user()->email
        ])->first();
        $admin_id = $admin_data->id;

        //find the admin type
        $admin_type_choice_data = $this->admin_type_choice_repository->findWhere([
            'admin_id' => $admin_id
        ])->first();

        $admin_type_data = DB::table('admin_types')
            ->where('id', $admin_type_choice_data->admin_type_id)
            ->select('admin_type')
            ->first();

        return view('admins.store-jobs',[
            'current_school_year'                => $current_school_year,
            'guard'                              => $guard,
            'title'                              => $page_title,
            'online_collaborator_name'           => $online_collaborator_data->name,
            'online_collaborator_institution_id' => $online_collaborator_institution_id,
            'online_institution_name'            => $online_institution_data->name,
            'departments'                        => $department_data,
            'online_collaborator_id'             => $collaborator_id,
            'admin_type_data'                    => $admin_type_data->admin_type
        ]);
    }
    public function StoreDepartment($year,DepartmentCreateRequest $request)
    {
        $current_school_year = $year;
        $request = $this->institution_service->storeDepartment($request->all());

        session()->flash('success', [
            'success'    => $request['success'],
            'messages'   => $request['messages']
        ]);
        return redirect()->route('admin.show.dashboard',$current_school_year);
    }

    public function StoreJob($year,JobCreateRequest $request)
    {
        $current_school_year = $year;
        $request = $this->institution_service->storeJob($request->all());

        session()->flash('success', [
            'success'    => $request['success'],
            'messages'   => $request['messages']
        ]);
        return redirect()->route('admin.show.dashboard', $current_school_year);
    }

    public function SearchStudent(Request $request)
    {
        if($request->search != ""){

            if ($request->ajax()) {
                $output=[];
                $students = DB::table('students')
                    ->join('student_enrollments', 'students.id', '=', 'student_enrollments.student_id')
                    ->where('student_enrollments.enrollment_year',$request->current_school_year)
                    ->where('student_enrollments.institution_id', $request->institution_id)
                    ->where('students.name','LIKE','%' . $request->search . '%')
                    ->select('students.id','students.name','student_enrollments.transfer_type','student_enrollments.institution_class_id')
                    ->limit(5)->get();

                if (is_null($students)) {
                    $output = "Nenhum valor encontrado";
                }
                for ($i=0; $i < count($students); $i++) { 
                    $url = $request->current_school_year."/show/student-data/". $students[$i]->id.'/'.$students[$i]->institution_class_id;
                    if(is_null($students[$i]->transfer_type)){
                        $output_value = '<a href="' . $url . '"><div class="searchbar-item">' . $students[$i]->name .'</div></a>';
                    }else{
                        $output_value = '<a href="' . $url . '"><div class="searchbar-item">' . $students[$i]->name .' - '.$students[$i]->transfer_type.'</div></a>';
                    }
                    
                    array_push($output, $output_value);
                }
                
                return Response($output);
            }
        }
    }

    public function SearchCollaborator(Request $request)
    {

        if($request->search_collaborator != ""){

            if ($request->ajax()) {
                $output=[];
                $collaborators = DB::table('collaborators')
                    ->join('collaborator_jobs','collaborators.id','=','collaborator_jobs.collaborator_id')
                    ->where('collaborator_jobs.job_year',$request->current_school_year)
                    ->where('collaborators.institution_id', $request->institution_id)
                    ->where('name','LIKE','%' . $request->search_collaborator . '%')
                    ->select('collaborators.id','collaborators.name')
                    ->get();

                if (count($collaborators)==0) {
                    $output_value =  '<p><div class="searchbar-item">Nenhum Valor encontrado!</div></p>';
                    array_push($output, $output_value);
                }else{
                    for ($i=0; $i < count($collaborators); $i++) { 
                        $url = $request->current_school_year."/show/collaborator/data/". $collaborators[$i]->id;
                        $output_value = '<a href="' . $url . '"><div class="searchbar-item">' . $collaborators[$i]->name .'</div></a>';
                        array_push($output, $output_value);
                    }
                }
                                              
                return Response($output);
            }
        }
    }

    public function ShowTeachers($year)
    {
        $guard      = 'admins';
        $page_title = 'Professores';
        $collaborator_id = Auth::user()->collaborator_id;
        $current_school_year = $year;

        $online_collaborator_data = $this->collaborator_repository->findWhere([
            'id'=> $collaborator_id
        ])->first();

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

        $teachers_data = DB::table('teachers')
            ->join('collaborators','teachers.collaborator_id','=','collaborators.id')
            ->where('collaborators.institution_id','=',$online_collaborator_institution_id)
            ->where('collaborators.collaborator_status','=','Active')
            ->select('teachers.name', 'teachers.collaborator_id')
            ->orderBy('teachers.name','ASC')
            ->get();

        //find the admin id
        $admin_data = $this->repository->findWhere([
            'collaborator_id'   => $collaborator_id,
            'email'             => Auth::user()->email
        ])->first();
        $admin_id = $admin_data->id;

        //find the admin type
        $admin_type_choice_data = $this->admin_type_choice_repository->findWhere([
            'admin_id' => $admin_id
        ])->first();

        $admin_type_data = DB::table('admin_types')
            ->where('id', $admin_type_choice_data->admin_type_id)
            ->select('admin_type')
            ->first();

        return view('admins.show-teachers',[
            'current_school_year'                => $current_school_year,
            'title'                              => $page_title,
            'guard'                              => $guard,
            'online_collaborator_name'           => $online_collaborator_data->name,
            'online_collaborator_institution_id' => $online_collaborator_institution_id,
            'online_institution_name'            => $online_institution_data->name,
            'all_school_years'                   => $all_school_years,
            'teachers_data'                      => $teachers_data,
            'online_collaborator_id'             => $collaborator_id,
            'admin_type_data'                    => $admin_type_data->admin_type
       ]);
    }
    public function ShowCalendar($year)
    {
        $guard = 'admins';
        $page_title = 'Calendário';
        $collaborator_id = Auth::user()->collaborator_id;
        $current_school_year = $year;

        $online_collaborator_data = $this->collaborator_repository->findWhere([
            'id'=> $collaborator_id
        ])->first();
        $online_collaborator_institution_id = $online_collaborator_data->institution_id;

        //find the school year id
        $school_year_id = DB::table('school_years')
            ->where('institution_id',$online_collaborator_institution_id)
            ->where('year',$current_school_year)
            ->select('id')
            ->first();

        $institution_classes  = $this->institution_class_repository->findWhere([
            'institution_id' => $online_collaborator_institution_id,
            'school_year_id' => $school_year_id->id
        ])->all();

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

        $institution_classes = $this->institution_class_repository->findWhere([
            'institution_id' => $online_collaborator_institution_id,
            'school_year_id' => $school_year_id->id
        ])->all();

        //find the admin id
        $admin_data = $this->repository->findWhere([
            'collaborator_id'   => $collaborator_id,
            'email'             => Auth::user()->email
        ])->first();
        $admin_id = $admin_data->id;

        //find the admin type
        $admin_type_choice_data = $this->admin_type_choice_repository->findWhere([
            'admin_id' => $admin_id
        ])->first();

        $admin_type_data = DB::table('admin_types')
            ->where('id', $admin_type_choice_data->admin_type_id)
            ->select('admin_type')
            ->first();

        $calendar_activities_query = DB::table('institution_calendar_activities')
            ->select('id','activity')
            ->get();
        
        //list all calendar days registered
        $calendar_days = DB::table('institution_calendars')
            ->join('institution_calendar_activities','institution_calendar_activities.id','=','institution_calendars.activity_id')
            ->where('institution_calendars.institution_id',$online_collaborator_institution_id)
            ->where('institution_calendars.year', $current_school_year)
            ->orderBy('institution_calendars.day','ASC')
            ->select('institution_calendars.id','institution_calendars.day','institution_calendars.activity_id','institution_calendars.motive','institution_calendars.class_day','institution_calendars.year','institution_calendar_activities.activity')
            ->get();
        
        //months
        $months = ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'];
        $months_length = count($months);

        return view('admins.calendar',[
            'guard'                              => $guard, 
            'title'                              => $page_title,
            'online_collaborator_name'           => $online_collaborator_data->name,
            'online_collaborator_id'             => $collaborator_id,
            'admin_type_data'                    => $admin_type_data->admin_type,
            'online_collaborator_institution_id' => $online_collaborator_institution_id,
            'online_institution_name'            => $online_institution_data->name,
            'current_school_year'                => $current_school_year,
            'all_school_years'                   => $all_school_years,
            'all_institution_classes'            => $institution_classes,
            'calendar_activities'                => $calendar_activities_query,
            'months'                             => $months,
            'months_length'                      => $months_length,
            'calendar_days'                      => $calendar_days

        ]);
    }

    public function StoreCalendarDay($year, Request $request){
        //dd($request->all());

        $request = $this->institution_service->storeCalendarDay($request->all());

        session()->flash('success', [
            'success'    => $request['success'],
            'messages'   => $request['messages']
        ]);

        $current_school_year = $year;

        return redirect()->route('admin.calendar',[
            'current_school_year' => $current_school_year
        ]);
    }

    public function StoreAdmin($year, Request $request)
    {
        $collaborator_id = Auth::user()->collaborator_id;
        $current_school_year = $year;
        $online_collaborator_data = $this->collaborator_repository->findWhere([
            'id'=> $collaborator_id
        ])->first();

        $online_collaborator_institution_id = $online_collaborator_data->institution_id;

        $admin_data_request = [
            'name'              => $request->name,
            'email'             => $request->email,
            'password'          => Hash::make($request->password),
            'admin_status'      => 'active',
            'collaborator_id'   => $request->collaborator_id,
            'institution_id'    => $request->institution_id
        ];

        $stored_admin = $this->institution_service->storeAdmin($admin_data_request);

        //find the admin id
        $admin_data = DB::table('admins')
            ->where('collaborator_id',$request->collaborator_id)
            ->select('id')
            ->first();

        //dd($admin_data);

        $admin_type_data = [
            'admin_id'      => $admin_data->id,
            'admin_type_id' => $request['admin_type_id'],
        ];

        $stored_admin_type = $this->institution_service->storeAdminType($admin_type_data);

        session()->flash('success', [
            'success'    => $stored_admin_type['success'],
            'messages'   => $stored_admin_type['messages']
        ]);

        $guard = 'admins';
        $page_title = 'Configurações';

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

        return redirect()->route('admin.config',[
            'current_school_year'                => $current_school_year,
            'guard'                              => $guard,
            'page_title'                         => $page_title,
            'online_collaborator_institution_id' => $online_collaborator_institution_id,
            'online_institution_name'            => $online_institution_data->name,
            'all_school_years'                   => $all_school_years,
            'online_collaborator_id'             => $collaborator_id
        ]);
    }

    public function PlansHome($year)
    {
        $page_title = 'Grupos';
        $guard = 'admins';

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

        //find the admin id
        $admin_data = $this->repository->findWhere([
            'collaborator_id'   => $collaborator_id,
            'email'             => Auth::user()->email
        ])->first();
        $admin_id = $admin_data->id;

        //find the admin type
        $admin_type_choice_data = $this->admin_type_choice_repository->findWhere([
            'admin_id' => $admin_id
        ])->first();

        $admin_type_data = DB::table('admin_types')
            ->where('id', $admin_type_choice_data->admin_type_id)
            ->select('admin_type')
            ->first();

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

        return view('admins.plan-groups',[
            'current_school_year'                => $current_school_year,
            'guard'                              => $guard,
            'title'                              => $page_title,
            'online_collaborator_institution_id' => $online_collaborator_institution_id,
            'online_institution_name'            => $online_institution_data->name,
            'all_school_years'                   => $all_school_years,
            'online_collaborator_id'             => $collaborator_id,
            'admin_type_data'                    => $admin_type_data->admin_type,
            'online_collaborator_name'           => $online_collaborator_data->name,
            'school_year_id'                     => $school_year_id->id,
            'collaborator_id'                    => $collaborator_id,
            'all_plan_groups_data'               => $all_groups_data,
            'all_groups_counter_br'              => $all_groups_counter_br
        ]);
    }

    public function StoreGroupPlan($year, Request $request)
    {
        $current_school_year = $year;

        $request = $this->institution_service->storeGroupPlan($request->all());

        session()->flash('success', [
            'success'    => $request['success'],
            'messages'   => $request['messages']
        ]);

        return redirect()->route('admin.plan.home', $current_school_year);
    }

    public function ShowPlanGroup($year,$group_id)
    {
        $page_title = 'Grupos';
        $guard = 'admins';

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

        //find the admin id
        $admin_data = $this->repository->findWhere([
            'collaborator_id'   => $collaborator_id,
            'email'             => Auth::user()->email
        ])->first();
        $admin_id = $admin_data->id;

        //find the admin type
        $admin_type_choice_data = $this->admin_type_choice_repository->findWhere([
            'admin_id' => $admin_id
        ])->first();

        $admin_type_data = DB::table('admin_types')
            ->where('id', $admin_type_choice_data->admin_type_id)
            ->select('admin_type')
            ->first();

        $school_year_id = $this->school_year_repository->findWhere([
            'institution_id'    => $online_collaborator_institution_id,
            'year'              => $year
        ])->first();

        $school_year_division_data = DB::table('institution_school_year_divisions')
            ->where('institution_id','=',$online_collaborator_institution_id)
            ->select('id','division')
            ->get();

        //find the daily plans
        $daily_plans = DB::table('daily_plans')
            ->join('institution_classes','daily_plans.class_plan','=','institution_classes.id')
            ->join('institution_school_year_divisions','daily_plans.school_year_division_id','=','institution_school_year_divisions.id')
            ->join('teachers','daily_plans.teacher_id','=','teachers.id')
            ->where('daily_plans.institution_id', $online_collaborator_institution_id)
            ->where('daily_plans.school_year_id', $school_year_id->id)
            ->where('daily_plans.group_id',$group_id)
            ->select('institution_classes.institution_class','daily_plans.plan_date','institution_school_year_divisions.division','daily_plans.scholarity_id','teachers.name','teachers.id')
            ->get();
            //dd($daily_plans);
        $daily_plans_counter = 1;

        return view('admins.daily_plans',[
            'current_school_year'                => $current_school_year,
            'guard'                              => $guard,
            'title'                              => $page_title,
            'online_collaborator_institution_id' => $online_collaborator_institution_id,
            'online_institution_name'            => $online_institution_data->name,
            'all_school_years'                   => $all_school_years,
            'online_collaborator_id'             => $collaborator_id,
            'admin_type_data'                    => $admin_type_data->admin_type,
            'online_collaborator_name'           => $online_collaborator_data->name,
            'school_year_id'                     => $school_year_id->id,
            'collaborator_id'                    => $collaborator_id,
            'school_year_divisions'              => $school_year_division_data,
            'daily_plans'                        => $daily_plans,
            'daily_plans_counter'                => $daily_plans_counter
        ]);
    }

    public function ReAddAdmin($year,$admin_id)
    {
        $current_school_year = $year;

        $data = [
            'admin_status' => 'active'
        ];

        $request = $this->institution_service->reAddAdmin($data,$admin_id);

        session()->flash('success', [
            'success'    => $request['success'],
            'messages'   => $request['messages']
        ]);

        return redirect()->route('admin.config',$current_school_year);
    }

    public function StoreCurricularComponent($year, Request $request)
    {
        //dd($request->all());
        $current_school_year = $year;
        $request = $this->institution_service->storeCurricularComponent($request->all());

        session()->flash('success', [
            'success'    => $request['success'],
            'messages'   => $request['messages']
        ]);

        return redirect()->route('admin.show.dashboard',$current_school_year);
    }

    public function StoreSchoolYearDivision($year, Request $request)
    {
        //dd($request->all());

        $request = $this->institution_service->storeSchoolYearDivision($request->all());

        session()->flash('success', [
            'success'    => $request['success'],
            'messages'   => $request['messages']
        ]);

        $guard = 'admins';
        $page_title = 'Configurações';
        $current_school_year = $year;

        $collaborator_id = Auth::user()->collaborator_id;

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

        return redirect()->route('admin.config',[
            'current_school_year'                => $current_school_year,
            'guard'                              => $guard,
            'page_title'                         => $page_title,
            'online_collaborator_institution_id' => $online_collaborator_institution_id,
            'online_institution_name'            => $online_institution_data->name,
            'all_school_years'                   => $all_school_years,
            'online_collaborator_id'             => $collaborator_id
        ]);
    }

    public function StoreStudentInWaitingList($year,$page, Request $request)
    {
        $guard = 'admins';
        $current_school_year = $year;
        $class_id = $request['institution_class_id'];
        
        $request = $this->student_service->storeStudentInWaitingList($request->all());

        session()->flash('success', [
            'success'    => $request['success'],
            'messages'   => $request['messages']
        ]);

        if($page == 'home'){
            return redirect()->route('admin.show.dashboard',$current_school_year);
        }else{
            if($page == 'class_students'){
                
                return redirect()->route('admin.show.class.students',['year' => $current_school_year, 'class_id' => $class_id]);
            }
        }
        
    }

    public function InternallyTransferStudent($year, $student_id, Request $request)
    {
        $guard = 'admins';
        $current_school_year = $year;
        //dd($request->all());
        $student_enrollment_data = DB::table('student_enrollments')
            ->where('student_enrollments.student_id', $student_id)
            ->where('student_enrollments.enrollment_year',$year)
            ->select(
                'student_enrollments.id'
            )->first();
        $student_enrollment_id = $student_enrollment_data->id;

        //Change the transfer type to MOV
        $transfer_data = [
            'transfer_date'         => date('Y-m-d'),
            'transfer_type'         => 'MOV',
            'enrollment_status_id'  => '2'
        ];
        
        $update_request = $this->student_service->updateStudentEnrollments($transfer_data,$student_enrollment_id);

        session()->flash('success', [
            'success'    => $update_request['success'],
            'messages'   => $update_request['messages']
        ]);
        //Store the new enrollment
        $request = $this->student_service->storeStudentEnrollment($request->all());
        return redirect()->route('admin.show.student.data',['year' => $current_school_year, 'id' => $student_id]);
    }

    public function StoreExam($year,Request $request)
    {
        //dd($request->all());
        $guard = 'admins';
        $collaborator_id = Auth::user()->collaborator_id;

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

        $teacher = DB::table('teacher_classes')
            ->where('curricular_component_id','=',$request['curricular_component_id'])
            ->where('institution_class_id','=',$request['institution_class_id'])
            ->where('institution_id','=',$online_collaborator_institution_id)
            ->where('school_year_id','=',$school_year_id->id)
        ->first();
        
        $data = [
            'exam'                      => $request['exam'],
            'exam_date'                 => $request['exam_date'],
            'value'                     => $request['value'],
            'teacher_id'                => $teacher->teacher_id,
            'division_id'               => $request['division_id'],
            'school_year_id'            => $school_year_id->id,
            'curricular_component_id'   => $request['curricular_component_id'],
            'institution_id'            => $online_collaborator_institution_id,
            'institution_class_id'      => $request['institution_class_id']
        ];
        //dd($request->all(),$data);

        $request = $this->institution_service->storeExam($data);

        session()->flash('success', [
            'success'    => $request['success'],
            'messages'   => $request['messages']
        ]);
        $current_school_year = $year;
        return redirect()->route('admin.show.dashboard',$current_school_year);
    }

    public function ExamResults($year,$id)
    {
        //dd($year,$id);
        $page_title = 'Resultado';
        $guard = 'admins';

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

        //find the admin id
        $admin_data = $this->repository->findWhere([
            'collaborator_id'   => $collaborator_id,
            'email'             => Auth::user()->email
        ])->first();
        $admin_id = $admin_data->id;

        //find the admin type
        $admin_type_choice_data = $this->admin_type_choice_repository->findWhere([
            'admin_id' => $admin_id
        ])->first();

        $admin_type_data = DB::table('admin_types')
            ->where('id', $admin_type_choice_data->admin_type_id)
            ->select('admin_type')
            ->first();

        $exam = DB::table('exams')
            ->join('curricular_components','curricular_components.id','=','exams.curricular_component_id')
            ->join('teachers','teachers.id','=','exams.teacher_id')
            ->join('institution_school_year_divisions','institution_school_year_divisions.id','=','exams.division_id')
            ->join('institution_classes','institution_classes.id','=','exams.institution_class_id')
            ->where('exams.id','=',$id)
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
                ->where('exam_id','=',$id)
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

        return view('admins.exam-results',[
            'current_school_year'                => $current_school_year,
            'guard'                              => $guard,
            'title'                              => $page_title,
            'online_collaborator_institution_id' => $online_collaborator_institution_id,
            'online_institution_name'            => $online_institution_data->name,
            'all_school_years'                   => $all_school_years,
            'online_collaborator_id'             => $collaborator_id,
            'admin_type_data'                    => $admin_type_data->admin_type,
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

    public function UpdateExam($year,$id,Request $request)
    {
        $request = $this->institution_service->updateExam($request->all(),$id);

        session()->flash('success', [
            'success'    => $request['success'],
            'messages'   => $request['messages']
        ]);

        $current_school_year = $year;
        return redirect()->route('admin.show.dashboard',$current_school_year);
    }

    public function ExportInstitutionClassSchedule($year, $institution_class_id)
    {
        $collaborator_id = Auth::user()->collaborator_id;

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

        $institution_class_name = DB::table('institution_classes')
            ->where('institution_id','=', $online_collaborator_institution_id)
            ->where('id','=',$institution_class_id)
            ->where('school_year_id','=',$school_year_id->id)
            ->first();

        $schedule = DB::table('institution_class_schedules')
            ->join('institution_classes','institution_classes.id','=','institution_class_schedules.institution_class_id')
            ->join('curricular_components','curricular_components.id','=','institution_class_schedules.curricular_component_id')
            ->where('institution_class_schedules.institution_class_id','=',$institution_class_id)
            ->select('institution_class_schedules.hour','institution_class_schedules.institution_class_id','institution_class_schedules.week_day','institution_class_schedules.sequence','institution_classes.institution_class','curricular_components.component')
            ->orderBy('institution_class_schedules.week_day','ASC')
            ->orderBy('institution_class_schedules.sequence','ASC')
            ->orderBy('institution_class_schedules.hour','ASC')
            ->get();

        $teacher_classes = DB::table('teacher_classes')
            ->join('curricular_components','curricular_components.id','=','teacher_classes.curricular_component_id')
            ->join('teachers','teachers.id','=','teacher_classes.teacher_id')
            ->where('teacher_classes.institution_id','=', $online_collaborator_institution_id)
            ->where('teacher_classes.school_year_id','=',$school_year_id->id)
            ->where('teacher_classes.institution_class_id','=',$institution_class_id)
            ->select('curricular_components.component','teachers.name')
            ->get();
        
        /*Export to sheet format*/

        $templatePath = substr(__DIR__, 0,24) . '/storage/templates/class-schedule-template.xlsx';
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($templatePath);

        $worksheet = $spreadsheet->getActiveSheet();

        $worksheet->getCell('A1')->setValue($online_institution_data->name);
        $worksheet->getCell('A2')->setValue(mb_strtoupper($online_institution_data->motto,mb_internal_encoding()));
        $worksheet->getCell('A4')->setValue(mb_strtoupper('Horário de aula - '.$institution_class_name->institution_class,mb_internal_encoding()));

        $line = 7;
        for($i=0;$i<5;$i++){
            foreach($schedule as $data){
                if($data->week_day == ($i+1)){
                    $worksheet->getCellByColumnAndRow((1),$line)->setValue($data->hour);
                    $worksheet->getCellByColumnAndRow(($i+2),$line)->setValue($data->component);
                    $line++;
                }
            }
            $line=7;
        }
        $line = 20;
        foreach ($teacher_classes as $tc) {
            $worksheet->getCellByColumnAndRow(2,$line)->setValue($tc->component);
            $worksheet->getCellByColumnAndRow(3,$line)->setValue($tc->name);
            $line++;
        }

        // Redirect output to a client’s web browser (Xlsx)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Horário de aula - '.$institution_class_name->institution_class.'.xlsx"');
        header('Cache-Control: max-age=0');
        // If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');

        // If you're serving to IE over SSL, then the following may be needed
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
        header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header('Pragma: public'); // HTTP/1.0

        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');

        dd($schedule);
    }

    public function storeInstitutionClassSchedule($year,Request $request)
    {
        $current_school_year = $year;
        //dd($request->all());
        $request = $this->institution_service->storeInstitutionClassSchedule($request->all());

        session()->flash('success', [
            'success'    => $request['success'],
            'messages'   => $request['messages']
        ]);
        return redirect()->route('admin.show.dashboard',$current_school_year);
    }

    public function storeStudentAttendance($year,$class_id, Request $request)
    {
        $current_school_year = $year;
     
        //find the id of the year
        $school_year_id = DB::table('school_years')
            ->where('institution_id',$request['institution_id'])
            ->where('year',$current_school_year)
            ->select('id')
            ->first();

        $week_day = date('w',strtotime($request['day']));
        
        
        //find the schedule
        $schedule = DB::table('institution_class_schedules')
            ->join('curricular_components','institution_class_schedules.curricular_component_id','=','curricular_components.id')
            ->where('institution_class_schedules.institution_class_id', $class_id)
            ->where('institution_class_schedules.institution_id',$request['institution_id'])
            ->where('institution_class_schedules.school_year_id',$school_year_id->id)
            ->where('institution_class_schedules.week_day', $week_day)
            ->select(
                'institution_class_schedules.id',
                'institution_class_schedules.hour',
                'curricular_components.component'
            )
            ->get();
        //attendance
        foreach ($schedule as $sc) {
            $data = [
                'day'                           => $request['day'],
                'student_id'                    => $request['student_id'],
                'institution_class_schedule_id' => $sc->id,
                'institution_id'                => $request['institution_id']
            ];

            $school_attendance = $this->student_service->storeStudentSchoolAttendance($data);
        }
        return redirect()->route('admin.show.class.students',[
            'year'      => $current_school_year,
            'class_id'  => $class_id
        ]);
    }

     public function deletePrevisionSetup($year,$id)
    {
        $current_school_year = $year;

        $request = $this->institution_service->destroyPrevision($id);

        session()->flash('success', [
            'success'    => $request['success'],
            'messages'   => $request['messages']
        ]);
        return redirect()->route('admin.show.dashboard',$current_school_year);
    }

    public function previsionSetup($year, Request $request){
        //dd($request->all());
        $current_school_year = $year;
        $request = $this->institution_service->storePrevisionSetup($request->all());

        session()->flash('success', [
            'success'    => $request['success'],
            'messages'   => $request['messages']
        ]);
        return redirect()->route('admin.show.dashboard',$current_school_year);
    }
    
    public function Prevision($year, $class_id, Request $request){
        $page_title                 = 'Previsão';
        $guard                      = 'admins';
        $collaborator_id            = Auth::user()->collaborator_id;
        $current_school_year        = $year;
        $online_collaborator_data   = $this->collaborator_repository->findWhere([
            'id'=> $collaborator_id
        ])->first();

        $curricular_component_id = $request['curricular_component_id'];

        $online_collaborator_institution_id = $online_collaborator_data->institution_id;

        $online_institution_data  = $this->institution_repository->findWhere([
            'id'    => $online_collaborator_institution_id
        ])->first();

        //find the class name
        $class_name = DB::table('institution_classes')
            ->where('id','=',$class_id)
            ->select('institution_class')
            ->first(); 

        //find the curricular component name
        $curricular_component_name = DB::table('curricular_components')
            ->where('id',  '=',$curricular_component_id)
            ->select('component')
            ->first(); 
        //find all curricular components
        $curricular_components = DB::table('curricular_components')
            ->where('year',$current_school_year)
            ->where('institution_id',$online_collaborator_institution_id)
            ->select('id','component')
            ->get();

        //find the admin id
        $admin_data = $this->repository->findWhere([
            'collaborator_id'   => $collaborator_id,
            'email'             => Auth::user()->email
        ])->first();
        $admin_id = $admin_data->id;

        //find the admin type
        $admin_type_choice_data = $this->admin_type_choice_repository->findWhere([
            'admin_id' => $admin_id
        ])->first();

        $admin_type_data = DB::table('admin_types')
            ->where('id', $admin_type_choice_data->admin_type_id)
            ->select('admin_type')
            ->first();

        $all_school_years = $this->school_year_repository->findWhere([
            'institution_id' => $online_collaborator_institution_id
        ])->all();

        //get the id of the year
        $school_year_id = DB::table('school_years')
            ->where('institution_id',$online_collaborator_institution_id)
            ->where('year',$current_school_year)
            ->select('id')
            ->first();


        //get the class days
        $week_day_classes = DB::table('institution_class_schedules')
            ->where('institution_class_id',     '=',$class_id)
            ->where('curricular_component_id',  '=',$curricular_component_id)
            ->where('institution_id',           '=',$online_collaborator_institution_id)
            ->where('school_year_id',           '=',$school_year_id->id)
            ->distinct()
            ->get('week_day');

        //get the amount of classes in the specific day
        $week_day_classes_data = [];
        foreach ($week_day_classes as $wdc) {
            $query = DB::table('institution_class_schedules')
                ->where('institution_class_id',     '=',$class_id)
                ->where('curricular_component_id',  '=',$curricular_component_id)
                ->where('institution_id',           '=',$online_collaborator_institution_id)
                ->where('school_year_id',           '=',$school_year_id->id)
                ->where('week_day',                 '=',$wdc->week_day)
                ->select('week_day')
                ->get();
            array_push($week_day_classes_data,[
                'week_day'  => $wdc->week_day,
                'amount'    => count($query)
            ]);
        }

        $calendar_days = DB::table('institution_calendars')
            ->join('institution_calendar_activities','institution_calendar_activities.id','=','institution_calendars.activity_id')
            ->where('institution_calendars.institution_id',$online_collaborator_institution_id)
            ->where('institution_calendars.year', $current_school_year)
            ->where('class_day','=','yes')
            ->orderBy('institution_calendars.day','ASC')
            ->select('institution_calendars.id','institution_calendars.day','institution_calendars.activity_id','institution_calendars.motive','institution_calendars.class_day','institution_calendars.year','institution_calendar_activities.activity')
            ->get();
        

        //get the amount of saturdays
        $amount_saturdays = 0;
        $prevision_sumary = [];
        $all_calendar_saturdays  = [];
        $all_prevision_saturdays = [];
        //loop for taking all the calendar_days
        for ($i=0; $i < count($calendar_days); $i++) { 
            if(date('w',strtotime($calendar_days[$i]->day))==6){
                //the amount of saturdays is related to the weekday
                //example: if the amount is 1 the day of the week related is monday
                $amount_saturdays++;
                if($amount_saturdays==6){
                    //when the amount reach 6 restart the counting to 1 wich is monday
                    $amount_saturdays=1;
                }
                array_push($all_calendar_saturdays, $calendar_days[$i]->day);
                //search for week_day_classes_data where weekday is equal to amount_saturdays
                //get the amount of classes related to the class day
                for ($j=0; $j < count($week_day_classes_data); $j++) {
                    if($week_day_classes_data[$j]['week_day']==$amount_saturdays){
                        array_push($all_prevision_saturdays, $calendar_days[$i]->day);
                        array_push($prevision_sumary,[
                            'calendar_day'  => $calendar_days[$i]->day,
                            'amount'        => $week_day_classes_data[$j]['amount']
                        ]);
                    }
                }
            }else{
                for ($j=0; $j < count($week_day_classes_data); $j++) {
                    //get the days with class
                    if(date('w',strtotime($calendar_days[$i]->day))==$week_day_classes_data[$j]['week_day']){
                        //get the amount of classes related to the class day
                        array_push($prevision_sumary,[
                            'calendar_day'  => $calendar_days[$i]->day,
                            'amount'        => $week_day_classes_data[$j]['amount']
                        ]);
                    }
                }
            }
        }

        //get the grade
        $grade_related_to_class = DB::table('institution_classes')
            ->where('institution_id','=',$online_collaborator_institution_id)
            ->where('id','=',$class_id)
            ->select('grade_id')
            ->first();

        //get the total hours
        $total_hours = DB::table('prevision_setups')
            ->where('institution_id','=',$online_collaborator_institution_id)
            ->where('curricular_component_id','=',$curricular_component_id)
            ->where('grade_id','=',$grade_related_to_class->grade_id)
            ->select('total_hours')
            ->first();
        if(is_null($total_hours)){
            $total_hours = null;
        }else{
            $total_hours = $total_hours->total_hours;
        }
        
        //months
        $months = ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'];
        $months_length = count($months);

        //echo '<br>Carga Horária Atual: '.count($prevision).'<br>';
        //echo 'Carga Horária Esperada: '.$total_hours->total_hours.'<br>';
        //echo 'Faltam '.($total_hours->total_hours-count($prevision));

        //verify if the remaining hours < 10
        //se sim, comparar as datas do calendário com a previsão (prevision) realizada acima
        //e encontrar as datas que possuem activity_id = 5 que é conselho de classe e add somente a quantidade que está faltando no array (prevision)

        //serch the teacher related to this curricular component 
        $teacher_data = DB::table('teacher_classes')
            ->where('institution_class_id','=',$class_id)
            ->where('curricular_component_id','=',$curricular_component_id)
            ->select('teacher_id')
            ->first();
            //dd(is_null($teacher_data));
        $counter_total_hours=0;
        for($i=0;$i<$months_length;$i++){
            for ($j=0; $j < count($prevision_sumary); $j++) { 
                if(date('m',strtotime($prevision_sumary[$j]['calendar_day']))==($i+1)){
                    for ($k=0; $k < $prevision_sumary[$j]['amount']; $k++) { 
                        $counter_total_hours++;
                    }
                }
            }
        }
        //add new saturdays to prevision if expected total hours < ideal total
        $new_saturdays = [];
        if($total_hours>$counter_total_hours){
            $missing_hours = $total_hours-$counter_total_hours;

            if($missing_hours<15){
                //get the saturdays that is different from the calendar
           
                /*echo 'ANTES <br>';
                echo 'Esperado: '.$total_hours, 'Atual: '.$counter_total_hours.'<br>';*/
                $new_saturdays = $all_calendar_saturdays;//add all saturdays into new_saturdays and remove what is common between calendar's saturdays and prevision's saturdays
                for($i=0;$i<count($all_calendar_saturdays);$i++){
                    for ($j=0; $j < count($all_prevision_saturdays); $j++) { 
                        if($all_calendar_saturdays[$i]==$all_prevision_saturdays[$j]){
                            unset($new_saturdays[$i]);
                        }
                    }
                }
                if(count($new_saturdays)==0){
                    if($missing_hours==count($all_calendar_saturdays)){
                        foreach ($all_calendar_saturdays as $saturday) {
                            array_push($prevision_sumary, [
                                'calendar_day'  => $saturday,
                                'amount'        => 1
                            ]);
                        }
                    }
                    if($missing_hours<count($all_calendar_saturdays)){
                        $iteration_counter=0;
                        foreach ($all_calendar_saturdays as $saturday) {
                            array_push($prevision_sumary, [
                                'calendar_day'  => $saturday,
                                'amount'        => 1
                            ]);
                            $iteration_counter++;
                            if($iteration_counter==$missing_hours) break;
                        }
                    }
                    if($missing_hours>count($all_calendar_saturdays)){
                        if($missing_hours%2 == 0){
                            if(count($all_calendar_saturdays)%2==0){
                                $amount_hours = $missing_hours/count($all_calendar_saturdays);
                                foreach ($all_calendar_saturdays as $saturday) {
                                    array_push($prevision_sumary, [
                                        'calendar_day'  => $saturday,
                                        'amount'        => $amount_hours
                                    ]);
                                }
                            }else{
                                //add new saturdays in prevision. This is made in two steps, first add the amount of saturdays and the missing hours is added doing a second loop
                                foreach ($all_calendar_saturdays as $saturday) {
                                    array_push($prevision_sumary, [
                                        'calendar_day'  => $saturday,
                                        'amount'        => 1
                                    ]);
                                }
                                //redo the counting
                                $counter_total_hours=0;
                                for($i=0;$i<$months_length;$i++){
                                    for ($j=0; $j < count($prevision_sumary); $j++) { 
                                        if(date('m',strtotime($prevision_sumary[$j]['calendar_day']))==($i+1)){
                                            for ($k=0; $k < $prevision_sumary[$j]['amount']; $k++) { 
                                                $counter_total_hours++;
                                            }
                                        }
                                    }
                                }
                                //second part of adding new saturdays to the prevision
                                foreach ($all_calendar_saturdays as $saturday) {
                                    array_push($prevision_sumary, [
                                        'calendar_day'  => $saturday,
                                        'amount'        => 1
                                    ]);
                                    if($counter_total_hours==$total_hours) break;
                                }
                            }
                        }
                    }
                }else{
                    if($missing_hours==count($new_saturdays)){
                        foreach ($new_saturdays as $saturday) {
                            array_push($prevision_sumary, [
                                'calendar_day'  => $saturday,
                                'amount'        => 1
                            ]);
                        }
                    }
                    if($missing_hours<count($new_saturdays)){
                        $iteration_counter=0;
                        foreach ($new_saturdays as $saturday) {
                            array_push($prevision_sumary, [
                                'calendar_day'  => $saturday,
                                'amount'        => 1
                            ]);
                            $iteration_counter++;
                            if($iteration_counter==$missing_hours) break;
                        }
                    }
                    if($missing_hours>count($new_saturdays)){
                        if($missing_hours%2 == 0){
                            if(count($new_saturdays)%2==0){
                                $amount_hours = $missing_hours/count($new_saturdays);
                                foreach ($new_saturdays as $saturday) {
                                    array_push($prevision_sumary, [
                                        'calendar_day'  => $saturday,
                                        'amount'        => $amount_hours
                                    ]);
                                }
                            }else{
                                //add new saturdays in prevision. This is made in two steps, first add the amount of saturdays and the missing hours is added doing a second loop
                                foreach ($new_saturdays as $saturday) {
                                    array_push($prevision_sumary, [
                                        'calendar_day'  => $saturday,
                                        'amount'        => 1
                                    ]);
                                }
                                //redo the counting
                                $counter_total_hours=0;
                                for($i=0;$i<$months_length;$i++){
                                    for ($j=0; $j < count($prevision_sumary); $j++) { 
                                        if(date('m',strtotime($prevision_sumary[$j]['calendar_day']))==($i+1)){
                                            for ($k=0; $k < $prevision_sumary[$j]['amount']; $k++) { 
                                                $counter_total_hours++;
                                            }
                                        }
                                    }
                                }
                                //second part of adding new saturdays to the prevision
                                foreach ($new_saturdays as $saturday) {
                                    array_push($prevision_sumary, [
                                        'calendar_day'  => $saturday,
                                        'amount'        => 1
                                    ]);
                                    if($counter_total_hours==$total_hours) break;
                                }
                            }
                        }
                    }
                }
                //redo the counting
                $counter_total_hours=0;
                for($i=0;$i<$months_length;$i++){
                    for ($j=0; $j < count($prevision_sumary); $j++) { 
                        if(date('m',strtotime($prevision_sumary[$j]['calendar_day']))==($i+1)){
                            for ($k=0; $k < $prevision_sumary[$j]['amount']; $k++) { 
                                $counter_total_hours++;
                            }
                        }
                    }
                }
                //sort array
                $aux = [];
                for($i = 0; $i < count($prevision_sumary); $i++){
                    for($j = 0; $j < count($prevision_sumary) - 1; $j++){
                        if($prevision_sumary[$j]['calendar_day'] > $prevision_sumary[$j + 1]['calendar_day']){
                            $aux[0] = $prevision_sumary[$j];
                            $prevision_sumary[$j] = $prevision_sumary[$j + 1];
                            $prevision_sumary[$j + 1] = $aux[0];
                        }
                    }
                }
                /*echo 'DEPOIS <br>';
                echo 'Esperado: '.$total_hours, 'Atual: '.$counter_total_hours;
                dd($all_calendar_saturdays,'Sábados da previsão: ', $all_prevision_saturdays,'Novos Sábados:',$new_saturdays,'Horas a complementar:',$missing_hours,'Previsão:',$prevision_sumary);*/
            }
        }

        return view('admins.prevision',[
            'guard'                              => $guard,
            'title'                              => $page_title,
            'prevision_sumary'                   => $prevision_sumary,
            'online_collaborator_name'           => $online_collaborator_data->name,
            'online_collaborator_id'             => $collaborator_id,
            'admin_type_data'                    => $admin_type_data->admin_type,
            'online_collaborator_institution_id' => $online_collaborator_institution_id,
            'online_institution_name'            => $online_institution_data->name,
            'current_school_year'                => $current_school_year,
            'all_school_years'                   => $all_school_years,
            'curricular_component_name'          => $curricular_component_name->component,
            'currricular_component_id'           => $curricular_component_id,
            'curricular_components'              => $curricular_components,
            'class_name'                         => $class_name->institution_class,
            'months'                             => $months,
            'months_length'                      => $months_length,
            'teacher_data'                       => $teacher_data,
            'class_id'                           => $class_id,
            'week_day_classes'                   => $week_day_classes,
            'counter_total_hours'                => $counter_total_hours,
            'expected_total_hours'               => $total_hours
        ]);
    }

    public function ExportPrevisionDataSheet($year, $class_id, $teacher_id, $curricular_component_id)
    {
        $guard      = 'admins';
        
        $current_school_year = $year;

        $collaborator_id = Auth::user()->collaborator_id;

        $online_collaborator_data = $this->collaborator_repository->findWhere([
            'id'=> $collaborator_id
        ])->first();

        $online_collaborator_institution_id = $online_collaborator_data->institution_id;

        $online_institution_data  = $this->institution_repository->findWhere([
            'id'    => $online_collaborator_institution_id
        ])->first();

        //get the id of the year
        $school_year_id = DB::table('school_years')
            ->where('institution_id',$online_collaborator_institution_id)
            ->where('year',$current_school_year)
            ->select('id')
            ->first();

        //get the class days
        $week_day_classes = DB::table('institution_class_schedules')
            ->where('institution_class_id',     '=',$class_id)
            ->where('curricular_component_id',  '=',$curricular_component_id)
            ->where('institution_id',           '=',$online_collaborator_institution_id)
            ->where('school_year_id',           '=',$school_year_id->id)
            ->distinct()
            ->get('week_day');

        //get the amount of classes in the specific day
        $week_day_classes_data = [];
        foreach ($week_day_classes as $wdc) {
            $query = DB::table('institution_class_schedules')
                ->where('institution_class_id',     '=',$class_id)
                ->where('curricular_component_id',  '=',$curricular_component_id)
                ->where('institution_id',           '=',$online_collaborator_institution_id)
                ->where('school_year_id',           '=',$school_year_id->id)
                ->where('week_day',                 '=',$wdc->week_day)
                ->select('week_day')
                ->get();
            array_push($week_day_classes_data,[
                'week_day'  => $wdc->week_day,
                'amount'    => count($query)
            ]);
        }

        $calendar_days = DB::table('institution_calendars')
            ->join('institution_calendar_activities','institution_calendar_activities.id','=','institution_calendars.activity_id')
            ->where('institution_calendars.institution_id',$online_collaborator_institution_id)
            ->where('institution_calendars.year', $current_school_year)
            ->where('class_day','=','yes')
            ->orderBy('institution_calendars.day','ASC')
            ->select('institution_calendars.id','institution_calendars.day','institution_calendars.activity_id','institution_calendars.motive','institution_calendars.class_day','institution_calendars.year','institution_calendar_activities.activity')
            ->get();
        

        //get the amount of saturdays
        $amount_saturdays        = 0;
        $prevision_sumary        = [];
        $all_calendar_saturdays  = [];
        $all_prevision_saturdays = [];
        //loop for taking all the calendar_days
        for ($i=0; $i < count($calendar_days); $i++) { 
            if(date('w',strtotime($calendar_days[$i]->day))==6){
                //the amount of saturdays is related to the weekday
                //example: if the amount is 1 the day of the week related is monday
                $amount_saturdays++;
                if($amount_saturdays==6){
                    //when the amount reach 6 restart the counting to 1 wich is monday
                    $amount_saturdays=1;
                }
                array_push($all_calendar_saturdays, $calendar_days[$i]->day);
                //search for week_day_classes_data where weekday is equal to amount_saturdays
                //get the amount of classes related to the class day
                for ($j=0; $j < count($week_day_classes_data); $j++) {
                    if($week_day_classes_data[$j]['week_day']==$amount_saturdays){
                        array_push($all_prevision_saturdays, $calendar_days[$i]->day);
                        array_push($prevision_sumary,[
                            'calendar_day'  => $calendar_days[$i]->day,
                            'amount'        => $week_day_classes_data[$j]['amount']
                        ]);
                    }
                }
            }else{
                for ($j=0; $j < count($week_day_classes_data); $j++) {
                    //get the days with class
                    if(date('w',strtotime($calendar_days[$i]->day))==$week_day_classes_data[$j]['week_day']){
                        //get the amount of classes related to the class day
                        array_push($prevision_sumary,[
                            'calendar_day'  => $calendar_days[$i]->day,
                            'amount'        => $week_day_classes_data[$j]['amount']
                        ]);
                    }
                }
            }
        }

        //get the grade
        $grade_related_to_class = DB::table('institution_classes')
            ->where('institution_id','=',$online_collaborator_institution_id)
            ->where('id','=',$class_id)
            ->select('grade_id')
            ->first();

        //get the total hours
        $total_hours = DB::table('prevision_setups')
            ->where('institution_id','=',$online_collaborator_institution_id)
            ->where('curricular_component_id','=',$curricular_component_id)
            ->where('grade_id','=',$grade_related_to_class->grade_id)
            ->select('total_hours')
            ->first();
        if(is_null($total_hours)){
            $total_hours = null;
        }else{
            $total_hours = $total_hours->total_hours;
        }
        //months
        $months = ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'];
        $months_length = count($months);

        //serch the teacher related to this curricular component 
        $teacher_data = DB::table('teacher_classes')
            ->join('teachers','teachers.id','=','teacher_classes.teacher_id')
            ->where('teacher_classes.institution_class_id','=',$class_id)
            ->where('teacher_classes.curricular_component_id','=',$curricular_component_id)
            ->select('teacher_classes.teacher_id','teachers.name')
            ->first();

        //find the curricular component name
        $curricular_component_name = DB::table('curricular_components')
            ->where('id',  '=',$curricular_component_id)
            ->select('component')
            ->first();

        //find the class name
        $class_name = DB::table('institution_classes')
            ->where('id','=',$class_id)
            ->select('institution_class')
            ->first();

        $counter_total_hours=0;
        for($i=0;$i<$months_length;$i++){
            for ($j=0; $j < count($prevision_sumary); $j++) { 
                if(date('m',strtotime($prevision_sumary[$j]['calendar_day']))==($i+1)){
                    for ($k=0; $k < $prevision_sumary[$j]['amount']; $k++) { 
                        $counter_total_hours++;
                    }
                }
            }
        }
        //add new saturdays to prevision if expected total hours < ideal total
        $new_saturdays = [];
        if($total_hours>$counter_total_hours){
            $missing_hours = $total_hours-$counter_total_hours;

            if($missing_hours<15){
                //get the saturdays that is different from the calendar
           
                /*echo 'ANTES <br>';
                echo 'Esperado: '.$total_hours, 'Atual: '.$counter_total_hours.'<br>';*/
                $new_saturdays = $all_calendar_saturdays;//add all saturdays into new_saturdays and remove what is common between calendar's saturdays and prevision's saturdays
                for($i=0;$i<count($all_calendar_saturdays);$i++){
                    for ($j=0; $j < count($all_prevision_saturdays); $j++) { 
                        if($all_calendar_saturdays[$i]==$all_prevision_saturdays[$j]){
                            unset($new_saturdays[$i]);
                        }
                    }
                }
                if(count($new_saturdays)==0){
                    if($missing_hours==count($all_calendar_saturdays)){
                        foreach ($all_calendar_saturdays as $saturday) {
                            array_push($prevision_sumary, [
                                'calendar_day'  => $saturday,
                                'amount'        => 1
                            ]);
                        }
                    }
                    if($missing_hours<count($all_calendar_saturdays)){
                        $iteration_counter=0;
                        foreach ($all_calendar_saturdays as $saturday) {
                            array_push($prevision_sumary, [
                                'calendar_day'  => $saturday,
                                'amount'        => 1
                            ]);
                            $iteration_counter++;
                            if($iteration_counter==$missing_hours) break;
                        }
                    }
                    if($missing_hours>count($all_calendar_saturdays)){
                        if($missing_hours%2 == 0){
                            if(count($all_calendar_saturdays)%2==0){
                                $amount_hours = $missing_hours/count($all_calendar_saturdays);
                                foreach ($all_calendar_saturdays as $saturday) {
                                    array_push($prevision_sumary, [
                                        'calendar_day'  => $saturday,
                                        'amount'        => $amount_hours
                                    ]);
                                }
                            }else{
                                //add new saturdays in prevision. This is made in two steps, first add the amount of saturdays and the missing hours is added doing a second loop
                                foreach ($all_calendar_saturdays as $saturday) {
                                    array_push($prevision_sumary, [
                                        'calendar_day'  => $saturday,
                                        'amount'        => 1
                                    ]);
                                }
                                //redo the counting
                                $counter_total_hours=0;
                                for($i=0;$i<$months_length;$i++){
                                    for ($j=0; $j < count($prevision_sumary); $j++) { 
                                        if(date('m',strtotime($prevision_sumary[$j]['calendar_day']))==($i+1)){
                                            for ($k=0; $k < $prevision_sumary[$j]['amount']; $k++) { 
                                                $counter_total_hours++;
                                            }
                                        }
                                    }
                                }
                                //second part of adding new saturdays to the prevision
                                foreach ($all_calendar_saturdays as $saturday) {
                                    array_push($prevision_sumary, [
                                        'calendar_day'  => $saturday,
                                        'amount'        => 1
                                    ]);
                                    if($counter_total_hours==$total_hours) break;
                                }
                            }
                        }
                    }
                }else{
                    if($missing_hours==count($new_saturdays)){
                        foreach ($new_saturdays as $saturday) {
                            array_push($prevision_sumary, [
                                'calendar_day'  => $saturday,
                                'amount'        => 1
                            ]);
                        }
                    }
                    if($missing_hours<count($new_saturdays)){
                        $iteration_counter=0;
                        foreach ($new_saturdays as $saturday) {
                            array_push($prevision_sumary, [
                                'calendar_day'  => $saturday,
                                'amount'        => 1
                            ]);
                            $iteration_counter++;
                            if($iteration_counter==$missing_hours) break;
                        }
                    }
                    if($missing_hours>count($new_saturdays)){
                        if($missing_hours%2 == 0){
                            if(count($new_saturdays)%2==0){
                                $amount_hours = $missing_hours/count($new_saturdays);
                                foreach ($new_saturdays as $saturday) {
                                    array_push($prevision_sumary, [
                                        'calendar_day'  => $saturday,
                                        'amount'        => $amount_hours
                                    ]);
                                }
                            }else{
                                //add new saturdays in prevision. This is made in two steps, first add the amount of saturdays and the missing hours is added doing a second loop
                                foreach ($new_saturdays as $saturday) {
                                    array_push($prevision_sumary, [
                                        'calendar_day'  => $saturday,
                                        'amount'        => 1
                                    ]);
                                }
                                //redo the counting
                                $counter_total_hours=0;
                                for($i=0;$i<$months_length;$i++){
                                    for ($j=0; $j < count($prevision_sumary); $j++) { 
                                        if(date('m',strtotime($prevision_sumary[$j]['calendar_day']))==($i+1)){
                                            for ($k=0; $k < $prevision_sumary[$j]['amount']; $k++) { 
                                                $counter_total_hours++;
                                            }
                                        }
                                    }
                                }
                                //second part of adding new saturdays to the prevision
                                foreach ($new_saturdays as $saturday) {
                                    array_push($prevision_sumary, [
                                        'calendar_day'  => $saturday,
                                        'amount'        => 1
                                    ]);
                                    if($counter_total_hours==$total_hours) break;
                                }
                            }
                        }
                    }
                }
                //redo the counting
                $counter_total_hours=0;
                for($i=0;$i<$months_length;$i++){
                    for ($j=0; $j < count($prevision_sumary); $j++) { 
                        if(date('m',strtotime($prevision_sumary[$j]['calendar_day']))==($i+1)){
                            for ($k=0; $k < $prevision_sumary[$j]['amount']; $k++) { 
                                $counter_total_hours++;
                            }
                        }
                    }
                }
                //sort array
                $aux = [];
                for($i = 0; $i < count($prevision_sumary); $i++){
                    for($j = 0; $j < count($prevision_sumary) - 1; $j++){
                        if($prevision_sumary[$j]['calendar_day'] > $prevision_sumary[$j + 1]['calendar_day']){
                            $aux[0] = $prevision_sumary[$j];
                            $prevision_sumary[$j] = $prevision_sumary[$j + 1];
                            $prevision_sumary[$j + 1] = $aux[0];
                        }
                    }
                }
                /*echo 'DEPOIS <br>';
                echo 'Esperado: '.$total_hours, 'Atual: '.$counter_total_hours;
                dd($all_calendar_saturdays,'Sábados da previsão: ', $all_prevision_saturdays,'Novos Sábados:',$new_saturdays,'Horas a complementar:',$missing_hours,'Previsão:',$prevision_sumary);*/
            }
        }


        /*Export to sheet format*/
        $templatePath = substr(__DIR__, 0,24) . '/storage/templates/prevision-template.xlsx';
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($templatePath);

        $worksheet = $spreadsheet->getActiveSheet();

        $worksheet->getCell('A1')->setValue(mb_strtoupper($online_institution_data->name, mb_internal_encoding()).' - '.mb_strtoupper($online_institution_data->city, mb_internal_encoding()).' - ESTADO DE(O) '.mb_strtoupper($online_institution_data->state, mb_internal_encoding()));
        $worksheet->getCell('A2')->setValue('PREVISÃO '.$year);
        $worksheet->getCell('C4')->setValue('COMPONENTE CURRICULAR: '.$curricular_component_name->component);
        $worksheet->getCell('C5')->setValue('TURMA: '.$class_name->institution_class);
        $worksheet->getCell('C6')->setValue('PROFESSOR (A): '.$teacher_data->name);
        $worksheet->getCell('A3')->setValue('SEINTEGRADO - Sistema Escolar Integrado');
        $worksheet->getCell('BO23')->setValue($total_hours);

        $line = 9;
        $column = 2;
        for($i=0;$i<$months_length;$i++){
            for ($j=0; $j < count($prevision_sumary); $j++) { 
                if(date('m',strtotime($prevision_sumary[$j]['calendar_day']))==($i+1)){
                    for ($k=0; $k < $prevision_sumary[$j]['amount']; $k++) { 
                        $worksheet->getCellByColumnAndRow(($column),($line))->setValue(date('d/m',strtotime($prevision_sumary[$j]['calendar_day'])));
                        $column++;
                    }
                }
            }
            $column = 2;
            $line++;
        }

         // Redirect output to a client’s web browser (Xlsx)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Previsão de "'.$curricular_component_name->component.'"do "'.$class_name->institution_class.'.xlsx"');
        header('Cache-Control: max-age=0');
        // If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');

        // If you're serving to IE over SSL, then the following may be needed
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
        header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header('Pragma: public'); // HTTP/1.0

        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
        
    }

    public function ExportDailyClassDataSheet($year, $class_id, $teacher_id,$curricular_component_id, $month)
    {
        $guard      = 'admins';
        
        $current_school_year = $year;

        $collaborator_id = Auth::user()->collaborator_id;

        $online_collaborator_data = $this->collaborator_repository->findWhere([
            'id'=> $collaborator_id
        ])->first();

        $online_collaborator_institution_id = $online_collaborator_data->institution_id;

        $online_institution_data  = $this->institution_repository->findWhere([
            'id'    => $online_collaborator_institution_id
        ])->first();

        //months
        $months = ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'];
        $months_length = count($months);

        //get the id of the year
        $school_year_id = DB::table('school_years')
            ->where('institution_id',$online_collaborator_institution_id)
            ->where('year',$current_school_year)
            ->select('id')
            ->first();

        //get the class days
        $week_day_classes = DB::table('institution_class_schedules')
            ->where('institution_class_id',     '=',$class_id)
            ->where('curricular_component_id',  '=',$curricular_component_id)
            ->where('institution_id',           '=',$online_collaborator_institution_id)
            ->where('school_year_id',           '=',$school_year_id->id)
            ->distinct()
            ->get('week_day');

        //get the amount of classes in the specific day
        $week_day_classes_data = [];
        foreach ($week_day_classes as $wdc) {
            $query = DB::table('institution_class_schedules')
                ->where('institution_class_id',     '=',$class_id)
                ->where('curricular_component_id',  '=',$curricular_component_id)
                ->where('institution_id',           '=',$online_collaborator_institution_id)
                ->where('school_year_id',           '=',$school_year_id->id)
                ->where('week_day',                 '=',$wdc->week_day)
                ->select('week_day')
                ->get();
            array_push($week_day_classes_data,[
                'week_day'  => $wdc->week_day,
                'amount'    => count($query)
            ]);
        }

        $calendar_days = DB::table('institution_calendars')
            ->join('institution_calendar_activities','institution_calendar_activities.id','=','institution_calendars.activity_id')
            ->where('institution_calendars.institution_id',$online_collaborator_institution_id)
            ->where('institution_calendars.year', $current_school_year)
            ->where('class_day','=','yes')
            ->orderBy('institution_calendars.day','ASC')
            ->select('institution_calendars.id','institution_calendars.day','institution_calendars.activity_id','institution_calendars.motive','institution_calendars.class_day','institution_calendars.year','institution_calendar_activities.activity')
            ->get();
        
        //get the amount of saturdays
        $amount_saturdays = 0;
        $prevision_sumary = [];
        $all_calendar_saturdays  = [];
        $all_prevision_saturdays = [];
        //loop for taking all the calendar_days
        for ($i=0; $i < count($calendar_days); $i++) { 
            if(date('w',strtotime($calendar_days[$i]->day))==6){
                //the amount of saturdays is related to the weekday
                //example: if the amount is 1 the day of the week related is monday
                $amount_saturdays++;
                if($amount_saturdays==6){
                    //when the amount reach 6 restart the counting to 1 wich is monday
                    $amount_saturdays=1;
                }
                array_push($all_calendar_saturdays, $calendar_days[$i]->day);
                //search for week_day_classes_data where weekday is equal to amount_saturdays
                //get the amount of classes related to the class day
                for ($j=0; $j < count($week_day_classes_data); $j++) {
                    if($week_day_classes_data[$j]['week_day']==$amount_saturdays){
                        array_push($all_prevision_saturdays, $calendar_days[$i]->day);
                        array_push($prevision_sumary,[
                            'calendar_day'  => $calendar_days[$i]->day,
                            'amount'        => $week_day_classes_data[$j]['amount'],
                            'activity_id'   => $calendar_days[$i]->activity_id,
                            'activity'      => $calendar_days[$i]->activity
                        ]);
                    }
                }
            }else{
                for ($j=0; $j < count($week_day_classes_data); $j++) {
                    //get the days with class
                    if(date('w',strtotime($calendar_days[$i]->day))==$week_day_classes_data[$j]['week_day']){
                        //get the amount of classes related to the class day
                        array_push($prevision_sumary,[
                            'calendar_day'  => $calendar_days[$i]->day,
                            'amount'        => $week_day_classes_data[$j]['amount'],
                            'activity_id'   => $calendar_days[$i]->activity_id,
                            'activity'      => $calendar_days[$i]->activity
                        ]);
                    }
                }
            }
        }

        //get the grade
        $grade_related_to_class = DB::table('institution_classes')
            ->where('institution_id','=',$online_collaborator_institution_id)
            ->where('id','=',$class_id)
            ->select('grade_id')
            ->first();

        //get the total hours
        $total_hours = DB::table('prevision_setups')
            ->where('institution_id','=',$online_collaborator_institution_id)
            ->where('curricular_component_id','=',$curricular_component_id)
            ->where('grade_id','=',$grade_related_to_class->grade_id)
            ->select('total_hours')
            ->first();

        //months
        $months = ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'];
        $months_length = count($months);

        //serch the teacher related to this curricular component 
        $teacher_data = DB::table('teacher_classes')
            ->join('teachers','teachers.id','=','teacher_classes.teacher_id')
            ->where('teacher_classes.institution_id','=',$online_collaborator_institution_id)
            ->where('teacher_classes.institution_class_id','=',$class_id)
            ->where('teacher_classes.curricular_component_id','=',$curricular_component_id)
            ->select('teacher_classes.teacher_id','teachers.name')
            ->first();

        //find the curricular component name
        $curricular_component_name = DB::table('curricular_components')
            ->where('id',  '=',$curricular_component_id)
            ->where('institution_id','=',$online_collaborator_institution_id)
            ->select('component')
            ->first();

        //find the class name
        $class_name = DB::table('institution_classes')
            ->join('grades','grades.id','=','institution_classes.grade_id')
            ->join('scholarities','scholarities.id','=','grades.scholarity_id')
            ->where('institution_classes.institution_id','=',$online_collaborator_institution_id)
            ->where('institution_classes.id','=',$class_id)
            ->select('institution_classes.institution_class','institution_classes.school_shifts','grades.grade','scholarities.scholarity')
            ->first();

        //get the first day of school
        $first_day = DB::table('school_years')
            ->where('institution_id','=',$online_collaborator_institution_id)
            ->where('year',$current_school_year)
            ->select('first_day')
            ->first();
        //dd($first_day->first_day);
        //get students before the first day of school
        $students_before = DB::table('students')
            ->join('student_enrollments','student_enrollments.student_id','=','students.id')
            ->where('student_enrollments.institution_id','=',$online_collaborator_institution_id)
            ->where('student_enrollments.institution_class_id', $class_id)
            ->where('student_enrollments.enrollment_year',$current_school_year)
            ->where('student_enrollments.enrollment_date','<',$first_day->first_day)
            ->select('students.id','students.name','student_enrollments.enrollment_date', 'student_enrollments.transfer_date', 'student_enrollments.transfer_type')
            ->orderBy('students.name','ASC')
            ->get();
        $students_after = DB::table('students')
            ->join('student_enrollments','student_enrollments.student_id','=','students.id')
            ->where('student_enrollments.institution_id','=',$online_collaborator_institution_id)
            ->where('student_enrollments.institution_class_id', $class_id)
            ->where('student_enrollments.enrollment_year',$current_school_year)
            ->where('student_enrollments.enrollment_date','>=',$first_day->first_day)
            ->select('students.id','students.name','student_enrollments.enrollment_date', 'student_enrollments.transfer_date', 'student_enrollments.transfer_type')
            ->orderBy('student_enrollments.enrollment_date','ASC')
            ->get();
        $all_students = [];
        foreach ($students_before as $data) {
            array_push($all_students, $data);
        }
        foreach ($students_after as $data) {
            array_push($all_students, $data);
        }
        //dd($all_students);
        

        /*Export to sheet format*/

        $templatePath = substr(__DIR__, 0,24) . '/storage/templates/daily-class-grid-template.xlsx';
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($templatePath);

        $worksheet = $spreadsheet->getActiveSheet();

        $worksheet->getCell('B3')->setValue(mb_strtoupper($online_institution_data->city, mb_internal_encoding()));
        $worksheet->getCell('B4')->setValue('ESTADO DE(O) '.mb_strtoupper($online_institution_data->state, mb_internal_encoding()));
        $worksheet->getCell('B5')->setValue(mb_strtoupper($online_institution_data->name, mb_internal_encoding()));
        $worksheet->getCell('B6')->setValue('SEINTEGRADO - Sistema Escolar Integrado');
        $worksheet->getCell('C3')->setValue('MÊS: '.mb_strtoupper($months[$month], mb_internal_encoding()));
        $worksheet->getCell('C2')->setValue('ANO: '.mb_strtoupper($class_name->scholarity, mb_internal_encoding()));
        $worksheet->getCell('C4')->setValue('ANO: '.mb_strtoupper($class_name->grade, mb_internal_encoding()));
        $worksheet->getCell('C5')->setValue('TURMA: '.mb_strtoupper($class_name->institution_class, mb_internal_encoding()));
        $worksheet->getCell('C6')->setValue('PROFESSOR (A): '.mb_strtoupper($teacher_data->name, mb_internal_encoding()));
        $worksheet->getCell('C7')->setValue('FREQUÊNCIA/AULAS DADAS EM '.mb_strtoupper($months[$month], mb_internal_encoding()));
        $worksheet->getCell('Q3')->setValue('COMPONENTE CURRICULAR: '.mb_strtoupper($curricular_component_name->component, mb_internal_encoding()));
        $worksheet->getCell('Q4')->setValue('ANO LETIVO: '.$current_school_year);
        $worksheet->getCell('Q5')->setValue('TURNO: '.mb_strtoupper($class_name->school_shifts, mb_internal_encoding()));

        $line_activity  = 9;
        $line           = 8;
        $column         = 3;

        for ($i=0; $i < count($prevision_sumary); $i++){//run for every prevision date
            if (date('m',strtotime($prevision_sumary[$i]['calendar_day']))==($month+1)){//get the dates of the chosen month
                for($j=0; $j < $prevision_sumary[$j]['amount']; $j++){//for every class
                    $worksheet->getCellByColumnAndRow(($column),($line))->setValue(date('d/m',strtotime($prevision_sumary[$i]['calendar_day'])));

                    foreach($all_students as $data){//for each student
                        $student_attendances = DB::table('student_school_attendances')
                            ->join('students','students.id','=','student_school_attendances.student_id')
                            ->where('students.id','=',$data->id)
                            ->whereMonth('student_school_attendances.day',($month+1))
                            ->select('students.id','students.name','student_school_attendances.day')
                            ->distinct()
                            ->get();
                        if(is_null($data->transfer_date)){//if there's no transfer date, it means that the student is enrolled
                            if(date('m',strtotime($data->enrollment_date))==($month+1)){//if month chosen is the same of enrollment month
                                if(date('Y',strtotime($data->enrollment_date))==($current_school_year)){//if year chosen is the same of enrollment year
                                    //put the name in the sheet with enrollment_date
                                    $worksheet->getCellByColumnAndRow((2),($line+1))->setValue($data->name.' - MAT '.date('d/m',strtotime($data->enrollment_date)));
                                }else{
                                    $worksheet->getCellByColumnAndRow((2),($line+1))->setValue($data->name);
                                }
                                
                            }else{//if month chosen is not the same of enrollment month
                                //put only the name in the sheet
                                if(date('Y',strtotime($data->enrollment_date))<$year){
                                    $worksheet->getCellByColumnAndRow((2),($line+1))->setValue($data->name);
                                }else{
                                    if(date('Y',strtotime($data->enrollment_date))==$year){
                                        if(date('m',strtotime($data->enrollment_date))<($month+1)){
                                            $worksheet->getCellByColumnAndRow((2),($line+1))->setValue($data->name);
                                        }
                                    }
                                }
                                
                            }

                            if($data->enrollment_date>$prevision_sumary[$i]['calendar_day']){//if the current prevision date is minor than the enrollment date
                                if(date('m',strtotime($data->enrollment_date))==($month+1)){
                                    $worksheet->getCellByColumnAndRow(($column),($line+1))->setValue('/');
                                }else{
                                    $worksheet->getCellByColumnAndRow(($column),($line+1))->setValue('');
                                }
                            }else{
                                if(count($student_attendances)==0){//if there're no attendances
                                    $worksheet->getCellByColumnAndRow(($column),($line+1))->setValue('.');
                                }else{//if there're attendances
                                    $aux_counter=0;
                                    for($k=0;$k<count($student_attendances);$k++){//for every attendance compare with the prevision
                                        if($prevision_sumary[$i]['calendar_day']==$student_attendances[$k]->day){//if prevision day is equal to attendance, means that student was not at the school
                                            $worksheet->getCellByColumnAndRow(($column),($line+1))->setValue('F');
                                            $aux_counter++;//amount of classes that student was not at the school
                                        }
                                    }
                                    if($aux_counter==0){//if zero, means that student was at the school
                                        $worksheet->getCellByColumnAndRow(($column),($line+1))->setValue('.');
                                    }
                                }
                            }
                        }else{//if student were transfered
                            if(date('m',strtotime($data->transfer_date))==($month+1)){//if the transfer month is the same of the month chosen
                                if($data->transfer_type=='TRF'){//if the transfer type is transfered
                                    $worksheet->getCellByColumnAndRow((2),($line+1))->setValue($data->name.' - TRF '.date('d/m',strtotime($data->transfer_date)));
                                }else{
                                    if($data->transfer_type=='MOV'){//if the transfer type is moved
                                        $worksheet->getCellByColumnAndRow((2),($line+1))->setValue($data->name.' - MOV '.date('d/m',strtotime($data->transfer_date)));
                                    }
                                }
                            }else{
                                $worksheet->getCellByColumnAndRow((2),($line+1))->setValue($data->name);
                            }

                            if($data->transfer_date>$prevision_sumary[$i]['calendar_day']){//if the prevision date is minor than transfer date, means that student is enrolled
                                if(count($student_attendances)==0){//if there're no attendances
                                    $worksheet->getCellByColumnAndRow(($column),($line+1))->setValue('.');
                                }else{//if there're attendances
                                    $aux_counter=0;
                                    for($k=0;$k<count($student_attendances);$k++){//for every attendance compare with the prevision
                                        if($prevision_sumary[$i]['calendar_day']==$student_attendances[$k]->day){//if prevision day is equal to attendance, means that student was not at the school
                                            $worksheet->getCellByColumnAndRow(($column),($line+1))->setValue('F');
                                            $aux_counter++;//amount of classes that student was not at the school
                                        }
                                    }
                                    if($aux_counter==0){//if zero, means that student was at the school
                                        $worksheet->getCellByColumnAndRow(($column),($line+1))->setValue('.');
                                    }
                                }
                            }else{
                                $worksheet->getCellByColumnAndRow(($column),($line+1))->setValue('/');
                            }
                        }

                        //Count the attendance days and put in the sheet
                        $attendances_counter=0;
                        foreach ($student_attendances as $attendance) {
                            //if the student attendence month is the same choosen, count
                            if(date('m',strtotime($attendance->day)) == ($month+1)){
                                for ($x=0; $x < count($prevision_sumary); $x++) {
                                    //get the amount of attendance days
                                    if($prevision_sumary[$x]['calendar_day']==$attendance->day){
                                        for ($y=0; $y < $prevision_sumary[$y]['amount']; $y++) {
                                            $attendances_counter++;
                                        }
                                    }
                                }
                            }
                        }

                        $worksheet->getCellByColumnAndRow(68,($line+1))->setValue($attendances_counter);
                        //Add activities
                        if($prevision_sumary[$i]['activity_id']>4){//Conselho de Classe, Planejamento, Trabalho Coletivo
                            $word           = mb_strtoupper($prevision_sumary[$i]['activity'],mb_internal_encoding());
                            $word_length    = strlen($word);
                            $splitted_word  = [];
                            //split the word
                            for($l=0;$l<$word_length;$l++){
                                $part = substr($word,$l,1);
                                array_push($splitted_word,$part);
                            }
                            //put the spllited word in the sheet
                            foreach($splitted_word as $splitted){
                                $worksheet->getCellByColumnAndRow(($column),($line_activity))->setValue($splitted);
                                $line_activity++;
                            }
                            //put blank spaces under the spllited word
                            for($m=0;$m<(count($splitted_word)+5);$m++){
                                $worksheet->getCellByColumnAndRow(($column),($line_activity))->setValue('');
                                $line_activity++;
                            }
                            $line_activity = 9;
                        }
                        $line++;
                    }
                    $line = 8;
                    $column++;
                }
            }
        }

        
        // Redirect output to a client’s web browser (Xlsx)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Diário de Classe - '.$class_name->institution_class.' - '.$curricular_component_name->component.' - '.$months[$month].'".xlsx"');
        header('Cache-Control: max-age=0');
        // If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');

        // If you're serving to IE over SSL, then the following may be needed
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
        header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header('Pragma: public'); // HTTP/1.0

        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
    }

    public function storeTeacherClasses($year, $class_id, Request $request)
    {
        $guard      = 'admins';
        
        $current_school_year = $year;

        $verification = DB::table('teacher_classes')
            ->where('institution_id','=',$request['institution_id'])
            ->where('school_year_id','=',$request['school_year_id'])
            ->where('institution_class_id','=',$request['institution_class_id'])
            ->where('curricular_component_id','=',$request['curricular_component_id'])
            ->first();

        if(is_null($verification)){
            $request = $this->teacher_service->storeTeacherClass($request->all());

            session()->flash('message', $request['messages']);
        }else{
            session()->flash('message', 'Esta Compomente Curricular já foi vinculada à outro professor!');
        }

        
        return redirect()->route('admin.show.class.students',[
            'year'      => $current_school_year,
            'class_id'  => $class_id
        ]);
    }

    /**
      * Updating methods
      *
      */

    public function UpdateInstitution($year,InstitutionUpdateRequest $request)
    {
        $collaborator_id            = Auth::user()->collaborator_id;
        $current_school_year        = $year;
        $online_collaborator_data   = $this->collaborator_repository->findWhere([
            'id'=> $collaborator_id
        ])->first();

        $online_collaborator_institution_id = $online_collaborator_data->institution_id;

        $request = $this->institution_service->update($request->all(),$online_collaborator_institution_id);

        session()->flash('success', [
            'success'    => $request['success'],
            'messages'   => $request['messages']
        ]);

        $guard = 'admins';
        $page_title = 'Configurações';

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

        return redirect()->route('admin.config',[
            'current_school_year'                => $current_school_year,
            'guard'                              => $guard,
            'page_title'                         => $page_title,
            'online_collaborator_institution_id' => $online_collaborator_institution_id,
            'online_institution_name'            => $online_institution_data->name,
            'all_school_years'                   => $all_school_years,
            'online_collaborator_id'             => $collaborator_id
        ]);
    }

    public function UpdateInstitutionInep($year,InstitutionUpdateRequest $request)
    {
        $collaborator_id = Auth::user()->collaborator_id;
        $current_school_year = $year;
        $online_collaborator_data = $this->collaborator_repository->findWhere([
            'id'=> $collaborator_id
        ])->first();

        $online_collaborator_institution_id = $online_collaborator_data->institution_id;

        $request = $this->institution_service->update($request->all(),$online_collaborator_institution_id);

        session()->flash('success', [
            'success'    => $request['success'],
            'messages'   => $request['messages']
        ]);

        $guard = 'admins';
        $page_title = 'Configurações';

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

        return redirect()->route('admin.config',[
            'current_school_year'                => $current_school_year,
            'guard'                              => $guard,
            'page_title'                         => $page_title,
            'online_collaborator_institution_id' => $online_collaborator_institution_id,
            'online_institution_name'            => $online_institution_data->name,
            'all_school_years'                   => $all_school_years,
            'online_collaborator_id'             => $collaborator_id
        ]);
    }

    public function UpdateSchoolYear($year,SchoolYearUpdateRequest $request)
    {
        $collaborator_id = Auth::user()->collaborator_id;
        $current_school_year = $year;
        $online_collaborator_data = $this->collaborator_repository->findWhere([
            'id'=> $collaborator_id
        ])->first();

        $online_collaborator_institution_id = $online_collaborator_data->institution_id;
        $request = $this->institution_service->updateSchoolYear($request->all());

        session()->flash('success', [
            'success'    => $request['success'],
            'messages'   => $request['messages']
        ]);

        $guard = 'admins';
        $page_title = 'Configurações';

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

        return redirect()->route('admin.config',[
            'current_school_year'                => $current_school_year,
            'guard'                              => $guard,
            'page_title'                         => $page_title,
            'online_collaborator_institution_id' => $online_collaborator_institution_id,
            'online_institution_name'            => $online_institution_data->name,
            'all_school_years'                   => $all_school_years,
            'online_collaborator_id'             => $collaborator_id
        ]);
    }

    public function UpdateDepartment($year,DepartmentUpdateRequest $request)
    {
        $collaborator_id = Auth::user()->collaborator_id;
        $current_school_year = $year;
        $online_collaborator_data = $this->collaborator_repository->findWhere([
            'id'=> $collaborator_id
        ])->first();

        $online_collaborator_institution_id = $online_collaborator_data->institution_id;
        $request = $this->institution_service->updateDepartment($request->all());

        session()->flash('success', [
            'success'    => $request['success'],
            'messages'   => $request['messages']
        ]);

        $guard = 'admins';
        $page_title = 'Configurações';

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

        return redirect()->route('admin.config',[
            'current_school_year'                => $current_school_year,
            'guard'                              => $guard,
            'page_title'                         => $page_title,
            'online_collaborator_institution_id' => $online_collaborator_institution_id,
            'online_institution_name'            => $online_institution_data->name,
            'all_school_years'                   => $all_school_years,
            'online_collaborator_id'             => $collaborator_id
        ]);
    }

    public function UpdateJob($year,JobUpdateRequest $request,$id)
    {   
        $collaborator_id = Auth::user()->collaborator_id;
        $current_school_year = $year;
        $online_collaborator_data = $this->collaborator_repository->findWhere([
            'id'=> $collaborator_id
        ])->first();

        $online_collaborator_institution_id = $online_collaborator_data->institution_id;
        $request = $this->institution_service->updateJob($request->all(),$id);

        session()->flash('success', [
            'success'    => $request['success'],
            'messages'   => $request['messages']
        ]);

        $guard = 'admins';
        $page_title = 'Configurações';

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

        return redirect()->route('admin.config',[
            'guard'                              => $guard,
            'page_title'                         => $page_title,
            'current_school_year'                => $current_school_year,
            'online_collaborator_institution_id' => $online_collaborator_institution_id,
            'online_institution_name'            => $online_institution_data->name,
            'all_school_years'                   => $all_school_years,
            'online_collaborator_id'             => $collaborator_id
        ]);
    }

    public function UpdateStudent($year, $id, StudentUpdateRequest $request)
    {
        //dd($year, $id,$request);
        $guard = 'admins';
        $page_title = 'Dados';

        $collaborator_id = Auth::user()->collaborator_id;
        $current_school_year = $year;
        $online_collaborator_data = $this->collaborator_repository->findWhere([
            'id'=> $collaborator_id
        ])->first();

        $online_collaborator_institution_id = $online_collaborator_data->institution_id;

        //Update the student data
        $request = $this->student_service->updateStudent($request->all(),$id);

        $class_id = DB::table('student_enrollments')
            ->where('student_id',$id)
            ->select('institution_class_id')
            ->first();

        session()->flash('success', [
            'success'    => $request['success'],
            'messages'   => $request['messages']
        ]);
        
        //Redirect to the current page after updating
        return redirect()->route('admin.show.student.data.byclass',[
            'year'     => $current_school_year,
            'id'        => $id,
            'class_id'  => $class_id->institution_class_id
        ]);
    }

    public function UpdateStudentAddress($year, $id, StudentAddressUpdateRequest $request)
    {
        $guard = 'admins';
        $page_title = 'Dados';

        $collaborator_id = Auth::user()->collaborator_id;
        $current_school_year = $year;
        $online_collaborator_data = $this->collaborator_repository->findWhere([
            'id'=> $collaborator_id
        ])->first();

        $online_collaborator_institution_id = $online_collaborator_data->institution_id;

        //Find the student address id from the table
        $student_address_data = $this->student_address_repository->findWhere([
            'student_id'      => $id,
            'enrollment_year' => $current_school_year
        ])->first();
        $student_address_id = $student_address_data->id;

        //Update the student address
        $request = $this->student_service->updateStudentAddress($request->all(),$student_address_id);

        session()->flash('success', [
            'success'    => $request['success'],
            'messages'   => $request['messages']
        ]);

        $class_id = DB::table('student_enrollments')
            ->where('student_id',$id)
            ->select('institution_class_id')
            ->first();

        //Redirect to the current page after updating
        return redirect()->route('admin.show.student.data.byclass',[
            'year'     => $current_school_year,
            'id'        => $id,
            'class_id'  => $class_id->institution_class_id
        ]);
    }

    public function UpdateStudentCns($year, $id, StudentCnUpdateRequest $request)
    {
        //dd($year, $id,$request);
        //Update the student CN
        $guard = 'admins';
        $page_title = 'Dados';

        $collaborator_id = Auth::user()->collaborator_id;
        $current_school_year = $year;
        $online_collaborator_data = $this->collaborator_repository->findWhere([
            'id'=> $collaborator_id
        ])->first();

        $online_collaborator_institution_id = $online_collaborator_data->institution_id;

        //Find the student cn id from the table
        $student_cn_data = $this->student_cn_repository->findWhere([
            'student_id'      => $id
        ])->first();
        $student_cn_id = $student_cn_data->id;

        //Update the student cn
        $request = $this->student_service->updateStudentCn($request->all(),$student_cn_id);

        session()->flash('success', [
            'success'    => $request['success'],
            'messages'   => $request['messages']
        ]);

        $class_id = DB::table('student_enrollments')
            ->where('student_id',$id)
            ->select('institution_class_id')
            ->first();

        //Redirect to the current page after updating
        return redirect()->route('admin.show.student.data.byclass',[
            'year'     => $current_school_year,
            'id'        => $id,
            'class_id'  => $class_id->institution_class_id
        ]);
    }

    public function UpdateStudentContacts($year, $id, StudentContactsUpdateRequest $request)
    {
        //dd($year, $id,$request);
        //Update the student contacts
        $guard = 'admins';
        $page_title = 'Dados';

        $collaborator_id = Auth::user()->collaborator_id;
        $current_school_year = $year;
        $online_collaborator_data = $this->collaborator_repository->findWhere([
            'id'=> $collaborator_id
        ])->first();

        $online_collaborator_institution_id = $online_collaborator_data->institution_id;

        //Find the student contacts id from the table
        $student_contact_data = $this->student_contacts_repository->findWhere([
            'student_id'      => $id,
            'enrollment_year' => $current_school_year
        ])->first();
        $student_contact_id = $student_contact_data->id;

        //Update the student contact
        $request = $this->student_service->updateStudentContact($request->all(),$student_contact_id);

        session()->flash('success', [
            'success'    => $request['success'],
            'messages'   => $request['messages']
        ]);

        $class_id = DB::table('student_enrollments')
            ->where('student_id',$id)
            ->select('institution_class_id')
            ->first();

        //Redirect to the current page after updating
        return redirect()->route('admin.show.student.data.byclass',[
            'year'      => $current_school_year,
            'id'        => $id,
            'class_id'  => $class_id->institution_class_id
        ]);
    }

    public function UpdateStudentEnrollments($year, $id, StudentEnrollmentUpdateRequest $request)
    {
        //Update the student enrollment
        $guard = 'admins';
        $page_title = 'Dados';

        $collaborator_id = Auth::user()->collaborator_id;
        $current_school_year = $year;
        $online_collaborator_data = $this->collaborator_repository->findWhere([
            'id'=> $collaborator_id
        ])->first();

        $online_collaborator_institution_id = $online_collaborator_data->institution_id;
        
        //Find the student cn id from the table

        $student_enrollment_data = $this->student_enrollment_repository->findWhere([
            'student_id'      => $id,
            'enrollment_year' => $current_school_year
        ])->first();
        $student_enrollment_id = $student_enrollment_data->id;

        //Update the student enrollment
        $request = $this->student_service->updateStudentEnrollments($request->all(),$student_enrollment_id);

        session()->flash('success', [
            'success'    => $request['success'],
            'messages'   => $request['messages']
        ]);

        $class_id = DB::table('student_enrollments')
            ->where('student_id',$id)
            ->select('institution_class_id')
            ->first();

        //Redirect to the current page after updating
        return redirect()->route('admin.show.student.data.byclass',[
            'year'     => $current_school_year,
            'id'        => $id,
            'class_id'  => $class_id->institution_class_id
        ]);
    }

    public function UpdateSchoolYearDivision($year,$id,Request $request)
    {

        $request = $this->institution_service->updateSchoolYearDivision($request->all(),$id);

        session()->flash('success', [
            'success'    => $request['success'],
            'messages'   => $request['messages']
        ]);

        $guard = 'admins';
        $page_title = 'Configurações';
        $current_school_year = $year;
        $collaborator_id = Auth::user()->collaborator_id;

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

        return redirect()->route('admin.config',[
            'current_school_year'                => $current_school_year,
            'guard'                              => $guard,
            'page_title'                         => $page_title,
            'online_collaborator_institution_id' => $online_collaborator_institution_id,
            'online_institution_name'            => $online_institution_data->name,
            'all_school_years'                   => $all_school_years,
            'online_collaborator_id'             => $collaborator_id
        ]);
    }

    public function UpdateCollaborator($year,$collaborator_id,Request $request)
    {

        $request = $this->collaborator_service->updateCollaborator($request->all(),$id);

        session()->flash('success', [
            'success'    => $request['success'],
            'messages'   => $request['messages']
        ]);

        $current_school_year = $year;

        return redirect()->route('admin.show.collaborator.data',[
            'year'  => $current_school_year,
            'id'    => $collaborator_id
        ]);
    }
    public function UpdateCollaboratorAddress($year,$collaborator_id,Request $request)
    {
        $address_id = DB::table('collaborator_addresses')
            ->where('collaborator_id','=',$collaborator_id)
            ->first();
        $request = $this->collaborator_service->updateCollaboratorAddress($request->all(),$address_id->id);

        session()->flash('success', [
            'success'    => $request['success'],
            'messages'   => $request['messages']
        ]);

        $current_school_year = $year;

        return redirect()->route('admin.show.collaborator.data',[
            'year'  => $current_school_year,
            'id'    => $collaborator_id
        ]);
    }
    public function UpdateCollaboratorScholarity($year,$collaborator_id,Request $request)
    {
        $scholarity_id = DB::table('collaborator_scholarities')
            ->where('collaborator_id','=',$collaborator_id)
            ->first();
        $request = $this->collaborator_service->UpdateCollaboratorScholarity($request->all(),$scholarity_id->id);

        session()->flash('success', [
            'success'    => $request['success'],
            'messages'   => $request['messages']
        ]);

        $current_school_year = $year;

        return redirect()->route('admin.show.collaborator.data',[
            'year'  => $current_school_year,
            'id'    => $collaborator_id
        ]);
    }
    public function UpdateCollaboratorContact($year,$collaborator_id,Request $request)
    {
        $contact_id = DB::table('collaborator_contacts')
            ->where('collaborator_id','=',$collaborator_id)
            ->first();
        $request = $this->collaborator_service->updateCollaboratorContact($request->all(),$contact_id->id);

        session()->flash('success', [
            'success'    => $request['success'],
            'messages'   => $request['messages']
        ]);

        $current_school_year = $year;

        return redirect()->route('admin.show.collaborator.data',[
            'year'  => $current_school_year,
            'id'    => $collaborator_id
        ]);
    }
    public function UpdateCollaboratorJob($year,$collaborator_id,Request $request)
    {
        $job_id = DB::table('collaborator_jobs')
            ->where('collaborator_id','=',$collaborator_id)
            ->first();
        $request = $this->collaborator_service->updateCollaboratorJob($request->all(),$job_id->id);

        session()->flash('success', [
            'success'    => $request['success'],
            'messages'   => $request['messages']
        ]);

        $current_school_year = $year;

        return redirect()->route('admin.show.collaborator.data',[
            'year'  => $current_school_year,
            'id'    => $collaborator_id
        ]);
    }

    /**
      * Deleting methods
      *
      */

    public function DeleteExam($year,$id)
    {
        $current_school_year = $year;

        $verification = DB::table('student_exam_results')
            ->where('exam_id','=',$id)
            ->select('result')
            ->get();
        if(count($verification)!=0){
            session()->flash('message','Não foi possível eliminar avaliação devido ter notas vinculadas à ela! Remova primeiro todas as notas desta avaliação!');
        }else{
            $request = $this->institution_service->destroyExam($id);

            session()->flash('message', $request['messages']);
        }

        return redirect()->route('admin.show.dashboard', $current_school_year);
    }


    public function deleteDepartment($year,$id)
    {
        $current_school_year = $year;
        dd($id);
        /*
         * Verify if there are offices linked to the department
         * if exist report an error
         * if not delete the department
         */
        $request = $this->institution_service->destroyDepartment($id);

        session()->flash('success', [
            'success'    => $request['success'],
            'messages'   => $request['messages']
        ]);
        return redirect()->route('admin.show.dashboard', $current_school_year);
    }

    public function deleteJob($year,$id)
    {
        $current_school_year = $year;
        dd($id);

        $request = $this->institution_service->destroyJob($id);

        session()->flash('success', [
            'success'    => $request['success'],
            'messages'   => $request['messages']
        ]);
        return redirect()->route('admin.show.dashboard',$current_school_year);
    }

    public function DeleteSchoolYearDivision($year,$id)
    {
        $guard = 'admins';
        $page_title = 'Configurações';
        $current_school_year = $year;
        $collaborator_id = Auth::user()->collaborator_id;

        $request = $this->institution_service->destroySchoolYearDivision($id);

        session()->flash('success', [
            'success'    => $request['success'],
            'messages'   => $request['messages']
        ]);

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

        return redirect()->route('admin.config',[
            'current_school_year'                => $current_school_year,
            'guard'                              => $guard,
            'page_title'                         => $page_title,
            'online_collaborator_institution_id' => $online_collaborator_institution_id,
            'online_institution_name'            => $online_institution_data->name,
            'all_school_years'                   => $all_school_years,
            'online_collaborator_id'             => $collaborator_id
        ]);
    }

    public function RemoveAdmin($year,$admin_id)
    {
        $current_school_year = $year;

        $data = [
            'admin_status' => 'inactive'
        ];

        $request = $this->institution_service->removeAdmin($data,$admin_id);

        session()->flash('success', [
            'success'    => $request['success'],
            'messages'   => $request['messages']
        ]);

        return redirect()->route('admin.config',$current_school_year);
    }

    public function RemoveStudentWaitingList($year,$candidate_id,$class_id)
    {
        //dd($year,$candidate_id,$class_id);
        $current_school_year = $year;

        $request = $this->student_service->destroyStudentWaitingList($candidate_id);

        session()->flash('success', [
            'success'    => $request['success'],
            'messages'   => $request['messages']
        ]);

        return redirect()->route('admin.show.class.students',['year' => $current_school_year,'class_id' => $class_id]);
    }

    public function DeleteCalendarDay($year,$id)
    {
        $current_school_year = $year;

        $request = $this->institution_service->destroyCalendarDay($id);

        session()->flash('success', [
            'success'    => $request['success'],
            'messages'   => $request['messages']
        ]);

        return redirect()->route('admin.calendar',$current_school_year);
    }





    
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $admins = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $admins,
            ]);
        }

        return view('admins.index', compact('admins'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  AdminCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(AdminCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $admin = $this->repository->create($request->all());

            $response = [
                'message' => 'Admin created.',
                'data'    => $admin->toArray(),
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
        $admin = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $admin,
            ]);
        }

        return view('admins.show', compact('admin'));
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
        $admin = $this->repository->find($id);

        return view('admins.edit', compact('admin'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  AdminUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(AdminUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $admin = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Admin updated.',
                'data'    => $admin->toArray(),
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
                'message' => 'Admin deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Admin deleted.');
    }
}
