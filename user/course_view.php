<?php
    include_once $_SERVER['DOCUMENT_ROOT'].'/PETxLAB/db/db_con.php';
    include_once $_SERVER['DOCUMENT_ROOT']."/PETxLAB/config.php";
    include $_SERVER['DOCUMENT_ROOT']."/PETxLAB/user/header.php";
?>

<link rel="stylesheet" href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/PETxLAB/user/css/course_view.css" type="text/css">

<main>
    <form action="" method="post">
        <ul class="course_list">
            <li class="card">
                <div class="course_thumb ratio ratio-4x3">
                    <img src="" alt="">
                </div>
                <div class="course_desc d-flex">
                    <span class="course_cate" style="text-decoration:none;">
                        전문교육과정
                    </span>
                    <h3 class="course_title text-truncate">펫 베이커리 특화과정</h3>

                    <span class="duration">
                        2023-00-00 ~ 2023-00-00
                    </span>

                    <span class="date">30일</span>

                    <p class="desc_txt">
                    강의 내용을 간단하게 한 두줄 정도 나타날 수 있도록 간략하게 설명글을 작성합니다.
                    </p>

                    <div class="progress_area">
                        <div class="progress_bar"></div>
                    </div>
                    <p class="progress_txt">
                        진도율: 20%
                    </p>
                </div>
            </li>
            <li class="card">
                <div class="card_title d-flex">
                    <h4>강의목록</h4>
                    <span>총 5건</span>
                </div>
                <ul>
                    <li class="card inner_card">
                        <a href="" class="d-flex justify-content-between" title="">
                            <div class="video_desc">
                                <h5 class="video_title">
                                    강의 1번 영상 주제
                                </h5>
                                <p class="video_duration">
                                    강의 길이: 30분
                                    <span class="state state_complete">완료</span>
                                </p>
                            </div>
                            <i class="bi bi-play-circle"></i>
                        </a>
                    </li>
                    <li class="card inner_card">
                        <a href="" class="d-flex justify-content-between" title="">
                            <div class="video_desc">
                                <h5 class="video_title">
                                    강의 2번 영상 주제
                                </h5>
                                <p class="video_duration">
                                    강의 길이: 30분
                                    <span class="state">미수강</span>
                                </p>
                            </div>
                            <i class="bi bi-play-circle"></i>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="card">
                <div class="card_title d-flex">
                    <h4>자료목록</h4>
                    <span>총 2건</span>
                </div>
                <ul>
                    <li class="card inner_card d-flex">
                        <a href="" class="d-flex justify-content-between" title="">
                            <div class="file_desc">
                                <h5 class="file_title">
                                    강의 자료 1번
                                </h5>
                                <p class="file_size">
                                    용량: 2.4mb
                                </p>
                            </div>
                            <i class="bi bi-arrow-down-circle"></i>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </form>
</main>

<?php
    include $_SERVER['DOCUMENT_ROOT']."/PETxLAB/user/footer.php";
?>