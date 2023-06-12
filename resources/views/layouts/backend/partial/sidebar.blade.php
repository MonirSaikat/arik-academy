<ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
  <a class="sidebar-brand d-flex align-items-center justify-content-center text-light" href="">
    <div class="sidebar-brand-icon">
      <!--<img src="img/logo/logo2.png">-->
    </div>
    <div class="sidebar-brand-text mx-3"><span class="">Aric Academy</span></div>
  </a>

  <hr class="sidebar-divider my-0">

  <li class="nav-item {{ Route::currentRouteName() == 'backend.dashboard' ? 'active' : 0 }}">
    <a class="nav-link" href="{{ route('backend.dashboard') }}">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span>{{ __('sidebar.dashboard') }}</span></a>
  </li>
  <hr class="sidebar-divider">
  <div class="sidebar-heading">
    {{ __('sidebar.features') }}
  </div>

  @if (userHasPermission('academic-module'))
    <li class="nav-item">
      <a class="nav-link {{ Request::is('academic*') ? '' : 'collapsed' }}" active href="#" data-toggle="collapse"
        data-target="#academic-menu" aria-expanded="true" aria-controls="academic-menu">
        <i class="fab fa-fw fa-wpforms"></i>
        <span>{{ __('sidebar.academic') }}</span>
      </a>
      <div id="academic-menu" class="collapse {{ Request::is('authority/academic*') ? 'show' : '' }}"
        aria-labelledby="headingForm" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          @if (userHasPermission('session-index'))
            <a class="collapse-item {{ Request::is('authority/academic/session') ? 'active' : '' }}"
              href="{{ route('backend.session.index') }}">{{ __('sidebar.create-session') }}</a>
          @endif

          @if (userHasPermission('section-index'))
            <a class="collapse-item {{ Request::is('authority/academic/section') ? 'active' : '' }}"
              href="{{ route('backend.section.index') }}">{{ __('sidebar.create-section') }}</a>
          @endif

          @if (userHasPermission('group-index'))
            <a class="collapse-item {{ Request::is('authority/academic/group') ? 'active' : '' }}"
              href="{{ route('backend.group.index') }}">{{ __('sidebar.create-group') }}</a>
          @endif

          @if (userHasPermission('class-index'))
            <a class="collapse-item {{ Request::is('authority/academic/class') ? 'active' : '' }}"
              href="{{ route('backend.class.index') }}">{{ __('sidebar.create-class') }}</a>
          @endif

          @if (userHasPermission('room-index'))
            <a class="collapse-item {{ Request::is('authority/academic/room') ? 'active' : '' }}"
              href="{{ route('backend.room.index') }}">{{ __('sidebar.class-room') }}</a>
          @endif

          @if (userHasPermission('routine-index'))
            <a class="collapse-item {{ Request::is('authority/academic/routine') ? 'active' : '' }}"
              href="{{ route('backend.routine.index') }}">{{ __('sidebar.create-routine') }}</a>
          @endif

        </div>
      </div>
    </li>
  @endif
  @if (userHasPermission('subject-module'))
    <li class="nav-item">
      <a class="nav-link {{ Request::is('authority/subject*') ? '' : 'collapsed' }}" active href="#"
        data-toggle="collapse" data-target="#subject-menu" aria-expanded="true" aria-controls="subject-menu">
        <i class="fab fa-fw fa-wpforms"></i>
        <span>{{ __('sidebar.subject') }}</span>
      </a>
      <div id="subject-menu" class="collapse {{ Request::is('authority/subject*') ? 'show' : '' }}"
        aria-labelledby="headingForm" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          @if (userHasPermission('subject-store'))
            <a class="collapse-item {{ Request::is('authority/subject/index') ? 'active' : '' }}"
              href="{{ route('backend.subject.index') }}">{{ __('sidebar.create-subject') }}</a>
            <a class="collapse-item {{ Request::is('authority/subject/assign') ? 'active' : '' }}"
              href="{{ route('backend.subjectassign.index') }}">{{ __('sidebar.assign-to-class') }}</a>
            <a class="collapse-item {{ Request::is('authority/subject/assign/teacher') ? 'active' : '' }}"
              href="{{ route('backend.subjectassignteacher.index') }}">{{ __('sidebar.assign-to-teacher') }}</a>
            <a class="collapse-item {{ Request::is('authority/subject/assign/optional') ? 'active' : '' }}"
              href="{{ route('backend.subjectassignstudent.optionalassign') }}">{{ __('sidebar.optional_subject') }}</a>
          @endif

        </div>
      </div>
    </li>
  @endif

  @if (userHasPermission('student-module'))
    <li class="nav-item">
      <a class="nav-link {{ Request::is('authority/student*') ? '' : 'collapsed' }}" active href="#"
        data-toggle="collapse" data-target="#student-menu" aria-expanded="true" aria-controls="student-menu">
        <i class="fab fa-fw fa-wpforms"></i>
        <span>{{ __('sidebar.student') }}</span>
      </a>
      <div id="student-menu" class="collapse {{ Request::is('authority/student*') ? 'show' : '' }}"
        aria-labelledby="headingForm" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          @if (userHasPermission('student-store'))
            <a class="collapse-item {{ Request::is('authority/student/create') ? 'active' : '' }}"
              href="{{ route('backend.student.create') }}">{{ __('sidebar.add-student') }}</a>
          @endif

          @if (userHasPermission('student-index'))
            <a class="collapse-item {{ Request::is('authority/student/index') ? 'active' : '' }}"
              href="{{ route('backend.student.index') }}">{{ __('sidebar.student-list') }}</a>
          @endif

          @if (userHasPermission('student-index'))
            <a class="collapse-item {{ Request::is('authority/student/pending') ? 'active' : '' }}"
              href="{{ route('backend.student.pending') }}">{{ __('sidebar.student-pending') }}</a>
          @endif

          @if (userHasPermission('student-store'))
            <a class="collapse-item {{ Request::is('authority/student/import') ? 'active' : '' }}"
              href="{{ route('backend.student.import') }}">Import</a>
          @endif


          @if (userHasPermission('student-advance'))
            <a class="collapse-item {{ Request::is('authority/student/deactive') ? 'active' : '' }}"
              href="{{ route('backend.student.deactive') }}">{{ __('sidebar.disable-student') }}</a>
            <!--<a class="collapse-item " href="">{{ __('sidebar.promote-student') }}</a>-->
            <!--<a class="collapse-item " href="">{{ __('sidebar.report') }}</a>-->
            <!--<a class="collapse-item " href="">{{ __('sidebar.id-card-generate') }}</a>-->
          @endif

        </div>
      </div>
    </li>
  @endif

  @if (userHasPermission('teacher-module'))
    <li class="nav-item">
      <a class="nav-link {{ Request::is('teacher*') ? '' : 'collapsed' }}" active href="#" data-toggle="collapse"
        data-target="#teacher-menu" aria-expanded="true" aria-controls="teacher-menu">
        <i class="fab fa-fw fa-wpforms"></i>
        <span>{{ __('sidebar.teacher') }}</span>
      </a>
      <div id="teacher-menu" class="collapse {{ Request::is('teacher*') ? 'show' : '' }}"
        aria-labelledby="headingForm" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          @if (userHasPermission('teacher-store'))
            <a class="collapse-item {{ Request::is('teacher') ? 'active' : '' }}"
              href="{{ route('backend.teacher.index') }}">{{ __('sidebar.teacher list') }}</a>
          @endif
        </div>
      </div>
    </li>
  @endif
  @if (userHasPermission('attendance-module'))
    <li class="nav-item">
      <a class="nav-link {{ Request::is('attendance*') ? '' : 'collapsed' }}" active href="#"
        data-toggle="collapse" data-target="#attendance-menu" aria-expanded="true" aria-controls="attendance-menu">
        <i class="fab fa-fw fa-wpforms"></i>
        <span>{{ __('sidebar.attendance') }}</span>
      </a>
      <div id="attendance-menu" class="collapse {{ Request::is('attendance*') ? 'show' : '' }}"
        aria-labelledby="headingForm" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          @if (userHasPermission('attendance-store'))
            <a class="collapse-item {{ Request::is('attendance/manually') ? 'active' : '' }}"
              href="{{ route('backend.attendance.index') }}">{{ __('sidebar.manually-attendance') }}</a>
            <a class="collapse-item " href="">{{ __('sidebar.device-synchronic') }}</a>
          @endif
        </div>
      </div>
    </li>
  @endif

  @if (userHasPermission('homework-module'))
    <li class="nav-item">
      <a class="nav-link {{ Request::is('authority/home_work*') ? '' : 'collapsed' }}" active href="#" data-toggle="collapse" data-target="#homework-menu"
        aria-expanded="true" aria-controls="homework-menu">
        <i class="fab fa-fw fa-wpforms"></i>
        <span>{{ __('sidebar.homework') }}</span>
      </a>
      <div id="homework-menu" class="collapse {{ Request::is('authority/home_work*') ? 'show' : '' }}" aria-labelledby="headingForm" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <a class="collapse-item {{ Request::is('authority/home_work/create') ? 'active' : '' }}" href="{{ route('backend.home_work.create') }}">{{ __('sidebar.add-homework') }}</a>
          <a class="collapse-item {{ Request::is('authority/home_work') ? 'active' : '' }}" href="{{ route('backend.home_work.index') }}">{{ __('sidebar.homework-evaluation') }}</a>
        </div>
      </div>
    </li>
  @endif
  @if (userHasPermission('examination-module'))
    <li class="nav-item">
      <a class="nav-link {{ Request::is('authority/examination*') ? '' : 'collapsed' }}" active href="#"
        data-toggle="collapse" data-target="#exam-menu" aria-expanded="true" aria-controls="exam-menu">
        <i class="fab fa-fw fa-wpforms"></i>
        <span>{{ __('sidebar.examination') }}</span>
      </a>
      <div id="exam-menu" class="collapse {{ Request::is('authority/examination*') ? 'show' : '' }}"
        aria-labelledby="headingForm" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          @if (userHasPermission('examination-advance'))
            <a class="collapse-item {{ Request::is('authority/examination/grade') ? 'active' : '' }}"
              href="{{ route('backend.grade.index') }}">{{ __('sidebar.marks-grade') }}</a>
            <a class="collapse-item {{ Request::is('authority/examination/exam') ? 'active' : '' }}"
              href="{{ route('backend.exam.index') }}">{{ __('sidebar.create-exam') }}</a>
            <a class="collapse-item {{ Request::is('authority/examination/exam-setup') ? 'active' : '' }}"
              href="{{ route('backend.exam_setup.index') }}">{{ __('sidebar.exam-setup') }}</a>
            <a class="collapse-item {{ Request::is('authority/examination/seat_plan') ? 'active' : '' }}"
              href="{{ route('backend.seat_plan.index') }}">{{ __('sidebar.seat-plan') }}</a>
            <a class="collapse-item {{ Request::is('authority/examination/id_card') ? 'active' : '' }}"
              href="{{ route('backend.id_card.index') }}">ID Card</a>
            <!--<a class="collapse-item " href="">{{ __('sidebar.admit-card') }}</a>-->
            <!--<a class="collapse-item " href="">{{ __('sidebar.setting') }}</a>-->
            <!--<a class="collapse-item " href="">{{ __('sidebar.seat-plan') }}</a>-->

            <a class="collapse-item " href="">{{ __('sidebar.blank-mark-sheet') }}</a>
            <a class="collapse-item {{ Request::is('authority/examination/input-mark*') ? 'active' : '' }}"
              href="{{ route('backend.input_mark.index') }}">{{ __('sidebar.input-mark') }}</a>
            <!--<a class="collapse-item {{ Request::is('authority/examination/view-mark*') ? 'active' : '' }}" href="{{ route('backend.view_mark.index') }}">{{ __('sidebar.view-mark') }}</a>-->
            <a class="collapse-item {{ Request::is('authority/examination/edit-mark*') ? 'active' : '' }}"
              href="{{ route('backend.edit_mark.seachStudent') }}">{{ __('sidebar.edit-mark') }}</a>

            <!--<a class="collapse-item {{ Request::is('authority/examination/view-result') ? 'active' : '' }}" href="{{ route('backend.view_result.index_print') }}">{{ __('sidebar.view-result') }}</a>-->
            <a class="collapse-item {{ Request::is('authority/examination/tabulation_sheet') ? 'active' : '' }}"
              href="{{ route('backend.tabulation_sheet.tabulation_sheet') }}">{{ __('sidebar.tabulation-sheet') }}</a>
            <a class="collapse-item {{ Request::is('authority/examination/mark-sheet') ? 'active' : '' }}"
              href="{{ route('backend.mark_sheet.index') }}">{{ __('sidebar.mark-sheet') }}</a>
            <a class="collapse-item {{ Request::is('authority/examination/merit_list') ? 'active' : '' }}"
              href="{{ route('backend.merit_list.index') }}">{{ __('sidebar.merit-list') }}</a>
          @endif
        </div>
      </div>
    </li>
  @endif

  @if (userHasPermission('fees-module'))
    <li class="nav-item">
      <a class="nav-link {{ Request::is('authority/fee*') ? '' : 'collapsed' }}" active href="#"
        data-toggle="collapse" data-target="#fees-menu" aria-expanded="true" aria-controls="fees-menu">
        <i class="fab fa-fw fa-wpforms"></i>
        <span>{{ __('sidebar.fees') }}</span>
      </a>
      <div id="fees-menu" class="collapse {{ Request::is('authority/fee*') ? 'show' : '' }}"
        aria-labelledby="headingForm" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <a class="collapse-item {{ Request::is('fee/group') ? 'active' : '' }}"
            href="{{ route('backend.fee.group.index') }}">{{ __('sidebar.fees-group') }}</a>
          <a class="collapse-item {{ Request::is('fee/type') ? 'active' : '' }}"
            href="{{ route('backend.fee.type.index') }}">{{ __('sidebar.fees-type') }}</a>
          <a class="collapse-item {{ Request::is('fee/allocation') ? 'active' : '' }}"
            href="{{ route('backend.fee.allocation.index') }}">Fee Allocation</a>
          <a class="collapse-item {{ Request::is('fee/invoice') ? 'active' : '' }}"
            href="{{ route('backend.fee.invoice.index') }}">Fee Invoice</a>
          <a class="collapse-item " href="">{{ __('sidebar.fees-waiver') }}</a>
          <a class="collapse-item " href="">{{ __('sidebar.fees-collection') }}</a>
          <a class="collapse-item " href="">{{ __('sidebar.payment-search') }}</a>
          <a class="collapse-item " href="">{{ __('sidebar.report') }}</a>
        </div>
      </div>
    </li>
  @endif
  @if (userHasPermission('accounting-module'))
    <li class="nav-item">
      <a class="nav-link collapsed" active href="#" data-toggle="collapse" data-target="#accounting-menu"
        aria-expanded="true" aria-controls="accounting-menu">
        <i class="fab fa-fw fa-wpforms"></i>
        <span>{{ __('sidebar.accounting') }}</span>
      </a>
      <div id="accounting-menu" class="collapse " aria-labelledby="headingForm" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <a class="collapse-item " href="">{{ __('sidebar.cashbook') }}</a>
          <a class="collapse-item " href="{{ route('backend.bank.index') }}">{{ __('sidebar.bank') }}</a>
          <a class="collapse-item "
            href="{{ route('backend.transcation.index') }}">{{ __('Bank Transcation') }}</a>
          <a class="collapse-item "
            href="{{ route('backend.expense_category.index') }}">{{ __('Expense Category') }}</a>
          <a class="collapse-item " href="{{ route('backend.expense.index') }}">{{ __('sidebar.expense') }}</a>
          <a class="collapse-item " href="">{{ __('sidebar.report') }}</a>
        </div>
      </div>
    </li>
  @endif
  @if (userHasPermission('income-module'))
    <li class="nav-item">
      <a class="nav-link collapsed" active href="#" data-toggle="collapse" data-target="#income-menu"
        aria-expanded="true" aria-controls="income-menu">
        <i class="fab fa-fw fa-wpforms"></i>
        <span>{{ __('sidebar.income') }}</span>
      </a>
      <div id="income-menu" class="collapse " aria-labelledby="headingForm" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <a class="collapse-item " href="{{ route('backend.income.index') }}">{{ __('sidebar.income') }}</a>
          <a class="collapse-item "
            href="{{ route('backend.income_category.index') }}">{{ __('sidebar.income category') }}</a>
        </div>
      </div>
    </li>
  @endif
  @if (userHasPermission('inventory-module'))
    <li class="nav-item">
      <a class="nav-link collapsed" active href="#" data-toggle="collapse" data-target="#inventory-menu"
        aria-expanded="true" aria-controls="inventory-menu">
        <i class="fab fa-fw fa-wpforms"></i>
        <span>{{ __('sidebar.inventory') }}</span>
      </a>
      <div id="inventory-menu" class="collapse " aria-labelledby="headingForm" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <a class="collapse-item " href="{{ route('backend.issue.index') }}">{{ __('sidebar.Issue/Return') }}</a>
          <a class="collapse-item "
            href="{{ route('backend.inventory_category.index') }}">{{ __('sidebar.Inventory Categories') }}</a>
          <a class="collapse-item " href="{{ route('backend.supplier.index') }}">{{ __('sidebar.suppliers') }}</a>
          <a class="collapse-item " href="{{ route('backend.store.index') }}">{{ __('sidebar.Stores') }}</a>
          <a class="collapse-item " href="{{ route('backend.item.index') }}">{{ __('sidebar.Item Coding') }}</a>
          <a class="collapse-item " href="{{ route('backend.purchase.index') }}">{{ __('sidebar.Purchase') }}</a>
          <a class="collapse-item " href="{{ route('backend.stock.index') }}">{{ __('sidebar.Items Stock') }}</a>
        </div>
      </div>
    </li>
  @endif
  @if (userHasPermission('hrm-module'))
    <li class="nav-item">
      <a class="nav-link collapsed" active href="#" data-toggle="collapse" data-target="#hrm-menu"
        aria-expanded="true" aria-controls="hrm-menu">
        <i class="fab fa-fw fa-wpforms"></i>
        <span>{{ __('sidebar.hrm') }}</span>
      </a>
      <div id="hrm-menu" class="collapse " aria-labelledby="headingForm" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <a class="collapse-item "
            href="{{ route('backend.designation.index') }}">{{ __('sidebar.designation') }}</a>
          <a class="collapse-item "
            href="{{ route('backend.department.index') }}">{{ __('sidebar.department') }}</a>
          <a class="collapse-item " href="{{ route('backend.stuff.index') }}">{{ __('sidebar.stuff') }}</a>
          <a class="collapse-item " href="">{{ __('sidebar.stuff-attendance') }}</a>
          <a class="collapse-item " href="{{ route('backend.payroll.index') }}">{{ __('sidebar.payroll') }}</a>
          <a class="collapse-item " href="">{{ __('sidebar.report') }}</a>
        </div>
      </div>
    </li>
  @endif
  @if (userHasPermission('sms-module'))
    <li class="nav-item">
      <a class="nav-link {{ Request::is('sms*') ? '' : 'collapsed' }}" active href="#" data-toggle="collapse"
        data-target="#sms-menu" aria-expanded="true" aria-controls="sms-menu">
        <i class="fab fa-fw fa-wpforms"></i>
        <span>{{ __('sidebar.sms') }}</span>
      </a>
      <div id="sms-menu" class="collapse {{ Request::is('sms*') ? 'show' : '' }}" aria-labelledby="headingForm"
        data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <a class="collapse-item " href="">{{ __('sidebar.result-sms') }}</a>
          <a class="collapse-item {{ Request::is('sms') ? 'active' : '' }}"
            href="{{ route('backend.sendsms.index') }}">{{ __('sidebar.bulk-sms') }}</a>
        </div>
      </div>
    </li>
  @endif
  @if (userHasPermission('communication-module'))
    <li class="nav-item">
      <a class="nav-link collapsed" active href="#" data-toggle="collapse" data-target="#communication-menu"
        aria-expanded="true" aria-controls="communication-menu">
        <i class="fab fa-fw fa-wpforms"></i>
        <span>{{ __('sidebar.communication') }}</span>
      </a>
      <div id="communication-menu" class="collapse " aria-labelledby="headingForm" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <a class="collapse-item " href="">{{ __('sidebar.notice-board') }}</a>
          <a class="collapse-item " href="">{{ __('sidebar.email') }}</a>
          <a class="collapse-item " href="">{{ __('sidebar.event') }}</a>
        </div>
      </div>
    </li>
  @endif
  @if (userHasPermission('library-module'))
    <li class="nav-item">
      <a class="nav-link collapsed" active href="#" data-toggle="collapse" data-target="#library-menu"
        aria-expanded="true" aria-controls="library-menu">
        <i class="fab fa-fw fa-wpforms"></i>
        <span>{{ __('sidebar.library') }}</span>
      </a>
      <div id="library-menu" class="collapse " aria-labelledby="headingForm" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <a class="collapse-item " href="">{{ __('sidebar.category') }}</a>
          <a class="collapse-item " href="">{{ __('sidebar.books') }}</a>
          <a class="collapse-item " href="">{{ __('sidebar.member') }}</a>
          <a class="collapse-item " href="">{{ __('issue/return') }}</a>
          <a class="collapse-item " href="">{{ __('sidebar.all-issues') }}</a>
        </div>
      </div>
    </li>
  @endif
  @if (auth()->user()->id == 1)
    <li class="nav-item">
      <a class="nav-link {{ Request::is('school*') ? '' : 'collapsed' }}" active href="#"
        data-toggle="collapse" data-target="#library-menu1" aria-expanded="true" aria-controls="library-menu1">
        <i class="fab fa-fw fa-wpforms"></i>
        <span>{{ __('General Setting') }}</span>
      </a>
      <div id="library-menu1" class="collapse {{ Request::is('school*') ? 'show' : '' }}"
        aria-labelledby="headingForm" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <a class="collapse-item {{ Request::is('school/principal/index') ? 'active' : '' }}"
            href="{{ route('school.principal.index') }}">Message</a>
          <a class="collapse-item {{ Request::is('school/history') ? 'active' : '' }} "
            href="{{ route('school.history') }}">History</a>
          <a class="collapse-item {{ Request::is('school/staff') ? 'active' : '' }}"
            href="{{ route('school.staff') }}">Faculty</a>
          <a class="collapse-item {{ Request::is('school/principal') ? 'active' : '' }}"
            href="{{ route('school.principal') }}">Principle Information</a>
          <a class="collapse-item {{ Request::is('school/gallery') ? 'active' : '' }}"
            href="{{ route('school.gallery') }}">School Gallery</a>
          <a class="collapse-item {{ Request::is('school/worker') ? 'active' : '' }}"
            href="{{ route('school.worker') }}">School Staff</a>
          <a class="collapse-item {{ Request::is('school/phone') ? 'active' : '' }}"
            href="{{ route('school.phone') }}">School Information</a>
          <a class="collapse-item {{ Request::is('school/logo') ? 'active' : '' }}"
            href="{{ route('school.log') }}">School Logo</a>
          <a class="collapse-item {{ Request::is('school/chairman/photo') ? 'active' : '' }}"
            href="{{ route('school.chairman.photo') }}">Chairman</a>
          <a class="collapse-item {{ Request::is('school/slider') ? 'active' : '' }}"
            href="{{ route('school.slider') }}">Sliders</a>
          <a class="collapse-item {{ Request::is('school/notice') ? 'active' : '' }}"
            href="{{ route('school.notice') }}">Notice</a>
        </div>
      </div>
    </li>
  @endif

  @if (auth()->user()->id == 1)
    <li class="nav-item">
      <a class="nav-link {{ Request::is('setting*') ? '' : 'collapsed' }}" active href="#"
        data-toggle="collapse" data-target="#setting-menu" aria-expanded="true" aria-controls="setting-menu">
        <i class="fab fa-fw fa-wpforms"></i>
        <span>{{ __('sidebar.setting') }}</span>
      </a>
      <div id="setting-menu" class="collapse {{ Request::is('setting*') ? 'show' : '' }}"
        aria-labelledby="headingForm" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <a class="collapse-item {{ Request::is('setting/role/create') ? 'active' : '' }}"
            href="{{ route('backend.role.create') }}">{{ __('sidebar.role-permission') }}</a>
          <a class="collapse-item {{ Request::is('setting/brance') ? 'active' : '' }}"
            href="{{ route('backend.branch.index') }}">{{ __('sidebar.branch') }}</a>
          <a class="collapse-item "
            href="{{ route('backend.setting.index') }}">{{ __('sidebar.general-setting') }}</a>
          <a class="collapse-item {{ Request::is('setting/user_list') ? 'active' : '' }}"
            href="{{ route('backend.user_list.index') }}">{{ __('sidebar.user-list') }}</a>
          <a class="collapse-item " href="">{{ __('sidebar.payment-method') }}</a>
          <a class="collapse-item " href="">{{ __('sidebar.sms-api') }}</a>
          <a class="collapse-item " href="">{{ __('sidebar.backup') }}</a>
          <a class="collapse-item " href="">{{ __('sidebar.template-setting') }}</a>
        </div>
      </div>
    </li>
  @endif






</ul>
