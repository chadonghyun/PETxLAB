<?php
    include_once $_SERVER['DOCUMENT_ROOT'].'/PETxLAB/db/db_con.php';
    include_once $_SERVER['DOCUMENT_ROOT']."/PETxLAB/config.php";
    include $_SERVER['DOCUMENT_ROOT']."/PETxLAB/user/header.php";
?>

<link rel="stylesheet" href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/PETxLAB/user/css/course_list.css" type="text/css">

<main>
    <h2>
        전문교육과정
    </h2>
    <form action="" method="get">
        <div class="sub_title">
            <select name="cate" id="cate">
                <option value="1">반려동물 전문창업</option>
                <option value="2">반려동물 행동교정사</option>
                <option value="3">반려동물 식품관리사</option>
                <option value="4">펫 유치원 교원사</option>
                <option value="5">펫 뷰티션</option>
                <option value="6">반려동물장례코디네이터</option>
                <option value="7">반려동물관리사</option>
                <option value="8">동물병원코디네이터</option>
                <option value="9">펫시터</option>
            </select>
        </div>
        <div class="search_area d-flex">
            <p>총 5건</p>
            <div class="search_box">
                <input type="search" name="course_search" id="course_search" placeholder="검색어 입력">
                <i class="bi bi-search"></i>
            </div>
        </div>
    </form>
    <form action="" method="post">
        <ul class="course_list">
            <li class="card d-flex justify-content-between">
                <div class="course_thumb">
                    <img src="" alt="">
                </div>
                <div class="course_desc d-flex">
                    <span class="course_cate" style="text-decoration:none;">
                        전문교육과정
                    </span>
                    <h3 class="course_title text-truncate">펫 베이커리 특화과정</h3>
                    <div class="progress_area">
                        <div class="progress_bar"></div>
                    </div>
                    <p class="progress_txt">
                        진도율: 20%
                    </p>
                    <a href="#" class="detail_btn" title="강의 바로가기">바로가기</a>
                </div>
            </li>

            <li class="card d-flex justify-content-between">
                <div class="course_thumb">
                    <img src="" alt="">
                </div>
                <div class="course_desc d-flex">
                    <span class="course_cate" style="text-decoration:none;">
                        전문교육과정
                    </span>
                    <h3 class="course_title text-truncate">펫 베이커리 특화과정</h3>
                    <div class="progress_area">
                        <div class="progress_bar"></div>
                    </div>
                    <p class="progress_txt">
                        진도율: 20%
                    </p>
                    <a href="#" class="detail_btn" title="강의 바로가기">바로가기</a>
                </div>
            </li>
        </ul>
    </form>
</main>

<?php
    include $_SERVER['DOCUMENT_ROOT']."/PETxLAB/user/footer.php";
?>