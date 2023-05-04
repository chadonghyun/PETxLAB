<?php
  include_once $_SERVER['DOCUMENT_ROOT'].'/PETxLAB/db/db_con.php';
  include_once $_SERVER['DOCUMENT_ROOT']."/PETxLAB/config.php";
  include $_SERVER['DOCUMENT_ROOT']."/PETxLAB/user/header.php";
?>

<div class="wrap">
  <section id="myinfo">
    <div class="pf_desc">
      <div class="pf_img">
        <img src="<?php $_SERVER['DOCUMENT_ROOT']?>/PETxLAB/user/images/logo.png" alt="프로필">
      </div>
      <div class="pf_sub">
        <a href="#none" title="">정보수정</a>
        <p><?php?>아이디</p>
        <p><?php?>이름</p>
        <span><?php?>일 출석</span>
      </div>
    </div>
    <div class="pf_class">
      <div class="pf_l ">
        <a href="" title="" class="pf_case">
          <p class="case">건</p>
          <span>학습중</span>
        </a>
      </div>
      <div class="pf_c">
        <a href="" title="" class="pf_case">
          <p class="case">건</p>
          <span>학습종료</span>
        </a>
      </div>
      <div class="pf_r">
        <a href="" title="" class="pf_case">
          <p class="case">건</p>
          <span>신청내역</span>
        </a>
      </div>
    </div>
  </section>
  <section id="mycourse">
    <div class="cr_top top">
      <h2>학습중인 강의</h2>
      <a href="#none" title="">전체보기</a>
    </div>
    <div class="cr_con">
      <div class="cr_img">
        <img src="" alt="">
      </div>
      <div class="cr_sub">
        <span><?php?>전문교육과정</span>
        <h3><?php?>펫 베이커리 특화과정</h3>
        <div class="cr_gauge">
          <div class="cr_gauge_bar"></div>
        </div>
        <div class="cr_rate">
          <span>진도율: 20%<?php?></span>
          <a href="" title="">바로가기</a>
        </div>
      </div>
    </div>
  </section>


  <section id="myweek">
    <div class="wk_top top">
      <h2>주간학습</h2>
      <span>*강의 1건 이상 학습시 체크됩니다.</span>
    </div>
    <div class="calender">
      <div class="ymw">
        <span>23년 5월 3주차</span>
      </div>
      <div class="days">
        <div class="day">
          <span>월</span>
          <div class="my_checked">
            <img src="<?php $_SERVER['DOCUMENT_ROOT']?>/PETxLAB/user/images/stamp.png" alt="">
          </div>
        </div>
        <div class="day">
          <span>화</span>
          <div class="my_checked">
            <img src="<?php $_SERVER['DOCUMENT_ROOT']?>/PETxLAB/user/images/stamp.png" alt="">
          </div>
        </div>
        <div class="day">
          <span>수</span>
          <div class="my_checked">
            <img src="<?php $_SERVER['DOCUMENT_ROOT']?>/PETxLAB/user/images/stamp.png" alt="">
          </div>
        </div>
        <div class="day">
          <span>목</span>
          <div class="my_checked">
          </div>
        </div>
        <div class="day">
          <span>금</span>
          <div class="my_checked">
          </div>
        </div>
        <div class="day">
          <span>토</span>
          <div class="my_checked">
          </div>
        </div>
        <div class="day">
          <span>일</span>
          <div class="my_checked">
          </div>
        </div>
      </div>
    </div>
  </section>


  <section id="mycer">
    <div class="cer_top top">
      <h2>수료증</h2>
      <a href="" title="전체보기">전체보기</a>
    </div>
    <div class="cer_none">
      <div class="cer_img">
        <img src="<?php $_SERVER['DOCUMENT_ROOT']?>/PETxLAB/user/images/nocer.png" alt="">
      </div>
      <div class="cer_sub">
        <p>보유중인 수료증이 없어요</p>
        <p>수료발급 가능 강의를 완강해보세요!</p>
        <?php?><a href="#none" title="강의보러가기">강의보러가기</a>
      </div>
    </div>
    <!-- <div class="cer_com">
      <figure>
        <img src="<?php $_SERVER['DOCUMENT_ROOT']?>/PETxLAB/user/images/exbg.png" alt="">
        <figcaption><?php?>펫 베이커리 특화과정1</figcaption>
      </figure>
      <figure>
        <img src="<?php $_SERVER['DOCUMENT_ROOT']?>/PETxLAB/user/images/exbg.png" alt="">
        <figcaption><?php?>펫 베이커리 특화과정1</figcaption>
      </figure>
    </div> -->
  </section>


  <section id="myqna">
    <div class="qna_top top">
      <h2>QnA</h2>
      <?php?><a href="#none" title="">전체보기</a>
    </div>
    <ul class="qna_tab_list">
      <li class="active" data-tab="all">전체</li>
      <li data-tab="solved">해결</li>
      <li data-tab="unsolved">미해결</li>
    </ul>
    <div class="qna_tab">
      <ul class="tabs">
        <li class="tab" data-tab="all">
          <div class="content">
            <p>
              <?php?><span>펫 베이커리 특화과정1</span>
              <?php?><span class="sol">해결</span>
            </p>
            <p><?php?>질문질문질문질문질문질문</p>
            <span><?php?>2000.02.20</span>
          </div>
          <div class="content">
            <p>
            <?php?><span>펫 베이커리 특화과정2</span>
            <?php?><span class="unsol">미해결</span>
            </p>
            <p><?php?>질문질문질문질문질문질문</p>
            <span><?php?>2000.02.20</span>
          </div>
        </li>
        <li class="tab" data-tab="unsolved">
          <div class="content">
          <p>
            <?php?><span>펫 베이커리 특화과정2</span>
            <?php?><span class="sol">해결</span>
          </p>
            <p><?php?>질문질문질문질문질문질문</p>
            <span><?php?>2000.02.20</span>
          </div>
        </li>
        <li class="tab" data-tab="solved">
          <div class="content">
          <p>
            <?php?><span>펫 베이커리 특화과정3</span>
            <?php?><span class="sol">해결</span>
          </p>
            <p><?php?>질문질문질문질문질문질문</p>
            <span><?php?>2000.02.20</span>
          </div>
        </li>
      </ul>
    </div>



  </section>
</div>

<?php
include $_SERVER['DOCUMENT_ROOT']."/PETxLAB/user/footer.php";
?>

</body>
</html>