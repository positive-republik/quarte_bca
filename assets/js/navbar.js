$(document).ready(function () {
    // Set Edit
    $('.qna-detail').on('click', function () {
        var id = $(this).data('id');
        showQna(id);
    });

    $('.reqDetail').on('click', function () {
        var id = $(this).data('id');
        showReq(id);
    })

    $('.upload_req').on('click', function () {
        var id = $(this).data('id');
        showUploadReq(id);
    })

    $('.qna_uploader').on('click', function () {
        var id = $(this).data('id');
        showUploadQna(id);
    })

    // Detail qna for guest
    function showQna(id) {
        $.get('http://localhost/project_/quarte_bca/guest/detailQna/'+id, function (data) {
            var qna = JSON.parse(data);
            $('#qnaModal input#produk').val(qna[0]['produk']);
            $('#qnaModal input#date').val(qna[0]['created_at']);
            $('#qnaModal textarea#quest').val(qna[0]['question']);
            $('#qnaModal input#dateanswer').val(qna[0]['update_at']);
            $('#qnaModal input#answer_name').val(qna[0]['answer_name']);
            $('#qnaModal textarea#answer').val(qna[0]['answer']);
            $('#qnaModal input#link').val(qna[0]['answer_link']);
            $('#qnaModal #link_btn').attr("href", qna[0]['answer_link']);
        });
    }
    
    // Detail request for guest
    function showReq(id) {
        $.get('http://localhost/project_/quarte_bca/guest/detailReq/' + id, function (data) {
            var req = JSON.parse(data);

            $('#reqModal input#req_title').val(req[0]['req_title']); //Judul Request
            $('#reqModal input#date').val(req[0]['created_at']); //Tanggal Request
            $('#reqModal input#startdate').val(req[0]['req_start']); //Awal Bulan
            $('#reqModal input#endate').val(req[0]['req_end']); //Akhir Bulan
            $('#reqModal input#answer_name').val(req[0]['answer_name']); //Nama Responder
            $('#reqModal input#date').val(req[0]['update_at']); //Tanggal Respon
            $('#reqModal textarea#note').val(req[0]['req_note']); //Catatan Request
            $('#reqModal input#req_link').val(req[0]['req_link']); //Link Unduh
            $('#reqModal #req_link_btn').attr("href", req[0]['req_link']);
        });
    }

    // Detail request for uploader
    function showUploadReq(id) {
        $.get('http://localhost/project_/quarte_bca/uploader/detailReq/' + id, function (data) {
            var req = JSON.parse(data);
            $('#uploadreqModal input#upload_req_title').val(req[0]['req_title']); //Judul Request
            $('#uploadreqModal input#create_at').val(req[0]['created_at']); //Tanggal Request
            $('#uploadreqModal input#upload_startdate').val(req[0]['req_start']); //Awal Bulan
            $('#uploadreqModal input#upload_endate').val(req[0]['req_end']); //Akhir Bulan
            $('#uploadreqModal input#upload_answer_name').val(req[0]['requester_name']); //Nama Requester
            $('#uploadreqModal input#upload_date').val(req[0]['update_at']); //Tanggal Respon
            $('#uploadreqModal textarea#upload_note').val(req[0]['req_note']); //Catatan Request
            $('#uploadreqModal input#upload_req_link').val(req[0]['req_link']); //Link Unduh
            $('#uploadreqModal #upload_ req_link_btn').attr("href", req[0]['req_link']);
        });
    }


    // Detail chat for uploader
    function showUploadQna(id) {
        $.get('http://localhost/project_/quarte_bca/uploader/detailQna/' + id, function (data) {
            var qna = JSON.parse(data);
            console.log(qna);
            $('#uploadqnaModal input#produk').val(qna[0]['produk']); //produk
            $('#uploadqnaModal input#asker_name').val(qna[0]['asker_name']); //asker name
            $('#uploadqnaModal input#date').val(qna[0]['created_at']); //quest date
            $('#uploadqnaModal textarea#quest').val(qna[0]['question']); //quest
        });
    }
});