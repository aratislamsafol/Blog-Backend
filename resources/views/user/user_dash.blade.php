<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Post</title>
</head>
<body>
    <h5 style="text-align: center; padding:30px">All Post</h5>

    @php
        $post=App\Post::latest()->get();
    @endphp


    @foreach ($post as $row)
    <div class="card-group" style="padding:10px">
        <div class="card">
          <img src="{{asset($row->post_img)}}" style="height: 80px; width:80px" class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title">{{$row->post_title}}</h5>
            <p class="card-text">{{$row->post_details}}</p>
          </div>
          <div class="card-footer">
            <small class="text-muted">{{$row->created_at}}</small>
          </div>
          {{-- @guest --}}
          <div class="card-footer">
            <h4>Comment</h4>
            <div class="form-floating">

                <form action="{{route('add.comment',$row->id)}}" method="post">
                    @csrf
                    <input type="hidden" name="post_id_get" value="{{$row->id}}">
                    <textarea class="form-control" name="comment_text" placeholder="Leave a comment here" id="floatingTextarea"></textarea>
                    <button type="submit" class="mt-3">Save</button>
                </form>
            </div>

            @php
                $comment=App\Comment::where('post_id',$row->id)->latest()->get();
            @endphp
            @foreach ($comment as $comt)
            <div class="form-floating mb-3 mt-2">
                <input type="text" class="form-control" id="floatingInput" value="{{$comt->comment_text}}" >
                <label for="floatingInput">{{$comt->user->role->role_name}}: {{$comt->user->name}}</label>
                @if (Auth::check() && $comt->user_id==Auth::user()->id)
                    <a href="{{route('comment.edit',$comt->id)}}">Edit</a>
                    <a href="{{route('comment.del',$comt->id)}}">Delete</a>
                @endif

            </div>
            @endforeach
            {{-- @endguest --}}
          </div>
        </div>
      </div>
      @endforeach

      <!-- Latest compiled and minified JavaScript -->
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>
