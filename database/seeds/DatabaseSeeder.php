<?php

use Illuminate\Database\Seeder;
use App\Entities\Admin;
use App\Entities\AdminType;
use App\Entities\AdminTypeChoice;
use App\Entities\Collaborator;
use App\Entities\Color;
use App\Entities\Gender;
use App\Entities\Institution;
use App\Entities\EnrollmentStatus;
use App\Entities\Scholarity;
use App\Entities\Grade;
use App\Entities\KnowledgeArea;
use App\Entities\InstitutionCalendarActivity;
use App\Entities\BnccCurricularComponent;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        AdminType::create([
            'admin_type'            => 'Secretary'
        ]);
        AdminType::create([
            'admin_type'            => 'Coordination'
        ]);
        AdminType::create([
            'admin_type'            => 'School Management'
        ]);
        Color::create([
            'color'                 => 'Branca'
        ]);
        Color::create([
            'color'                 => 'Parda'
        ]);
        Color::create([
            'color'                 => 'Negra'
        ]);
        Color::create([
            'color'                 => 'Amarela'
        ]);
        Color::create([
            'color'                 => 'Indígena'
        ]);
        Gender::create([
            'gender'                => 'Masculino'
        ]);
        Gender::create([
            'gender'                => 'Feminino'
        ]);
        Institution::create([
            'name'                  => 'Instituição 1'
        ]);
        EnrollmentStatus::create([
            'enrollment_status'     => 'Active'
        ]);
        EnrollmentStatus::create([
            'enrollment_status'     => 'Inactive'
        ]);

        Collaborator::create([
            'name'                  => 'Rodrigo Collaborator',
            'cpf'                   => '1234567890124',
            'rg'                    => '1234568',
            'rg_emissor'            => 'EMI-SO',
            'date_birth'            => '1997-05-31',
            'place_birth'           => 'Goiânia-GO',
            'institution_id'        => '1',
            'gender_id'             => '1'
        ]);
        Admin::create([
    		'name' 					=> 'Rodrigo Admin',
	        'email' 				=> 'rodrigo_candido.admin@seintegrado.com',
	        'password' 				=> bcrypt('password'), 
	        'collaborator_id' 		=> '1',
            'institution_id'        => '1'
    	]);
        AdminTypeChoice::create([
            'admin_type_id' => '1',
            'admin_id'      => '1'
        ]);
        Scholarity::create([
            'scholarity' => 'Educação Infantil'
        ]);
        Scholarity::create([
            'scholarity' => 'Ensino Fundamental'
        ]);
        Scholarity::create([
            'scholarity' => 'Ensino Médio'
        ]);
        Scholarity::create([
            'scholarity' => 'Ensino Superior'
        ]);
        Grade::create([
            'grade'         => 'Berçário 1',
            'beginnig_age'  => '0',
            'scholarity_id' => '1'
        ]);
        Grade::create([
            'grade'         => 'Berçário 2',
            'beginnig_age'  => '1',
            'scholarity_id' => '1'
        ]);
        Grade::create([
            'grade'         => 'Maternal 1',
            'beginnig_age'  => '2',
            'scholarity_id' => '1'
        ]);
        Grade::create([
            'grade'         => 'Maternal 2',
            'beginnig_age'  => '3',
            'scholarity_id' => '1'
        ]);
        Grade::create([
            'grade'         => 'Jardim 1 (Pré 1)',
            'beginnig_age'  => '4',
            'scholarity_id' => '1'
        ]);
        Grade::create([
            'grade'         => 'Jardim 2 (Pré 2)',
            'beginnig_age'  => '5',
            'scholarity_id' => '1'
        ]);
        Grade::create([
            'grade'         => '1º Ano',
            'beginnig_age'  => '6',
            'scholarity_id' => '2'
        ]);
        Grade::create([
            'grade'         => '2º Ano',
            'beginnig_age'  => '7',
            'scholarity_id' => '2'
        ]);
        Grade::create([
            'grade'         => '3º Ano',
            'beginnig_age'  => '8',
            'scholarity_id' => '2'
        ]);
        Grade::create([
            'grade'         => '4º Ano',
            'beginnig_age'  => '9',
            'scholarity_id' => '2'
        ]);
        Grade::create([
            'grade'         => '5º Ano',
            'beginnig_age'  => '10',
            'scholarity_id' => '2'
        ]);
        Grade::create([
            'grade'         => '6º Ano',
            'beginnig_age'  => '11',
            'scholarity_id' => '2'
        ]);
        Grade::create([
            'grade'         => '7º Ano',
            'beginnig_age'  => '12',
            'scholarity_id' => '2'
        ]);
        Grade::create([
            'grade'         => '8º Ano',
            'beginnig_age'  => '13',
            'scholarity_id' => '2'
        ]);
        Grade::create([
            'grade'         => '9º Ano',
            'beginnig_age'  => '14',
            'scholarity_id' => '2'
        ]);
        Grade::create([
            'grade'         => '1º Ano',
            'beginnig_age'  => '15',
            'scholarity_id' => '3'
        ]);
        Grade::create([
            'grade'         => '2º Ano',
            'beginnig_age'  => '16',
            'scholarity_id' => '3'
        ]);
        Grade::create([
            'grade'         => '3º Ano',
            'beginnig_age'  => '17',
            'scholarity_id' => '3'
        ]);
        KnowledgeArea::create([
            'knowledge_area' => 'Linguagens'
        ]);
        KnowledgeArea::create([
            'knowledge_area' => 'Matemática'
        ]);
        KnowledgeArea::create([
            'knowledge_area' => 'Ciências da Natureza'
        ]);
        KnowledgeArea::create([
            'knowledge_area' => 'Ciências Humanas'
        ]);
        KnowledgeArea::create([
            'knowledge_area' => 'Ensino Religioso'
        ]);
        InstitutionCalendarActivity::create([
            'activity' => 'Aula'
        ]);
        InstitutionCalendarActivity::create([
            'activity' => 'Avaliação'
        ]);
        InstitutionCalendarActivity::create([
            'activity' => 'Feriado'
        ]);
        InstitutionCalendarActivity::create([
            'activity' => 'Recesso'
        ]);
        /*BnccCurricularComponent::create([
            'bncc_curricular_component'     => 'Geografia'
        ]);
        BnccCurricularComponent::create([
            'bncc_curricular_component'     => 'História'
        ]);
        BnccCurricularComponent::create([
            'bncc_curricular_component'     => 'Ciências'
        ]);
        BnccCurricularComponent::create([
            'bncc_curricular_component'     => 'Arte'
        ]);
        BnccCurricularComponent::create([
            'bncc_curricular_component'     => 'Educação Física'
        ]);
        BnccCurricularComponent::create([
            'bncc_curricular_component'     => 'Língua Inglesa'
        ]);
        BnccCurricularComponent::create([
            'bncc_curricular_component'     => 'Língua Portuguesa'
        ]);
        BnccCurricularComponent::create([
            'bncc_curricular_component'     => 'Matemática'
        ]);*/
    }
}
