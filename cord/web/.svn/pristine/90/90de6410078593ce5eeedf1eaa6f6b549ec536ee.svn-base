$(document).ready(function() {

    $('#LoginForm').on('submit',function (e) {
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: '../login.php',
            data: $(this).serialize(),
            success: function (data) {
                alert('로그인에 성공했습니다.');
                if(data==='학생')
                    location.href = '/student';
                else
                    location.href = '/professor';
            },
            error: function (data) {
                if(data.statusText === 'Not Data'){
                    alert('정확한 로그인 정보를 입력하세요');
                    $('[name=user_id]').val('');
                    $('[name=passwd]').val('');
                    $('[name=user_id]').focus();
                }else {
                    alert('필수 항목을 입력하세요');
                    $('[name=user_id]').focus();
                }
            }
        });
    });

    $('#Logout').on('submit',function (e) {
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: '../login.php',
            data: {param:'logout'},
            success: function () {
                alert("로그아웃 되었습니다.");
                location.href = '/';
            }
        });
    });

    goPage = function(data)  {
        location.href = '../student/attendance.php?subject=' + data;
    };

    $('.attendance').on('click',function () {
        var indexNo = $('.attendance').index(this);
        var date = $('.date').eq(indexNo).text();
        var data = $('[name=title]').text();

        location.href = '../professor/attendance.php?subject=' + data + '&date=' + date;
    });

    $('[name=back]').on('click', function (e) {
        e.preventDefault();
        $('#main').show();
        $('#qr').hide();
        $('#detail').hide();
    });

    $('[name=list_back]').on('click', function (e) {
        e.preventDefault();
        $('#detail').show();
        $('#main').hide();
        $('#qr').hide();
        countdown( "countdown", 0, 1 );
    });

    // 상세보기 페이지
    $('.detail').on('click', function (e) {

        var indexNo = $('.detail').index(this);
        var data = $('.relative').eq(indexNo).text();

        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: '../professor/detail.php',
            data: {subject: data},
            success: function (data) {
                $('#main').hide();
                $('#qr').hide();
                $('#detail').show();
                $('#detail').html(data);
            }
        });
    });

    // QR코드 생성 페이지
    $('.qr-btn').on('click',function (e) {

        var subject = $('[name=title]').text();
        var indexNo = $('.qr-btn').index(this);
        var date = $('.date').eq(indexNo).text();

        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: '../professor/qrcode.php',
            data: {subject:subject,date:date},
            success: function (data) {
                var googleqr = "https://chart.googleapis.com/chart?cht=qr&chs=500";
                var text = data;
                var qrchl = googleqr+"&chl="+ encodeURIComponent(text);
                $('#qrcodeimg').attr('src', qrchl);
                $('#main').hide();
                $('#detail').hide();
                $('#qr').show();

                timer();
                countdown( "countdown", 1, 0 );
            }
        });
    });

    //출석 상태 변경
    $('#ChangeAttendance').on('submit',function (e) {
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: '../professor/changeattendance.php',
            data: $(this).serialize(),
            success: function (data) {
                alert('성공적으로 변경되었습니다!');
            },
            error: function (data) {
                if(data.statusText === 'Not Data'){
                    alert('출석 변경에 실패했습니다.');
                }
            }
        });
    });

    function timer() {
        setInterval(function() {
            $('#detail').show();
            $('#qr').hide();
        }, 60000);
    }

    /* Timer */
    function countdown( elementName, minutes, seconds )
    {
        var element, endTime, hours, mins, msLeft, time;

        function twoDigits( n )
        {
            return (n <= 9 ? "0" + n : n);
        }

        function updateTimer()
        {
            msLeft = endTime - (+new Date);
            if ( msLeft < 1000 ) {
                element.innerHTML = "countdown's over!";
            } else {
                time = new Date( msLeft );
                hours = time.getUTCHours();
                mins = time.getUTCMinutes();
                element.innerHTML = (hours ? hours + ':' + twoDigits( mins ) : mins) + ':' + twoDigits( time.getUTCSeconds() );
                setTimeout( updateTimer, time.getUTCMilliseconds() + 500 );
            }
        }

        element = document.getElementById( elementName );
        endTime = (+new Date) + 1000 * (60*minutes + seconds) + 500;
        updateTimer();
    }

});