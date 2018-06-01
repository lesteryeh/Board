@extends('layouts.app') @section('content')
<div class="container">
    <!-- <div class="col-md-8">
            <div class="card">
                <div class="card-header"></div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                </div>
            </div>
        </div> -->
    <!-- <button class="btn btn-success sss" style="float: right" data-toggle="modal" data-target="#exampleModal">新增留言</button> -->
    <div class="clearfix"></div>
    @foreach ($info as $data)
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card" style="margin-top: 5px;">
                <!-- <button class="btn btn-primary" > test</button> -->
                <!-- <div class="clearfix"></div> -->
                <div class="card-header">
                    {{$UserData[$data['user_id']]['name']}}
                    <button class="btn btn-primary editmessage" data-toggle="modal" data-target="#exampleModal" textid="{{$data['id']}}" style="float: right"> 編輯留言</button>
                    <button class="btn btn-danger delmessage" deleteid="{{$data['id']}}" style="float: right"> 刪除留言</button>
                </div>
                <div class="card-body message{{$data['id']}}">{{$data['MessageInfo']}}</div>
            </div>
        </div>
    </div>
    @endforeach
    <!-- Button trigger modal -->
    <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
        Launch demo modal
    </button> -->
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">新增留言</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="/admin" id="newMessageForm">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <input type="hidden" name="UserID" value="{{ Auth::user()->id }}">
                        <textarea style="width: 440px; height: 350px;" name="Textinfo" id="Textinfo">
                        </textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <input type="submit" class="btn btn-primary" value="Save changes">
                    </div>
                </form>
                <form method="POST" action="/admin/edit" id="editMessageForm">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <input type="hidden" name="editUserID" value="{{ Auth::user()->id }}">
                        <input type="hidden" name="edittextID" id="edittextID" value="">
                        <textarea style="width: 440px; height: 350px;" name="editTextinfo" id="editTextinfo">
                        </textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <input type="submit" class="btn btn-primary" value="Save changes">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
jQuery(document).ready(function($) {

    // $("#exampleModal").modal("show");

    $(".sss").click(function() {
        $('#editMessageForm').hide();
        $('#editMessageForm').hide();
        $('#newMessageForm').show();
        $('#exampleModalLabel').text('新增留言');
    });


    $(".editmessage").click(function() {
        var $textid = $(this).attr('textid');
        var logs = $('.message' + $textid).text();
        // logs = logs.replace(new RegExp(" ", "g"), "");
        // logs = logs.replace(new RegExp("\n", "g"), "");
        // console.log(logs);
        // console.log($(this).attr('textid'));
        $('#edittextID').val($(this).attr('textid'));
        $('#exampleModalLabel').text('編輯留言');
        $('#editTextinfo').text(logs);
        $('#newMessageForm').hide();
        $('#editMessageForm').show();
    });

    $(".delmessage").click(function() {
        var DeleteID = $(this).attr('deleteid');
        $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });

        $.ajax({
            url: '/admin/del',
            data: { DeleteTextID: DeleteID },
            method: 'post',
            success: function(JsonObj) {
                var Result = jQuery.parseJSON(JsonObj);

                alert('刪除成功');
                // window.location.reload();
                var lasturl = '/admin';
                location.replace(lasturl);

            }
        });
    });


});

</script>
@endsection
