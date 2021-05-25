<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Zoom Meeting</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap.min.js"></script>
</head>
<body>
<div class="container">
    <div class="row" style="background: #bed95182">
        <div class="col-md-12">
            <h3 class="text-center"><a href="{{url('/')}}">ZOOM MEETING</a>
                @if(Auth::user()->id)
                    <a href="{{url('logout')}}" style="float: right;font-size: 15px">Logout</a>
                @else
                    <a href="{{url('login')}}" style="float: right;font-size: 15px"> &nbsp;&nbsp;Login</a>
                    <a href="{{url('register')}}" style="float: right;font-size: 15px">Register </a>
                @endif
            </h3>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-12">
            @if ($message = Session::get('error'))
                <div class="alert alert-danger alert-block text-center">
                    <strong>{{ $message }}</strong>
                </div>
            @endif
            @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block text-center">
                    <strong>{{ $message }}</strong>
                </div>
            @endif
        </div>
    </div>
    <div class="row" style="border:1px solid #eee; padding: 10px">
        <form class="form-inline" @if(isset($edit) && !empty($edit)) action="{{url('update/'.$edit->id)}}" @else action="{{url('save')}}" @endif method="post">
            @csrf
            <div class="row">
                <div class="col-md-3">
                        <label for="">Day</label>
                        <select class="form-control" id="" style="width: 80%" required name="meeting_day">
                            <option>Select Day</option>
                            <option @if(isset($edit) && !empty($edit)) @if($edit->meeting_day == 'Sunday') selected @endif @endif value="Sunday">Sunday</option>
                            <option @if(isset($edit) && !empty($edit)) @if($edit->meeting_day == 'Monday') selected @endif @endif value="Monday">Monday</option>
                            <option @if(isset($edit) && !empty($edit)) @if($edit->meeting_day == 'Tuesday') selected @endif @endif value="Tuesday">Tuesday</option>
                            <option @if(isset($edit) && !empty($edit)) @if($edit->meeting_day == 'Wednesday') selected @endif @endif value="Wednesday">Wednesday</option>
                            <option @if(isset($edit) && !empty($edit)) @if($edit->meeting_day == 'Thursday') selected @endif @endif value="Thursday">Thursday</option>
                            <option @if(isset($edit) && !empty($edit)) @if($edit->meeting_day == 'Friday') selected @endif @endif value="Friday">Friday</option>
                            <option @if(isset($edit) && !empty($edit)) @if($edit->meeting_day == 'Saturday') selected @endif @endif value="Saturday">Saturday</option>
                        </select>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="">Title</label>
                        <input type="text" id="" class="form-control mx-sm-3" placeholder="Zoom Title" required name="title" @if(isset($edit) && !empty($edit)) value="{{$edit->title}}" @endif>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="">ID/Link</label>
                        <input type="text" id="" class="form-control mx-sm-3" placeholder="ID/Zoom Link" required name="link" @if(isset($edit) && !empty($edit)) value="{{$edit->link}}" @endif>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label for="">Time</label>
                        <input type="text" id="" class="form-control mx-sm-3" placeholder="Meeting Time" name="time" @if(isset($edit) && !empty($edit)) value="{{$edit->meeting_time}}" @endif>
                    </div>
                </div>
            </div>
            <br>
            @if(isset($edit) && !empty($edit))
                @if(isset($edit->info) && !empty($edit->info))
                    <?php $info = unserialize($edit->info); ?>
                    <div class="row">
                        @foreach($info as $f)
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">Info</label>
                                    <input type="text" id="" class="form-control mx-sm-3" name="info[]"  value="{{$f}}">
                                </div>
                                <button class="btn-sm btn-danger remove" type="button">X</button>
                            </div>
                        @endforeach
                    </div>
                    <br>
                @endif
            @endif
            <div class="row" id="more">

            </div>
            <br>
            <div class="row">
                <div class="col-md-8"></div>
                <div class="col-md-2">
                    <button class="btn btn-warning btn-sm more" type="button">Add More Field</button>
                </div>
                <div class="col-md-1">
                    <button class="btn btn-primary btn-sm" type="submit"> @if(isset($edit) && !empty($edit)) Update @else Save @endif</button>
                </div>
            </div>
        </form>
    </div>
    <br>
    <div class="row">
        <div class="col-md-12" style="padding: 0px">
            <table class="table table-bordered text-center">
                <thead style="background: #f6f6f6" class="text-center">
                <tr>
                    <th scope="col" class="text-center">Day</th>
                    <th scope="col" class="text-center">Info</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>Sunday</td>
                    <td style="padding: 0">
                        <table>
                            <tr>
                                @foreach($Sunday as $d)
                                    <td style="border-right: 1px solid #ddd; padding-left: 5px; padding-right: 5px;width: 150px">
                                    <p>{{$d->meeting_time}}</p>
                                    <p>{{$d->title}}</p>
                                    @if(isset($d->info) && !empty($d->info))
                                        <?php $info = unserialize($d->info); ?>
                                        @foreach($info as $f)
                                            <p class="text-center">{{$f}}</p>
                                        @endforeach
                                    @endif
                                    <?php $link_array = explode(':', $d->link);
                                    if ($link_array[0] == 'https') {
                                    ?> <a href="{{$d->link}}" target="_blank">Zoom Link</a><?php
                                    }else{
                                    ?> <a href="https://us05web.zoom.us/j/{{$d->link}}?" target="_blank">Zoom Link</a><?php
                                    }?>
                                        <p>
                                            <a href="{{url('edit/'.$d->id)}}"><button class="btn-sm btn-warning btn">Edit </button></a>
                                            <a href="{{url('delete/'.$d->id)}}"><button class="btn-sm btn-danger btn">Delete </button></a>
                                        </p>
                                    </td>
                                @endforeach
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td>Monday</td>
                    <td style="padding: 0">
                        <table>
                            <tr>
                                @foreach($Monday as $d)
                                    <td style="border-right: 1px solid #ddd; padding-left: 5px; padding-right: 5px;width: 150px">
                                        <p>{{$d->meeting_time}}</p>
                                        <p>{{$d->title}}</p>
                                        @if(isset($d->info) && !empty($d->info))
                                            <?php $info = unserialize($d->info); ?>
                                            @foreach($info as $f)
                                                <p class="text-center">{{$f}}</p>
                                            @endforeach
                                        @endif
                                        <?php $link_array = explode(':', $d->link);
                                        if ($link_array[0] == 'https') {
                                        ?> <a href="{{$d->link}}" target="_blank">Zoom Link</a><?php
                                        }else{
                                        ?> <a href="https://us05web.zoom.us/j/{{$d->link}}?" target="_blank">Zoom Link</a><?php
                                        }?>
                                        <p>
                                            <a href="{{url('edit/'.$d->id)}}"><button class="btn-sm btn-warning btn">Edit </button></a>
                                            <a href="{{url('delete/'.$d->id)}}"><button class="btn-sm btn-danger btn">Delete </button></a>
                                        </p>
                                    </td>
                                @endforeach
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td>Tuesday</td>
                    <td style="padding: 0">
                        <table>
                            <tr>
                                @foreach($Tuesday as $d)
                                    <td style="border-right: 1px solid #ddd; padding-left: 5px; padding-right: 5px;width: 150px">
                                        <p>{{$d->meeting_time}}</p>
                                        <p>{{$d->title}}</p>
                                        @if(isset($d->info) && !empty($d->info))
                                            <?php $info = unserialize($d->info); ?>
                                            @foreach($info as $f)
                                                <p class="text-center">{{$f}}</p>
                                            @endforeach
                                        @endif
                                        <?php $link_array = explode(':', $d->link);
                                        if ($link_array[0] == 'https') {
                                        ?> <a href="{{$d->link}}" target="_blank">Zoom Link</a><?php
                                        }else{
                                        ?> <a href="https://us05web.zoom.us/j/{{$d->link}}?" target="_blank">Zoom Link</a><?php
                                        }?>
                                        <p>
                                            <a href="{{url('edit/'.$d->id)}}"><button class="btn-sm btn-warning btn">Edit </button></a>
                                            <a href="{{url('delete/'.$d->id)}}"><button class="btn-sm btn-danger btn">Delete </button></a>
                                        </p>
                                    </td>
                                @endforeach
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td>Wednesday</td>
                    <td style="padding: 0">
                        <table>
                            <tr>
                                @foreach($Wednesday as $d)
                                    <td style="border-right: 1px solid #ddd; padding-left: 5px; padding-right: 5px;width: 150px">
                                        <p>{{$d->meeting_time}}</p>
                                        <p>{{$d->title}}</p>
                                        @if(isset($d->info) && !empty($d->info))
                                            <?php $info = unserialize($d->info); ?>
                                            @foreach($info as $f)
                                                <p class="text-center">{{$f}}</p>
                                            @endforeach
                                        @endif
                                        <?php $link_array = explode(':', $d->link);
                                        if ($link_array[0] == 'https') {
                                        ?> <a href="{{$d->link}}" target="_blank">Zoom Link</a><?php
                                        }else{
                                        ?> <a href="https://us05web.zoom.us/j/{{$d->link}}?" target="_blank">Zoom Link</a><?php
                                        }?>
                                        <p>
                                            <a href="{{url('edit/'.$d->id)}}"><button class="btn-sm btn-warning btn">Edit </button></a>
                                            <a href="{{url('delete/'.$d->id)}}"><button class="btn-sm btn-danger btn">Delete </button></a>
                                        </p>
                                    </td>
                                @endforeach
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td>Thursday</td>
                    <td style="padding: 0">
                        <table>
                            <tr>
                                @foreach($Thursday as $d)
                                    <td style="border-right: 1px solid #ddd; padding-left: 5px; padding-right: 5px;width: 150px">
                                        <p>{{$d->meeting_time}}</p>
                                        <p>{{$d->title}}</p>
                                        @if(isset($d->info) && !empty($d->info))
                                            <?php $info = unserialize($d->info); ?>
                                            @foreach($info as $f)
                                                <p class="text-center">{{$f}}</p>
                                            @endforeach
                                        @endif
                                        <?php $link_array = explode(':', $d->link);
                                        if ($link_array[0] == 'https') {
                                        ?> <a href="{{$d->link}}" target="_blank">Zoom Link</a><?php
                                        }else{
                                        ?> <a href="https://us05web.zoom.us/j/{{$d->link}}?" target="_blank">Zoom Link</a><?php
                                        }?>
                                        <p>
                                            <a href="{{url('edit/'.$d->id)}}"><button class="btn-sm btn-warning btn">Edit </button></a>
                                            <a href="{{url('delete/'.$d->id)}}"><button class="btn-sm btn-danger btn">Delete </button></a>
                                        </p>
                                    </td>
                                @endforeach
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td>Friday</td>
                    <td style="padding: 0">
                        <table>
                            <tr>
                                @foreach($Friday as $d)
                                    <td style="border-right: 1px solid #ddd; padding-left: 5px; padding-right: 5px;width: 150px">
                                        <p>{{$d->meeting_time}}</p>
                                        <p>{{$d->title}}</p>
                                        @if(isset($d->info) && !empty($d->info))
                                            <?php $info = unserialize($d->info); ?>
                                            @foreach($info as $f)
                                                <p class="text-center">{{$f}}</p>
                                            @endforeach
                                        @endif
                                        <?php $link_array = explode(':', $d->link);
                                        if ($link_array[0] == 'https') {
                                        ?> <a href="{{$d->link}}" target="_blank">Zoom Link</a><?php
                                        }else{
                                        ?> <a href="https://us05web.zoom.us/j/{{$d->link}}?" target="_blank">Zoom Link</a><?php
                                        }?>
                                        <p>
                                            <a href="{{url('edit/'.$d->id)}}"><button class="btn-sm btn-warning btn">Edit </button></a>
                                            <a href="{{url('delete/'.$d->id)}}"><button class="btn-sm btn-danger btn">Delete </button></a>
                                        </p>
                                    </td>
                                @endforeach
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td>Saturday</td>
                    <td style="padding: 0">
                        <table>
                            <tr>
                                @foreach($Saturday as $d)
                                    <td style="border-right: 1px solid #ddd; padding-left: 5px; padding-right: 5px;width: 150px">
                                        <p>{{$d->meeting_time}}</p>
                                        <p>{{$d->title}}</p>
                                        @if(isset($d->info) && !empty($d->info))
                                            <?php $info = unserialize($d->info); ?>
                                            @foreach($info as $f)
                                                <p class="text-center">{{$f}}</p>
                                            @endforeach
                                        @endif
                                        <?php $link_array = explode(':', $d->link);
                                        if ($link_array[0] == 'https') {
                                        ?> <a href="{{$d->link}}" target="_blank">Zoom Link</a><?php
                                        }else{
                                        ?> <a href="https://us05web.zoom.us/j/{{$d->link}}?" target="_blank">Zoom Link</a><?php
                                        }?>
                                        <p>
                                            <a href="{{url('edit/'.$d->id)}}"><button class="btn-sm btn-warning btn">Edit </button></a>
                                            <a href="{{url('delete/'.$d->id)}}"><button class="btn-sm btn-danger btn">Delete </button></a>
                                        </p>
                                    </td>
                                @endforeach
                            </tr>
                        </table>
                    </td>
                </tr>

{{--                @foreach($data as $d)--}}
{{--                    <tr>--}}
{{--                        <td>{{$d->meeting_day}}</td>--}}
{{--                        <td>--}}
{{--                            <p>{{$d->meeting_time}}</p>--}}
{{--                            <p>{{$d->title}}</p>--}}
{{--                            @if(isset($d->info) && !empty($d->info))--}}
{{--                                <?php $info = unserialize($d->info); ?>--}}
{{--                                @foreach($info as $f)--}}
{{--                                    <p class="text-center">{{$f}}</p>--}}
{{--                                @endforeach--}}
{{--                            @endif--}}
{{--                            <?php $link_array = explode(':', $d->link);--}}
{{--                            if ($link_array[0] == 'https') {--}}
{{--                                ?> <a href="{{$d->link}}" target="_blank">Zoom Link</a><?php--}}
{{--                            }else{--}}
{{--                                ?> <a href="https://us05web.zoom.us/j/{{$d->link}}?" target="_blank">Zoom Link</a><?php--}}
{{--                            }?>--}}

{{--                        </td>--}}

{{--                        <td>--}}
{{--                            <a href="{{url('edit/'.$d->id)}}"><button class="btn-sm btn-warning btn">Edit </button></a>--}}
{{--                            <a href="{{url('delete/'.$d->id)}}"><button class="btn-sm btn-danger btn">Delete </button></a>--}}
{{--                        </td>--}}
{{--                    </tr>--}}
{{--                @endforeach--}}
                </tbody>
            </table>
        </div>
    </div>

</div>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js" ></script>
<script>
    $('.more').click(function (){
        var text_data = '<div class="col-md-3" style="padding-bottom: 15px">' +
                '<div class="form-group">' +
                    '<label for="">Info</label>' +
                    '<input type="text" id="" name="info[]" class="form-control mx-sm-3">' +
                '</div>' +
                '<button class="btn-sm btn-danger remove" type="button">X</button>' +
            '</div>';
        $('#more').append(text_data);

    });
    $(document).on("click", ".remove", function() {
        $(this).parent().remove();
    });
</script>
</body>
</html>
