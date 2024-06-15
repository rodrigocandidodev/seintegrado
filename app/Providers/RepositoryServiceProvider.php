<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(\App\Repositories\AdminRepository::class, \App\Repositories\AdminRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\CoreAdminRepository::class, \App\Repositories\CoreAdminRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\StudentRepository::class, \App\Repositories\StudentRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\TeacherRepository::class, \App\Repositories\TeacherRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\InstitutionRepository::class, \App\Repositories\InstitutionRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\GenderRepository::class, \App\Repositories\GenderRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\ColorRepository::class, \App\Repositories\ColorRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\CollaboratorAddressRepository::class, \App\Repositories\CollaboratorAddressRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\DepartmentRepository::class, \App\Repositories\DepartmentRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\JobRepository::class, \App\Repositories\JobRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\ScholarityRepository::class, \App\Repositories\ScholarityRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\CollaboratorJobRepository::class, \App\Repositories\CollaboratorJobRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\CollaboratorScholarityRepository::class, \App\Repositories\CollaboratorScholarityRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\CollaboratorContactsRepository::class, \App\Repositories\CollaboratorContactsRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\CollaboratorRepository::class, \App\Repositories\CollaboratorRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\SchoolYearRepository::class, \App\Repositories\SchoolYearRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\GradeRepository::class, \App\Repositories\GradeRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\InstitutionClassRepository::class, \App\Repositories\InstitutionClassRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\EnrollmentStatusRepository::class, \App\Repositories\EnrollmentStatusRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\StudentContactsRepository::class, \App\Repositories\StudentContactsRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\StudentEnrollmentRepository::class, \App\Repositories\StudentEnrollmentRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\StudentAddressRepository::class, \App\Repositories\StudentAddressRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\StudentCnRepository::class, \App\Repositories\StudentCnRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\AdminTypeRepository::class, \App\Repositories\AdminTypeRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\AdminTypeChoiceRepository::class, \App\Repositories\AdminTypeChoiceRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\KnowledgeAreaRepository::class, \App\Repositories\KnowledgeAreaRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\CurricularComponentRepository::class, \App\Repositories\CurricularComponentRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\InstitutionCalendarActivityRepository::class, \App\Repositories\InstitutionCalendarActivityRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\InstitutionCalendarRepository::class, \App\Repositories\InstitutionCalendarRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\ExamRepository::class, \App\Repositories\ExamRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\GroupRepository::class, \App\Repositories\GroupRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\InstitutionSchoolYearDivisionRepository::class, \App\Repositories\InstitutionSchoolYearDivisionRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\DailyPlanRepository::class, \App\Repositories\DailyPlanRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\ApplicationFieldThematicUnitRepository::class, \App\Repositories\ApplicationFieldThematicUnitRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\PracticalLanguageThematicAxisRepository::class, \App\Repositories\PracticalLanguageThematicAxisRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\BnccCurricularComponentRepository::class, \App\Repositories\BnccCurricularComponentRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\PlanBnccEfRepository::class, \App\Repositories\PlanBnccEfRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\PlanAftuRepository::class, \App\Repositories\PlanAftuRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\PlanPltaRepository::class, \App\Repositories\PlanPltaRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\StudentWaitingListRepository::class, \App\Repositories\StudentWaitingListRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\InstitutionClassScheduleRepository::class, \App\Repositories\InstitutionClassScheduleRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\StudentSchoolAttendanceRepository::class, \App\Repositories\StudentSchoolAttendanceRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\StudentMedicalCertificateRepository::class, \App\Repositories\StudentMedicalCertificateRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\InstitutionClassStudentSequenceRepository::class, \App\Repositories\InstitutionClassStudentSequenceRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\PrevisionSetupRepository::class, \App\Repositories\PrevisionSetupRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\TeacherClassRepository::class, \App\Repositories\TeacherClassRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\StudentExamResultRepository::class, \App\Repositories\StudentExamResultRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\ExamTypeRepository::class, \App\Repositories\ExamTypeRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\CurricularComponentClassRepository::class, \App\Repositories\CurricularComponentClassRepositoryEloquent::class);
        //:end-bindings:
    }
}
