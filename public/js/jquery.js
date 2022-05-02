//spotとuserの削除前の確認ポップアップ
$(".delete").on('click', function() {
    if(confirm('本当に削除しますか？')) {
        return true;
    } else {
        return false;
    }
});

$(function() {
    $('#city').on('click', function() {
        var pref = $('#prefecture option:selected').val();

        $.ajax({
            type: "GET",
            url: "./autocomplete",
            data: {"pref":pref},
        })
        .done(function(data) {
            // 入力補完を実施する要素に単語リストを設定
            $( "#city" ).autocomplete({
                source: $.each(data,function(key,obj){
                    obj;
                }),
            });
        });
    });
});

//spotの市区町村入力時の入力補完
$(function() {
    $('#prefecture').on('change', function() {
        var pref = $(this).val();

        $.ajax({
            type: "GET",
            url: "./autocomplete",
            data: {"pref":pref},
        })
        .done(function(data) {
            // 入力補完を実施する要素に単語リストを設定
            $( "#city" ).autocomplete({
                source: $.each(data,function(key,obj){
                    obj;
                }),
            });
        });
    });
});

$(function() {
    $('.details-button').on('click', function() {
        if($('.details').hasClass('open')) {
            $('#city-list').empty();
            $('.details').removeClass('open');
            $('.details-button').removeClass('after');
        } else {
            $('.details').addClass('open');
            $('.details-button').addClass('after');
            var area = $('#area option:selected').val();

            $.ajax({
                type: "GET",
                url: "/citysearch",
                data: {"area":area},
            })
            .done(function(data) {
                $.each(data,function(key,obj) {
                    const position = document.getElementById('city-list');
                    const citySet = document.createElement('div');
                    const p = document.createElement('p');
                    let input = document.createElement('input');
                    let label = document.createElement('label');
                    citySet.setAttribute('class', 'city-set');
                    input.setAttribute('type', 'radio');
                    input.setAttribute('name', 'municipality');
                    input.setAttribute('value', obj.cityCode);
                    input.setAttribute('id', 'municipality');
                    label.setAttribute('for', 'municipality');
                    label.setAttribute('class', 'city-name');
                    label.appendChild(document.createTextNode(obj.cityName));
                    citySet.appendChild(input);
                    citySet.appendChild(label);
                    position.appendChild(citySet);
                });
            });
        }
    });
});

$(function() {
    $('#area').on('change', function() {
        var area = $(this).val();
        $('#city-list').empty();

        $.ajax({
            type: "GET",
            url: "/citysearch",
            data: {"area":area},
        })
        .done(function(data) {
            $.each(data,function(key,obj) {
                const position = document.getElementById('city-list');
                const citySet = document.createElement('div');
                const p = document.createElement('p');
                let input = document.createElement('input');
                let label = document.createElement('label');
                citySet.setAttribute('class', 'city-set');
                input.setAttribute('type', 'radio');
                input.setAttribute('name', 'municipality');
                input.setAttribute('value', obj.cityCode);
                input.setAttribute('id', 'municipality');
                label.setAttribute('for', 'municipality');
                label.appendChild(document.createTextNode(obj.cityName));
                citySet.appendChild(input);
                citySet.appendChild(label);
                position.appendChild(citySet);
            });
        });
    });
});