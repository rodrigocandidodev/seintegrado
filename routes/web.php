<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('homepage');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('core-admin')->group(function(){
	Route::get('/login','Auth\CoreAdminLoginController@showLoginForm')->name('core-admin.login');
	Route::post('/login','Auth\CoreAdminLoginController@login')->name('core-admin.login.submit');
	Route::get('/', 'CoreAdminsController@dashboard')->name('core-admin.dashboard');
});
Route::prefix('admin')->group(function(){
	Route::get('/login','Auth\AdminLoginController@showLoginForm')->name('admin.login');
	Route::post('/login','Auth\AdminLoginController@login')->name('admin.login.submit');

	Route::get('/{year}', 'AdminsController@ShowDashboard')->name('admin.show.dashboard');
	Route::get('/', 'AdminsController@initialization')->name('admin.initialization');

	//Admin Routes
	Route::post('{year}/store/admin', 'AdminsController@StoreAdmin')->name('admin.store.admin.submit');
	Route::get('{year}/remove/admin/{id}', 'AdminsController@RemoveAdmin')->name('admin.remove.admin');
	Route::get('{year}/readd/admin/{id}', 'AdminsController@ReAddAdmin')->name('admin.readd.admin');

	Route::get('{year}/config', 'AdminsController@configPage')->name('admin.config');
	Route::post('{year}/prevision/{class_id}', 'AdminsController@Prevision')->name('prevision');
	Route::get('{year}/prevision/{class_id}/export-to-sheet', 'AdminsController@ExportDailyClassDataSheet')->name('admin.daily.class.data.sheet');
	Route::post('{year}/prevision-setup', 'AdminsController@previsionSetup')->name('admin.config.prevision.setup');
	Route::get('{year}/prevision-setup/{id}', 'AdminsController@deletePrevisionSetup')->name('admin.config.prevision.setup.delete');


	//Institution Routes
	Route::post('{year}/update/institution/data', 'AdminsController@UpdateInstitution')->name('admin.update.institution.data.submit');
	Route::post('{year}/store/institution/inep', 'AdminsController@UpdateInstitutionInep')->name('admin.store.institution.inep.submit');

	//School Year Routes
	Route::post('/store/school-year', 'AdminsController@StoreSchoolYear')->name('admin.store.school-year.submit');
	Route::get('/store/school-year', 'AdminsController@ShowStoreSchoolYearForm')->name('admin.store.school-year');
	Route::post('{year}/config/update/school-year', 'AdminsController@UpdateSchoolYear')->name('admin.update.school-year.submit');
	Route::post('{year}/config/update/school-year-division/{id}', 'AdminsController@UpdateSchoolYearDivision')->name('admin.update.school-year.division.submit');
	Route::post('{year}/config/store/school-year-division', 'AdminsController@StoreSchoolYearDivision')->name('admin.store.school-year.division.submit');
	Route::get('{year}/config/delete/school-year-division/{id}', 'AdminsController@DeleteSchoolYearDivision')->name('admin.delete.school-year.division.submit');

	
	//Department Routes
	Route::get('{year}/store/department', 'AdminsController@ShowStoreDepartmentForm')->name('admin.store.department');
	Route::post('{year}/config/update/department', 'AdminsController@UpdateDepartment')->name('admin.update.department.submit');
	Route::post('{year}/store/department', 'AdminsController@StoreDepartment')->name('admin.store.department.submit');
	Route::get('{year}/config/delete/department/{id}', 'AdminsController@deleteDepartment')->name('admin.delete.department');

	//Job Routes
	Route::get('{year}/store/jobs', 'AdminsController@ShowStoreJobForm')->name('admin.store.jobs');
	Route::post('{year}/store/job', 'AdminsController@StoreJob')->name('admin.store.job.submit');
	Route::get('{year}/config/delete/job/{id}', 'AdminsController@deleteJob')->name('admin.delete.job');
	Route::post('{year}/config/update/job/{id}', 'AdminsController@UpdateJob')->name('admin.update.job.submit');
	
	//Coordination Routes
	Route::post('{year}/store/curricular-component', 'AdminsController@StoreCurricularComponent')->name('admin.store.curricular.component');
	Route::get('{year}/group-plans', 'AdminsController@PlansHome')->name('admin.plan.home');
	Route::post('{year}/group-plans/store', 'AdminsController@StoreGroupPlan')->name('admin.store.plan.submit');
	Route::get('{year}/group-plans/{group_id}', 'AdminsController@ShowPlanGroup')->name('admin.plan.group');
	Route::get('{year}/calendar','AdminsController@ShowCalendar')->name('admin.calendar');
	Route::post('{year}/calendar/store-day','AdminsController@StoreCalendarDay')->name('admin.store.calendar.day.submit');
	Route::get('{year}/calendar/delete-day/{id}','AdminsController@DeleteCalendarDay')->name('admin.delete.calendar-day');
	Route::post('{year}/exam','AdminsController@StoreExam')->name('admin.store.exam.submit');
	Route::post('{year}/exam/update/{id}','AdminsController@UpdateExam')->name('admin.update.exam.submit');
	Route::get('{year}/exam/delete/{id}','AdminsController@DeleteExam')->name('admin.delete.exam');
	Route::get('{year}/exams/results/{exam_id}','AdminsController@ExamResults')->name('admin.exams.results');



	/*
	 * =============================================================================
	 * Student Enrollment Routes
	 * =============================================================================
	 */
	Route::get('{year}/store/student/home', 'AdminsController@storeStudentTestShow')->name('admin.store.student.home.show');

	Route::post('{year}/store/student/maindata', 'AdminsController@storeStudentMainData')->name('admin.store.student.maindata1');
	Route::post('{year}/store/student/birth-certificate', 'AdminsController@storeStudentBirthCertificate')->name('admin.store.student.birth-certificate.submit');
	Route::post('{year}/store/student/address1', 'AdminsController@storeStudentAddress1')->name('admin.store.student.address1.submit');
	Route::post('{year}/store/student/contact', 'AdminsController@storeStudentContact')->name('admin.store.student.contact.submit');
	Route::post('{year}/store/student/enrollment1', 'AdminsController@storeStudentEnrollment1')->name('admin.store.student.enrollment1.submit');


	Route::post('{year}/store/student/main-data', 'AdminsController@storeStudent')->name('admin.store.student.maindata');

	Route::get('{year}/store/student/cn', 'AdminsController@ShowStudentCnForm')->name('admin.store.student.cn');
	Route::post('{year}/store/student/cn', 'AdminsController@storeStudentCn')->name('admin.store.student.cn.submit');

	Route::get('{year}/store/student/{student_id}/{student_name}/{enrollment_year}/address', 'AdminsController@ShowStudentAddressForm')->name('admin.store.student.address');
	Route::post('{year}/store/student/address', 'AdminsController@storeStudentAddress')->name('admin.store.student.address.submit');

	Route::get('{year}/store/student/{student_id}/{student_name}/{enrollment_year}/contacts', 'AdminsController@ShowStudentContactsForm')->name('admin.store.student.contacts');
	Route::post('{year}/store/student/contacts', 'AdminsController@storeStudentContacts')->name('admin.store.student.contacts.submit');

	Route::get('{year}/store/student/{student_id}/{student_name}/{enrollment_year}/class', 'AdminsController@ShowStudentClassForm')->name('admin.store.student.class');
	Route::post('{year}/store/student/class', 'AdminsController@storeStudentEnrollment')->name('admin.store.student.class.submit');

	//Route::get('{year}/show/student-data/{id}', 'AdminsController@ShowStudentData')->name('admin.show.student.data');
	Route::get('{year}/show/student-data/{id}/{class_id}', 'AdminsController@ShowStudentDataByClass')->name('admin.show.student.data.byclass');
	//Route::get('{year}/show/student-data2/{id}/{class_id}', 'AdminsController@ShowStudentDataByClass2')->name('admin.show.student.data.byclass2');
	Route::get('{year}/rematricular/student-data/{id}/{next_year}', 'AdminsController@ShowRematricularStudentData')->name('admin.rematricular.student.data');
	Route::get('{year}/rematricular/student-data/{id}/{enrollment_year}/success','AdminsController@ShowSuccessRematricula')->name('admin.show.rematricular.success');
	Route::post('{year}/rematricular/student-data', 'AdminsController@storeStudentEnrollmentRematricula')->name('admin.store.student.class.rematricular.submit');


	Route::post('{year}/update/student-data/{id}', 'AdminsController@UpdateStudent')->name('admin.update.student.data');
	Route::post('{year}/update/student-address/{id}', 'AdminsController@UpdateStudentAddress')->name('admin.update.student.address');
	Route::post('{year}/update/student-cn/{id}', 'AdminsController@UpdateStudentCns')->name('admin.update.student.cn');
	Route::post('{year}/update/student-contact/{id}', 'AdminsController@UpdateStudentContacts')->name('admin.update.student.contact');
	Route::post('{year}/update/student-enrollment/{id}', 'AdminsController@UpdateStudentEnrollments')->name('admin.update.student.enrollment');

	Route::get('/show/student-data/{id}/{year}/excel', 'AdminsController@ExportStudentDataExcel')->name('admin.show.student.data.excel');
	Route::get('/show/student-data/{id}/{year}/print', 'AdminsController@PrintStudentEnrollment')->name('admin.show.student.data.print');
	Route::get('/show/student-declaration/{id}/{year}/{type}/print', 'AdminsController@PrintStudentDeclaration')->name('admin.show.student.declaration.print');
	Route::post('{year}/show/student-data', 'AdminsController@ShowStudentDataC')->name('admin.show.student.datac');

	Route::post('{year}/internal-transfer/{student_id}', 'AdminsController@InternallyTransferStudent')->name('admin.internal.transfer.submit');

	Route::get('{year}/show/class-students/{class_id}', 'AdminsController@ShowClassStudents')->name('admin.show.class.students');
	Route::post('{year}/show/class-students/{class_id}/attendance', 'AdminsController@storeStudentAttendance')->name('admin.attendance.class.students');
	Route::post('{year}/show/class-students/{class_id}/teacher-classes', 'AdminsController@storeTeacherClasses')->name('admin.teacehr.classes.submit');
	Route::get('{year}/show/class-students/{class_id}/export-to-sheet', 'AdminsController@ExportClassListDataSheet')->name('admin.show.class.students.data.sheet');
	Route::get('{year}/show/class-students/{class_id}/export-to-pdf', 'AdminsController@ExportClassListDataPDF')->name('admin.show.class.students.data.pdf');

	Route::get('{year}/prevision/{class_id}/{teacher_id}/{curricular_component_id}/{month}/daily-classes/export-to-sheet', 'AdminsController@ExportDailyClassDataSheet')->name('admin.daily.class.data.sheet');
	Route::get('{year}/prevision/{class_id}/{teacher_id}/{curricular_component_id}/prevision/export-to-sheet', 'AdminsController@ExportPrevisionDataSheet')->name('admin.prevision.data.sheet');

	Route::get('{year}/all-students/export-to-sheet','AdminsController@ExportAllStudentsListToSheet')->name('admin.all.students.sheet');
	Route::get('{year}/all-students/export-to-sheet/data','AdminsController@ExportAllStudentsDataListToSheet')->name('admin.all.students.data.sheet');

	Route::post('{year}/store/class', 'AdminsController@storeInstitutionClass')->name('admin.store.class.submit');

	Route::post('{year}/store/class-schedule', 'AdminsController@storeInstitutionClassSchedule')->name('admin.store.class.schedule.submit');
	Route::get('{year}/export-to-sheet/class-schedule/{institution_class_id}', 'AdminsController@ExportInstitutionClassSchedule')->name('admin.export.sheet.class.schedule');

	Route::get('/search/student', 'AdminsController@SearchStudent');

	Route::post('{year}/store/student/waiting-list/{page}', 'AdminsController@StoreStudentInWaitingList')->name('admin.store.student.waiting.list.submit');
	Route::get('{year}/delete/student/waiting-list/{candidate_id}/{class_id}', 'AdminsController@RemoveStudentWaitingList')->name('admin.delete.student.waiting.list');



	/*
	 * =============================================================================
	 * Collaborator Routes
	 * =============================================================================
	 */

	Route::post('{year}/store/collaborator/main-data', 'AdminsController@storeCollaborator')->name('admin.store.collaborator.maindata');

	Route::get('{year}/store/collaborator/address', 'AdminsController@ShowCollaboratorAddressForm')->name('admin.store.collaborator.address');
	Route::post('{year}/store/collaborator/address', 'AdminsController@storeCollaboratorAddress')->name('admin.store.collaborator.address.submit');

	Route::get('{year}/store/collaborator/{stored_collaborator_id}/{stored_collaborator_name}/scholartity', 'AdminsController@ShowCollaboratorScholarityForm')->name('admin.store.collaborator.scholarity');
	Route::post('{year}/store/collaborator/scholartity', 'AdminsController@storeCollaboratorScholarity')->name('admin.store.collaborator.scholarity.submit');

	Route::get('{year}/store/collaborator/{stored_collaborator_id}/{stored_collaborator_name}/contacts', 'AdminsController@ShowCollaboratorContactsForm')->name('admin.store.collaborator.contacts');
	Route::post('{year}/store/collaborator/contacts', 'AdminsController@storeCollaboratorContacts')->name('admin.store.collaborator.contacts.submit');

	Route::get('{year}/store/collaborator/{stored_collaborator_id}/{stored_collaborator_name}/job', 'AdminsController@ShowCollaboratorJobForm')->name('admin.store.collaborator.job');
	Route::post('{year}/store/collaborator/job', 'AdminsController@storeCollaboratorJob')->name('admin.store.collaborator.job.submit');

	Route::post('{year}/store/teacher/data', 'AdminsController@storeTeacherAccessData')->name('admin.store.teacher.accessdata.submit');

	Route::get('{year}/show/collaborator/data/{id}', 'AdminsController@ShowCollaboratorData')->name('admin.show.collaborator.data');
	Route::post('{year}/show/collaborator/data', 'AdminsController@ShowCollaboratorDataC')->name('admin.show.collaborator.datac');
	Route::get('{year}/show/collaborators', 'AdminsController@ShowCollaborators')->name('admin.show.collaborators');
	Route::get('{year}/show/teachers', 'AdminsController@ShowTeachers')->name('admin.show.teachers');
	Route::get('/search/collaborator', 'AdminsController@SearchCollaborator');
	Route::post('{year}/collaborator/update/{collaborator_id}', 'AdminsController@UpdateCollaborator')->name('admin.update.collaborator');
	Route::post('{year}/collaborator/update/address/{collaborator_id}', 'AdminsController@UpdateCollaboratorAddress')->name('admin.update.collaborator.address');
	Route::post('{year}/collaborator/update/scholarity/{collaborator_id}', 'AdminsController@UpdateCollaboratorScholarity')->name('admin.update.collaborator.scholarity');
	Route::post('{year}/collaborator/update/contact/{collaborator_id}', 'AdminsController@UpdateCollaboratorContact')->name('admin.update.collaborator.contact');
	Route::post('{year}/collaborator/update/job/{collaborator_id}', 'AdminsController@UpdateCollaboratorJob')->name('admin.update.collaborator.job');
});
Route::prefix('teacher')->group(function(){
	Route::get('/login','Auth\TeacherLoginController@showLoginForm')->name('teacher.login');
	Route::post('/login','Auth\TeacherLoginController@login')->name('teacher.login.submit');
	Route::get('/', 'TeachersController@initialization')->name('teacher.initialization');
	Route::get('/{year}', 'TeachersController@ShowDashboard')->name('teacher.show.dashboard');

	Route::get('{year}/group-plans', 'TeachersController@PlansHome')->name('teacher.plans.home');
	Route::get('{year}/group-plans/{group_id}', 'TeachersController@ShowPlanGroup')->name('teacher.plan.group');
	Route::post('{year}/group-plans/store-daily-plan', 'TeachersController@StoreDailyPlan')->name('teacher.daily.plan.submit');

	Route::get('{year}/show/collaborator/data/{id}', 'TeachersController@ShowCollaboratorData')->name('teacher.show.collaborator.data');
	Route::get('{year}/exams/{division_id}','TeachersController@Exams')->name('teacher.exams');
	Route::get('{year}/exams/results/{exam_id}','TeachersController@ExamResults')->name('teacher.exams.results');
	Route::post('{year}/exams/results/{exam_id}/{student_id}/store','TeachersController@StoreExamResults')->name('teacher.exams.results.submit');
	Route::post('{year}/exams/results/{exam_id}/{student_id}/update','TeachersController@UpdateExamResult')->name('teacher.exams.results.update');
});
Route::prefix('student')->group(function(){
	Route::get('/login','Auth\StudentLoginController@showLoginForm')->name('student.login');
	Route::post('/login','Auth\StudentLoginController@login')->name('student.login.submit');
	Route::get('/', 'StudentsController@dashboard')->name('student.dashboard');
});
