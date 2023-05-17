<?php
include_once $_SERVER['DOCUMENT_ROOT']."/PETxLAB/db/db_con.php";
include_once $_SERVER['DOCUMENT_ROOT']."/PETxLAB/config.php";
include $_SERVER['DOCUMENT_ROOT']."/PETxLAB/user/header.php";
?>
  <!-- index.css -->
  <link rel="stylesheet" href="./css/index.css" type="text/css">
  <!-- 스와이퍼js -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css"/>
  <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js" defer></script>
  <!-- 스크립트 연결 -->
  <script src="https://code.jquery.com/jquery-latest.min.js" defer></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js" defer></script>
  <script src="./js/index.js" defer></script>

  <main>
    <section id="mbanner">
      <div class="img_box"></div>
      <ul id="slide">
        <li><img src="./images/mbanner1.png" alt="banner1"></li>
        <li><img src="./images/mbanner2.png" alt="banner2"></li>
        <li><img src="./images/mbanner3.png" alt="banner3"></li>
        <li><img src="./images/mbanner4.png" alt="banner4"></li>
      </ul>
    </section>

    <section id="slogan">
      <h2>
        <img src="./images/logo1.png" alt="logo">
      </h2>
      <div class="txt_box">
        <p>Let me do it For <br><span>YOU</span></p>
        <p>반려동물을 위한 교육 패러다임을 구축하여<br>함께하는 공동체를 만들어갑니다.</p>
      </div>
    </section>

    <section id="intro">
      <div class="lecture_box">
        <h2>강의소개</h2>
        <div class="tabmenu">
          <div class="on">
            <p class="on2">인기강의</p>
          </div>
          <div>
            <p>신규강의</p>
          </div>
        </div>
        <div class="slide_wrap">
          <div class="first_slide slide_box">
            <div class="swiper">
              <div class="swiper-wrapper">
                <div class="swiper-slide">
                  <a href="#" title="recommand1" onclick="alert('해당페이지는 준비중에 있습니다.');" >
                    <div class="img_box">
                      <img src="./images/class1.png" alt="class1">
                    </div>
                    <p>반려동물행동교정사</p>
                    <p>반려인구 1,500만 시대의 만능 해결사<br>반려가구의 행복을 돕는 반려계 멀티 플레이어</p>
                  </a>
                </div>
                <div class="swiper-slide">
                  <a href="#" title="recommand1" onclick="alert('해당페이지는 준비중에 있습니다.');" >
                    <div class="img_box">
                      <img src="./images/class2.png" alt="class1">
                    </div>
                    <p>건조간식 특화과정</p>
                    <p>씹는 것을 좋아하는 강아지를 위한<br> 건조간식을 전문적으로 배우는 교육과정</p>
                  </a>  
                </div>
                <div class="swiper-slide">
                  <a href="#" title="recommand1" onclick="alert('해당페이지는 준비중에 있습니다.');" >
                    <div class="img_box">
                      <img src="./images/class3.png" alt="class1">
                    </div>
                    <p>펫 미용</p>
                    <p>셀프미용의 달인,고수익 애견미용사<br>활용도 200% 자격증</p>
                  </a>
                </div>
              </div>
              <div class="swiper-pagination fraction"></div>
              <div class="swiper-button-prev button"></div>
              <div class="swiper-button-next button"></div>
            </div>
          </div>
          <div class="second_slide slide_box">
            <div class="swiper">
              <div class="swiper-wrapper">
                <div class="swiper-slide">
                  <a href="#" title="recommand1" onclick="alert('해당페이지는 준비중에 있습니다.');" >
                    <div class="img_box">
                      <img src="./images/class4.png" alt="class1">
                    </div>
                    <p>나의 도마뱀을 알라</p>
                    <p>애완 도마뱀의 A to Z 까지 파헤쳐보자</p>
                  </a>
                </div>

                <div class="swiper-slide">
                  <a href="#" title="recommand1" onclick="alert('해당페이지는 준비중에 있습니다.');" >
                    <div class="img_box">
                      <img src="./images/class5.png" alt="class1">
                    </div>
                    <p>동물병원 코디네이터</p>
                    <p>미용부터 수의테크니션 교육까지<br> 풀패키지 커리큘럼</p>
                  </a>
                </div>

                <div class="swiper-slide">
                  <a href="#" title="recommand1" onclick="alert('해당페이지는 준비중에 있습니다.');" >
                    <div class="img_box">
                      <img src="./images/class6.png" alt="class1">
                    </div>
                    <p>반려동물장례코디네이터</p>
                    <p>사명감 있는 특별한 직업<br>2023 유망직업 선정!</p>
                  </a>
                </div>
              </div>
              <div class="swiper-button-prev button"></div>
              <div class="swiper-button-next button"></div>
              <div class="swiper-pagination fraction"></div>
            </div>
          </div>
          <h2 class="teacher_intro">강의진 소개</h2>
          <div class="third_slide">
            <div class="swiper">
              <div class="swiper-wrapper">
                <div class="swiper-slide">
                  <div class="img_box">
                    <img src="./images/teacher1.png" alt="teacher1">
                  </div>
                  <h3>제임스킴 강사님</h3>
                  <ul>
                    <li>서울대학교 수의과대학 수의과 박사</li>
                    <li>前 삼성 에버랜드 동물원 수의사</li>
                    <li>前 삼성화재 안내견학교장</li>
                  </ul>
                </div>
                <div class="swiper-slide">
                  <div class="img_box">
                    <img src="./images/teacher2.png" alt="teacher1">
                  </div>
                  <h3>Mr.Cha 강사님</h3>
                  <ul>
                    <li>서울대학교 수의과대학 수의과 박사</li>
                    <li>前 삼성 에버랜드 동물원 수의사</li>
                    <li>前 삼성화재 안내견학교장</li>
                  </ul>
                </div>
                <div class="swiper-slide">
                  <div class="img_box">
                    <img src="./images/teacher3.png" alt="teacher1">
                  </div>
                  <h3>김견 강사님</h3>
                  <ul>
                    <li>서울대학교 수의과대학 수의과 박사</li>
                    <li>'강아지는 왜 멍하고 짖을까?'저자</li>
                    <li>前 애버랜드 판다랜드 팀장</li>
                  </ul>
                </div>
              </div>
              <div class="swiper-button-prev button"></div>
              <div class="swiper-button-next button"></div>
              <div class="swiper-pagination fraction"></div>
            </div>
          </div>          
        </div>
        </div>
      </div>

    </section>

    <section id="job">
      <h2>취업정보포털</h2>
      <dl>
        <dt><a href="#" title="title" onclick="alert('채용정보 페이지는 준비중에 있습니다.');">마감 2023.08.31</a></dt>
        <dd>[서울] (서울 성동구)<br>
          펌킨펫하우스 / 훈련사 채용</dd>
        <dt><a href="#" title="title" onclick="alert('채용정보 페이지는 준비중에 있습니다.');">마감 2023.08.31</a></dt>
        <dd>[충북] (충북 청주시)<br>
          바우보우 / 훈련견습생 채용</dd>
        <dt><a href="#" title="title" onclick="alert('채용정보 페이지는 준비중에 있습니다.');" >마감 2023.08.31</a></dt>
        <dd>[경기] (경기 고양시)<br>
          일산클래식동물병원 / 수의테크니션 채용</dd>
        <dt><a href="#" title="title" onclick="alert('채용정보 페이지는 준비중에 있습니다.');">마감 2023.08.31</a></dt>
        <dd>[서울] (서울 강남구)<br>
          임재성동물의료센터 / 수의테크니션 채용</dd>
        <dt><a href="#" title="title" onclick="alert('채용정보 페이지는 준비중에 있습니다.');">마감 2023.08.31</a></dt>
        <dd>[경기] (경기 성남시)
          백현동물병원 / 수의테크니션 채용</dd>
      </dl>
    </section>

    <section id="recommand">
      <h2>추천강의</h2>
        <div class="first_slide slide_box">
          <div class="swiper">
            <div class="swiper-wrapper">
              <div class="swiper-slide">
                <a href="#" title="recommand1" onclick="alert('해당페이지는 준비중에 있습니다.');" >
                  <div class="img_box">
                    <img src="./images/class7.png" alt="class1">
                  </div>
                  <p>펫뷰티션</p>
                  <p>반려동물 위생&미용관리의 모든것<br>펫뷰티전문가 도전해보세요</p>
                </a>
              </div>
              <div class="swiper-slide">
                <a href="#" title="recommand1" onclick="alert('해당페이지는 준비중에 있습니다.');" >
                  <div class="img_box">
                    <img src="./images/class8.png" alt="class1">
                  </div>
                  <p>펫유치원교원사</p>
                  <p>잘나가는 '개치원'의 창업준비<br>창업시장,정보,필요한 정보가 다 있다!</p>
                </a>
              </div>
              <div class="swiper-slide">
                <a href="#" title="recommand1" onclick="alert('해당페이지는 준비중에 있습니다.');" >
                  <div class="img_box">
                    <img src="./images/class9.png" alt="class1">
                  </div>
                  <p>펫 아이템</p>
                  <p>나의 펫을 위한 아이템 만들기<br>의류,악세서리 만드는 법 배우기</p>
                </a>
              </div>
              <div class="swiper-slide">
                <a href="#" title="recommand1" onclick="alert('해당페이지는 준비중에 있습니다.');" >
                  <div class="img_box">
                    <img src="./images/class10.png" alt="class1">
                  </div>
                  <p>반려동물행동교정사</p>
                  <p>나의 펫의 마음알기, 행동 교정하기<br>제 2의 강형욱이 되어보세요</p>
                </a>
              </div>
            </div>
            <div class="swiper-button-prev button"></div>
            <div class="swiper-button-next button"></div>
            <div class="swiper-pagination fraction"></div>
          </div>
        </div>
    </section>
    
    <section id="network">
      <div class="background">
        <div class="bg">
          <h2>수강생네트워크</h2>
        </div>
        <div class="talk">
          <img src="./images/talking.png" alt="talking" class="cloud">
          <ul class="talking_box">
            <li><a href="#" title="ment1" onclick="alert('웃는게 예쁜 조은님 고생하셨습니다.');">양꼬치엔 칭따오! 참 좋아요 <br><span>-조은일만가득-</span></a></li>
            <li><a href="#" title="ment1" onclick="alert('주무시는게 아름다운 종현님 고생하셨습니다.');">유익한 강의네요,<br>또 듣고 싶어요 <br><span>-잠자는종현-</span></a></li>
            <li><a href="#" title="ment1" onclick="alert('눈빛카리스마 챠님 고생하셨습니다.');">수업 강추합니다!<br>많이 배웠어요 <br><span>-동현챠-</span></a></li>
            <li><a href="#" title="ment1" onclick="alert('모두들 고생하셨습니다. 꼭 취뽀 성공해요~(윙크윙크하트하트쪽쭈욱쪽~)');">모두들<br> 고생하셨습니다.<br><span>-펭귄킴-</span></a></li>
          </ul>
        </div>
      </div>

      <div class="animal">
        <div class="circle">
          <div class="imgbox">
            <img src="./images/circle.png" alt="circle" class="img">
          </div>
        </div>
      </div>
    </section>
    
    <section id="faq">
      <h2>FAQ</h2>
      <dl>
        <dt>
            <p>Q.</p>
            <p>회원정보 수정하는 법</p>
        </dt>
        <dd>
            <p>A.</p>
            <p>로그인 후 '마이페이지>내정보수정'로 들어가시면 확인이 가능합니다.</p>
        </dd>
        <dt>
            <p>Q.</p>
            <p>자주하는 질문2</p>
        </dt>
        <dd>
            <p>A.</p>
            <p>반려동물을 위한 교육 패러다임을 구축하여 함께하는 공동체를 만들어갑니다.</p>
        </dd>
        <dt>
            <p>Q.</p>
            <p>회원정보 수정하는 법</p>
        </dt>
        <dd>
            <p>A.</p>
            <p>로그인 후 '마이페이지>내정보수정'에서 가능합니다.</p>
        </dd>
      </dl>
    </section>
  </main>
<?php 
include $_SERVER['DOCUMENT_ROOT']."/PETxLAB/user/footer.php";
?>