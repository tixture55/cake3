function ajaxMethod() {
    $.ajax({
        url: "/cake3/ajax",
        type: "POST",
        data: { name : "tanaka" },
        dataType: "text",
        success : function(data, dataType){
            //通信成功時の処理
                        //alert(data);
                                },
                                        error: function(){
                                                    //通信失敗時の処理
                                                                alert('通信失敗');
                                                                        }
                                                                            });
                                                                            }
