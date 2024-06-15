<?php 
namespace App\Services;

use Illuminate\Support\Facades\DB;

use App\Repositories\InstitutionRepository;
use App\Repositories\SchoolYearRepository;
use App\Repositories\InstitutionClassRepository;
use App\Repositories\DepartmentRepository;
use App\Repositories\JobRepository;
use App\Repositories\AdminRepository;
use App\Repositories\AdminTypeChoiceRepository;
use App\Repositories\CurricularComponentRepository;
use App\Repositories\GroupRepository;
use App\Repositories\InstitutionSchoolYearDivisionRepository;
use App\Repositories\InstitutionCalendarRepository;
use App\Repositories\ExamRepository;
use App\Repositories\InstitutionClassScheduleRepository;
use App\Repositories\PrevisionSetupRepository;
use App\Repositories\ExamTypeRepository;

use App\Validators\InstitutionValidator;
use App\Validators\SchoolYearValidator;
use App\Validators\InstitutionClassValidator;
use App\Validators\DepartmentValidator;
use App\Validators\JobValidator;
use App\Validators\AdminValidator;
use App\Validators\AdminTypeChoiceValidator;
use App\Validators\CurricularComponentValidator;
use App\Validators\GroupValidator;
use App\Validators\InstitutionSchoolYearDivisionValidator;
use App\Validators\InstitutionCalendarValidator;
use App\Validators\ExamValidator;
use App\Validators\InstitutionClassScheduleValidator;
use App\Validators\PrevisionSetupValidator;
use App\Validators\ExamTypeValidator;

use Prettus\Validator\Exceptions\ValidatorException;
use Prettus\Validator\Contracts\ValidatorInterface;

class InstitutionService
{
	private $repository;
	private $school_year_repository;
	private $institution_class_repository;
	private $department_repository;
	private $job_repository;
	private $admin_repository;
	private $admin_type_choice_repository;
	private $curricular_component_repository;
	private $group_repository;
	private $school_year_division_repository;
	private $institution_calendar_repository;
	private $exam_repository;
	private $institution_class_schedule_repository;
	private $prevision_setup_repository;
	private $exam_type_repository;

	private $validator;
	private $school_year_validator;
	private $institution_class_validator;
	private $department_validator;
	private $job_validator;
	private $admin_validator;
	private $admin_type_choice_validator;
	private $curricular_component_validator;
	private $group_validator;
	private $school_year_division_validator;
	private $institution_calendar_validator;
	private $exam_validator;
	private $institution_class_schedule_validator;
	private $prevision_setup_validator;
	private $exam_type_validator;

	function __construct(
		InstitutionRepository 					 $repository,
		SchoolYearRepository 					 $school_year_repository,
		InstitutionClassRepository 				 $institution_class_repository,
		DepartmentRepository 					 $department_repository,
		JobRepository 							 $job_repository,
		AdminRepository 						 $admin_repository,
		AdminTypeChoiceRepository 				 $admin_type_choice_repository,
		CurricularComponentRepository 			 $curricular_component_repository,
		GroupRepository 						 $group_repository,
		InstitutionSchoolYearDivisionRepository	 $school_year_division_repository,
		InstitutionCalendarRepository 			 $institution_calendar_repository,
		ExamRepository 							 $exam_repository,
		InstitutionClassScheduleRepository 	     $institution_class_schedule_repository,
		PrevisionSetupRepository 				 $prevision_setup_repository,
		ExamTypeRepository 						 $exam_type_repository,

		InstitutionValidator 					$validator,
		SchoolYearValidator 					$school_year_validator,
		InstitutionClassValidator 				$institution_class_validator,
		DepartmentValidator 					$department_validator,
		JobValidator 							$job_validator,
		AdminValidator							$admin_validator,
		AdminTypeChoiceValidator 				$admin_type_choice_validator,
		CurricularComponentValidator 			$curricular_component_validator,
		GroupValidator 							$group_validator,
		InstitutionSchoolYearDivisionValidator  $school_year_division_validator,
		InstitutionCalendarValidator 			$institution_calendar_validator,
		ExamValidator 							$exam_validator,
		InstitutionClassScheduleValidator 		$institution_class_schedule_validator,
		PrevisionSetupValidator 				$prevision_setup_validator,
		ExamTypeValidator 						$exam_type_validator
	)
	{
		$this->repository 									= $repository;
		$this->school_year_repository 						= $school_year_repository;
		$this->institution_class_repository 				= $institution_class_repository;
		$this->department_repository 						= $department_repository;
		$this->job_repository 								= $job_repository;
		$this->admin_repository 							= $admin_repository;
		$this->admin_type_choice_repository 				= $admin_type_choice_repository;
		$this->curricular_component_repository 				= $curricular_component_repository;
		$this->group_repository 							= $group_repository;
		$this->school_year_division_repository 				= $school_year_division_repository;
		$this->institution_calendar_repository  			= $institution_calendar_repository;
		$this->exam_repository 								= $exam_repository;
		$this->institution_class_schedule_repository 		= $institution_class_schedule_repository;
		$this->prevision_setup_repository 					= $prevision_setup_repository;
		$this->exam_type_repository 						= $exam_type_repository;

		$this->validator  									= $validator;
		$this->school_year_validator 						= $school_year_validator;
		$this->institution_class_validator  				= $institution_class_validator;
		$this->department_validator 						= $department_validator;
		$this->job_validator 								= $job_validator;
		$this->admin_validator								= $admin_validator;
		$this->admin_type_choice_validator 					= $admin_type_choice_validator;
		$this->curricular_component_validator 				= $curricular_component_validator;
		$this->group_validator 								= $group_validator;
		$this->school_year_division_validator				= $school_year_division_validator;
		$this->institution_calendar_validator   			= $institution_calendar_validator;
		$this->exam_validator  								= $exam_validator;
		$this->institution_class_schedule_validator  		= $institution_class_schedule_validator;
		$this->prevision_setup_validator 					= $prevision_setup_validator;
		$this->exam_type_validator 							= $exam_type_validator;
	}

	public function store($data)
	{
		try {
			$this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_CREATE);
			$institution 	= $this->repository->create($data);

			return [
				'success' 		=> true,
				'messages'		=> 'Institutição cadastrada com sucesso',
				'data'			=> $institution
			];
		} catch (Exception $e) {
			return [
				'success' 	 	=> false,
				'messages'	 	=> 'Erro de execução ao cadastrar Institutição',
				'data'		 	=> null
			];
		}
	}

	public function storeSchoolYear($data)
	{
		try {
			$this->school_year_validator->with($data)->passesOrFail(ValidatorInterface::RULE_CREATE);
			$school_year 	= $this->school_year_repository->create($data);
			return [
				'success' 		=> true,
				'messages'		=> 'Ano Letivo cadastrado com sucesso',
				'data'			=> $school_year
			];
		} catch (Exception $e) {
			return [
				'success' 	 	=> false,
				'messages'	 	=> 'Erro de execução ao cadastrar Ano Letivo',
				'data'		 	=> null
			];
		}
	}

	public function storeInstitutionClass($data)
	{
		try {

			$this->institution_class_validator->with($data)->passesOrFail(ValidatorInterface::RULE_CREATE);
			$institution_classes 	= $this->institution_class_repository->create($data);
			return [
				'success' 		=> true,
				'messages'		=> 'Turma cadastrada com sucesso',
				'data'			=> $institution_classes
			];
		} catch (Exception $e) {
			return [
				'success' 	 	=> false,
				'messages'	 	=> 'Erro de execução ao cadastrar Turma',
				'data'		 	=> null
			];
		}
	}

	public function storeDepartment($data)
	{
		try {

			$this->department_validator->with($data)->passesOrFail(ValidatorInterface::RULE_CREATE);
			$department 	= $this->department_repository->create($data);
			return [
				'success' 		=> true,
				'messages'		=> 'Departamento cadastrado com sucesso',
				'data'			=> $department
			];
		} catch (Exception $e) {
			return [
				'success' 	 	=> false,
				'messages'	 	=> 'Erro de execução ao cadastrar Departamento',
				'data'		 	=> null
			];
		}
	}

	public function storeJob($data)
	{
		try {

			$this->job_validator->with($data)->passesOrFail(ValidatorInterface::RULE_CREATE);
			$job = $this->job_repository->create($data);
			return [
				'success' 		=> true,
				'messages'		=> 'Cargo cadastrado com sucesso',
				'data'			=> $job
			];
		} catch (Exception $e) {
			return [
				'success' 	 	=> false,
				'messages'	 	=> 'Erro de execução ao cadastrar Cargo',
				'data'		 	=> null
			];
		}
	}

	public function storeAdmin($data)
	{
		try {
			$this->admin_validator->with($data)->passesOrFail(ValidatorInterface::RULE_CREATE);
			$admin = $this->admin_repository->create($data);
			return [
				'success' 		=> true,
				'messages'		=> 'Administrador cadastrado com sucesso',
				'data'			=> $admin
			];
		} catch (Exception $e) {
			return [
				'success' 	 	=> false,
				'messages'	 	=> 'Erro de execução ao cadastrar Administrador',
				'data'		 	=> null
			];
		}
	}

	public function storeAdminType($data)
	{
		try {
			$this->admin_type_choice_validator->with($data)->passesOrFail(ValidatorInterface::RULE_CREATE);
			$admin_type = $this->admin_type_choice_repository->create($data);
			return [
				'success' 		=> true,
				'messages'		=> 'Tipo de administrador cadastrado com sucesso',
				'data'			=> $admin_type
			];
		} catch (Exception $e) {
			return [
				'success' 	 	=> false,
				'messages'	 	=> 'Erro de execução ao cadastrar Tipo de Administrador',
				'data'		 	=> null
			];
		}
	}

	public function storeCurricularComponent($data)
	{
		try {
			$this->curricular_component_validator->with($data)->passesOrFail(ValidatorInterface::RULE_CREATE);
			$curricular_component = $this->curricular_component_repository->create($data);
			return [
				'success' 		=> true,
				'messages'		=> 'Componente Curricular cadastrada com sucesso',
				'data'			=> $curricular_component
			];
		} catch (Exception $e) {
			return [
				'success' 	 	=> false,
				'messages'	 	=> 'Erro de execução ao cadastrar Componente Curricular',
				'data'		 	=> null
			];
		}
	}

	public function storeGroupPlan($data)
	{
		try {
			$this->group_validator->with($data)->passesOrFail(ValidatorInterface::RULE_CREATE);
			$group = $this->group_repository->create($data);
			return [
				'success' 		=> true,
				'messages'		=> 'Grupo cadastrado com sucesso',
				'data'			=> $group
			];
		} catch (Exception $e) {
			return [
				'success' 	 	=> false,
				'messages'	 	=> 'Erro de execução ao cadastrar Grupo',
				'data'		 	=> null
			];
		}
	}

	public function storeSchoolYearDivision($data)
	{
		try {
			$this->school_year_division_validator->with($data)->passesOrFail(ValidatorInterface::RULE_CREATE);
			$division = $this->school_year_division_repository->create($data);
			return [
				'success' 		=> true,
				'messages'		=> 'Divisão cadastrada com sucesso',
				'data'			=> $division
			];
		} catch (Exception $e) {
			return [
				'success' 	 	=> false,
				'messages'	 	=> 'Erro de execução ao cadastrar Divisão',
				'data'		 	=> null
			];
		}
	}

	public function storeCalendarDay($data)
	{
		try {
			$this->institution_calendar_validator->with($data)->passesOrFail(ValidatorInterface::RULE_CREATE);
			$calendar_day = $this->institution_calendar_repository->create($data);
			return [
				'success' 		=> true,
				'messages'		=> 'Data cadastrada com sucesso',
				'data'			=> $calendar_day
			];
		} catch (Exception $e) {
			return [
				'success' 	 	=> false,
				'messages'	 	=> 'Erro de execução ao cadastrar Data do calendário',
				'data'		 	=> null
			];
		}
	}

	public function storeExam($data)
	{
		try {
			$this->exam_validator->with($data)->passesOrFail(ValidatorInterface::RULE_CREATE);
			$exam = $this->exam_repository->create($data);
			return [
				'success' 		=> true,
				'messages'		=> 'Avaliação cadastrada com sucesso',
				'data'			=> $exam
			];
		} catch (Exception $e) {
			return [
				'success' 	 	=> false,
				'messages'	 	=> 'Erro de execução ao cadastrar Avaliação',
				'data'		 	=> null
			];
		}
	}

	public function storeInstitutionClassSchedule($data)
	{
		try {
			$this->institution_class_schedule_validator->with($data)->passesOrFail(ValidatorInterface::RULE_CREATE);
			//dd($data);
			$exam = $this->institution_class_schedule_repository->create($data);
			return [
				'success' 		=> true,
				'messages'		=> 'Horário cadastrado com sucesso',
				'data'			=> $exam
			];
		} catch (Exception $e) {
			return [
				'success' 	 	=> false,
				'messages'	 	=> 'Erro de execução ao cadastrar Horário',
				'data'		 	=> null
			];
		}
	}

	public function storePrevisionSetup($data)
	{
		try {
			$this->prevision_setup_validator->with($data)->passesOrFail(ValidatorInterface::RULE_CREATE);
			//dd($data);
			$prevision = $this->prevision_setup_repository->create($data);
			return [
				'success' 		=> true,
				'messages'		=> 'Carga Horária cadastrada com sucesso',
				'data'			=> $prevision
			];
		} catch (Exception $e) {
			return [
				'success' 	 	=> false,
				'messages'	 	=> 'Erro de execução ao cadastrar Carga Horária',
				'data'		 	=> null
			];
		}
	}
	public function storeExamType($data)
	{
		try {
			$this->exam_type_validator->with($data)->passesOrFail(ValidatorInterface::RULE_CREATE);
			//dd($data);
			$exam_type = $this->exam_type_repository->create($data);
			return [
				'success' 		=> true,
				'messages'		=> 'Tipo cadastrado com sucesso',
				'data'			=> $exam_type
			];
		} catch (Exception $e) {
			return [
				'success' 	 	=> false,
				'messages'	 	=> 'Erro de execução ao cadastrar Tipo de Avaliação',
				'data'		 	=> null
			];
		}
	}

	public function update($data, $id)
	{
		try {
			$this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_UPDATE);
			$institution 	= $this->repository->update($data,$id);

			return [
				'success' 		=> true,
				'messages'		=> 'Institutição atualizada com sucesso',
				'data'			=> $institution
			];
		} catch (Exception $e) {
			return [
				'success' 	 	=> false,
				'messages'	 	=> 'Erro de execução ao atualizar Institutição',
				'data'		 	=> null
			];
		}
	}

	public function updateInstitutionInep($data, $id)
	{
		try {
			$this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_UPDATE);
			$institution_inep 	= $this->repository->update($data,$id);

			return [
				'success' 		=> true,
				'messages'		=> 'Número do INEP da Institutição atualizada com sucesso',
				'data'			=> $institution_inep
			];
		} catch (Exception $e) {
			return [
				'success' 	 	=> false,
				'messages'	 	=> 'Erro de execução ao atualizar o número do INEP da Instituição',
				'data'		 	=> null
			];
		}
	}

	public function updateSchoolYearStatus($data, $id)
	{
		try {
			$this->school_year_validator->with($data)->passesOrFail(ValidatorInterface::RULE_UPDATE);
			$school_year_status 	= $this->school_year_repository->update($data,$id);

			return [
				'success' 		=> true,
				'messages'		=> 'Status atualizado com sucesso',
				'data'			=> $school_year_status
			];
		} catch (Exception $e) {
			return [
				'success' 	 	=> false,
				'messages'	 	=> 'Erro de execução ao atualizar Status',
				'data'		 	=> null
			];
		}
	}

	public function updateSchoolYear($data)
	{
		try {
			$id = $data['id'];
			$this->school_year_validator->with($data)->passesOrFail(ValidatorInterface::RULE_UPDATE);

			$school_year 	= $this->school_year_repository->update($data,$id);

			return [
				'success' 		=> true,
				'messages'		=> 'Ano Letivo atualizado com sucesso',
				'data'			=> $school_year
			];
		} catch (Exception $e) {
			return [
				'success' 	 	=> false,
				'messages'	 	=> 'Erro de execução ao atualizar o Ano Letivo',
				'data'		 	=> null
			];
		}
	}

	public function updateDepartment($data)
	{
		try {
			$id = $data['id'];
			$this->department_validator->with($data)->passesOrFail(ValidatorInterface::RULE_UPDATE);
			$department 	= $this->department_repository->update($data,$id);

			return [
				'success' 		=> true,
				'messages'		=> 'Departamento atualizado com sucesso',
				'data'			=> $department
			];
		} catch (Exception $e) {
			return [
				'success' 	 	=> false,
				'messages'	 	=> 'Erro de execução ao atualizar Departamento',
				'data'		 	=> null
			];
		}
	}

	public function updateJob($data,$id)
	{
		try { 
			$this->job_validator->with($data)->passesOrFail(ValidatorInterface::RULE_UPDATE);
			$job 	= $this->job_repository->update($data,$id);

			return [
				'success' 		=> true,
				'messages'		=> 'Cargo atualizado com sucesso',
				'data'			=> $job
			];
		} catch (Exception $e) {
			return [
				'success' 	 	=> false,
				'messages'	 	=> 'Erro de execução ao atualizar Cargo',
				'data'		 	=> null
			];
		}
	}

	public function updateSchoolYearDivision($data,$id)
	{
		try { 
			$this->school_year_division_validator->with($data)->passesOrFail(ValidatorInterface::RULE_UPDATE);
			$division 	= $this->school_year_division_repository->update($data,$id);

			return [
				'success' 		=> true,
				'messages'		=> 'Divisão atualizada com sucesso',
				'data'			=> $division
			];
		} catch (Exception $e) {
			return [
				'success' 	 	=> false,
				'messages'	 	=> 'Erro de execução ao atualizar Divisão',
				'data'		 	=> null
			];
		}
	}

	public function updateExam($data,$id)
	{
		try { 
			$this->exam_validator->with($data)->passesOrFail(ValidatorInterface::RULE_UPDATE);
			$exam 	= $this->exam_repository->update($data,$id);

			return [
				'success' 		=> true,
				'messages'		=> 'Avaliação atualizada com sucesso',
				'data'			=> $exam
			];
		} catch (Exception $e) {
			return [
				'success' 	 	=> false,
				'messages'	 	=> 'Erro de execução ao atualizar Avaliação',
				'data'		 	=> null
			];
		}
	}

	public function updateExamType($data,$id)
	{
		try { 
			$this->exam_type_validator->with($data)->passesOrFail(ValidatorInterface::RULE_UPDATE);
			$exam_type 	= $this->exam_type_repository->update($data,$id);

			return [
				'success' 		=> true,
				'messages'		=> 'Tipo atualizado com sucesso',
				'data'			=> $exam_type
			];
		} catch (Exception $e) {
			return [
				'success' 	 	=> false,
				'messages'	 	=> 'Erro de execução ao atualizar Tipo de Avaliação',
				'data'		 	=> null
			];
		}
	}

	public function removeAdmin($data,$id)
	{
		try { 
			$admin 	= DB::table('admins')
				->where('id',$id)
				->update($data);

			return [
				'success' 		=> true,
				'messages'		=> 'Administrador removido com sucesso',
				'data'			=> $admin
			];
		} catch (Exception $e) {
			return [
				'success' 	 	=> false,
				'messages'	 	=> 'Erro de execução ao remover Administrador',
				'data'		 	=> null
			];
		}
	}

	public function reAddAdmin($data,$id)
	{
		try { 
			$admin 	= DB::table('admins')
				->where('id',$id)
				->update($data);

			return [
				'success' 		=> true,
				'messages'		=> 'Administrador restaurado com sucesso',
				'data'			=> $admin
			];
		} catch (Exception $e) {
			return [
				'success' 	 	=> false,
				'messages'	 	=> 'Erro de execução ao restaurar Administrador',
				'data'		 	=> null
			];
		}
	}

	public function destroyDepartment($id)
	{
		try {
			$deleted = $this->department_repository->delete($id);

			return [
				'success' 		=> true,
				'messages'		=> 'Departamento eliminado com sucesso',
				'data'			=> $deleted
			];
		} catch (Exception $e) {
			return [
				'success' 	 	=> false,
				'messages'	 	=> 'Erro de execução ao eliminar Departamento',
				'data'		 	=> null
			];
		}
	}

	public function destroyJob($id)
	{
		try {
			$deleted = $this->job_repository->delete($id);

			return [
				'success' 		=> true,
				'messages'		=> 'Cargo eliminado com sucesso',
				'data'			=> $deleted
			];
		} catch (Exception $e) {
			return [
				'success' 	 	=> false,
				'messages'	 	=> 'Erro de execução ao eliminar Cargo',
				'data'		 	=> null
			];
		}
	}

	public function destroySchoolYearDivision($id)
	{
		try {
			$deleted = $this->school_year_division_repository->delete($id);

			return [
				'success' 		=> true,
				'messages'		=> 'Divisão eliminada com sucesso',
				'data'			=> $deleted
			];
		} catch (Exception $e) {
			return [
				'success' 	 	=> false,
				'messages'	 	=> 'Erro de execução ao eliminar Divisão',
				'data'		 	=> null
			];
		}
	}

	public function destroyCalendarDay($id)
	{
		try {
			$deleted = $this->institution_calendar_repository->delete($id);

			return [
				'success' 		=> true,
				'messages'		=> 'Data eliminada com sucesso',
				'data'			=> $deleted
			];
		} catch (Exception $e) {
			return [
				'success' 	 	=> false,
				'messages'	 	=> 'Erro de execução ao eliminar Data do calendário',
				'data'		 	=> null
			];
		}
	}

	public function destroyExam($id)
	{
		try {
			$deleted = $this->exam_repository->delete($id);

			return [
				'success' 		=> true,
				'messages'		=> 'Avaliação eliminada com sucesso',
				'data'			=> $deleted
			];
		} catch (Exception $e) {
			return [
				'success' 	 	=> false,
				'messages'	 	=> 'Erro de execução ao eliminar Avaliação',
				'data'		 	=> null
			];
		}
	}

	public function destroyPrevision($id)
	{
		try {
			$deleted = $this->prevision_setup_repository->delete($id);

			return [
				'success' 		=> true,
				'messages'		=> 'Previsão eliminada com sucesso',
				'data'			=> $deleted
			];
		} catch (Exception $e) {
			return [
				'success' 	 	=> false,
				'messages'	 	=> 'Erro de execução ao eliminar Previsão',
				'data'		 	=> null
			];
		}
	}
}