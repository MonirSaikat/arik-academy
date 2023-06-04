<?php

use App\Http\Controllers\Academic\ClassController;
use App\Http\Controllers\Academic\GroupController;
use App\Http\Controllers\Academic\RoomController;
use App\Http\Controllers\Academic\RoutineController;
use App\Http\Controllers\Academic\SectionController;
use App\Http\Controllers\Academic\SessionController;
use App\Http\Controllers\Attendance\AttendanceController;
use App\Http\Controllers\Bank\BankController;
use App\Http\Controllers\Containt\ChairmanController;
use App\Http\Controllers\Containt\FrontendController;
use App\Http\Controllers\Containt\GalleryController;
use App\Http\Controllers\Containt\HistoryController;
use App\Http\Controllers\Containt\LogoController;
use App\Http\Controllers\Containt\MessageController;
use App\Http\Controllers\Containt\NoticeBoardController;
use App\Http\Controllers\Containt\PhoneController;
use App\Http\Controllers\Containt\PrincipalController;
use App\Http\Controllers\Containt\SchoolWorkerController;
use App\Http\Controllers\Containt\SliderController;
use App\Http\Controllers\Containt\StaffController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Examination\ExamController;
use App\Http\Controllers\Examination\ExamSetupController;
use App\Http\Controllers\Examination\GradeController;
use App\Http\Controllers\Examination\InputMarkController;
use App\Http\Controllers\Examination\ViewMarkcontroller;
use App\Http\Controllers\Expense\ExpenseCategoryController;
use App\Http\Controllers\Expense\ExpenseController;
use App\Http\Controllers\Fee\FeeAllocationController;
use App\Http\Controllers\Fee\FeeController;
use App\Http\Controllers\Fee\FeeInvoiceController;
use App\Http\Controllers\Fee\FeeTypeController;
use App\Http\Controllers\Frontend\OnlineapplyController;
use App\Http\Controllers\GeneralSettingController;
use App\Http\Controllers\Hrm\DepartmentController;
use App\Http\Controllers\Hrm\DesignationController;
use App\Http\Controllers\Hrm\PayrollController;
use App\Http\Controllers\Hrm\StuffController;
use App\Http\Controllers\Income\IncomeCategoryController;

//frontend
use App\Http\Controllers\Income\IncomeController;
use App\Http\Controllers\Inventory\InventoryCategoryController;
use App\Http\Controllers\Issue\IssueController;
use App\Http\Controllers\Item\ItemcodingController;
use App\Http\Controllers\Purchase\PurchaseController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\Setting\BranchController;
use App\Http\Controllers\Setting\UserListController;
use App\Http\Controllers\SMSController;
use App\Http\Controllers\Stock\StockController;
use App\Http\Controllers\Stores\StoreController;
use App\Http\Controllers\Student\StudentController;
use App\Http\Controllers\Subject\SubjectAssignClassController;
use App\Http\Controllers\Subject\SubjectAssignTeacherController;
use App\Http\Controllers\Subject\SubjectController;
use App\Http\Controllers\Supplier\SupplierController;
use App\Http\Controllers\StudentDashboardController;

//fee
use App\Http\Controllers\Teacher\TeacherController;
use App\Http\Controllers\TeacherDashboardController;
use App\Http\Controllers\Transcation\TranscationController;
use Illuminate\Support\Facades\Route;

Route::get('/online_apply', [OnlineapplyController::class, 'onlineapply'])->name('onlineapply');
Route::post('/online_apply', [OnlineapplyController::class, 'onlineapply_create'])->name('onlineapply_create');
Route::get('/transection', [OnlineapplyController::class, 'transection'])->name('transection');
Route::post('/transection', [OnlineapplyController::class, 'transectionPost']);

Route::group(
  ['as' => 'backend.', 'namespace' => 'Backend', 'prefix' => 'authority/student_dashboard', 'middleware' => ['auth', 'student']]
  ,
  function () {
    Route::get('/', [StudentDashboardController::class, 'studentDashboard'])->name('student.dashboard');
    Route::get('/profile', [StudentDashboardController::class, 'studentProfile'])->name('student.dashboard.profile');
    Route::get('/fees', [StudentDashboardController::class, 'studentFees'])->name('student.dashboard.fees');
  }
);

Route::group(['as' => 'backend.', 'namespace' => 'Backend', 'prefix' => 'authority', 'middleware' => ['auth', 'admin']], function () {

  Route::group(['prefix' => 'dashboard'], function () {
    Route::get('/', [DashboardController::class, 'dashboard'])->name('dashboard');
  });

  //filter
  Route::get('fee/class/group/{id}', [GroupController::class, 'group']);
  Route::get('fee/student/search/{id}', [StudentController::class, 'search_student']);
  Route::get('profile/{id}', [DashboardController::class, 'profile'])->name('user.profile');
  Route::post('profile/update/{id}', [DashboardController::class, 'profile_update'])->name('user.profile.update');

  Route::group(['as' => 'general.', 'prefix' => 'general'], function () {
    Route::get('/langauage/{lang}', [GeneralSettingController::class, 'language'])->name('language');
  });

  Route::group(['as' => 'role.', 'prefix' => 'setting/role'], function () {
    Route::get('/index', [RoleController::class, 'index'])->name('index');
    Route::get('/create', [RoleController::class, 'create'])->name('create');
    Route::post('/store', [RoleController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [RoleController::class, 'edit'])->name('edit');
    Route::get('/view/{id}', [RoleController::class, 'view'])->name('view');
    Route::put('/update/{id}', [RoleController::class, 'update'])->name('update');
    Route::delete('/destroy/{id}', [RoleController::class, 'destroy'])->name('destroy');
    Route::get('/assign/{id}', [RoleController::class, 'assign_create'])->name('assign.create');
    Route::post('/assign/{id}', [RoleController::class, 'assign_store'])->name('assign.store');
  });

  Route::group(['as' => 'branch.', 'prefix' => 'setting/brance'], function () {
    Route::get('/', [BranchController::class, 'index'])->name('index');
    Route::post('/store', [BranchController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [BranchController::class, 'edit'])->name('edit');
    Route::post('/update', [BranchController::class, 'update'])->name('update');
    Route::get('/delete/{id}', [BranchController::class, 'destroy'])->name('delete');
    Route::get('/activedeactive/{id}', [BranchController::class, 'activedeactive'])->name('deactive');
  });
  Route::group(['as' => 'user_list.', 'prefix' => 'setting/user_list'], function () {
    Route::get('/', [UserListController::class, 'index'])->name('index');
    Route::post('/store', [UserListController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [UserListController::class, 'edit'])->name('edit');
    Route::post('/update', [UserListController::class, 'update'])->name('update');
    Route::get('/delete/{id}', [UserListController::class, 'destroy'])->name('delete');
    Route::get('/activedeactive/{id}', [UserListController::class, 'activedeactive'])->name('deactive');
  });

  Route::group(['as' => 'session.', 'prefix' => 'academic/session'], function () {
    Route::get('/', [SessionController::class, 'index'])->name('index');
    Route::post('/store', [SessionController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [SessionController::class, 'edit'])->name('edit');
    Route::post('/update', [SessionController::class, 'update'])->name('update');
    Route::get('/delete/{id}', [SessionController::class, 'destroy'])->name('delete');
  });

  Route::group(['as' => 'setting.', 'prefix' => 'setting/general'], function () {
    Route::get('/', [GeneralSettingController::class, 'index'])->name('index');
    Route::post('/store', [GeneralSettingController::class, 'store'])->name('store');
  });

  Route::group(['as' => 'section.', 'prefix' => 'academic/section'], function () {
    Route::get('/', [SectionController::class, 'index'])->name('index');
    Route::post('/store', [SectionController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [SectionController::class, 'edit'])->name('edit');
    Route::post('/update', [SectionController::class, 'update'])->name('update');
    Route::get('/delete/{id}', [SectionController::class, 'destroy'])->name('delete');
  });

  Route::group(['as' => 'group.', 'prefix' => 'academic/group'], function () {
    Route::get('/', [GroupController::class, 'index'])->name('index');
    Route::post('/store', [GroupController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [GroupController::class, 'edit'])->name('edit');
    Route::post('/update', [GroupController::class, 'update'])->name('update');
    Route::get('/delete/{id}', [GroupController::class, 'destroy'])->name('delete');
  });

  Route::group(['as' => 'room.', 'prefix' => 'academic/room'], function () {
    Route::get('/', [RoomController::class, 'index'])->name('index');
    Route::post('/store', [RoomController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [RoomController::class, 'edit'])->name('edit');
    Route::post('/update', [RoomController::class, 'update'])->name('update');
    Route::get('/delete/{id}', [RoomController::class, 'destroy'])->name('delete');
  });

  Route::group(['as' => 'class.', 'prefix' => 'academic/class'], function () {
    Route::get('/', [ClassController::class, 'index'])->name('index');
    Route::post('/store', [ClassController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [ClassController::class, 'edit'])->name('edit');
    Route::post('/update', [ClassController::class, 'update'])->name('update');
    Route::get('/delete/{id}', [ClassController::class, 'destroy'])->name('delete');
  });

  Route::group(['as' => 'routine.', 'prefix' => 'academic/routine'], function () {
    Route::get('/', [RoutineController::class, 'index'])->name('index');
    Route::post('/store', [RoutineController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [RoutineController::class, 'edit'])->name('edit');
    Route::post('/update', [RoutineController::class, 'update'])->name('update');
    Route::get('/delete/{id}', [RoutineController::class, 'destroy'])->name('delete');

    Route::get('/getSection/{id}',[RoutineController::class,'getSection']);
  });

  // subject module
  Route::group(['as' => 'subject.', 'prefix' => 'subject'], function () {
    Route::get('/index', [SubjectController::class, 'index'])->name('index');
    Route::post('/store', [SubjectController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [SubjectController::class, 'edit'])->name('edit');
    Route::post('/update', [SubjectController::class, 'update'])->name('update');
    Route::get('/delete/{id}', [SubjectController::class, 'destroy'])->name('delete');
  });

  Route::group(['as' => 'subjectassign.', 'prefix' => 'subject/assign'], function () {
    Route::get('/', [SubjectAssignClassController::class, 'index'])->name('index');
    Route::post('/store', [SubjectAssignClassController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [SubjectAssignClassController::class, 'edit'])->name('edit');
    Route::post('/update', [SubjectAssignClassController::class, 'update'])->name('update');
    Route::get('/delete/{id}', [SubjectAssignClassController::class, 'destroy'])->name('delete');
  });
  Route::group(['as' => 'subjectassignstudent.', 'prefix' => 'subject/assign/optional'], function () {
    Route::get('/', [SubjectAssignClassController::class, 'optionalassign'])->name('optionalassign');
    Route::post('/store', [SubjectAssignClassController::class, 'optionalassignstore'])->name('optionalassignstore');
  });

  Route::group(['as' => 'subjectassignteacher.', 'prefix' => 'subject/assign/teacher'], function () {
    Route::get('/', [SubjectAssignTeacherController::class, 'index'])->name('index');
    Route::post('/store', [SubjectAssignTeacherController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [SubjectAssignTeacherController::class, 'edit'])->name('edit');
    Route::post('/update', [SubjectAssignTeacherController::class, 'update'])->name('update');
    Route::get('/delete/{id}', [SubjectAssignTeacherController::class, 'destroy'])->name('delete');
  });

  Route::group(['as' => 'student.', 'prefix' => 'student'], function () {
    Route::get('/index', [StudentController::class, 'index'])->name('index');
    Route::get('/pending', [StudentController::class, 'getPendingStudents'])->name('pending');
    Route::get('/info/{id}', [StduentController::class, 'info'])->name('info');
    Route::get('/create', [StudentController::class, 'create'])->name('create');
    Route::post('/store', [StudentController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [StudentController::class, 'edit'])->name('edit');
    Route::post('/update/{id}', [StudentController::class, 'update'])->name('update');
    Route::get('/delete/{id}', [StudentController::class, 'destroy'])->name('delete');
    Route::get('/activedeactive/{id}', [StudentController::class, 'activedeactive'])->name('activedeactive');
    Route::get('/deactive', [StudentController::class, 'deactive'])->name('deactive');
    Route::get('/import', [StudentController::class, 'import'])->name('import');
    Route::post('/import/store', [StudentController::class, 'import_store'])->name('import.store');
    Route::get('/download', [StudentController::class, 'download'])->name('download');
  });

  Route::group(['as' => 'teacher.', 'prefix' => 'teacher'], function () {
    Route::get('/', [TeacherController::class, 'index'])->name('index');
    Route::post('/store', [TeacherController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [TeacherController::class, 'edit'])->name('edit');
    Route::post('/update', [TeacherController::class, 'update'])->name('update');
    Route::get('/delete/{id}', [TeacherController::class, 'destroy'])->name('delete');
  });

  Route::group(['as' => 'attendance.', 'prefix' => 'attendance'], function () {
    Route::get('/manually', [AttendanceController::class, 'index'])->name('index');
    Route::post('/store', [AttendanceController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [AttendanceController::class, 'edit'])->name('edit');
    Route::post('/update', [AttendanceController::class, 'update'])->name('update');
    Route::get('/delete/{id}', [AttendanceController::class, 'destroy'])->name('delete');
  });

  Route::group(['as' => 'sendsms.', 'prefix' => 'sms'], function () {
    Route::get('/', [SMSController::class, 'index'])->name('index');
    Route::post('/send', [SMSController::class, 'send'])->name('send');
  });

  // Examination
  Route::group(['as' => 'grade.', 'prefix' => 'examination/grade'], function () {
    Route::get('/', [GradeController::class, 'index'])->name('index');
    Route::post('/store', [GradeController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [GradeController::class, 'edit'])->name('edit');
    Route::post('/update', [GradeController::class, 'update'])->name('update');
    Route::delete('/delete/{id}', [GradeController::class, 'destroy'])->name('delete');
  });

  Route::group(['as' => 'exam.', 'prefix' => 'examination/exam'], function () {
    Route::get('/', [ExamController::class, 'index'])->name('index');
    Route::post('/store', [ExamController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [ExamController::class, 'edit'])->name('edit');
    Route::post('/update', [ExamController::class, 'update'])->name('update');
    Route::delete('/delete/{id}', [ExamController::class, 'destroy'])->name('delete');
  });

  Route::group(['as' => 'exam_setup.', 'prefix' => 'examination/exam-setup'], function () {
    Route::get('/', [ExamSetupController::class, 'index'])->name('index');
    Route::post('/store', [ExamSetupController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [ExamSetupController::class, 'edit'])->name('edit');
    Route::post('/update', [ExamSetupController::class, 'update'])->name('update');
    Route::delete('/delete/{id}', [ExamSetupController::class, 'destroy'])->name('delete');

    Route::post('/title_store', [ExamSetupController::class, 'title_store'])->name('title_store');
    Route::get('/title_edit/{id}', [ExamSetupController::class, 'title_edit'])->name('title_edit');
    Route::post('/title_update', [ExamSetupController::class, 'title_update'])->name('title_update');
    Route::delete('/title_delete/{id}', [ExamSetupController::class, 'title_delete'])->name('title_delete');
  });

  //bank
  Route::group(['as' => 'bank.', 'prefix' => 'bank'], function () {
    Route::get('/', [BankController::class, 'index'])->name('index');
    Route::post('/store', [BankController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [BankController::class, 'edit'])->name('edit');
    Route::post('/update', [BankController::class, 'update'])->name('update');
    Route::get('/delete/{id}', [BankController::class, 'destroy'])->name('delete');
  });

  //bank transcation
  Route::group(['as' => 'transcation.', 'prefix' => 'transcation'], function () {
    Route::get('/', [TranscationController::class, 'index'])->name('index');
    Route::post('/store', [TranscationController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [TranscationController::class, 'edit'])->name('edit');
    Route::post('/update', [TranscationController::class, 'update'])->name('update');
    Route::get('/delete/{id}', [TranscationController::class, 'destroy'])->name('delete');
  });

  //expense_category
  Route::group(['as' => 'expense_category.', 'prefix' => 'expense_category'], function () {
    Route::get('/', [ExpenseCategoryController::class, 'index'])->name('index');
    Route::post('/store', [ExpenseCategoryController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [ExpenseCategoryController::class, 'edit'])->name('edit');
    Route::post('/update', [ExpenseCategoryController::class, 'update'])->name('update');
    Route::get('/delete/{id}', [ExpenseCategoryController::class, 'destroy'])->name('delete');
  });

  //expense
  Route::group(['as' => 'expense.', 'prefix' => 'expense'], function () {
    Route::get('/', [ExpenseController::class, 'index'])->name('index');
    Route::post('/store', [ExpenseController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [ExpenseController::class, 'edit'])->name('edit');
    Route::post('/update', [ExpenseController::class, 'update'])->name('update');
    Route::get('/delete/{id}', [ExpenseController::class, 'destroy'])->name('delete');
  });

  //income_category
  Route::group(['as' => 'income_category.', 'prefix' => 'income_category'], function () {
    Route::get('/', [IncomeCategoryController::class, 'index'])->name('index');
    Route::post('/store', [IncomeCategoryController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [IncomeCategoryController::class, 'edit'])->name('edit');
    Route::post('/update', [IncomeCategoryController::class, 'update'])->name('update');
    Route::get('/delete/{id}', [IncomeCategoryController::class, 'destroy'])->name('delete');
  });

  //income
  Route::group(['as' => 'income.', 'prefix' => 'income'], function () {
    Route::get('/', [IncomeController::class, 'index'])->name('index');
    Route::post('/store', [IncomeController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [IncomeController::class, 'edit'])->name('edit');
    Route::post('/update', [IncomeController::class, 'update'])->name('update');
    Route::get('/delete/{id}', [IncomeController::class, 'destroy'])->name('delete');
  });

  //inventory_category
  Route::group(['as' => 'inventory_category.', 'prefix' => 'inventory_category'], function () {
    Route::get('/', [InventoryCategoryController::class, 'index'])->name('index');
    Route::post('/store', [InventoryCategoryController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [InventoryCategoryController::class, 'edit'])->name('edit');
    Route::post('/update', [InventoryCategoryController::class, 'update'])->name('update');
    Route::get('/delete/{id}', [InventoryCategoryController::class, 'destroy'])->name('delete');
  });

  //item coding
  Route::group(['as' => 'item.', 'prefix' => 'item'], function () {
    Route::get('/', [ItemcodingController::class, 'index'])->name('index');
    Route::post('/store', [ItemcodingController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [ItemcodingController::class, 'edit'])->name('edit');
    Route::post('/update', [ItemcodingController::class, 'update'])->name('update');
    Route::get('/delete/{id}', [ItemcodingController::class, 'destroy'])->name('delete');
  });

  //stores
  Route::group(['as' => 'store.', 'prefix' => 'store'], function () {
    Route::get('/', [StoreController::class, 'index'])->name('index');
    Route::post('/store', [StoreController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [StoreController::class, 'edit'])->name('edit');
    Route::post('/update', [StoreController::class, 'update'])->name('update');
    Route::get('/delete/{id}', [StoreController::class, 'destroy'])->name('delete');
  });

  //supplier
  Route::group(['as' => 'supplier.', 'prefix' => 'supplier'], function () {
    Route::get('/', [SupplierController::class, 'index'])->name('index');
    Route::post('/store', [SupplierController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [SupplierController::class, 'edit'])->name('edit');
    Route::post('/update', [SupplierController::class, 'update'])->name('update');
    Route::get('/delete/{id}', [SupplierController::class, 'destroy'])->name('delete');
  });

  //purchase
  Route::group(['as' => 'purchase.', 'prefix' => 'purchase'], function () {
    Route::get('/', [PurchaseController::class, 'index'])->name('index');
  });

  //item stock
  Route::group(['as' => 'stock.', 'prefix' => 'stock'], function () {
    Route::get('/', [StockController::class, 'index'])->name('index');
    Route::post('/store', [StockController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [StockController::class, 'edit'])->name('edit');
    Route::post('/update', [StockController::class, 'update'])->name('update');
    Route::get('/delete/{id}', [StockController::class, 'destroy'])->name('delete');
  });

  //issue/Return
  Route::group(['as' => 'issue.', 'prefix' => 'issue'], function () {
    Route::get('/', [IssueController::class, 'index'])->name('index');
    Route::post('/store', [IssueController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [IssueController::class, 'edit'])->name('edit');
    Route::post('/update', [IssueController::class, 'update'])->name('update');
    Route::get('/delete/{id}', [IssueController::class, 'destroy'])->name('delete');
  });

  //hrm/department
  Route::group(['as' => 'department.', 'prefix' => 'department'], function () {
    Route::get('/', [DepartmentController::class, 'index'])->name('index');
    Route::post('/store', [DepartmentController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [DepartmentController::class, 'edit'])->name('edit');
    Route::post('/update', [DepartmentController::class, 'update'])->name('update');
    Route::get('/delete/{id}', [DepartmentController::class, 'destroy'])->name('delete');
  });

  //hrm/stuff
  Route::group(['as' => 'stuff.', 'prefix' => 'stuff'], function () {
    Route::get('/', [StuffController::class, 'index'])->name('index');
    Route::post('/store', [StuffController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [StuffController::class, 'edit'])->name('edit');
    Route::post('/update', [StuffController::class, 'update'])->name('update');
    Route::get('/delete/{id}', [StuffController::class, 'destroy'])->name('delete');
  });

  //hrm/designation
  Route::group(['as' => 'designation.', 'prefix' => 'designation'], function () {
    Route::get('/', [DesignationController::class, 'index'])->name('index');
    Route::post('/store', [DesignationController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [DesignationController::class, 'edit'])->name('edit');
    Route::post('/update', [DesignationController::class, 'update'])->name('update');
    Route::get('/delete/{id}', [DesignationController::class, 'destroy'])->name('delete');
  });

  //hrm/payroll
  Route::group(['as' => 'payroll.', 'prefix' => 'payroll'], function () {
    Route::get('/', [PayrollController::class, 'index'])->name('index');
    Route::post('/store', [PayrollController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [PayrollController::class, 'edit'])->name('edit');
    Route::post('/update', [PayrollController::class, 'update'])->name('update');
    Route::get('/delete/{id}', [PayrollController::class, 'destroy'])->name('delete');
  });

  Route::group(['as' => 'input_mark.', 'prefix' => 'examination/input-mark'], function () {
    Route::get('/', [InputMarkController::class, 'index'])->name('index');
    Route::get('/create', [InputMarkController::class, 'create'])->name('create');
    Route::post('/store', [InputMarkController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [InputMarkController::class, 'edit'])->name('edit');
    Route::post('/update', [InputMarkController::class, 'update'])->name('update');
    Route::delete('/delete/{id}', [InputMarkController::class, 'destroy'])->name('delete');
  });

  Route::group(['as' => 'fee.group.', 'prefix' => 'fee/group'], function () {
    Route::get('/', [FeeController::class, 'index'])->name('index');
    Route::get('/create', [FeeController::class, 'create'])->name('create');
    Route::post('/store', [FeeController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [FeeController::class, 'edit'])->name('edit');
    Route::post('/update', [FeeController::class, 'update'])->name('update');
    Route::delete('/delete/{id}', [FeeController::class, 'destroy'])->name('delete');
  });

  Route::group(['as' => 'fee.type.', 'prefix' => 'fee/type'], function () {
    Route::get('/', [FeeTypeController::class, 'index'])->name('index');
    Route::get('/create', [FeeTypeController::class, 'create'])->name('create');
    Route::post('/store', [FeeTypeController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [FeeTypeController::class, 'edit'])->name('edit');
    Route::post('/update', [FeeTypeController::class, 'update'])->name('update');
    Route::delete('/delete/{id}', [FeeTypeController::class, 'destroy'])->name('delete');
  });

  Route::group(['as' => 'fee.allocation.', 'prefix' => 'fee/allocation'], function () {
    Route::get('/', [FeeAllocationController::class, 'index'])->name('index');
    Route::get('/create', [FeeAllocationController::class, 'create'])->name('create');
    Route::post('/store', [FeeAllocationController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [FeeAllocationController::class, 'edit'])->name('edit');
    Route::post('/update', [FeeAllocationController::class, 'update'])->name('update');
    Route::delete('/delete/{id}', [FeeAllocationController::class, 'destroy'])->name('delete');
    Route::get('/get-fee-type/{id}', [FeeAllocationController::class, 'getFeeType']);
    Route::get('/get-fee-info/{id}', [FeeAllocationController::class, 'getFeeTypeInfo']);
  });

  Route::group(['as' => 'fee.invoice.', 'prefix' => 'fee/invoice'], function () {
    Route::get('/', [FeeInvoiceController::class, 'index'])->name('index');
    Route::get('/create', [FeeInvoiceController::class, 'create'])->name('create');
    Route::post('/store', [FeeInvoiceController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [FeeInvoiceController::class, 'edit'])->name('edit');
    Route::post('/update', [FeeInvoiceController::class, 'update'])->name('update');
    Route::delete('/delete/{id}', [FeeInvoiceController::class, 'destroy'])->name('delete');
  });

  Route::group(['as' => 'edit_mark.', 'prefix' => 'examination/edit-mark'], function () {
    Route::get('/student', [InputMarkController::class, 'seachStudent'])->name('seachStudent');
    Route::post('/student/markupdate/{id}', [InputMarkController::class, 'updateMard'])->name('updateMark');
  });

  Route::group(['as' => 'view_mark.', 'prefix' => 'examination/view-mark'], function () {
    Route::get('/', [ViewMarkcontroller::class, 'index'])->name('index');
  });

  Route::group(['as' => 'view_result.', 'prefix' => 'examination/view-result'], function () {
    Route::get('/', [ViewMarkcontroller::class, 'view_result'])->name('index');
  });

  Route::group(['as' => 'view_result.', 'prefix' => 'examination/transcript'], function () {
    Route::get('/print', [ViewMarkcontroller::class, 'view_result_print'])->name('index_print');
  });

  Route::group(['as' => 'tabulation_sheet.', 'prefix' => 'examination/tabulation_sheet'], function () {
    Route::get('/', [ViewMarkcontroller::class, 'tabulation_sheet'])->name('tabulation_sheet');
  });

  Route::group(['as' => 'merit_list.', 'prefix' => 'examination/merit_list'], function () {
    Route::get('/', [ViewMarkcontroller::class, 'merit_list'])->name('index');
  });

  Route::group(['as' => 'mark_sheet.', 'prefix' => 'examination/mark_sheet'], function () {
    Route::get('/', [ViewMarkcontroller::class, 'mark_sheet'])->name('index');
  });
});

Route::get('/', [FrontendController::class, 'index'])->name('index');
Route::get('/index/principal', [FrontendController::class, 'principal'])->name('index.principal');
Route::get('school/worker/froend', [FrontendController::class, 'worker'])->name('school.worker.froend');
//faculity and staffs
Route::get('/faculity/staffs', [FrontendController::class, 'staffs'])->name('faculity.staffs');
//result page view
Route::get('result', [FrontendController::class, 'result'])->name('result');
//view alumni
Route::get('alumni', [FrontendController::class, 'alumni'])->name('alumni');
//club
Route::get('gallery', [FrontendController::class, 'gallery'])->name('gallery');
Route::get('apply-online', [FrontendController::class, 'applyOnline'])->name('apply_online');
Route::post('apply-online', [FrontendController::class, 'postApplyOnline'])->name('apply_online.store');

//backend
//principal message add view
Route::get('school/principal/index', [MessageController::class, 'index'])->name('school.principal.index');
Route::post('school/principal/index', [MessageController::class, 'message']);
Route::get('/delete/{id}/message', [MessageController::class, 'delete'])->name('delete.messasge');
Route::get('edit/{id}/message', [MessageController::class, 'edit'])->name('edit.message');
Route::post('edit/{id}/message', [MessageController::class, 'update']);

//school history
Route::get('/school/history', [HistoryController::class, 'index'])->name('school.history');
Route::post('/school/history', [HistoryController::class, 'create']);
Route::get('/school/{id}/history/delete', [HistoryController::class, 'delete'])->name('school.history.delete');
Route::get('school/{id}/history/edit', [HistoryController::class, 'edit'])->name('school.history.edit');
Route::post('school/{id}/history/edit', [HistoryController::class, 'update']);

//faculty and staff
Route::get('/school/staff', [StaffController::class, 'index'])->name('school.staff');
Route::post('/school/staff', [StaffController::class, 'create']);
Route::get('/school/{id}/staff/delete', [StaffController::class, 'delete'])->name('school.staff.delete');

//principal
Route::get('school/principal', [PrincipalController::class, 'index'])->name('school.principal');
Route::post('school/principal', [PrincipalController::class, 'create']);
Route::get('/school/{id}/principal/delete', [PrincipalController::class, 'delete'])->name('school.principal.delete');

//Frontend Gallery
Route::get('school/gallery', [GalleryController::class, 'index'])->name('school.gallery');
Route::post('school/gallery', [GalleryController::class, 'create']);
Route::get('school/{id}/gallery/delete', [GalleryController::class, 'delete'])->name('school.gallery.delete');

//school worker
Route::get('school/worker', [SchoolWorkerController::class, 'index'])->name('school.worker');
Route::post('school/worker', [SchoolWorkerController::class, 'cretae']);
Route::get('school/{id}/worker/delete', [SchoolWorkerController::class, 'delete'])->name('school.worker.delete');

//school phone
Route::get('school/phone', [PhoneController::class, 'index'])->name('school.phone');
Route::post('school/phone', [PhoneController::class, 'create']);
Route::get('school/{id}/phone/delete', [PhoneController::class, 'delete'])->name('school.phone.delete');
Route::get('school/{id}/phone/edit', [PhoneController::class, 'edit'])->name('school.phone.edit');
Route::post('school/{id}/phone/edit', [PhoneController::class, 'update']);

//school logo
Route::get('school/logo', [LogoController::class, 'index'])->name('school.log');
Route::post('school/logo', [LogoController::class, 'cretae']);
Route::get('school/{id}/logo/delete', [LogoController::class, 'delete'])->name('school.logo.delete');

// chairman photo
Route::get('school/chairman/photo', [ChairmanController::class, 'index'])->name('school.chairman.photo');
Route::post('school/chairman/photo', [ChairmanController::class, 'create']);
Route::post('school/chairman/photo/update/{id}', [ChairmanController::class, 'update_data']);
Route::get('school/{id}/chairman/delete', [ChairmanController::class, 'delete'])->name('school.chairman.delete');

//slider
Route::get('school/slide', [SliderController::class, 'index'])->name('school.slider');
Route::post('school/slide', [SliderController::class, 'create']);
Route::get('school/{id}/slider/delete', [SliderController::class, 'delete'])->name('school.slider.delete');

//Notice
Route::get('school/notice', [NoticeBoardController::class, 'index'])->name('school.notice');
Route::post('school/notice', [NoticeBoardController::class, 'store'])->name('school.notice.store');
Route::get('school/{id}/notice/edit', [NoticeBoardController::class, 'edit'])->name('school.notice.edit');
Route::post('school/{id}/notice/edit', [NoticeBoardController::class, 'update']);
Route::get('school/{id}/notice/delte', [NoticeBoardController::class, 'delete'])->name('school.notice.delete');
Route::get('download/{id}', [NoticeBoardController::class, 'getpdf'])->name('download');

require __DIR__ . '/auth.php';
require __DIR__ . '/students.php';
