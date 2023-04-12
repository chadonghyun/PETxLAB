<?php
include $_SERVER['DOCUMENT_ROOT']."/PETxLAB/adm/header.php";
?>

<!-- 메인영역 -->
<main>
  <!-- adm_m_list.css -->
  <link rel="stylesheet" type="text/css" href="./css/adm_m_list.css">
    <article id="main_h">
      <ul id="tab_mnu">
        <li>회원관리</li>
        <li>강사관리</li>
        <li>수강생관리</li>
      </ul>

      <div id="search_wrap">
        <select id="search_box">
          <option value="제목 + 내용">제목 + 내용</option>
          <option value="아이디">아이디</option>
          <option value="이름">이름</option>
        </select>

        <input type="search" placeholder="여기에 입력하세요." id="text_box">
        <i class="bi bi-search"></i>
      </div>
    </article>

    <article id="main_b">
      <table id="c_list">
        <thead>
          <tr>
            <th>No</th><th>회원번호</th><th>분류</th><th>이름(아이디)</th><th>휴대전화</th><th>이메일</th><th>수강</th><th>접속일</th><th>가입일</th><th>메일발송</th><th><input type="checkbox"></th>
          </tr>
        </thead>

        <tbody>
          <tr>
            <td>1</td>
            <td>00001</td>
            <td>강사</td>
            <td>이름임1(아이디임1)</td>
            <td>010-1234-5678</td>
            <td>email@email.com</td>
            <td>2</td>
            <td>20</td>
            <td>2000.01.02</td>
            <td><i class="bi bi-envelope"></i></td>
            <td><input type="checkbox"></td>
          </tr>

          <tr>
            <td>2</td>
            <td>00001</td>
            <td>강사</td>
            <td>이름임1(아이디임1)</td>
            <td>010-1234-5678</td>
            <td>email@email.com</td>
            <td>2</td>
            <td>20</td>
            <td>2000.01.02</td>
            <td><i class="bi bi-envelope"></i></td>
            <td><input type="checkbox"></td>
          </tr>

          <tr>
            <td>3</td>
            <td>00001</td>
            <td>강사</td>
            <td>이름임1(아이디임1)</td>
            <td>010-1234-5678</td>
            <td>email@email.com</td>
            <td>2</td>
            <td>20</td>
            <td>2000.01.02</td>
            <td><i class="bi bi-envelope"></i></td>
            <td><input type="checkbox"></td>
          </tr>

          <tr>
            <td>4</td>
            <td>00001</td>
            <td>강사</td>
            <td>이름임1(아이디임1)</td>
            <td>010-1234-5678</td>
            <td>email@email.com</td>
            <td>2</td>
            <td>20</td>
            <td>2000.01.02</td>
            <td><i class="bi bi-envelope"></i></td>
            <td><input type="checkbox"></td>
          </tr>

          <tr>
            <td>5</td>
            <td>00001</td>
            <td>강사</td>
            <td>이름임1(아이디임1)</td>
            <td>010-1234-5678</td>
            <td>email@email.com</td>
            <td>2</td>
            <td>20</td>
            <td>2000.01.02</td>
            <td><i class="bi bi-envelope"></i></td>
            <td><input type="checkbox"></td>
          </tr>

          <tr>
            <td>6</td>
            <td>00001</td>
            <td>강사</td>
            <td>이름임1(아이디임1)</td>
            <td>010-1234-5678</td>
            <td>email@email.com</td>
            <td>2</td>
            <td>20</td>
            <td>2000.01.02</td>
            <td><i class="bi bi-envelope"></i></td>
            <td><input type="checkbox"></td>
          </tr>

          <tr>
            <td>7</td>
            <td>00001</td>
            <td>강사</td>
            <td>이름임1(아이디임1)</td>
            <td>010-1234-5678</td>
            <td>email@email.com</td>
            <td>2</td>
            <td>20</td>
            <td>2000.01.02</td>
            <td><i class="bi bi-envelope"></i></td>
            <td><input type="checkbox"></td>
          </tr>

          <tr>
            <td>8</td>
            <td>00001</td>
            <td>강사</td>
            <td>이름임1(아이디임1)</td>
            <td>010-1234-5678</td>
            <td>email@email.com</td>
            <td>2</td>
            <td>20</td>
            <td>2000.01.02</td>
            <td><i class="bi bi-envelope"></i></td>
            <td><input type="checkbox"></td>
          </tr>
          
          <tr>
            <td>9</td>
            <td>00001</td>
            <td>강사</td>
            <td>이름임1(아이디임1)</td>
            <td>010-1234-5678</td>
            <td>email@email.com</td>
            <td>2</td>
            <td>20</td>
            <td>2000.01.02</td>
            <td><i class="bi bi-envelope"></i></td>
            <td><input type="checkbox"></td>
          </tr>

          <tr>
            <td>10</td>
            <td>00001</td>
            <td>강사</td>
            <td>이름임1(아이디임1)</td>
            <td>010-1234-5678</td>
            <td>email@email.com</td>
            <td>2</td>
            <td>20</td>
            <td>2000.01.02</td>
            <td><i class="bi bi-envelope"></i></td>
            <td><input type="checkbox"></td>
          </tr>
        </tbody>
      </table>
      <ul id="page_nv">
        <li>&#x003C;</li>
        <li>1</li>
        <li>2</li>
        <li>3</li>
        <li>4</li>
        <li>5</li>
        <li>&#x003E;</li>
      </ul>

      <button><i class="bi bi-envelope"></i> 전체발송</button>
      <button><i class="bi bi-envelope"></i> 선택발송</button>
    </article>
  </main>
</body>
</html>