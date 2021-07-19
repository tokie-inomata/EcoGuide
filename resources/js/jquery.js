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
    var details_flg =   $('#details_flg').val();
    if(details_flg == 0) {
        var area = $('#area option:selected').val();

        $.ajax({
            type: "GET",
            url: "/citysearch",
            data: {"area":area},
        })
        .done(function(data) {
            $.each(data,function(key,obj) {
                $('#city-list').append('<td class="details"><input class="select-city" type="checkbox"  name="municipality[]" value="'+obj.cityCode+'"><span class="city-name">'+obj.cityName+'</span></td>');
            });
        });
    }
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
                $('#city-list').append('<td class="details"><input class="select-city" type="checkbox"  name="municipality[]" value="'+obj.cityCode+'"><span class="city-name">'+obj.cityName+'</span></td>');
            });
        });
    });
});