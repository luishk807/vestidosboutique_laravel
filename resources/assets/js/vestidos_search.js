function openModalSearch(){
    $("html,body").css("overflow","hidden");
    $("#vestidos-search-main-pnl").fadeIn();
}
function closeModalSearch(){
    $("#vestidos-search-main-pnl").fadeOut();
    searchlist = [];
    $("#vestidos-search-results-pnl").hide();
    $("#search-input-text").val("");
    $("html,body").css("overflow","auto");
    $("#vestidos-search-result-not-found").hide();
}
//end
function searchBarProductName(event){
    event.stopPropagation();
    if(event.keyCode == 40 || event.keyCode == 38 || event.keyCode == 37 || event.keyCode == 39){
        return;
    }
    $("#vestidos-search-results-pnl").hide();
    $(".vestidos-search-loader").show();
    $("#vestidos-search-result-not-found").hide();
    if(event.target.value.length > 3){
        $.ajax({
            type: "GET",
            url: "/api/searchCompProductList",
            data: {
                data:event.target.value
            },
            success: function(data) {
                data = data.data;
                if(data && data.length>0){
                    searchlist = [];
                    $(".vestidos-search-loader").hide();
                    $("#vestidos-search-results-pnl").show();
                    var listul=$("#vestidos-search-results-pnl ul");
                    listul.empty();
                    $.each(data, function(index,element){
                        var purl = "/product/"+element.id;
                        listul.append('<li><a href="'+purl+'">'+element.products_name+' '+' '+element.product_model+' '+element.brand_name+'</a></li>');
                    });
                    setTimeout(function(){
                        var test = $("#vestidos-search-results-pnl ul li").children();
                        $.each(test,function(elem,data){
                            searchlist.push(data);
                        })
                    },50)
                }else{
                    $(".vestidos-search-loader").hide();
                    $("#vestidos-search-results-pnl").hide();
                    $("#vestidos-search-result-not-found span").text(event.target.value);
                    $("#vestidos-search-result-not-found").show();
                }
            }
        });
    }
}
function inputSearchKeyDown(event){
    event.stopPropagation();
    if(event.keyCode==9){
        setTimeout(function(){
            if(searchlist[0]){
                searchlist[0].focus();
            }
        },100)
    }else if(event.keyCode==13){
        var sstring = $(event.target).val();
        var sort_opt = "low";
        location.href="/shop/search/product/"+sstring+"/"+sort_opt;
    }
}
$(document).ready(function(){
    $("#shopPage_select").change(function(evt){
        var sort_opt = $(evt.target).val();
        var evtid = $("#evtid").val();
        var sstring = $("#sstring").val();
        var evtype = $("#evtype").val();
        location.href=sstring ? "/shop/search/product/"+sstring+"/"+sort_opt : "/shop/"+evtype+"/"+evtid+"/"+sort_opt;
    });
})
function searchOnKeyDown(event){
    event.preventDefault();
    event.stopPropagation();
    var current = searchlist.indexOf(event.target) !== -1 ? searchlist.indexOf(event.target) : null;
    var setFocus = false;
    var newIndex = null;
    if(event.keyCode==40){
        if(searchlist[current+1] && current <= searchlist.length){
            setFocus = true;
            newIndex = current+1;
        }
    }else if(event.keyCode==38){
        if(searchlist[current-1]){
            setFocus = true;
            newIndex = current-1;
        }
    }else if(event.keyCode==13){
        if(searchlist[current]){
            searchlist[current].click();
        }
    }else if(event.keyCode==27){
        $("#vestidos-search-results-pnl").hide();
        $("#vestidos-search-result-not-found").hide();
        setTimeout(function(){
            $("#search-input-text").focus();
            $("#search-input-text").val("");
        })

    }
    if(setFocus && searchlist[newIndex]){
        setTimeout(function(){
            searchlist[newIndex].focus();
        })
    }
}
var searchlist = [];