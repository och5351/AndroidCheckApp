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
        location.href = '../student/attendance.php?class_name=' + data;
    };

    $('.attendance').on('click',function (e) {
        var indexNo = $('.attendance').index(this);
        var date = $('.date').eq(indexNo).text();
        var class_name = $('[name=title]').text();
        var division = $('[name=division]').text();

        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: '../professor/attendance.php',
            data: {class_name: class_name, division: division, date: date},
            success: function (data) {
                $('#main').hide();
                $('#qr').hide();
                $('#detail').hide();
                $('#attendance').show();
                $('#attendance').html(data);
            }
        });
    });

    $('.detail-view').on('click', function (e) {
        e.preventDefault();
        $('#main').hide();
        $('#qr').hide();
        $('#attendance').empty();
        $('#detail').show();
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
        var class_name = $('.class_name').eq(indexNo).text();
        var division = $('.division').eq(indexNo).text();

        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: '../professor/detail.php',
            data: {class_name: class_name, division: division},
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

        var class_name = $('[name=title]').text();
        var indexNo = $('.qr-btn').index(this);
        var date = $('.date').eq(indexNo).text();
        $('#countdown').empty();

        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: '../professor/qrcode.php',
            data: {class_name:class_name,date:date},
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
            success: function () {
                alert('성공적으로 변경되었습니다!');
                location.reload();
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