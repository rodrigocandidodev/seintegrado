<?php 
namespace App\Services;

use App\Repositories\CollaboratorRepository;
use App\Repositories\ScholarityRepository;
use App\Repositories\JobRepository;
use App\Repositories\CollaboratorAddressRepository;
use App\Repositories\CollaboratorScholarityRepository;
use App\Repositories\CollaboratorContactsRepository;
use App\Repositories\CollaboratorJobRepository;
use App\Repositories\TeacherRepository;


use App\Validators\CollaboratorValidator;
use App\Validators\ScholarityValidator;
use App\Validators\JobValidator;
use App\Validators\CollaboratorAddressValidator;
use App\Validators\CollaboratorScholarityValidator;
use App\Validators\CollaboratorContactsValidator;
use App\Validators\CollaboratorJobValidator;
use App\Validators\TeacherValidator;

use Prettus\Validator\Exceptions\ValidatorException;
use Prettus\Validator\Contracts\ValidatorInterface;

class CollaboratorService
{
	private $repository;
	private $scholarity_repository;
	private $job_repository;
	private $collaborator_address_repository;
	private $collaborator_scholarity_repository;
	private $collaborator_contacts_repository;
	private $collaborator_job_repository;
	private $teacher_repository;
	private $validator;
	private $scholarity_validator;
	private $job_validator;
	private $collaborator_address_validator;
	private $collaborator_scholarity_validator;
	private $collaborator_contacts_validator;
	private $collaborator_job_validator;
	private $teacher_validator;

	function __construct(
		CollaboratorRepository 				$repository,
		ScholarityRepository 				$scholarity_repository,
		JobRepository 						$job_repository,
		CollaboratorAddressRepository 		$collaborator_address_repository,
		CollaboratorScholarityRepository    $collaborator_scholarity_repository,
		CollaboratorContactsRepository 		$collaborator_contacts_repository,
		CollaboratorJobRepository 			$collaborator_job_repository,
		TeacherRepository 					$teacher_repository,
		CollaboratorValidator 				$validator,
		ScholarityValidator 				$scholarity_validator,
		JobValidator 						$job_validator,
		CollaboratorAddressValidator 		$collaborator_address_validator,
		CollaboratorScholarityValidator 	$collaborator_scholarity_validator,
		CollaboratorContactsValidator 		$collaborator_contacts_validator,
		CollaboratorJobValidator 			$collaborator_job_validator,
		TeacherValidator 					$teacher_validator
	)
	{
		$this->repository 							= $repository;
		$this->scholarity_repository 				= $scholarity_repository;
		$this->job_repository 						= $job_repository;
		$this->collaborator_address_repository 		= $collaborator_address_repository;
		$this->collaborator_scholarity_repository 	= $collaborator_scholarity_repository;
		$this->collaborator_contacts_repository 	= $collaborator_contacts_repository;
		$this->collaborator_job_repository 			= $collaborator_job_repository;
		$this->teacher_repository 					= $teacher_repository;
		$this->validator 							= $validator;
		$this->scholarity_validator 				= $scholarity_validator;
		$this->job_validator 						= $job_validator;
		$this->collaborator_address_validator 		= $collaborator_address_validator;
		$this->collaborator_scholarity_validator 	= $collaborator_scholarity_validator;
		$this->collaborator_contacts_validator 		= $collaborator_contacts_validator;
		$this->collaborator_job_validator 			= $collaborator_job_validator;
		$this->teacher_validator 					= $teacher_validator;
	}
	public function store($data)
	{
		try {
			$this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_CREATE);
			$collaborator = $this->repository->create($data);

			$stored_collaborator_data = $this->repository->findWhere([
	            'name'    => $data['name'],
	            'cpf'     => $data['cpf']
	        ])->first();

			return [
				'success' 					=> true,
				'messages'					=> 'Colaborador cadastrado com sucesso',
				'data'						=> $collaborator,
				'stored-collaborator-id'	=> $stored_collaborator_data->id,
				'stored-collaborator-name'  => $data['name']
			];
		} catch (Exception $e) {
			return [
				'success' 					=> false,
				'messages'					=> 'Erro de execução ao cadastrar Colaborador',
				'data'						=> null,
				'stored-collaborator-id'	=> null,
				'stored-collaborator-name' 	=> null
			];
		}
	}

	public function storeCollaboratorAddress($data)
	{
		try {
			$this->collaborator_address_validator->with($data)->passesOrFail(ValidatorInterface::RULE_CREATE);
			$collaborator_address = $this->collaborator_address_repository->create($data);

			$stored_collaborator_data = $this->repository->findWhere([
	            'id'    => $data['collaborator_id']
	        ])->first();

			return [
				'success' 					=> true,
				'messages'					=> 'Endereço cadastrado com sucesso',
				'data'						=> $collaborator_address,
				'stored-collaborator-id'    => $data['collaborator_id'],
				'stored-collaborator-name'  => $stored_collaborator_data->name
			];
		} catch (Exception $e) {
			return [
				'success' 					=> false,
				'messages'					=> 'Erro de execução ao cadastrar o Endereço',
				'data'						=> null,
				'stored-collaborator-id' 	=> null,
				'stored-collaborator-name' 	=> null
			];
		}
	}

	public function storeCollaboratorScholarity($data)
	{
		try {
			$this->collaborator_scholarity_validator->with($data)->passesOrFail(ValidatorInterface::RULE_CREATE);
			$scholarity = $this->collaborator_scholarity_repository->create($data);

			$stored_collaborator_data = $this->repository->findWhere([
	            'id'    => $data['collaborator_id']
	        ])->first();

			return [
				'success' 					=> true,
				'messages'					=> 'Escolaridade cadastrado com sucesso',
				'data'						=> $scholarity,
				'stored-collaborator-id'    => $data['collaborator_id'],
				'stored-collaborator-name'  => $stored_collaborator_data->name
			];
		} catch (Exception $e) {
			return [
				'success' 					=> false,
				'messages'					=> 'Erro de execução ao cadastrar Escolaridade',
				'data'						=> null,
				'stored-collaborator-id' 	=> null,
				'stored-collaborator-name' 	=> null
			];
		}
	}
	public function storeCollaboratorContacts($data)
	{

		try {
			$this->collaborator_contacts_validator->with($data)->passesOrFail(ValidatorInterface::RULE_CREATE);
			$collaborator_contacts = $this->collaborator_contacts_repository->create($data);

			$stored_collaborator_data = $this->repository->findWhere([
	            'id'    => $data['collaborator_id']
	        ])->first();

			return [
				'success' 					=> true,
				'messages'					=> 'Contatos cadastrado com sucesso',
				'data'						=> $collaborator_contacts,
				'stored-collaborator-id'    => $data['collaborator_id'],
				'stored-collaborator-name'  => $stored_collaborator_data->name
			];
		} catch (Exception $e) {
			return [
				'success' 					=> false,
				'messages'					=> 'Erro de execução ao cadastrar Contatos',
				'data'						=> null,
				'stored-collaborator-id' 	=> null,
				'stored-collaborator-name' 	=> null
			];
		}
	}
	public function storeCollaboratorJob($data)
	{

		try {
			$this->collaborator_job_validator->with($data)->passesOrFail(ValidatorInterface::RULE_CREATE);
			$collaborator_job = $this->collaborator_job_repository->create($data);

			$job_id = $data['job_id'];
			
			$stored_collaborator_data = $this->repository->findWhere([
	            'id'    => $data['collaborator_id']
	        ])->first();

			return [
				'success' 					=> true,
				'messages'					=> 'Cargo cadastrado com sucesso',
				'data'						=> $collaborator_job,
				'stored-collaborator-id'    => $data['collaborator_id'],
				'stored-collaborator-name'  => $stored_collaborator_data->name,
				'job'						=> $job_id
			];
		} catch (Exception $e) {
			return [
				'success' 					=> false,
				'messages'					=> 'Erro de execução ao cadastrar Cargo',
				'data'						=> null,
				'stored-collaborator-id' 	=> null,
				'stored-collaborator-name' 	=> null,
				'job'						=> null
			];
		}
	}
	public function storeTeacherAccessData($data)
	{
		try {
			//dd($data['name'], $data['email'], $data['password']);

			
			$this->teacher_validator->with($data)->passesOrFail(ValidatorInterface::RULE_CREATE);
			$access_data = $this->teacher_repository->create($data);
			
			$stored_collaborator_data = $this->repository->findWhere([
	            'id'    => $data['collaborator_id']
	        ])->first();


			return [
				'success'  => true,
				'messages' => 'Dadaos de acesso cadastrados com sucesso'
			];
		} catch (Exception $e) {
			return [
				'success'  => false,
				'messages' => 'Erro de execução ao cadastrar Dados de Acesso de professor'
			];
		}
	}
	public function updateCollaborator($data, $id)
	{
		//dd($data);
		try {
			$this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_UPDATE);
			$collaborator 	= $this->repository->update($data,$id);

			return [
				'success' 		=> true,
				'messages'		=> 'Atualizado com sucesso',
				'data'			=> $collaborator
			];
		} catch (Exception $e) {
			return [
				'success' 	 	=> false,
				'messages'	 	=> 'Erro de execução ao atualizar Colaborador',
				'data'		 	=> null
			];
		}
	}
	public function updateCollaboratorAddress($data, $id)
	{
		
		try {
			$this->collaborator_address_validator->with($data)->passesOrFail(ValidatorInterface::RULE_UPDATE);

			$address 	= $this->collaborator_address_repository->update($data,$id);

			return [
				'success' 		=> true,
				'messages'		=> 'Atualizado com sucesso',
				'data'			=> $address
			];
		} catch (Exception $e) {
			return [
				'success' 	 	=> false,
				'messages'	 	=> 'Erro de execução ao atualizar Endereço',
				'data'		 	=> null
			];
		}
	}
	public function updateCollaboratorScholarity($data, $id)
	{
		
		try {
			$this->collaborator_scholarity_validator->with($data)->passesOrFail(ValidatorInterface::RULE_UPDATE);

			$scholarity 	= $this->collaborator_scholarity_repository->update($data,$id);

			return [
				'success' 		=> true,
				'messages'		=> 'Atualizado com sucesso',
				'data'			=> $scholarity
			];
		} catch (Exception $e) {
			return [
				'success' 	 	=> false,
				'messages'	 	=> 'Erro de execução ao atualizar Endereço',
				'data'		 	=> null
			];
		}
	}
	public function updateCollaboratorContact($data, $id)
	{
		
		try {
			$this->collaborator_contacts_validator->with($data)->passesOrFail(ValidatorInterface::RULE_UPDATE);

			$contacts 	= $this->collaborator_contacts_repository->update($data,$id);

			return [
				'success' 		=> true,
				'messages'		=> 'Atualizado com sucesso',
				'data'			=> $contacts
			];
		} catch (Exception $e) {
			return [
				'success' 	 	=> false,
				'messages'	 	=> 'Erro de execução ao atualizar Contatos',
				'data'		 	=> null
			];
		}
	}
	public function updateCollaboratorJob($data, $id)
	{
		
		try {
			$this->collaborator_job_validator->with($data)->passesOrFail(ValidatorInterface::RULE_UPDATE);

			$job 	= $this->collaborator_job_repository->update($data,$id);

			return [
				'success' 		=> true,
				'messages'		=> 'Atualizado com sucesso',
				'data'			=> $job
			];
		} catch (Exception $e) {
			return [
				'success' 	 	=> false,
				'messages'	 	=> 'Erro de execução ao atualizar Trabalho',
				'data'		 	=> null
			];
		}
	}
}
