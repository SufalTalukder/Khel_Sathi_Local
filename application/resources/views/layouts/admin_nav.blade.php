<nav class="navbar navbar-expand-lg mainmenu">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon icons icon-menu"></span></button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link altactive" href="" title="Main Dashboard">
                        <span class="fas fa-th-large"></span>
                    </a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="{{ route('ad') }}">
                        <span class="icons icon-speedometer"></span> Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="module-list.html">
                        <span class="icons icon-layers"></span> Module List
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="icons icon-organization"></span> Master
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li>
                            <a class="dropdown-item" href="AddCourse.html">Add Course</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="CourseWiseGroup.html">Course wise Group & Sub-group Master</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="AddSubject.html">Add Subject</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="InputCourseDetails.html">Input Course Details</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="CourseWiseCriteria.html">Course wise Criteria</a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="icons icon-graph"></span> Transactions
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li>
                            <a class="dropdown-item" href="DateManagementForTheCourse.html">Date Adjustment for the Student</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="AddCourseWiseEligibility.html">Add Course wise Eligibility</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="DateAdjustmentForRegistration.html">Date Adjustment for Registration</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="DateAdjustmentForCourseFee.html">Date Adjustment for Course Fee Submission</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="ClosingOfSubmissionOfFee.html">Closing of submission of Fee course wise</a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="icons icon-docs"></span> Report
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li>
                            <a class="dropdown-item" href="PrintDataMasterSection.html">Print Data as per the Master Section</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="CourseWiseRegistered.html">Course-wise Registered Student</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="CourseWiseAdmitted.html">Course-wise Admitted Student</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="StudentBoardCount.html">Student Board's count Report</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="QueryBuilder.html">Query Builder Report</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li>
                    <a class="searchbtn nav-link" href="#">
                        <span class="icons icon-magnifier"></span>
                    </a>
                    <ul class="searchbox">
                        <li>
                            <div class="title">
                                Type something to start searching <a class="searchbtn" href="#">
                                    <i class="fas fa-times"></i>
                                </a>
                            </div>
                            <form class="card">
                                <div class="card-body row no-gutters align-items-center">
                                    <div class="col-auto">
                                        <i class="fas fa-search h4 text-body"></i>
                                    </div>
                                    <!--end of col-->
                                    <div class="col">
                                        <input class="form-control form-control-lg form-control-borderless" type="search" placeholder="Search topics or keywords" />
                                    </div>
                                    <!--end of col-->
                                    <div class="col-auto">
                                        <button class="btn btn-lg btn-primary" type="submit">Search</button>
                                    </div>
                                    <!--end of col-->
                                </div>
                            </form>
                            <div class="searchbody">
                                <ul class="searchlist">
                                    <li>
                                        <a href="#">
                                            <b>Privacy on Software</b> 
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <b>Privacy on Software</b> 
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <b>Privacy on Software</b> 
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
