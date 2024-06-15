<?php 
namespace App\Services;

use Illuminate\Support\Facades\DB;

use App\Repositories\TeacherRepository;
use App\Repositories\DailyPlanRepository;
use App\Repositories\TeacherClassRepository;
use App\Repositories\StudentExamResultRepository;

use App\Validators\TeacherValidator;
use App\Validators\DailyPlanValidator;
use App\Validators\TeacherClassValidator;
use App\Validators\StudentExamResultValidator;

use Prettus\Validator\Exceptions\ValidatorException;
use Prettus\Validator\Contracts\ValidatorInterface;

class TeacherService
{
	private $repository;
	private $daily_plan_repository;
	private $teacher_class_repository;
	private $student_exam_result_repository;

	private $validator;
	private $daily_plan_validator;
	private $teacher_class_validator;
	private $student_exam_result_validator;

	function __construct(
		TeacherRepository 					$repository,
		DailyPlanRepository 				$daily_plan_repository,
		TeacherClassRepository 				$teacher_class_repository,
		StudentExamResultRepository 		$student_exam_result_repository,

		TeacherValidator 					$validator,
		DailyPlanValidator 					$daily_plan_validator,
		TeacherClassValidator 				$teacher_class_validator,
		StudentExamResultValidator 			$student_exam_result_validator
	)
	{
		$this->repository 						= $repository;
		$this->daily_plan_repository 			= $daily_plan_repository;
		$this->teacher_class_repository 		= $teacher_class_repository;
		$this->student_exam_result_repository	= $student_exam_result_repository;

		$this->validator  						= $validator;
		$this->daily_plan_validator 			= $daily_plan_validator;
		$this->teacher_class_validator 			= $teacher_class_validator;
		$this->student_exam_result_validator 	= $student_exam_result_validator;
	}

	public function storeDailyPlan($data)
	{
		try {
			$this->daily_plan_validator->with($data)->passesOrFail(ValidatorInterface::RULE_CREATE);
			$daily_plan 	= $this->daily_plan_repository->create($data);
			return [
				'success' 		=> true,
				'messages'		=> 'Planejamento Diário cadastrado com sucesso',
				'data'			=> $daily_plan
			];
		} catch (Exception $e) {
			return [
				'success' 	 	=> false,
				'messages'	 	=> 'Erro de execução ao cadastrar Planejamento Diário',
				'data'		 	=> null
			];
		}
	}
	public function storeTeacherClass($data)
	{
		try {
			$this->teacher_class_validator->with($data)->passesOrFail(ValidatorInterface::RULE_CREATE);
			$teacher_class 	= $this->teacher_class_repository->create($data);
			return [
				'success' 		=> true,
				'messages'		=> 'Vínculo realizado com sucesso',
				'data'			=> $teacher_class
			];
		} catch (Exception $e) {
			return [
				'success' 	 	=> false,
				'messages'	 	=> 'Erro de execução ao realizar Vínculo',
				'data'		 	=> null
			];
		}
	}
	public function storeExamResult($data)
	{
		try {
			$this->student_exam_result_validator->with($data)->passesOrFail(ValidatorInterface::RULE_CREATE);
			$result 	= $this->student_exam_result_repository->create($data);
			return [
				'success' 		=> true,
				'messages'		=> 'Resultado lançado com sucesso',
				'data'			=> $result
			];
		} catch (Exception $e) {
			return [
				'success' 	 	=> false,
				'messages'	 	=> 'Erro de execução ao lançar Resultado',
				'data'		 	=> null
			];
		}
	}
	public function updateExamResult($data, $id)
	{
		try {
			$this->student_exam_result_validator->with($data)->passesOrFail(ValidatorInterface::RULE_UPDATE);
			$updated 	= $this->student_exam_result_repository->update($data,$id);

			return [
				'success' 		=> true,
				'messages'		=> 'Avaliação atualizada com sucesso',
				'data'			=> $updated
			];
		} catch (Exception $e) {
			return [
				'success' 	 	=> false,
				'messages'	 	=> 'Erro de execução ao atualizar Avaliação',
				'data'		 	=> null
			];
		}
	}
}
