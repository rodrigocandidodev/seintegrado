<?php 
namespace App\Services;

use Illuminate\Support\Facades\Hash;

use App\Repositories\StudentRepository;
use App\Repositories\StudentEnrollmentRepository;
use App\Repositories\StudentCnRepository;
use App\Repositories\StudentAddressRepository;
use App\Repositories\StudentContactsRepository;
use App\Repositories\StudentWaitingListRepository;
use App\Repositories\StudentSchoolAttendanceRepository;

use App\Validators\StudentValidator;
use App\Validators\StudentEnrollmentValidator;
use App\Validators\StudentCnValidator;
use App\Validators\StudentAddressValidator;
use App\Validators\StudentContactsValidator;
use App\Validators\StudentWaitingListValidator;
use App\Validators\StudentSchoolAttendanceValidator;

use Prettus\Validator\Exceptions\ValidatorException;
use Prettus\Validator\Contracts\ValidatorInterface;

class StudentService
{
	private $repository;
	private $student_enrollment_repository;
	private $student_cn_repository;
	private $student_address_repository;
	private $student_contacts_repository;
	private $student_waiting_list_repository;
	private $student_school_attendance_repository;

	private $validator;
	private $student_enrollment_validator;
	private $student_cn_validator;
	private $student_address_validator;
	private $student_contacts_validator;
	private $student_waiting_list_validator;
	private $student_school_attendance_validator;

	function __construct(
		StudentRepository 					$repository,
		StudentEnrollmentRepository     	$student_enrollment_repository,
        StudentCnRepository             	$student_cn_repository,
        StudentAddressRepository        	$student_address_repository,
        StudentContactsRepository       	$student_contacts_repository,
        StudentWaitingListRepository 		$student_waiting_list_repository,
        StudentSchoolAttendanceRepository  	$student_school_attendance_repository,

		StudentValidator 					$validator,
		StudentEnrollmentValidator 			$student_enrollment_validator,
		StudentCnValidator 					$student_cn_validator,
		StudentAddressValidator 			$student_address_validator,
		StudentContactsValidator 			$student_contacts_validator,
		StudentWaitingListValidator 		$student_waiting_list_validator,
		StudentSchoolAttendanceValidator   	$student_school_attendance_validator
	)
	{
		$this->repository 							= $repository;
		$this->student_enrollment_repository    	= $student_enrollment_repository;
        $this->student_cn_repository            	= $student_cn_repository;
        $this->student_address_repository       	= $student_address_repository;
        $this->student_contacts_repository      	= $student_contacts_repository;
        $this->student_waiting_list_repository 		= $student_waiting_list_repository;
        $this->student_school_attendance_repository	= $student_school_attendance_repository;

		$this->validator  							= $validator;
		$this->student_enrollment_validator 		= $student_enrollment_validator;
		$this->student_cn_validator 				= $student_cn_validator;
		$this->student_address_validator 			= $student_address_validator;
		$this->student_contacts_validator 			= $student_contacts_validator;
		$this->student_waiting_list_validator 		= $student_waiting_list_validator;
		$this->student_school_attendance_validator 	= $student_school_attendance_validator;
	}

	/**
	  * Storing methods
	  *
	  */
	public function store($data)
	{
		try {
			$processed_data = [
				'name' 					=> $data['name'],
				'mother' 				=> $data['mother'],
				'father' 				=> $data['father'],
				'legal_responsable' 	=> $data['legal_responsable'],
				'email' 				=> $data['email'],
				'password' 				=> Hash::make($data['password']),
				'cpf' 					=> $data['cpf'],
				'date_birth' 			=> $data['date_birth'],
				'place_birth' 			=> $data['place_birth'],
				'sus_number' 			=> $data['sus_number'],
				'auth_image_use' 		=> $data['auth_image_use'],
				'health_special_needs' 	=> $data['health_special_needs'],
				'health_problem' 		=> $data['health_problem'],
				'institution_id' 		=> $data['institution_id'],
				'gender_id' 			=> $data['gender_id'],
				'color_id' 				=> $data['color_id']
			];
			
			$this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_CREATE);
			$student 	= $this->repository->create($processed_data);
			$student_data = $this->repository->findWhere([
	            'name'    => $data['name'],
	            'mother'  => $data['mother']
	        ])->first();

			return [
				'success' 		=> true,
				'messages'		=> 'Aluno cadastrado com sucesso',
				'data'			=> $student,
				'student-id'	=> $student_data->id,
				'student-name'  => $data['name']
			];
		} catch (Exception $e) {
			return [
				'success' 	 	=> false,
				'messages'	 	=> 'Erro de execução ao cadastrar Aluno',
				'data'		 	=> null,
				'student-id' 	=> null,
				'student-name'  => null
			];
		}
	}

	public function storeStudentCn($data)
	{
		try {
			$this->student_cn_validator->with($data)->passesOrFail(ValidatorInterface::RULE_CREATE);
			$student_cn = $this->student_cn_repository->create($data);

			$student_data = $this->repository->findWhere([
	            'id'    => $data['student_id']
	        ])->first();

			return [
				'success' 	  => true,
				'messages'	  => 'Certidão de Nascimento cadastrada com sucesso',
				'data'		  => $student_cn,
				'student-id'  => $data['student_id'],
				'student-name'=> $student_data->name
			];
		} catch (Exception $e) {
			return [
				'success' 		=> false,
				'messages'		=> 'Erro de execução ao cadastrar Certidão de Nascimento',
				'data'			=> null,
				'student-id'	=> null,
				'student-name' 	=> null
			];
		}
	}

	public function storeStudentAddress($data)
	{

		try {
			$this->student_address_validator->with($data)->passesOrFail(ValidatorInterface::RULE_CREATE);
			$student_address = $this->student_address_repository->create($data);

			$student_data = $this->repository->findWhere([
	            'id'    => $data['student_id']
	        ])->first();

			return [
				'success' 		=> true,
				'messages'		=> 'Endereço cadastrado com sucesso',
				'data'			=> $student_address,
				'student-id'	=> $data['student_id'],
				'student-name'  => $student_data->name
			];
		} catch (Exception $e) {
			return [
				'success' 	 	=> false,
				'messages'	 	=> 'Erro de execução ao cadastrar o endereço',
				'data'		 	=> null,
				'student-id' 	=> null,
				'student-name'	=> null
			];
		}
	}

	public function storeStudentContacts($data)
	{
		try {
			$this->student_contacts_validator->with($data)->passesOrFail(ValidatorInterface::RULE_CREATE);
			$student_contacts = $this->student_contacts_repository->create($data);

			$student_data = $this->repository->findWhere([
	            'id'    => $data['student_id']
	        ])->first();

			return [
				'success' 		=> true,
				'messages'		=> 'Contatos cadastrados com sucesso',
				'data'			=> $student_contacts,
				'student-id'	=> $data['student_id'],
				'student-name'  => $student_data->name
			];
		} catch (Exception $e) {
			return [
				'success' 	 	=> false,
				'messages'	 	=> 'Erro de execução ao cadastrar os Contatos',
				'data'		 	=> null,
				'student-id' 	=> null,
				'student-name' 	=> null
			];
		}
	}

	public function storeStudentEnrollment($data)
	{

		try {
			$this->student_enrollment_validator->with($data)->passesOrFail(ValidatorInterface::RULE_CREATE);
			$student_enrollment = $this->student_enrollment_repository->create($data);

			$student_data = $this->repository->findWhere([
	            'id'    => $data['student_id']
	        ])->first();

			return [
				'success' 		=> true,
				'messages'		=> 'Cadastro de requerente realizado com sucesso',
				'data'			=> $student_enrollment,
				'student-id'	=> $data['student_id'],
				'student-name'  => $student_data->name
			];
		} catch (Exception $e) {
			return [
				'success' 	 	=> false,
				'messages'	 	=> 'Erro de execução ao cadastrar requerente',
				'data'		 	=> null,
				'student-id' 	=> null,
				'student-name' 	=> null
			];
		}
	}

	public function storeStudentInWaitingList($data)
	{

		try {
			$this->student_waiting_list_validator->with($data)->passesOrFail(ValidatorInterface::RULE_CREATE);

			$waiting_list_data = $this->student_waiting_list_repository->create($data);

			return [
				'success' 		=> true,
				'messages'		=> 'Candidato adicionado na lista de espera com sucesso',
				'data'			=> $waiting_list_data
			];
		} catch (Exception $e) {
			return [
				'success' 	 	=> false,
				'messages'	 	=> 'Erro de execução ao cadastrar candidato na lista de espera',
				'data'		 	=> null
			];
		}
	}

	public function storeStudentSchoolAttendance($data)
	{

		try {
			$this->student_school_attendance_validator->with($data)->passesOrFail(ValidatorInterface::RULE_CREATE);
			$schedule = $this->student_school_attendance_repository->create($data);

			return [
				'success' 		=> true,
				'messages'		=> 'Falta lançada com sucesso!',
				'data'			=> $schedule
			];
		} catch (Exception $e) {
			return [
				'success' 	 	=> false,
				'messages'	 	=> 'Erro de execução ao lançar falta',
				'data'		 	=> null
			];
		}
	}

	/**
	  * Updating methods
	  *
	  */
	public function updateStudent($data, $id)
	{
		//dd($data);
		try {
			$this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_UPDATE);
			$students 	= $this->repository->update($data,$id);

			return [
				'success' 		=> true,
				'messages'		=> 'Dados Pessoais atualizados com sucesso',
				'data'			=> $students
			];
		} catch (Exception $e) {
			return [
				'success' 	 	=> false,
				'messages'	 	=> 'Erro de execução ao atualizar os dados do aluno',
				'data'		 	=> null
			];
		}
	}

	public function updateStudentAddress($data, $id)
	{
		//dd($data);
		try {
			$this->student_address_validator->with($data)->passesOrFail(ValidatorInterface::RULE_UPDATE);
			$student_address 	= $this->student_address_repository->update($data,$id);

			return [
				'success' 		=> true,
				'messages'		=> 'Endereço atualizado com sucesso',
				'data'			=> $student_address
			];
		} catch (Exception $e) {
			return [
				'success' 	 	=> false,
				'messages'	 	=> 'Erro de execução ao atualizar o endereço do aluno',
				'data'		 	=> null
			];
		}
	}

	public function updateStudentCn($data, $id)
	{
		//dd($data);
		try {
			$this->student_cn_validator->with($data)->passesOrFail(ValidatorInterface::RULE_UPDATE);
			$student_cn 	= $this->student_cn_repository->update($data,$id);

			return [
				'success' 		=> true,
				'messages'		=> 'Certidão de nascimento atualizada com sucesso',
				'data'			=> $student_cn
			];
		} catch (Exception $e) {
			return [
				'success' 	 	=> false,
				'messages'	 	=> 'Erro de execução ao atualizar a Certidão de Nascimento do aluno',
				'data'		 	=> null
			];
		}
	}

	public function updateStudentContact($data, $id)
	{
		//dd($data);
		try {
			$this->student_contacts_validator->with($data)->passesOrFail(ValidatorInterface::RULE_UPDATE);
			$student_contact 	= $this->student_contacts_repository->update($data,$id);

			return [
				'success' 		=> true,
				'messages'		=> 'Contatos atualizados com sucesso',
				'data'			=> $student_contact
			];
		} catch (Exception $e) {
			return [
				'success' 	 	=> false,
				'messages'	 	=> 'Erro de execução ao atualizar os Contatos do aluno',
				'data'		 	=> null
			];
		}
	}

	public function updateStudentEnrollments($data, $id)
	{
		try {
			$this->student_enrollment_validator->with($data)->passesOrFail(ValidatorInterface::RULE_UPDATE);
			$student_enrollment	= $this->student_enrollment_repository->update($data,$id);

			return [
				'success' 		=> true,
				'messages'		=> 'Matrícula atualizada com sucesso',
				'data'			=> $student_enrollment
			];
		} catch (Exception $e) {
			return [
				'success' 	 	=> false,
				'messages'	 	=> 'Erro de execução ao atualizar a Matrícula do aluno',
				'data'		 	=> null
			];
		}
	}

	public function destroyStudentWaitingList($id)
	{
		try {
			$deleted = $this->student_waiting_list_repository->delete($id);

			return [
				'success' 		=> true,
				'messages'		=> 'Candidato removido com sucesso',
				'data'			=> $deleted
			];
		} catch (Exception $e) {
			return [
				'success' 	 	=> false,
				'messages'	 	=> 'Erro de execução ao remover Candidato',
				'data'		 	=> null
			];
		}
	}
}